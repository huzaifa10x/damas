# Running damasmc.com locally

The project is a **Yii2 Advanced** app. Two things stop it running from a plain clone:

1. **`vendor/` is not in git.** It must be installed with Composer, and the installed packages need **PHP 8.2 or newer** (PHP 8.1 fails with *"Composer detected issues in your platform"*).
2. **The generated files are not in git**: `frontend/web/index.php`, `backend/web/index.php` and every `*-local.php` config (database password, cookie key). Yii's `init` command creates them.

The root `.htaccess` also forces HTTPS and contains a cPanel-only PHP handler, so pointing a local server at the project root gives redirect loops or downloads PHP source. The setups below avoid that.

---

## Option A — Docker (recommended, identical on Windows/macOS/Linux)

Requirements: Docker Desktop.

```bash
# 1. Get the code
git clone https://github.com/huzaifa10x/damas.git
cd damas

# 2. Put your database dump in docker/db/  (e.g. docker/db/damas.sql or damas.sql.gz)

# 3. Build and start (first start imports the dump — large dumps take a few minutes)
docker compose -f docker-compose.local.yml up -d --build

# 4. Watch the import finish (look for "ready for connections" after "running /docker-entrypoint-initdb.d")
docker compose -f docker-compose.local.yml logs -f db

# 5. Install vendor/, generate index.php + local configs, fix permissions, test the DB
docker compose -f docker-compose.local.yml exec app bash docker/setup.sh
```

Open:

| What | URL |
|---|---|
| Website (English) | http://localhost:8080/en |
| Website (Arabic) | http://localhost:8080/ar |
| Admin panel | http://localhost:8080/web-admin |
| phpMyAdmin | http://localhost:8082 — server `db`, user `damas`, password `damas` |
| MySQL from your PC (HeidiSQL, TablePlus…) | host `127.0.0.1`, port `3307`, user `damas`, password `damas` |

Everyday commands:

```bash
docker compose -f docker-compose.local.yml up -d      # start
docker compose -f docker-compose.local.yml down       # stop (data is kept)
docker compose -f docker-compose.local.yml down -v    # stop AND delete the database (re-imports the dump on next start)
docker compose -f docker-compose.local.yml exec app bash   # shell inside the PHP container
```

---

## Option B — XAMPP / Laragon on Windows (no Docker)

1. Install **XAMPP with PHP 8.2+** (or Laragon) and **Composer** (https://getcomposer.org/Composer-Setup.exe).
2. In `C:\xampp\php\php.ini` make sure these lines are **not** commented: `extension=intl`, `extension=gd`, `extension=zip`, `extension=pdo_mysql`. Restart Apache.
3. Clone the project to `C:\xampp\htdocs\damas`.
4. Open a terminal in that folder:
   ```bash
   composer install
   php init --env=Development --overwrite=n
   ```
5. Create the database in phpMyAdmin (http://localhost/phpmyadmin): **New → name `damas` → collation `utf8mb4_unicode_ci`**, then **Import** your `.sql` file. For dumps over the upload limit use the command line instead:
   ```bash
   C:\xampp\mysql\bin\mysql -u root damas < C:\path\to\damas.sql
   ```
6. Edit `common/config/main-local.php`:
   ```php
   'dsn' => 'mysql:host=127.0.0.1;dbname=damas',
   'username' => 'root',
   'password' => '',
   'charset' => 'utf8mb4',
   ```
7. Add a virtual host so the site runs at the web root (the app builds URLs from `/`). Append to `C:\xampp\apache\conf\extra\httpd-vhosts.conf`:
   ```apache
   <VirtualHost *:80>
       ServerName damas.test
       DocumentRoot "C:/xampp/htdocs/damas/frontend/web"
       <Directory "C:/xampp/htdocs/damas/frontend/web">
           AllowOverride All
           Require all granted
       </Directory>
       Alias /web-admin "C:/xampp/htdocs/damas/backend/web"
       <Directory "C:/xampp/htdocs/damas/backend/web">
           AllowOverride All
           Require all granted
           RewriteEngine On
           RewriteBase /web-admin/
       </Directory>
   </VirtualHost>
   ```
   and add `127.0.0.1 damas.test` to `C:\Windows\System32\drivers\etc\hosts` (open Notepad as Administrator). Restart Apache and open http://damas.test/en.

---

## Things that look broken locally but are not

- **Images missing.** Uploaded images live in `frontend/web/uploads/`; the copy in git is old (the live banners such as `home_banner_mob30b4def9…webp` are not in it). Download `public_html/frontend/web/uploads/` from cPanel (File Manager → Compress → Download) and extract it over the local folder.
- **Some links point to https://damasmc.com.** `common/config/params.php` hard-codes `filepath` / `imagepath` to the live domain; those images load from production. That is expected.
- **Emails are not sent.** Locally they are written to `frontend/runtime/mail/` as `.eml` files.
- **Page cache is off locally.** It only runs when `YII_DEBUG` is false. To test production behaviour, set `YII_DEBUG` to `false` and `YII_ENV` to `'prod'` in `frontend/web/index.php`.
- **Changed a table structure?** Delete `frontend/runtime/cache/` (the schema cache keeps the old column list for up to 24 hours).

## Troubleshooting

| Symptom | Fix |
|---|---|
| `Composer detected issues in your platform … >= 8.2.0` | Your PHP is older than 8.2. Use the Docker setup or upgrade XAMPP. |
| `composer install` fails on `bower-asset/…` | Your network blocks https://asset-packagist.org — it must be reachable. |
| Blank page / `Unable to find 'common/config/main-local.php'` | Run `php init --env=Development --overwrite=n` (Docker: `docker/setup.sh`). |
| `SQLSTATE[HY000] [2002]` | Database host is wrong: Docker uses `db`, XAMPP uses `127.0.0.1`. |
| `SQLSTATE[42S02] Base table … doesn't exist` | The dump was not imported. Docker: `down -v`, check `docker/db/`, `up -d`. |
| `Unknown collation: 'utf8mb4_0900_ai_ci'` (XAMPP/MariaDB) | Open the .sql in an editor, replace `utf8mb4_0900_ai_ci` with `utf8mb4_unicode_ci`, import again. |
| Admin login fails | Set a local password (local DB only): run `php -r "echo password_hash('NewPass123', PASSWORD_BCRYPT), PHP_EOL;"`, then in phpMyAdmin put the output into `admin_users.password_hash` for your user. Yii's bcrypt check accepts this hash. |
