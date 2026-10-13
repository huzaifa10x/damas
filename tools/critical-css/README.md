# Critical CSS for the homepage

The homepage paints its first screen from a small CSS file inlined in `<head>` (`frontend/web/css/critical-home.css`,
~47 KB, ~8 KB gzipped) instead of waiting for ~860 KB of stylesheets. The full CSS then arrives as one combined
file (`frontend/web/css/main.bundle.css`) without blocking.

Measured on the live homepage HTML (Lighthouse mobile, median of 5): score 86 → 91, FCP 1.7 s → 1.0 s,
LCP 2.9 s → 2.3 s, Speed Index 2.2 s → 1.9 s, CLS unchanged (0.001).

## When to rebuild

After changing any of: `frontend/web/lib/bootstrap-5.3.2.min.css`, `frontend/web/css/app.min.css`,
`frontend/web/css/style.css`, or the homepage / layout markup above the fold.

If you forget, nothing breaks: both generated files contain a fingerprint of those three stylesheets, and
`frontend/components/CriticalCss.php` falls back to normal blocking stylesheets when the fingerprint no longer
matches. You only lose the speed-up until you rebuild.

## How to rebuild

1. Run the site locally with the new CSS (see LOCAL_SETUP.md), e.g. http://localhost:8080/en
2. Once: `pip3 install playwright && python3 -m playwright install chromium`
3. From the project root:
   ```bash
   python3 tools/critical-css/build.py http://localhost:8080/en
   ```
4. Upload `frontend/web/css/critical-home.css` and `frontend/web/css/main.bundle.css`
   (plus the changed source CSS), then delete `frontend/runtime/cache/` on the server.

The script checks 5 screen sizes (360 px phone to 1920 px desktop) in English and Arabic, keeps every CSS rule
that styles something on the first screen (plus 200 px below it), and keeps the rules that hide closed menus and
modals so they never flash open.
