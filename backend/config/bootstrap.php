<?php

use common\components\ContentCache;
use yii\base\Event;
use yii\db\BaseActiveRecord;

/*
 * Any content change made in the admin panel clears the frontend caches
 * (Words/About dictionaries, layout data, full-page cache) immediately.
 * Class-level events fire for every ActiveRecord model, so new admin modules are covered automatically.
 */
foreach ([BaseActiveRecord::EVENT_AFTER_INSERT, BaseActiveRecord::EVENT_AFTER_UPDATE, BaseActiveRecord::EVENT_AFTER_DELETE] as $event) {
    Event::on(BaseActiveRecord::class, $event, function () {
        ContentCache::flush();
    });
}

/* Belt and braces: bulk writes (deleteAll/updateAll) and file uploads don't fire model events,
   so also flush after every successful admin POST. */
Event::on(\yii\web\Application::class, \yii\base\Application::EVENT_AFTER_REQUEST, function () {
    if (Yii::$app->request->isPost) {
        ContentCache::flush();
    }
});
