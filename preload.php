<?php
$dirs = [
    __DIR__ . '/vendor/yiisoft/yii2',
    __DIR__ . '/vendor/yiisoft/yii2-bootstrap5',
    __DIR__ . '/common/models',
];
foreach ($dirs as $dir) {
    if (!is_dir($dir)) continue;
    $it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    foreach ($it as $file) {
        if ($file->getExtension() !== 'php') continue;
        $path = $file->getRealPath();
        if (str_contains($path, '/tests/') || str_contains($path, '/messages/')) continue;
        @opcache_compile_file($path);
    }
}
