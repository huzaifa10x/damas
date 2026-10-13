<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model {

    public $name;
    public $email;
    public $phone;
    public $password;
    public $confirm_password;

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                ['name', 'trim'],
                ['name', 'required'],
                ['name', 'match', 'pattern' => '/^[a-zA-Z\s]+$/', 'message' => 'Name can only contain letters and spaces.'],
                ['name', 'string', 'min' => 2, 'max' => 100],
                ['phone', 'trim'],
                ['phone', 'required'],
                ['phone', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This phone number has already been taken.'],
                ['phone', 'match', 'pattern' => '/^\+?[0-9]{10,15}$/', 'message' => 'Please enter a valid phone number.'],
                ['email', 'trim'],
                ['email', 'required'],
                ['email', 'email'],
                ['email', 'string', 'max' => 255],
                ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
                ['password', 'required'],
                ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
                ['password', 'match', 'pattern' => '/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{' . Yii::$app->params['user.passwordMinLength'] . ',}$/',
                'message' => 'Password must contain at least one uppercase letter, one number, and one special character (@$!%*?&).'],
                ['confirm_password', 'required'],
                ['confirm_password', 'compare', 'compareAttribute' => 'password', 'message' => 'Passwords do not match.']
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup() {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->phone = $this->phone;
        $user->status = 10;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();

        return $user->save();
//        return $user->save() && $this->sendEmail($user);
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user) {
        return Yii::$app
                        ->mailer
                        ->compose(
                                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'], ['user' => $user]
                        )
                        ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
                        ->setTo($this->email)
                        ->setSubject('Account registration at ' . Yii::$app->name)
                        ->send();
    }

}
