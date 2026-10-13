#!/usr/bin/env bash
# Builds a ready-to-upload ZIP of this project for a cPanel staging subdomain (e.g. bk.damasmc.com).
#
#   cd ~/Downloads/damas
#   bash deploy/build-staging.sh
#
# Output: ../damas-staging.zip  (code + vendor/, production index.php, no uploads/, no Docker files)
# Needs on your Mac: php and composer (the same ones you used for `composer install`).
set -euo pipefail
trap 'echo; echo "!! Build FAILED at line $LINENO. Copy everything above this line and send it."; exit 1' ERR

SRC="$(cd "$(dirname "$0")/.." && pwd)"
OUT="$(dirname "$SRC")/damas-staging-build"
ZIP="$(dirname "$SRC")/damas-staging.zip"

echo "==> Copying project to $OUT"
rm -rf "$OUT"
mkdir -p "$OUT"
rsync -a "$SRC/" "$OUT/" \
  --exclude '/.git' --exclude '/vendor' --exclude 'node_modules' --exclude '.DS_Store' \
  --exclude '/docker' --exclude '/docker-compose*.yml' --exclude '/deploy' \
  --exclude '/landing' --exclude '/landing.damasmc.com' \
  --exclude '/frontend/web/uploads' \
  --exclude '/frontend/runtime/*' --exclude '/backend/runtime/*' --exclude '/console/runtime/*' \
  --exclude '/frontend/web/assets/*' --exclude '/backend/web/assets/*' \
  --exclude '/common/config/*-local.php' --exclude '/frontend/config/*-local.php' \
  --exclude '/backend/config/*-local.php' --exclude '/console/config/*-local.php' \
  --exclude '/frontend/web/index*.php' --exclude '/backend/web/index*.php' \
  --exclude '/yii' --exclude '/yii_test' --exclude '/yii_test.bat' \
  --exclude 'error_log' --exclude '/info.php'

cd "$OUT"

echo "==> Installing production dependencies (no dev packages)"
command -v composer >/dev/null || { echo "!! composer not found on this Mac"; exit 1; }
if [ -f composer.lock ]; then
  # Same package versions as your working local install (vendor/ there was built from this lock file)
  COMPOSER_ALLOW_SUPERUSER=1 composer install --no-dev --optimize-autoloader --no-interaction --no-progress
else
  composer config platform.php 8.2.0
  COMPOSER_ALLOW_SUPERUSER=1 composer update --no-dev --optimize-autoloader --no-interaction --no-progress
fi
[ -f vendor/autoload.php ] || { echo "!! vendor/autoload.php was not created"; exit 1; }
MIN_PHP=$(grep -o "PHP_VERSION_ID >= [0-9]*" vendor/composer/platform_check.php 2>/dev/null | grep -o "[0-9]*$" || echo 0)
if [ "$MIN_PHP" -gt 0 ]; then
  MIN_PHP_TXT="$((MIN_PHP / 10000)).$(((MIN_PHP / 100) % 100))"
else
  MIN_PHP_TXT="8.2"
fi

echo "==> Generating production index.php files and config (YII_DEBUG=false)"
php init --env=Production --overwrite=All >/dev/null
cp "$SRC/deploy/staging/common-main-local.php" common/config/main-local.php

echo "==> Creating writable folders"
mkdir -p frontend/runtime backend/runtime console/runtime frontend/web/assets backend/web/assets frontend/web/uploads
for d in frontend/runtime backend/runtime console/runtime frontend/web/assets backend/web/assets; do
  touch "$d/.keep"
done

echo "==> Staging must not be indexed by Google"
printf 'User-agent: *\nDisallow: /\n' > frontend/web/robots.txt
printf 'User-agent: *\nDisallow: /\n' > backend/web/robots.txt
{
  printf '# STAGING ONLY: keep this copy out of search results (remove on the real site)\n'
  printf '<IfModule mod_headers.c>\n  Header always set X-Robots-Tag "noindex, nofollow"\n</IfModule>\n\n'
  cat .htaccess
} > .htaccess.new && mv .htaccess.new .htaccess

echo "==> Zipping"
rm -f "$ZIP"
zip -qr "$ZIP" . -x '*.DS_Store'
cd "$SRC"
rm -rf "$OUT"

echo
echo "Done: $ZIP ($(du -h "$ZIP" | cut -f1))"
echo "IMPORTANT: set the subdomain to PHP $MIN_PHP_TXT or newer in cPanel → MultiPHP Manager"
echo "Next: upload it to the subdomain's folder in cPanel and follow deploy/STAGING.md"
