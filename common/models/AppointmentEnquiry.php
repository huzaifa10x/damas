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
class AppointmentEnquiry extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
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
            ['phone_number', 'match', 'pattern' => '/^[0-9+ -]{10,15}$/', 'message' => 'Only numbers, plus (+), hyphen (-), a minimum length of 10 characters and a maximum length of 15 characters are allowed.'],
        ];
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
        ];
    }
}
