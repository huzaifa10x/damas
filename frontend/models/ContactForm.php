<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'body'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
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
            'verifyCode' => 'Verification Code',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($email)
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setReplyTo([$this->email => $this->name])
            ->setSubject($this->subject)
            ->setTextBody($this->body)
            ->send();
    }
}
