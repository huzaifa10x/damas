# damasmc.com — project guide, problems found, and what was changed

## 1. How the project is organised

It is a standard **Yii2 Advanced** application: one codebase, two websites (public site + admin panel) that share their models.

```
damas/
├── common/            Shared by the website and the admin panel
│   ├── config/        main.php (cache, components), params.php (emails, payment keys)
│   │                  main-local.php  ← DB password, NOT in git, created per server
│   ├── models/        One class per database table (Departments, Doctors, Words, About …)
│   ├── components/    Helpers: AppointmentForm, SetValues (sends booking emails),
│   │                  ContentCache + SafePageCache (new, see section 3)
│   └── mail/          Email templates
│
├── frontend/          THE PUBLIC WEBSITE  (https://damasmc.com/en, /ar)
│   ├── config/main.php   URL rules (/en/about-us → site/about …), asset settings
│   ├── controllers/      SiteController = almost every page; Ajax/Cart/Checkout = shop
│   ├── views/layouts/main.php   Header, mega-menu, footer, booking modal, all <head> tags
│   ├── views/site/*.php  One file per page (index.php = homepage)
│   └── web/              The only public folder: index.php, css/, js/, images/, uploads/,
│                         lib/ (self-hosted libraries, new)
│
├── backend/           THE ADMIN PANEL  (https://damasmc.com/web-admin)
│   ├── controllers/      One CRUD controller per content type
│   └── views/            Admin screens
│
├── console/           Command-line tasks (only the default user migrations)
├── environments/      Templates that `php init` copies into place (index.php, *-local.php)
├── landing/, landing.damasmc.com/   A separate landing-page site (119 MB, not part of Yii)
└── .htaccess          Production routing: /web-admin → backend/web, everything else → frontend/web
```

### What happens when someone opens https://damasmc.com/en

1. Apache (`.htaccess` in the root) rewrites the request into `frontend/web/`.
2. `frontend/web/.htaccess` sends anything that is not a real file to `frontend/web/index.php`.
3. `index.php` loads the configs and starts Yii. The URL rule `'<language>' => 'site/index'` picks **SiteController::actionIndex()**.
4. The action loads banners, departments, doctors, offers, insurance, testimonials and reviews from MySQL and renders **views/site/index.php**.
5. That HTML is wrapped in **views/layouts/main.php** (header, mega-menu, footer, booking modal).
6. Every piece of UI text ("Book Now", "About Us" …) comes from `Words::getValue()` (table `words`, English + Arabic). Editable blocks come from `About::getValue()` (table `about`).

To change a page: find its route in `frontend/config/main.php` → the action in `SiteController.php` → the view in `views/site/`. Shared header/footer: `views/layouts/main.php`.

---

## 2. Problems found (measured on a local copy, homepage)

### A. The repository is not what is running on the live site
The live homepage loads `images/logo (1).webp`, banners like `home_banner_mob30b4def9…webp` and three counters. None of those files exist in this repo, and the repo's layout renders `logo.svg` and four counters. Changes made in one place have not been reaching the other. **Before uploading anything, download `frontend/`, `common/`, `backend/` from cPanel and compare them with the repo** (WinMerge or `git diff --no-index`).

### B. Server time (TTFB 1.2 s on mobile, real users)
| Cause | Measured |
|---|---|
| `Words::getValue()` ran one SELECT **per label**; the layout calls it 39×, the homepage 27×, more inside loops | ~95 queries |
| `About::getValue()` same pattern | ~12 queries |
| No DB schema cache: every model runs `SHOW FULL COLUMNS` + `SHOW CREATE TABLE` on every request | ~30 queries |
| **Total for one homepage view** | **139 queries** |
| `AppAsset` registered `css/site.css`, which does not exist. Every page view requested it, Apache passed the miss to Yii, which rendered a full error page | **+67 queries and an HTTP 500 per visit** |
| No page caching at all | every visitor = full render |
| The layout cache comment said "clear from admin afterSave()" but nothing did, and frontend/backend used **different cache folders**, so admin edits could not clear it | stale menu up to 1 h |

### C. Render path (FCP 2.8 s, Speed Index)
- Render-blocking CSS from **three origins** (jsdelivr Bootstrap, own `app.min.css`, cdnjs Owl): each extra origin costs DNS + TCP + TLS before the first paint on mobile.
- `css/app.min.css` is **626 KB (64 KB gzipped) for every page**: 5,086 rules and 2,662 media-query blocks covering all 30 page types.
- ~110 KB of JS that nothing uses: **GSAP, ScrollTrigger, AOS, bootstrap-select**.
- `logo.svg` was preloaded with high priority, competing with the hero image (the LCP element).
- Static files that do not exist (`images/map-thumb.jpg` on every page, `images/doctorsBg.jpg` on department/service pages) each triggered a full Yii request.

### D. Broken inner pages in the repo code
jQuery is printed at the **end** of `<body>`, but 18 page views that use this layout (department-details, service-details, about, gallery, blogs, testimonial, product-details …) print their own synchronous `<script>` tags **inside the page body**, i.e. before jQuery exists. Their Owl sliders, select2 and inline `$(...)` code throw *"$ is not defined"*.

### E. Security issues to fix soon
- `frontend/web/error_log` (7.7 MB, 48,000 lines) and `backend/web/error_log` were publicly downloadable; they expose server paths. **Delete them on the server too.**
- `info.php` (phpinfo) in the project root.
- `common/config/params.php` contains the payment gateway `liveAuthKey` / `liveStoreId` and is committed to git. Move them to `params-local.php` and rotate the key.
- CSRF protection is disabled in every frontend controller (`enableCsrfValidation = false`).
- `backend/config/main.php` enables the **gii** code generator in production config.

---

## 3. What was changed

| File | Change | Why |
|---|---|---|
| `common/models/Words.php` | Whole `words` table read **once**, cached, served from memory. Same results (first row wins, case-insensitive like MySQL) | −95 queries |
| `common/models/About.php` | Same for `about` | −12 queries |
| `common/config/main.php` | One **shared cache** folder (`frontend/runtime/cache`) for frontend + backend; **DB schema cache** on (off when `YII_DEBUG`) | −30 queries; lets admin clear frontend cache |
| `common/components/ContentCache.php` *(new)* | One cache tag for all content caches | |
| `common/components/SafePageCache.php` *(new)* | Page cache that only stores HTTP 200 pages | a DB hiccup never gets cached |
| `backend/config/bootstrap.php` | Any admin insert/update/delete (and any admin POST) clears the content cache | edits show on the site immediately |
| `frontend/config/main.php` | Removed the separate frontend cache definition | uses the shared one |
| `frontend/controllers/SiteController.php` | **Full-page cache** for 19 public pages (not the ad landing pages, whose layout shows a per-visitor booking popup): GET only, skipped while the visitor has a pending flash message. Cache key ignores ad-tracking parameters (`gclid`, `fbclid`, `utm_*` …) so ad clicks share one cached page; unknown one-segment URLs (`/xyz`) are never cached | cached hit = **0 queries** |
| `frontend/views/layouts/main.php` | Booking forms' hidden `page_url` is filled in the browser with the visitor's real URL (keeps utm/gclid attribution with cached pages); libraries self-hosted; unused GSAP/ScrollTrigger/AOS/bootstrap-select removed; logo preload removed; page scripts moved after jQuery (fixes D); map thumbnail only rendered if the file exists; layout cache tied to admin invalidation | fewer origins, ~110 KB less JS |
| `frontend/views/site/index.php` | Owl/WOW/touchSwipe as one local deferred file; Fancybox loaded after `window.load` | 3 cdnjs requests → 1 local |
| `frontend/assets/AppAsset.php` | Removed missing `css/site.css` and duplicate `app.min.css` | −1 PHP request per visit |
| `frontend/web/lib/` *(new)* | jQuery 3.7.0, Bootstrap 5.3.2, select2 4.0.13, flatpickr 4.6.13, toastr 2.1.4, animate.css 4.1.1, vanilla-lazyload 17.8.3, Owl 2.3.4, WOW 1.1.3, touchSwipe 1.6.19, Fancybox 3.5.6 — byte-identical to the CDN files (SRI hashes match) | |
| `frontend/web/.htaccess` | Missing images/CSS/JS/fonts return a plain Apache 404 instead of booting Yii; `error_log`, `.map`, `.user.ini` blocked | |
| `department-details.php`, `service-details.php` | `doctorsBg.jpg` (missing) → `doctorsBg.webp` | |
| Deleted | `frontend/web/error_log`, `backend/web/error_log`, `info.php` | security |
| New | `docker-compose.local.yml`, `docker/`, `LOCAL_SETUP.md` | local setup |

### Measured result (local copy, homepage `/en`)
| | Before | After, first render | After, cached |
|---|---|---|---|
| DB queries | 139 (+67 for the site.css 404) | 12 | **0** |
| PHP requests per page view | 2 | 1 | 1 |
| Render-blocking origins | 3 | 1 | 1 |

Page content was compared before/after: identical except the removed logo `fetchpriority` and the missing-map thumbnail.

---

## 4. How to deploy (cPanel, upload only)

1. **Back up** `public_html` (cPanel → Backup, or compress and download `frontend/`, `common/`, `backend/`).
2. **Compare first** (problem A). If the live `layouts/main.php`, `site/index.php` or `SiteController.php` differ from the repo, apply the changes from section 3 to the live versions instead of overwriting them. These files can be uploaded as-is regardless: `common/models/Words.php`, `common/models/About.php`, `common/components/ContentCache.php`, `common/components/SafePageCache.php`, `backend/config/bootstrap.php`, `frontend/assets/AppAsset.php`, `frontend/web/.htaccess`, the whole `frontend/web/lib/` folder.
3. In `common/config/main.php` on the server, replace the `cache` entry and add the `db` entry exactly as in the repo version.
4. Check `frontend/web/index.php` on the server says `define('YII_DEBUG', false)` and `define('YII_ENV', 'prod')`. With debug on, the page cache and schema cache stay off.
5. Make sure `frontend/runtime/` is writable (755/775), then delete `frontend/runtime/cache/` once.
   **Rule from now on:** delete `frontend/runtime/cache/` (cPanel File Manager) after every deploy, after emptying `frontend/web/assets/`, and after any table/column change in phpMyAdmin. Cached pages contain the `/assets/<hash>/` script URLs and the schema cache holds the old column list for up to 24 h. Admin-panel content edits do NOT need this — they clear the cache automatically.
   If the server's `common/config/main-local.php` or `frontend|backend/config/main-local.php` define their own `'cache'`, remove it, otherwise admin edits clear a different cache than the site reads.
6. Delete `frontend/web/error_log`, `backend/web/error_log`, `info.php` on the server.
7. Test: homepage EN/AR, a department page, a doctor page, booking form (valid + invalid), the admin panel. Edit a word in the admin and confirm it appears on the site immediately.
8. Run PageSpeed again. Field data (the top section) needs 28 days to catch up; judge by the lab section first.

**Rollback:** re-upload the backup files and delete `frontend/runtime/cache/`.

---

## 5. Next steps (not done yet, in order of payoff)

1. **Split `app.min.css` per page** (it is compiled from `frontend/web/sass/`; `4-layouts/` already has one partial per page). Build `common.css` + `home.css` etc. and inline the homepage's above-the-fold rules. This is the biggest remaining FCP/Speed Index win.
2. **Inner pages** still load their own cdnjs/jsdelivr scripts, including a second select2 (4.1 slim) on top of the layout's 4.0.13. Now that their scripts run after jQuery (fix D), their sliders/selects work again and 4.1 replaces 4.0.13 on those pages (selects may look slightly different there). Convert them the same way as the homepage and drop the duplicate select2.
3. Remove `js/app.min.js` (SmoothScroll: wheel-hijacking library that adds a MutationObserver to `<body>`) unless the smooth wheel effect is wanted.
4. The 4 MB `#health` video and 9 MB hero MP4 in `uploads/home-banners/`: re-encode at 720p/1 Mbps.
5. Put Cloudflare in front of the site (free plan) for edge caching of `/lib`, `/css`, `/uploads`.
6. Fix the security items in section 2E.
