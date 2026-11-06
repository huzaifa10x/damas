<?php

namespace common\components;

use yii\base\Component;

class NewsletterHelper extends Component {

    public function getNewsletter() {
        $model = new \common\models\Newsletter();
        return $model;
    }

}
