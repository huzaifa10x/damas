<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "contact_enquiry".
 *
 * @property int $id
 * @property int|null $type 0-Enquiry,1->Feedback
 * @property string|null $name
 * @property string|null $email
 * @property string|null $phone_number
 * @property string|null $message
 * @property string $date
 */
class ContactEnquiry extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'contact_enquiry';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['type'], 'integer'],
                [['name', 'email', 'phone_number', 'message'], 'required', 'message' => 'The {attribute} field is required'],
//                ['name', 'match', 'pattern' => '/^[a-zA-Z. ]+$/', 'message' => 'Only letters, spaces, and dots are allowed.'],
                ['phone_number', 'match', 'pattern' => '/^[0-9+ -]{10,15}$/', 'message' => 'Only numbers, plus (+), hyphen (-), a minimum length of 10 characters and a maximum length of 15 characters are allowed'],
            [['message'], 'string'],
                [['date'], 'safe'],
                [['email'], 'email'],
                ['name', 'match', 'pattern' => '/^[a-zA-Z\s]+$/', 'message' => 'Only letters and spaces are allowed'],
//                ['phone_number', 'match', 'pattern' => '/^[+\d\s]+$/', 'message' => 'Only plus sign, spaces, and numbers are allowed.'],
                [['name', 'email'], 'string', 'max' => 255],
                [['phone_number'], 'string', 'max' => 15],
                [['message'], 'validateMessagePattern'],
        ];
    }
    
    public function validateMessagePattern($attribute, $params)
    {
        if (!preg_match('/^[A-Za-z\s]+$/', $this->$attribute)) {
            $this->addError($attribute, 'Only letters and spaces are allowed.');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'name' => 'Name',
            'email' => 'Email',
            'phone_number' => 'Phone Number',
            'message' => 'Message',
            'date' => 'Date',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($email) {
        return Yii::$app->mailer->compose()
                        ->setTo($email)
                        ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
                        ->setReplyTo([$this->email => $this->name])
                        ->setSubject('Contact Enquiry')
                        ->setTextBody($this->body)
                        ->send();
    }

}
