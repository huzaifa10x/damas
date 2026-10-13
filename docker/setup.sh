#!/usr/bin/env bash
# One-time setup inside the app container:
#   docker compose -f docker-compose.local.yml exec app bash docker/setup.sh
# Safe to re-run: it never touches your database and only creates missing local config files.
set -e
cd /var/www/html

echo "==> Installing PHP dependencies (vendor/)"
git config --global --add safe.directory /var/www/html || true
COMPOSER_ALLOW_SUPERUSER=1 composer install --no-interaction --prefer-dist

echo "==> Generating index.php and *-local.php files (Yii 'init', Development)"
if [ ! -f frontend/web/index.php ]; then
  php init --env=Development --overwrite=n
else
  echo "    already initialised, skipping"
fi

echo "==> Writing local DB/mailer config"
cp docker/config/common-main-local.php common/config/main-local.php
cp docker/config/app-main-local.php frontend/config/main-local.php
cp docker/config/app-main-local.php backend/config/main-local.php
for f in common/config/params-local.php frontend/config/params-local.php backend/config/params-local.php console/config/params-local.php; do
  [ -f "$f" ] || echo "<?php return [];" > "$f"
done

echo "==> Making runtime and asset folders writable"
mkdir -p frontend/runtime backend/runtime console/runtime frontend/web/assets backend/web/assets
chmod -R 777 frontend/runtime backend/runtime console/runtime frontend/web/assets backend/web/assets

echo "==> Checking the database connection"
php -r '
$h=getenv("DB_HOST");$d=getenv("DB_NAME");
try { $p=new PDO("mysql:host=$h;dbname=$d",getenv("DB_USER"),getenv("DB_PASSWORD"));
      $n=$p->query("SELECT COUNT(*) FROM information_schema.tables WHERE table_schema=".$p->quote($d))->fetchColumn();
      echo "    connected, $n tables in $d\n";
      if ($n == 0) echo "    !! database is empty: put your .sql in docker/db/ and run: docker compose -f docker-compose.local.yml down -v && docker compose -f docker-compose.local.yml up -d\n";
} catch (Exception $e) { echo "    !! ".$e->getMessage()."\n"; exit(1); }'

echo
echo "Done. Open http://localhost:8080/en  (admin: http://localhost:8080/web-admin)"
