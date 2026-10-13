<?php

namespace common\components;

use Yii;
use yii\filters\PageCache;

/**
 * PageCache that only stores successful (HTTP 200) responses.
 *
 * Yii's PageCache stores whatever is sent, including a 500 error page produced when the database
 * hiccups or a 404 for a mistyped slug. Without this guard such a page would be served from cache
 * for the full cache lifetime.
 */
class SafePageCache extends PageCache
{
    public function beforeCacheResponse()
    {
        return Yii::$app->response->statusCode === 200;
    }
}
