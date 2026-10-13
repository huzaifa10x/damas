<?php

namespace common\components;

use yii\base\Component;

class AppointmentModelHelper extends Component {

    public function getAppointmentModel() {
        $model = new \common\models\AppointmentEnquiry();
        return $model;
    }

}
