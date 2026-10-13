<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SetValues
 *
 * @author user
 */

namespace common\components;

use Yii;
use yii\base\Component;
use common\models\User;
use common\models\PaymentDetails;
use common\models\OrderAddress;

class SetValues extends Component {

    public function Attributes($model) {


        if (isset($model) && !Yii::$app->user->isGuest) {
            if ($model->isNewRecord) {
                $model->created_by = Yii::$app->user->identity->id;
                $model->created_at = date('Y-m-d H:i:s');
            } else {
                $model->updated_by = Yii::$app->user->identity->id;
            }
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function GetCurrencySymbol() {
        $symbol = 'AED';
        return $symbol;
    }

    /*
     * Booking email to user
     */

    public static function bookingemail($model) {
        try {
            // $message = Yii::$app->mailer->compose('booking_mail', ['model' => $model])
            //         ->setFrom([Yii::$app->params['senderEmail'] => 'Damas'])
            //         ->setTo($model->email)
            //         ->setSubject('Booking Enquiry');
            // $message->send();
            $message2 = Yii::$app->mailer->compose('booking_mail_admin', ['model' => $model])
                    ->setFrom([Yii::$app->params['senderEmail'] => 'Damas'])
                    ->setTo(Yii::$app->params['adminEmail'])
                    ->setSubject('New Booking Enquiry');
            $message2->send();
        } catch (Exception $ex) {
            
        }
    }

    /*
     * Booking confirmation to user
     */

    public static function bookingconfirmation($model) {
        try {
            $service = \common\models\Services::find()->where(['id' => $model->service])->one();
            $message = Yii::$app->mailer->compose('booking_confirmation', ['model' => $model, 'service' => $service])
                    ->setFrom([Yii::$app->params['senderEmail'] => 'Damas'])
                    ->setTo($model->email)
                    ->setSubject('Booking Confirmation');
            $message->send();
        } catch (Exception $ex) {
            
        }
    }
    
    /*
     * Order Confirm mail on success (cash on delivery and payment success)
     */

    public static function purchasemail($orderid) {
        try {
            $ordermaster = \common\models\OrderMaster::find()->where(['id' => $orderid])->one();
            $user = \common\models\User::findOne($ordermaster->user_id);
            $bill_address = \common\models\OrderAddress::find()->where(['id' => $ordermaster->billing_address])->one();
            if (!empty($bill_address) && $bill_address->email != '') {
                $message = Yii::$app->mailer->compose('order_mail', ['orderid' => $orderid])
                        ->setFrom([Yii::$app->params['senderEmail'] => 'Damas'])
                        ->setTo($bill_address->email)
                        ->setSubject('Order Confirmed (' . $ordermaster->order_id . ')');
                $message->send();
            }
            $message2 = Yii::$app->mailer->compose('order_mail_admin', ['orderid' => $orderid])
                        ->setFrom([Yii::$app->params['senderEmail'] => 'Damas'])
                        ->setTo(Yii::$app->params['adminPurchaseEmail'])
                        ->setSubject('New Order Received (' . $ordermaster->order_id . ')');
            $message2->send();
        } catch (Exception $ex) {
            
        }
    }

    /*
     * Get department names
     */

    public function GetDepartments($id, $language) {
        $model = \common\models\Doctors::find()->where(['id' => $id])->one();

        if (!empty($model) && $model->department != '') {
            // Convert the department field to an array of department IDs
            $departmentIds = explode(",", $model->department);

            // Fetch all department models in a single query
            $departments = \common\models\Departments::find()
                    ->where(['id' => $departmentIds])
                    ->all();

            // Collect department names based on the language
            $departmentNames = [];
            foreach ($departments as $dept) {
                $departmentNames[] = $language == 'ar' ? $dept->department_name_arabic : $dept->department_name;
            }

            // Return the concatenated list of department names, separated by commas
            return implode(', ', $departmentNames);
        }
        return '';
    }
    
    public function GetPrice($price) {
        $currency_price = $price;
        return sprintf('%0.2f', $currency_price);
    }

    public function GetVat($amount) {
        $vatPercentage = 5;
        $vatAmount = 0;
        if ($amount > 0) {
            $vatAmount = ($amount * $vatPercentage) / 100;
        }
        return $vatAmount;
    }
    
    public function GetTotalAmount($amount) {
        $vatPercentage = 5;
        $vatAmount = 0;
        if ($amount > 0) {
            $vatAmount = ($amount * $vatPercentage) / 100;
        }
        $totalAmount = $amount + $vatAmount;
        return $totalAmount;
    }
    
    public static function GetOfferImage($product_details) {
        $image = Yii::$app->params['imagepath'] . 'noImage.png';
        $path = Yii::$app->basePath . '/web/uploads/products/' . $product_details->image;
        if (!empty($product_details) && $product_details->image != '' && is_file($path) && file_exists($path)) {
            $image = Yii::$app->params['imagepath'] .'products/'. $product_details->image;
        }
        return $image;
    }

}
