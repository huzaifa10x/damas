<?php

namespace frontend\components;

use Yii;

/**
 * Above-the-fold CSS for pages that have a generated critical file (see tools/critical-css/README.md).
 *
 * When a page opts in ($this->params['criticalCss'] = 'critical-home.css'):
 *   - the critical file is inlined in <head> (first paint needs no stylesheet download);
 *   - bootstrap + app.min.css + style.css are loaded as ONE pre-built file (css/main.bundle.css) without
 *     blocking first paint. One file, not three: three files arriving at different times briefly change the
 *     cascade order and make the header jump (measured CLS 0.19 on mobile).
 *
 * Both generated files carry a fingerprint of the source stylesheets. If any source CSS was changed after they
 * were generated, prepare() returns null and the layout falls back to the normal render-blocking stylesheets,
 * so an outdated critical file can never produce a broken page — it only loses the speed-up until regenerated.
 */
class CriticalCss
{
    /** Source stylesheets, in cascade order. Must match tools/critical-css/build.py */
    const SOURCES = [
        '@webroot/lib/bootstrap-5.3.2.min.css',
        '@webroot/css/app.min.css',
        '@webroot/css/style.css',
    ];
    const BUNDLE = '@webroot/css/main.bundle.css';

    /**
     * @param string $file critical CSS file name inside web/css/
     * @return array|null ['css' => inline CSS, 'bundleUrl' => URL of the combined stylesheet] or null to fall back
     */
    public static function prepare($file)
    {
        $critical = Yii::getAlias('@webroot/css/' . basename($file));
        $bundle   = Yii::getAlias(self::BUNDLE);
        if (!is_file($critical) || !is_file($bundle)) {
            return null;
        }
        $signature = self::sourceSignature();
        if ($signature === null) {
            return null;
        }
        $css = file_get_contents($critical);
        if (self::headerSignature($css, 'critical-src') !== $signature) {
            return null;
        }
        $fh = fopen($bundle, 'r');
        $bundleHead = $fh ? fread($fh, 200) : '';
        if ($fh) {
            fclose($fh);
        }
        if (self::headerSignature($bundleHead, 'bundle-src') !== $signature) {
            return null;
        }
        return [
            'css' => $css,
            'bundleUrl' => Yii::getAlias('@web/css/main.bundle.css') . '?v=' . substr($signature, 0, 10),
        ];
    }

    /** md5 over the md5 of every source file (cached until a file's size or mtime changes). */
    public static function sourceSignature()
    {
        $paths = array_map([Yii::class, 'getAlias'], self::SOURCES);
        $stamp = '';
        foreach ($paths as $p) {
            if (!is_file($p)) {
                return null;
            }
            $stamp .= $p . ':' . filesize($p) . ':' . filemtime($p) . ';';
        }
        $compute = function () use ($paths) {
            $hashes = '';
            foreach ($paths as $p) {
                $hashes .= md5_file($p);
            }
            return md5($hashes);
        };
        if (Yii::$app->has('cache')) {
            return Yii::$app->cache->getOrSet('critical_css_sig_' . md5($stamp), $compute, 86400);
        }
        return $compute();
    }

    private static function headerSignature($css, $name)
    {
        return preg_match('#^/\*' . preg_quote($name, '#') . ':([0-9a-f]{32})\*/#', $css, $m) ? $m[1] : null;
    }
}
