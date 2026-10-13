<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AppointmentWidget
 *
 * @author
 * JIthin Wails
 */

namespace common\components;

use Yii;
use yii\base\Widget;
use common\models\AppointmentEnquiry;
use common\models\Products;
use yii\helpers\ArrayHelper;
use common\models\Genders;

class AppointmentForm extends Widget {

    public $language;

    public function init() {
        parent::init();
        if ($this->id === null) {
            return '';
        }
    }

    public function run() {
        $model = new AppointmentEnquiry();
        if ($this->language == 'ar') {
            $services = ArrayHelper::map(\common\models\Departments::find()->where(['status' => 1])->all(), 'id', 'department_name_arabic');
            $genders = ArrayHelper::map(Genders::find()->where(['status' => 1])->all(), 'id', 'gender_arabic');
        } else {
            $services = ArrayHelper::map(\common\models\Departments::find()->where(['status' => 1])->all(), 'id', 'department_name');
            $genders = ArrayHelper::map(Genders::find()->where(['status' => 1])->all(), 'id', 'gender');
        }
        
        if ($model->load(Yii::$app->request->post())) {
            // $model->appointment_date = date("Y-m-d", strtotime($model->appointment_date));
            $date = new \DateTime(str_replace(',', '', $model->appointment_date));
            // var_dump($date->format('Y-m-d'));exit;
            $model->appointment_date = $date->format('Y-m-d');
            $url = $model->page_url;
            $model->created_at = date('Y-m-d H:i:s');
            if ($model->validate() && $model->save()) {
                // Yii::$app->session->setFlash('success', 'Appointment Booked Successfully');
                Yii::$app->session['logerror'] = 1;
                Yii::$app->SetValues->bookingemail($model);
//                Yii::$app->params['booking_session'] = 1;
                Yii::$app->response->redirect($url);
            }
        }
        return $this->render('appointment-form', [
                    'language' => $this->language,
                    'model' => $model,
                    'genders' => $genders,
                    'services' => $services,
        ]);
    }

}

?>

