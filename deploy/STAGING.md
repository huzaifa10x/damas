# Staging copy on bk.damasmc.com (same cPanel server as the live site)

Use the **same cPanel server**, not Hostinger, if the goal is to compare speed: same CPU, MySQL, PHP and network,
so the PageSpeed difference between `damasmc.com` and `bk.damasmc.com` is caused by the code changes alone.
(Hostinger works for checking that pages load, but its numbers can't be compared with the live site.)

The staging copy uses its **own copy of the database**, sends **no emails** (they're saved to files),
and is **noindex** (header + robots.txt). The page canonical tags already point to https://damasmc.com.

---

## 1. Build the upload ZIP (on your Mac)

```bash
cd ~/Downloads/damas
bash deploy/build-staging.sh
```
Creates `~/Downloads/damas-staging.zip`: code + `vendor/` built for PHP 8.2, production `index.php` (debug off),
no Docker files, no `uploads/` (copied on the server in step 4, it's ~800 MB).

## 2. Create the subdomain (cPanel)

1. **Domains → Create A New Domain** → `bk.damasmc.com`
2. Untick "Share document root" and set **Document Root** to `bk.damasmc.com` (i.e. `/home/CPANELUSER/bk.damasmc.com`).
   It points at the project root, exactly like `public_html` does for the live site, so `/web-admin` works the same way.
3. **MultiPHP Manager** → set `bk.damasmc.com` to **PHP 8.2** (same as live).
4. **SSL/TLS Status** → **Run AutoSSL** (the site forces HTTPS, so it needs a certificate).
   If DNS is not managed in this cPanel (e.g. Cloudflare), first add an `A` record `bk` → the server IP shown in cPanel.

## 3. Upload the code

**File Manager** → open `/home/CPANELUSER/bk.damasmc.com` → **Upload** `damas-staging.zip` → right-click → **Extract** → delete the zip.
Turn on **Settings → Show Hidden Files** and check `.htaccess` is there.

## 4. Copy the images from the live site (server-side, no download)

File Manager → `public_html/frontend/web/` → right-click **uploads** → **Copy** →
destination `/bk.damasmc.com/frontend/web/` (it lands as `bk.damasmc.com/frontend/web/uploads`).
If the extracted zip already created an empty `uploads` folder, delete it first.

## 5. Database copy

1. **MySQL Databases** → create database `bkdamas` and user `bkdamas` (cPanel prefixes both: `CPANELUSER_bkdamas`) → **Add user to database → ALL PRIVILEGES**.
2. **phpMyAdmin** → live database → **Export** (Quick, SQL) → then select `CPANELUSER_bkdamas` → **Import** that file.
   Large file? Export with gzip compression ticked; phpMyAdmin imports `.sql.gz` directly.
3. File Manager → edit `bk.damasmc.com/common/config/main-local.php` → put in the database name, user and password.

## 6. Permissions

Folders `frontend/runtime`, `backend/runtime`, `console/runtime`, `frontend/web/assets`, `backend/web/assets`
must be writable: right-click → **Change Permissions** → **755** (use 775 if pages show "not writable").

## 7. Test

- https://bk.damasmc.com/en and /ar, a department page, a doctor page, offers.
- Booking form: submit once with a wrong date (red message should appear), once correctly → the "email" appears as a file in `frontend/runtime/mail/`.
- https://bk.damasmc.com/web-admin → edit a word (e.g. "Book Now") → reload the site: the change shows immediately.
- PageSpeed: run https://bk.damasmc.com/en and https://damasmc.com/en a few times each, mobile, and compare the **lab** section.
  First visit to each page builds the cache, so load each page once before testing.

## Updating staging later

Re-run `bash deploy/build-staging.sh`, upload and extract over the folder, **but don't overwrite**
`common/config/main-local.php` (or re-enter the DB password). Then delete `bk.damasmc.com/frontend/runtime/cache/`.

## Before removing staging

Delete the subdomain in **Domains** and the `CPANELUSER_bkdamas` database: it contains patient enquiries.

## Note on tracking

The staging pages still contain the Meta, TikTok, Snap and Clarity pixels, so test visits are counted there.
For a short test that's harmless; for longer use, filter `bk.damasmc.com` out in those tools.
