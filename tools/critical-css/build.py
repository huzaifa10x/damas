#!/usr/bin/env python3
"""
Builds the two files the homepage uses for fast first paint:

  frontend/web/css/main.bundle.css   bootstrap + app.min.css + style.css in one file (loaded without blocking)
  frontend/web/css/critical-home.css the CSS needed for the first screen (inlined in <head>)

Usage (from the project root, with the site running locally WITH THE CURRENT CSS, e.g. Docker):

  pip install playwright && python3 -m playwright install chromium     # once
  python3 tools/critical-css/build.py http://localhost:8080/en

Both files start with a fingerprint of the three source stylesheets. frontend/components/CriticalCss.php
compares it on every request: if any source CSS changed since this script ran, the site automatically falls
back to normal (blocking) stylesheets, so a forgotten rebuild costs speed, never a broken page.
"""
import hashlib
import os
import re
import sys
from urllib.parse import urlparse

ROOT = os.path.abspath(os.path.join(os.path.dirname(__file__), '..', '..'))
WEB = os.path.join(ROOT, 'frontend', 'web')
SOURCES = ['lib/bootstrap-5.3.2.min.css', 'css/app.min.css', 'css/style.css']  # cascade order, = CriticalCss::SOURCES
NON_CRITICAL = re.compile(r'vendor-async|fancybox|owl\.carousel|main\.bundle')   # already load without blocking

# Viewports checked: phones, tablet, laptop, desktop. Each in LTR (en) and RTL (ar).
VIEWPORTS = [(360, 740, True), (412, 823, True), (768, 1024, True), (1350, 940, False), (1920, 1080, False)]
FOLD_MARGIN = 200  # px below the first screen also styled (sections cut by the fold)

EXTRACT_JS = r"""
({fold, skip}) => {
  const vh = window.innerHeight + fold;
  const DYN = /:(hover|focus|focus-visible|focus-within|active|visited|checked|disabled|enabled|invalid|valid|placeholder-shown|indeterminate|target|autofill|-webkit-autofill|read-only|read-write)\b/g;
  const PSEUDO_EL = /::?(before|after|placeholder|selection|marker|backdrop|-webkit-[a-z-]+|-moz-[a-z-]+|-ms-[a-z-]+|first-letter|first-line|file-selector-button)\b/g;
  const skipRe = new RegExp(skip);
  const inFold = (el) => {
    if (el === document.documentElement || el === document.body) return true;
    if (el.getClientRects().length === 0) {
      // Not rendered: keep only the element that hides the subtree (its parent IS rendered) — e.g. .modal{display:none}
      const p = el.parentElement;
      return !!p && (p === document.body || p.getClientRects().length > 0) && p.getBoundingClientRect().top < vh;
    }
    return el.getBoundingClientRect().top < vh;
  };
  const cache = new Map();
  const selMatches = (sel) => {
    if (cache.has(sel)) return cache.get(sel);
    let ok = false;
    for (let part of sel.split(/,(?![^(]*\))/)) {
      let p = part.replace(PSEUDO_EL, '').replace(DYN, '').replace(/:not\(\s*\)/g, '').trim().replace(/[>+~]\s*$/, '').trim();
      if (!p) { ok = true; break; }
      let els;
      try { els = document.querySelectorAll(p); } catch (e) { ok = true; break; }
      for (const el of els) { if (inFold(el)) { ok = true; break; } }
      if (ok) break;
    }
    cache.set(sel, ok);
    return ok;
  };
  const out = [];
  const walk = (rules, path, wrappers, src) => {
    for (let i = 0; i < rules.length; i++) {
      const r = rules[i], key = path.concat(i);
      if (r.type === CSSRule.STYLE_RULE) { if (selMatches(r.selectorText)) out.push([src, key, wrappers, r.cssText]); }
      else if (r.type === CSSRule.MEDIA_RULE) walk(r.cssRules, key, wrappers.concat(['@media ' + r.conditionText]), src);
      else if (r.type === CSSRule.SUPPORTS_RULE) walk(r.cssRules, key, wrappers.concat(['@supports ' + r.conditionText]), src);
      else if (r.type === CSSRule.FONT_FACE_RULE || r.type === CSSRule.KEYFRAMES_RULE) out.push([src, key, wrappers, r.cssText]);
    }
  };
  for (const s of document.styleSheets) {
    if (!s.href || skipRe.test(s.href)) continue;
    const src = s.href.replace(/[?#].*$/, '');
    try { walk(s.cssRules, [], [], src); } catch (e) {}
  }
  return out;
}
"""


def md5_file(path):
    h = hashlib.md5()
    with open(path, 'rb') as f:
        for chunk in iter(lambda: f.read(1 << 20), b''):
            h.update(chunk)
    return h.hexdigest()


def signature():
    # Same formula as CriticalCss::sourceSignature(): md5 of the concatenated md5 of each source file
    return hashlib.md5(''.join(md5_file(os.path.join(WEB, s)) for s in SOURCES).encode()).hexdigest()


def build_bundle(sig):
    parts = ['/*bundle-src:%s*/' % sig]
    for s in SOURCES:
        with open(os.path.join(WEB, s), encoding='utf-8') as f:
            # @charset is only valid as the very first bytes of a file; the bundle is served as UTF-8 anyway
            parts.append(re.sub(r'^\ufeff?@charset "[^"]*";', '', f.read()))
    out = os.path.join(WEB, 'css', 'main.bundle.css')
    with open(out, 'w', encoding='utf-8') as f:
        f.write('\n'.join(parts))
    return out


def minify(css):
    css = re.sub(r'/\*.*?\*/', '', css, flags=re.S)
    css = re.sub(r'\s+', ' ', css)
    css = re.sub(r'\s*([{};,>])\s*', r'\1', css)   # never touch ':' — "a :not(x)" and "a:not(x)" differ
    return css.replace(';}', '}').strip()


def extract(url):
    from playwright.sync_api import sync_playwright
    host = urlparse(url).netloc
    order = {}   # source url -> position in SOURCES (keeps cascade order bootstrap < app < style)
    found = {}
    with sync_playwright() as p:
        browser = p.chromium.launch()
        for (w, h, mobile) in VIEWPORTS:
            for rtl in (False, True):
                ctx = browser.new_context(viewport={'width': w, 'height': h}, is_mobile=mobile, has_touch=mobile)
                page = ctx.new_page()
                # First paint happens before any script runs, and third-party requests are irrelevant
                page.route('**/*', lambda r: r.abort() if (r.request.resource_type == 'script' or urlparse(r.request.url).netloc != host) else r.continue_())
                page.goto(url.replace('/en', '/ar') if rtl and '/en' in url else url, wait_until='load')
                # Make sure the FULL stylesheets are applied (the page itself may be in critical mode)
                page.evaluate("""() => {
                    document.querySelectorAll('link[media=print]').forEach(l => l.media = 'all');
                    const crit = document.getElementById('critical-css'); if (crit) crit.remove();
                }""")
                page.wait_for_timeout(500)
                if rtl and '/en' not in url:
                    page.evaluate("() => { document.documentElement.lang = 'ar'; document.documentElement.dir = 'rtl'; }")
                for src, key, wrappers, text in page.evaluate(EXTRACT_JS, {'fold': FOLD_MARGIN, 'skip': NON_CRITICAL.pattern}):
                    name = next((s for s in SOURCES if src.endswith('/' + s) or src.endswith(s.split('/')[-1])), None)
                    if name is None and src.endswith('main.bundle.css'):
                        name = 'css/main.bundle.css'
                    if name is None:
                        continue
                    order.setdefault(name, len(order))
                    found[(SOURCES.index(name) if name in SOURCES else 0, tuple(key))] = (wrappers, text)
                ctx.close()
        browser.close()
    css = []
    for k in sorted(found):
        wrappers, text = found[k]
        for w in reversed(wrappers):
            text = w + '{' + text + '}'
        css.append(text)
    css = '\n'.join(css)
    # Inlined in the HTML, so relative ../fonts and ../images must become absolute
    return re.sub(r'url\((["\']?)\.\./(fonts|images)/', r'url(\1/\2/', css)


def main():
    if len(sys.argv) != 2:
        print(__doc__)
        sys.exit(1)
    sig = signature()
    bundle = build_bundle(sig)
    print('bundle   ', os.path.relpath(bundle, ROOT), os.path.getsize(bundle), 'bytes')
    css = minify(extract(sys.argv[1]))
    if len(css) < 5000:
        sys.exit('Critical CSS is only %d bytes — the page probably did not load its stylesheets. Not writing.' % len(css))
    out = os.path.join(WEB, 'css', 'critical-home.css')
    with open(out, 'w', encoding='utf-8') as f:
        f.write('/*critical-src:%s*/' % sig + css)
    print('critical ', os.path.relpath(out, ROOT), len(css), 'bytes')
    print('signature', sig)


if __name__ == '__main__':
    main()
