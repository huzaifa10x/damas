<?php

namespace common\components;

use Yii;
use yii\caching\TagDependency;

/**
 * One place for the cache tag that every content cache depends on.
 *
 * Any admin insert/update/delete (see backend/config/bootstrap.php) calls ContentCache::flush(),
 * which invalidates every cached item tagged with TAG: the Words/About dictionaries,
 * the layout data and the full-page cache. Frontend and backend share one cache directory
 * (common/config/main.php), so the backend's invalidation is seen by the frontend immediately.
 */
class ContentCache
{
    const TAG = 'site-content';

    /** Default lifetime for content caches, in seconds. Invalidation is by tag, so this is only a safety net. */
    const DURATION = 86400;

    public static function dependency()
    {
        return new TagDependency(['tags' => self::TAG]);
    }

    public static function flush()
    {
        if (Yii::$app && Yii::$app->has('cache')) {
            TagDependency::invalidate(Yii::$app->cache, self::TAG);
        }
    }
}
