<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "appointment_enquiry".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone_number
 * @property int $service
 * @property string $appointment_date
 * @property string $appointment_time
 * @property string|null $page_url
 * @property string|null $created_at
 * @property string $updated_at
 */
class AppointmentEnquiryListing extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */ 
     
    public $verifyCode;
    
    public static function tableName()
    {
        return 'appointment_enquiry';
    }

   
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'phone_number', 'service','age','gender'], 'required'],
            [['email'], 'email'],
            [['service','status','age','gender'], 'integer'],
            [['appointment_date', 'appointment_time', 'created_at', 'updated_at','message'], 'safe'],
            ['message', 'match', 'pattern' => '/^[a-zA-Z0-9\s.,!?\'"()-]+$/', 'message' => 'The input can only contain letters, numbers, spaces, and common punctuation.'],
            [['name', 'email', 'page_url'], 'string', 'max' => 255],
            [['phone_number'], 'string', 'max' => 15],
            ['name', 'match', 'pattern' => '/^[a-zA-Z\s]+$/', 'message' => 'Only letters and spaces are allowed.'],
            ['phone_number', 'match', 'pattern' => '/^[0-9+ ()-]{7,20}$/', 'message' => 'Please enter a valid phone number.'],
            ['verifyCode', 'validateRecaptcha'],
        ];
    }
    
      public function validateRecaptcha($attribute, $params)
    {
        $recaptchaResponse = Yii::$app->request->post('g-recaptcha-response');

        if (empty($recaptchaResponse)) {
            $this->addError($attribute, 'Please check the "I am not a robot" box.');
            return;
        }

        $secretKey = '6LeIN5stAAAAAN6xeu-JdyVXSZeoJCbMw9J0ZFc4';
        $verifyUrl = 'https://www.google.com/recaptcha/api/siteverify';

        // Send verification request to Google
        $response = file_get_contents($verifyUrl . '?secret=' . $secretKey . '&response=' . $recaptchaResponse);
        $responseData = json_decode($response);

        if (!$responseData || !$responseData->success) {
            $this->addError($attribute, 'reCAPTCHA verification failed. Please try again.');
        }
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'phone_number' => 'Phone Number',
            'service' => 'Department',
            'appointment_date' => 'Appointment Date',
            'appointment_time' => 'Appointment Time',
            'page_url' => 'Page Url',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'verifyCode' => 'Verification Code',
        ];
    }
}
