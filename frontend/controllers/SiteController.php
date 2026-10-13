<?php

namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\helpers\FileHelper;
use yii\helpers\ArrayHelper;
use common\models\Genders;
use common\models\Departments;
use common\models\AppointmentEnquiryListing;

/**
 * Site controller
 */
class SiteController extends Controller {

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'signup'],
                'rules' => [
                        [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                        [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
//                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions() {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex($language = NULL) {
       
        if ($language == '') {
            $language = 'en';
        }
        $model = new AppointmentEnquiryListing();
        if ($language == 'ar') {
            $services = ArrayHelper::map(Departments::find()->where(['status' => 1])->all(), 'id', 'department_name_arabic');
            $genders = ArrayHelper::map(Genders::find()->where(['status' => 1])->all(), 'id', 'gender_arabic');
        } else {
            $services = ArrayHelper::map(Departments::find()->where(['status' => 1])->all(), 'id', 'department_name');
            $genders = ArrayHelper::map(Genders::find()->where(['status' => 1])->all(), 'id', 'gender');
        }
        if ($model->load(Yii::$app->request->post())) {
            $dateString = $model->appointment_date ?? ''; // Use empty string if null
            $date = new \DateTime(str_replace(',', '', $dateString));
            $model->appointment_date = $date->format('Y-m-d');
            $url = $model->page_url;
            $model->created_at = date('Y-m-d H:i:s');
            if ($model->validate() && $model->save()) {
                Yii::$app->session['logerror'] = 1;
                Yii::$app->SetValues->bookingemail($model);
                // Yii::$app->response->redirect($url);
                return $this->redirect(['booking-success', 'language' => $language]);
            }
        }
        $sliders = \common\models\HomeBanner::find()->where(['status' => 1])->all();
        // $services = \common\models\Services::find()->where(['status' => 1])->all();
        $departments = \common\models\Departments::find()->where(['status' => 1])->all();
        $doctors = \common\models\Doctors::find()->where(['status' => 1])->all();
        $special_offers = \common\models\SpecialOffer::find()->where(['status' => 1])->all();
        $insurances = \common\models\Insurance::find()->where(['status' => 1])->all();
        $testimonials = \common\models\Testimonials::find()->where(['status' => 1])->orderBy(['id' => SORT_DESC])->all();
        $google_reviews = \common\models\GoogleReviews::find()->where(['status' => 1])->orderBy(['id' => SORT_DESC])->all();
        $meta_tags = \common\models\MetaTags::findOne(1);
        
        $isAr = ($language === 'ar');
        
        // Handle Title
        if ($isAr && !empty($meta_tags->meta_title_arabic)) {
            $this->view->title = $meta_tags->meta_title_arabic;
        } else {
            $this->view->title = $meta_tags->meta_title;
        }
        
        // Handle Keywords
        $keywords = ($isAr && !empty($meta_tags->meta_keyword_arabic)) 
                    ? $meta_tags->meta_keyword_arabic 
                    : $meta_tags->meta_keyword;
        
        // Handle Description
        $description = ($isAr && !empty($meta_tags->meta_description_arabic)) 
                       ? $meta_tags->meta_description_arabic 
                       : $meta_tags->meta_description;
        
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => $keywords]);
        $this->view->registerMetaTag(['name' => 'description', 'content' => $description]);
        
        $this->view->params['language'] = $language;
        return $this->render('index', [
                    'language' => $language,
                    'sliders' => $sliders,
                    'doctors' => $doctors,
                    // 'services' => $services,
                    'departments' => $departments,
                    'special_offers' => $special_offers,
                    'insurances' => $insurances,
                    'testimonials' => $testimonials,
                    'google_reviews' => $google_reviews,
                    'model' => $model,
                    'services' => $services,
                    'genders' => $genders,
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin($language) {
        $this->view->params['language'] = $language;
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['index', 'language' => $language]);
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['index', 'language' => $language]);
        }

        $model->password = '';

        return $this->render('login', [
                    'language' => $language,
                    'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout($language) {
        Yii::$app->user->logout();

        return $this->redirect(['login', 'language' => $language]);
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    
    public function actionContact($language) {
    $this->view->params['language'] = $language;
    $model = new \common\models\ContactEnquiry();
    $data = \common\models\ContactUs::findOne(1);
    $meta_tags = \common\models\MetaTags::findOne(3);
    $banner = \common\models\Banners::findOne(11);

    $this->view->title = $meta_tags->meta_title;
    $this->view->registerMetaTag(['name' => 'keywords', 'content' => $meta_tags->meta_keyword]);
    $this->view->registerMetaTag(['name' => 'description', 'content' => $meta_tags->meta_description]);

    if ($model->load(Yii::$app->request->post()) && $model->validate()) {
        $model->message = strip_tags($model->message);
        
        if ($model->save()) {
            
            // Step 1: Mail sending me try-catch block add kiya hai taake SES issue detect ho saken
            try {
                // View path for mail template
                $htmlBody = $this->renderPartial('@common/mail/enquiry-mail', ['model' => $model]);

                $sent = Yii::$app->mailer->compose()
                    ->setFrom([Yii::$app->params['senderEmail'] => 'Damas']) // Fix: String name passed back
                    ->setTo(Yii::$app->params['adminEmail'])
                    ->setSubject('New Contact Enquiry')
                    ->setHtmlBody($htmlBody) // Fix: TextBody ki jagah HtmlBody
                    ->send();
                
                

                if ($sent) {
                    Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible');
                } else {
                    // Agar mailer failed (false return kiya)
                    Yii::$app->session->setFlash('error', 'Mail server failed to deliver the email. Please check SMTP configuration.');
                }

            } catch (\Exception $e) {
                // Catch any Amazon SES / SMTP Connection error without breaking app
                Yii::error("Mail Sending Failed: " . $e->getMessage(), 'email');
                
                // Testing phase me screen par exact error dekhne ke liye is line ko uncomment karein:
                // die($e->getMessage());

                Yii::$app->session->setFlash('error', 'Email Error: ' . $e->getMessage());
            }

            return $this->redirect(['contact', 'language' => $language]);
        } else {
            // Step 2: Model database save errors check
            Yii::$app->session->setFlash('error', 'Database Save Failed: ' . print_r($model->getErrors(), true));
        }
    }

    return $this->render('contact', [
        'model' => $model,
        'data' => $data,
        'language' => $language,
        'banner' => $banner,
    ]);
}
    
    // public function actionContact($language) {
    //     $this->view->params['language'] = $language;
    //     $model = new \common\models\ContactEnquiry();
    //     $data = \common\models\ContactUs::findOne(1);
    //     $meta_tags = \common\models\MetaTags::findOne(3);
    //     $banner = \common\models\Banners::findOne(11);
    //     $this->view->title = $meta_tags->meta_title;
    //     $this->view->registerMetaTag(['name' => 'keywords', 'content' => $meta_tags->meta_keyword]);
    //     $this->view->registerMetaTag(['name' => 'description', 'content' => $meta_tags->meta_description]);
    //     if ($model->load(Yii::$app->request->post()) && $model->validate()) {
    //         $model->message = strip_tags($model->message);
            
    //         if ($model->save()) {
                
                
    //             // $message = Yii::$app->mailer->compose('enquiry-mail', ['model' => $model])
    //             //         ->setFrom([Yii::$app->params['senderEmail'] => 'Damas'])
    //             //         ->setTo(Yii::$app->params['adminEmail'])
    //             //         // ->setCc(['minnu@intersmart.in'])
    //             //         ->setSubject('New Contact Enquiry');
    //             // $message->send();
                
    //             $htmlBody = $this->renderPartial('enquiry-mail', ['model' => $model]);
    //             $htmlBody = $this->renderPartial('@common/mail/enquiry-mail', ['model' => $model]);
                
    //             Yii::$app->mailer->compose()
    //             ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['Damas']])
    //             ->setTo(Yii::$app->params['adminEmail']) // Admin Email yahan receive karega
    //             ->setSubject('New Contact Enquiry')
    //             ->setTextBody($htmlBody)
    //             ->send();
    //             Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible');
    //             // return $this->redirect(['contact', 'language' => $language]);
    //              return $this->redirect(['contact', 'language' => $language]);
    //         }
    //     }

    //     return $this->render('contact', [
    //                 'model' => $model,
    //                 'data' => $data,
    //                 'language' => $language,
    //                 'banner' => $banner,
    //     ]);
    // }
    
//     public function actionContact($language) {
//     $this->view->params['language'] = $language;
//     $model = new \common\models\ContactEnquiry();
//     $data = \common\models\ContactUs::findOne(1);
//     $meta_tags = \common\models\MetaTags::findOne(3);
//     $banner = \common\models\Banners::findOne(11);
//     $this->view->title = $meta_tags->meta_title;
//     $this->view->registerMetaTag(['name' => 'keywords', 'content' => $meta_tags->meta_keyword]);
//     $this->view->registerMetaTag(['name' => 'description', 'content' => $meta_tags->meta_description]);
//     if ($model->load(Yii::$app->request->post()) && $model->validate()) {
//         $model->message = strip_tags($model->message);
//         if ($model->save()) {
//             // 1. Generate the HTML from your existing view file
//             // $htmlBody = $this->renderPartial('enquiry-mail', ['model' => $model]);
//             $htmlBody = $this->renderPartial('@common/mail/enquiry-mail', ['model' => $model]);

//             // 2. Call the API helper method
//             $isSent = $this->sendZeptoEmail(
//                 Yii::$app->params['adminEmail'], 
//                 'New Contact Enquiry', 
//                 $htmlBody
//             );

//             if ($isSent) {
//                 Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible');
//             } else {
//                 Yii::$app->session->setFlash('error', 'There was an error sending your message. Please try again later.');
//             }

//             return $this->redirect(['site/contact', 'language' => $language]);
//         }
//     }

//     return $this->render('contact', [
//         'model' => $model,
//         'data' => $data,
//         'language' => $language,
//         'banner' => $banner,
//     ]);
// }

private function sendZeptoEmail($toEmail, $subject, $htmlContent)
{
    $url = "https://api.zeptomail.com/v1.1/email";
    $apiKey = "Zoho-enczapikey wSsVR610r0GhB/gsnjytL+c+nlpcUl/yFR8s0Fryv3H0GquQ/cc/lRfOVgOnTaQcEGJpEjYb9bp7m00E0WIKit0vnlsBCSiF9mqRe1U4J3x17qnvhDzPVmhalRSLKI4KwwljnWhnFcgh+g=="; 

    $data = [
        "from" => ["address" => Yii::$app->params['senderEmail'], "name" => "Damas"],
        "to" => [["email_address" => ["address" => $toEmail]]],
        "subject" => $subject,
        "htmlbody" => $htmlContent,
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "Authorization: " . $apiKey,
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // --- DEBUGGING: Display the response if it fails ---
    // Agar success code 200 ya 201 hai, to return true hoga.
    if ($httpCode === 200 || $httpCode === 201) {
        return true;
    } else {
        // Agar error aaya to log mein store ho jayega, screen par nahi dikhega
        Yii::error("ZeptoMail API Error ($httpCode): " . $response);
        return false;
    }

    return ($httpCode === 200);
}
    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout($language) {
        $this->view->params['language'] = $language;
        $model = new AppointmentEnquiryListing();
        if ($language == 'ar') {
            $services = ArrayHelper::map(Departments::find()->where(['status' => 1])->all(), 'id', 'department_name_arabic');
            $genders = ArrayHelper::map(Genders::find()->where(['status' => 1])->all(), 'id', 'gender_arabic');
        } else {
            $services = ArrayHelper::map(Departments::find()->where(['status' => 1])->all(), 'id', 'department_name');
            $genders = ArrayHelper::map(Genders::find()->where(['status' => 1])->all(), 'id', 'gender');
        }
        if ($model->load(Yii::$app->request->post())) {
            $dateString = $model->appointment_date ?? ''; // Use empty string if null
            $date = new \DateTime(str_replace(',', '', $dateString));
            $model->appointment_date = $date->format('Y-m-d');
            $url = $model->page_url;
            $model->created_at = date('Y-m-d H:i:s');
            if ($model->validate() && $model->save()) {
                Yii::$app->session['logerror'] = 1;
                Yii::$app->SetValues->bookingemail($model);
                // Yii::$app->response->redirect($url);
                return $this->redirect(['booking-success', 'language' => $language]);
            }
        }
        $our_history = \common\models\OurHistory::find()->where(['status' => 1])->orderBy(['year' => SORT_ASC])->all();
        $meta_tags = \common\models\MetaTags::findOne(2);
        $banner = \common\models\Banners::findOne(1);
        $this->view->title = $meta_tags->meta_title;
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => $meta_tags->meta_keyword]);
        $this->view->registerMetaTag(['name' => 'description', 'content' => $meta_tags->meta_description]);
        return $this->render('about', [
                    'language' => $language,
                    'our_history' => $our_history,
                    'banner' => $banner,
                    'model' => $model,
                    'services' => $services,
                    'genders' => $genders,
        ]);
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup($language) {
        $this->view->params['language'] = $language;
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Your registration completed successfully');
            return $this->redirect(['login', 'language' => $language]);
        }

        return $this->render('signup', [
                    'language' => $language,
                    'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionForgotPassword($language) {
        $this->view->params['language'] = $language;
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address');
            }
            return $this->redirect(['forgot-password', 'language' => $language]);
        }

        return $this->render('requestPasswordResetToken', [
                    'language' => $language,
                    'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token) {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            // Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
                    'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token) {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            // Yii::$app->session->setFlash('success', 'Your email has been confirmed');
            return $this->goHome();
        }

        // Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail() {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                // Yii::$app->session->setFlash('success', 'Check your email for further instructions');
                return $this->goHome();
            }
            // Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address');
        }

        return $this->render('resendVerificationEmail', [
                    'model' => $model
        ]);
    }

    /**
     * To Change Language.
     *
     * @return mixed
     */
    public function actionLanguage($language) {
        if (Yii::$app->request->isAjax) {
            $lang = $_POST['lang'];
            \common\components\SetLanguage::SetLanguage($lang);
            Yii::$app->session['language'] = $lang;
            return Yii::$app->session['language'];
        }
    }

    /**
     * To change-session.
     *
     * @return mixed
     */
    public function actionChangeSession($language) {
        if (Yii::$app->request->isAjax) {
            Yii::$app->session['logerror'] = 0;
            return Yii::$app->session['logerror'];
        }
    }

    /**
     * Displays department page.
     *
     * @return mixed
     */
    public function actionDepartments($language) {
        $this->view->params['language'] = $language;
        $departments = \common\models\Departments::find()->where(['status' => 1])->orderBy([new \yii\db\Expression('-sort_order DESC, sort_order ASC')])->all();
        $meta_tags = \common\models\MetaTags::findOne(4);
        $banner = \common\models\Banners::findOne(2);
        $this->view->title = $meta_tags->meta_title;
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => $meta_tags->meta_keyword]);
        $this->view->registerMetaTag(['name' => 'description', 'content' => $meta_tags->meta_description]);
        return $this->render('department', [
                    'language' => $language,
                    'departments' => $departments,
                    'banner' => $banner,
        ]);
    }

    /**
     * Displays department detail page.
     *
     * @return mixed
     */
    public function actionDepartmentDetails($language, $slug) {
        $this->view->params['language'] = $language;
        $departments = \common\models\Departments::find()->where(['status' => 1])->orderBy([new \yii\db\Expression('-sort_order DESC, sort_order ASC')])->all();
        $department_details = \common\models\Departments::find()->where(['canonical_name' => $slug])->one();
        $department_videos1 = \common\models\DepartmentVideos::find()->where(['department_id' => $department_details->id, 'status' => 1])->andWhere(['not', ['video' => null]])->one();
        $department_videos2 = [];
        if (!empty($department_videos1)) {
            $department_videos2 = \common\models\DepartmentVideos::find()->where(['department_id' => $department_details->id, 'status' => 1])->andWhere(['!=', 'id', $department_videos1->id])->andWhere(['not', ['video' => null]])->all();
        }
        
            if ($language == 'ar') {
                $meta_title = $department_details->meta_title_ar;
                $meta_keyword = $department_details->meta_keyword_ar;
                $meta_description = $department_details->meta_description_ar;
            } else {
                $meta_title = $department_details->meta_title;
                $meta_keyword = $department_details->meta_keyword;
                $meta_description = $department_details->meta_description;
            }

        $treatment_results = \common\models\DepartmentTreatmentResults::find()->where(['department_id' => $department_details->id, 'status' => 1])->all();
        $proc_and_cons = \common\models\DepartmentProsAndCons::find()->where(['department_id' => $department_details->id, 'status' => 1])->all();
        $related_services = \common\models\Services::find()->where(['department' => $department_details->id, 'status' => 1])->orderBy([new \yii\db\Expression('-sort_order DESC, sort_order ASC')])->all();
        $our_doctors = \common\models\Doctors::find()->where(['status' => 1])->andWhere(new \yii\db\Expression('FIND_IN_SET(:department,department)'))->addParams([':department' => $department_details->id])->all();
        $banner = \common\models\Banners::findOne(2);
        $this->view->title = $meta_title;
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => $meta_keyword]);
        $this->view->registerMetaTag(['name' => 'description', 'content' => $meta_description]);
        return $this->render('department-details', [
                    'language' => $language,
                    'departments' => $departments,
                    'department_details' => $department_details,
                    'department_videos1' => $department_videos1,
                    'department_videos2' => $department_videos2,
                    'treatment_results' => $treatment_results,
                    'banner' => $banner,
                    'proc_and_cons' => $proc_and_cons,
                    'related_services' => $related_services,
                    'our_doctors' => $our_doctors,
        ]);
    }

    /**
     * Displays service detail page.
     *
     * @return mixed
     */
    public function actionServiceDetails($language, $department, $slug) {
        $this->view->params['language'] = $language;
        $services = \common\models\Services::find()->where(['status' => 1])->orderBy([new \yii\db\Expression('-sort_order DESC, sort_order ASC')])->all();
        $department_details = \common\models\Departments::find()->where(['canonical_name' => $department])->one();
        $service_details = \common\models\Services::find()->where(['canonical_name' => $slug])->one();
        $service_videos1 = \common\models\ServiceVideos::find()->where(['service' => $service_details->id, 'status' => 1])->one();
        $service_videos2 = [];
        if (!empty($service_videos1)) {
            $service_videos2 = \common\models\ServiceVideos::find()->where(['service' => $service_details->id, 'status' => 1])->andWhere(['!=', 'id', $service_videos1->id])->all();
        }
        $treatment_results = \common\models\ServiceTreatmentResults::find()->where(['service' => $service_details->id, 'status' => 1])->all();
        $proc_and_cons = \common\models\ServiceProsAndCons::find()->where(['service' => $service_details->id, 'status' => 1])->all();
        $related_products = \common\models\Products::find()->where(['service' => $service_details->id, 'status' => 1])->orderBy([new \yii\db\Expression('-sort_order DESC, sort_order ASC')])->all();
        $our_doctors = \common\models\Doctors::find()->where(['status' => 1])->andWhere(new \yii\db\Expression('FIND_IN_SET(:service,service)'))->addParams([':service' => $service_details->id])->all();
        $banner = \common\models\Banners::findOne(12);
        $sub_services = \common\models\SubServices::find()->where(['service' => $service_details->id, 'status' => 1])->all();
        
        $isAr = ($language === 'ar');
        
        // Handle Title
        if ($isAr && !empty($service_details->meta_title_ar)) {
            $this->view->title = $service_details->meta_title_ar;
        } else {
            $this->view->title = $service_details->meta_title;
        }
        
        // Handle Keywords
        $keywords = ($isAr && !empty($service_details->meta_keyword_ar)) 
                    ? $service_details->meta_keyword_ar 
                    : $service_details->meta_keyword;
        
        // Handle Description
        $description = ($isAr && !empty($service_details->meta_description_ar)) 
                       ? $service_details->meta_description_ar 
                       : $service_details->meta_description;
        
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => $keywords]);
        $this->view->registerMetaTag(['name' => 'description', 'content' => $description]);

        return $this->render('service-details', [
                    'language' => $language,
                    'services' => $services,
                    'service_details' => $service_details,
                    'service_videos1' => $service_videos1,
                    'service_videos2' => $service_videos2,
                    'treatment_results' => $treatment_results,
                    'banner' => $banner,
                    'proc_and_cons' => $proc_and_cons,
                    'related_products' => $related_products,
                    'our_doctors' => $our_doctors,
                    'sub_services' => $sub_services,
                    'department_details' => $department_details,
        ]);
    }

    /**
     * Displays product detail page.
     *
     * @return mixed
     */
    public function actionSubserviceDetails($language, $service, $slug) {
        $this->view->params['language'] = $language;
        $details = \common\models\SubServices::find()->where(['canonical_name' => $slug])->one();
        $this->view->title = $details->meta_title;
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => $details->meta_keyword]);
        $this->view->registerMetaTag(['name' => 'description', 'content' => $details->meta_description]);
        return $this->render('subservice-details', [
                    'language' => $language,
                    'details' => $details,
        ]);
    }

    /**
     * Displays product detail page.
     *
     * @return mixed
     */
    public function actionProductDetails($language, $slug) {
        $this->view->params['language'] = $language;
        $product_details = \common\models\Products::find()->where(['canonical_name' => $slug])->one();
        $now_price = $product_details->price;
        $actual_price = 0;
        $percentage = 0;
        if ($product_details->offer_price > 0) {
            $actual_price = $product_details->price;
            $now_price = $product_details->offer_price;
            $percentage = round(100 - (($product_details->offer_price / $product_details->price) * 100));
        }
        $averageRating = \common\models\ProductReview::find()->where(['status' => 1, 'product_id' => $product_details->id])->average('rating');
        $benefits_of_treatments = \common\models\BenefitsOfTreatments::find()->where(['product_id' => $product_details->id, 'status' => 1])->all();
        $before_after_images = \common\models\ProductImages::find()->where(['product_id' => $product_details->id, 'status' => 1])->all();
        $faqs = \common\models\ProductFaq::find()->where(['product_id' => $product_details->id, 'status' => 1])->all();
        $terms_conditions = \common\models\ProductTermsAndConditions::find()->where(['product_id' => $product_details->id, 'status' => 1])->all();
        $reviews = \common\models\ProductReview::find()->where(['product_id' => $product_details->id, 'status' => 1])->all();
        $related_products = \common\models\Products::find()->where(['service' => $product_details->service, 'status' => 1])->orderBy([new \yii\db\Expression('-sort_order DESC, sort_order ASC')])->andWhere(['!=', 'id', $product_details->id])->all();
        // $this->view->title = $product_details->meta_title;
        // $this->view->registerMetaTag(['name' => 'keywords', 'content' => $product_details->meta_keyword]);
        // $this->view->registerMetaTag(['name' => 'description', 'content' => $product_details->meta_description]);
        
        $isAr = ($language === 'ar');
        
        // Handle Title
        if ($isAr && !empty($product_details->meta_title_ar)) {
            $this->view->title = $product_details->meta_title_ar;
        } else {
            $this->view->title = $product_details->meta_title;
        }
        
        // Handle Keywords
        $keywords = ($isAr && !empty($product_details->meta_keyword_ar)) 
                    ? $product_details->meta_keyword_ar 
                    : $product_details->meta_keyword;
        
        // Handle Description
        $description = ($isAr && !empty($product_details->meta_description_ar)) 
                       ? $product_details->meta_description_ar 
                       : $product_details->meta_description;
        
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => $keywords]);
        $this->view->registerMetaTag(['name' => 'description', 'content' => $description]);
        return $this->render('product-details', [
                    'language' => $language,
                    'product_details' => $product_details,
                    'actual_price' => $actual_price,
                    'now_price' => $now_price,
                    'percentage' => $percentage,
                    'benefits_of_treatments' => $benefits_of_treatments,
                    'before_after_images' => $before_after_images,
                    'faqs' => $faqs,
                    'terms_conditions' => $terms_conditions,
                    'reviews' => $reviews,
                    'related_products' => $related_products,
                    'averageRating' => $averageRating,
        ]);
    }

    /**
     * Displays offers page.
     *
     * @return mixed
     */
    public function actionOffers($language) {
        $this->view->params['language'] = $language;
        $searchModel = new \common\models\ProductsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['status' => 1]);
        $dataProvider->pagination->pageSize = 999999;
        $dep_id = '';
        $serv_id = '';
        $services = \common\models\Services::find()->where(['status' => 1])->orderBy([new \yii\db\Expression('-sort_order DESC, sort_order ASC')])->all();
        if (Yii::$app->request->post()) {
            if ($_POST['department'] != '') {
                $qry = \common\models\Services::find()->where(['department' => $_POST['department']])->select('id');
                $dataProvider->query->andWhere(['service' => $qry]);
                $dep_id = $_POST['department'];
                $services = \common\models\Services::find()->where(['status' => 1, 'department' => $_POST['department']])->orderBy([new \yii\db\Expression('-sort_order DESC, sort_order ASC')])->all();
            }
            if ($_POST['service'] != '') {
                $dataProvider->query->andWhere(['service' => $_POST['service']]);
                $serv_id = $_POST['service'];
            }
        }
        $departments = \common\models\Departments::find()->where(['status' => 1])->orderBy([new \yii\db\Expression('-sort_order DESC, sort_order ASC')])->all();
        $meta_tags = \common\models\MetaTags::findOne(6);
        $banner = \common\models\Banners::findOne(4);
        $this->view->title = $meta_tags->meta_title;
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => $meta_tags->meta_keyword]);
        $this->view->registerMetaTag(['name' => 'description', 'content' => $meta_tags->meta_description]);
        return $this->render('offers', [
                    'language' => $language,
                    'services' => $services,
                    'departments' => $departments,
                    'banner' => $banner,
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'dep_id' => $dep_id,
                    'serv_id' => $serv_id,
        ]);
    }

    /**
     * Displays our doctors page.
     *
     * @return mixed
     */
    public function actionOurDoctors($language) {
        $this->view->params['language'] = $language;
        $departments = \common\models\Departments::find()->where(['status' => 1])->orderBy([new \yii\db\Expression('-sort_order DESC, sort_order ASC')])->all();
        $dr_id = '';
        $dep_id = '';
        $query = new \yii\db\Query;
        $query->select(['id'])->from('doctors')->where(['status' => 1]);
        if (Yii::$app->request->post()) {
            if (isset($_POST['department']) && $_POST['department'] != '') {
                $department_id = 0;
                $query_dep = \common\models\Departments::find()->where(['or', ['like', 'department_name', $_POST['department']], ['like', 'department_name_arabic', $_POST['department']]])->one();

                if (!empty($query_dep)) {
                    $department_id = $query_dep->id;
                }
                $query->andWhere(new \yii\db\Expression('FIND_IN_SET(:department, department)'))->addParams([':department' => $department_id]);

                $dep_id = $_POST['department'];
            }
            if (isset($_POST['name']) && $_POST['name'] != '') {
                $query->andWhere(['or', ['like', 'doctor_name', $_POST['name']], ['like', 'doctor_name_arabic', $_POST['name']]]);
                $dr_id = $_POST['name'];
            }
        }
        $command = $query->createCommand();
        $res = $command->queryAll();
        $doctors = \common\models\Doctors::find()->where(['id' => $res])->all();
        $meta_tags = \common\models\MetaTags::findOne(5);
        $banner = \common\models\Banners::findOne(3);
        $this->view->title = $meta_tags->meta_title;
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => $meta_tags->meta_keyword]);
        $this->view->registerMetaTag(['name' => 'description', 'content' => $meta_tags->meta_description]);
        return $this->render('our-doctors', [
                    'language' => $language,
                    'doctors' => $doctors,
                    'departments' => $departments,
                    'banner' => $banner,
                    'dr_id' => $dr_id,
                    'dep_id' => $dep_id,
        ]);
    }

    /**
     * Displays service detail page.
     *
     * @return mixed
     */
    public function actionDoctorDetails($language, $slug) {
        $this->view->params['language'] = $language;
        $doctor_details = \common\models\Doctors::find()->where(['canonical_name' => $slug])->one();
        $gallery_images = \common\models\DoctorGallery::find()->where(['doctor_id' => $doctor_details->id, 'status' => 1])->all();
        $language_list = \common\models\Languages::find()->where(['id' => explode(",", $doctor_details->languages_known), 'status' => 1])->all();
        $meta_tags = \common\models\MetaTags::findOne(5);
        $this->view->title = $meta_tags->meta_title;
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => $meta_tags->meta_keyword]);
        $this->view->registerMetaTag(['name' => 'description', 'content' => $meta_tags->meta_description]);
        return $this->render('doctor-details', [
                    'language' => $language,
                    'doctor_details' => $doctor_details,
                    'gallery_images' => $gallery_images,
                    'language_list' => $language_list,
        ]);
    }

    /**
     * Displays blog page.
     *
     * @return mixed
     */
    public function actionBlogs($language) {
        $this->view->params['language'] = $language;
        $dep = '';
        $keyword = '';
        $query = new \yii\db\Query;
        $query->select(['id'])->from('blogs')->where(['status' => 1]);
        if (Yii::$app->request->post()) {
            if (isset($_POST['department']) && $_POST['department'] != '') {
                $query->andWhere(['department_id' => $_POST['department']]);
                $dep = $_POST['department'];
            }
            if (isset($_POST['keyword']) && $_POST['keyword'] != '') {
                $qry = \common\models\Departments::find()->where(['like', 'department_name', $_POST['keyword']])->select('id');
                $query->andWhere(['or', ['department_id' => $qry], ['like', 'title', $_POST['keyword']], ['like', 'title_arabic', $_POST['keyword']], ['like', 'description_arabic', $_POST['keyword']], ['like', 'description', $_POST['keyword']]]);
                $keyword = $_POST['keyword'];
            }
        }
        $command = $query->createCommand();
        $res = $command->queryAll();
        $blogs = \common\models\Blogs::find()->where(['id' => $res])->orderBy(['date' => SORT_DESC])->all();
        $qry = \common\models\Blogs::find()->select('department_id')->distinct();
        $departments = \common\models\Departments::find()->where(['status' => 1, 'id' => $qry])->orderBy([new \yii\db\Expression('-sort_order DESC, sort_order ASC')])->all();
        $meta_tags = \common\models\MetaTags::findOne(8);
        $banner = \common\models\Banners::findOne(5);
        $this->view->title = $meta_tags->meta_title;
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => $meta_tags->meta_keyword]);
        $this->view->registerMetaTag(['name' => 'description', 'content' => $meta_tags->meta_description]);
        return $this->render('blogs', [
                    'language' => $language,
                    'blogs' => $blogs,
                    'banner' => $banner,
                    'departments' => $departments,
                    'dep' => $dep,
                    'keyword' => $keyword,
        ]);
    }

    /**
     * Displays blog detail page.
     *
     * @return mixed
     */
    public function actionBlogDetails($language, $slug) {
        $this->view->params['language'] = $language;
        $blog_details = \common\models\Blogs::find()->where(['canonical_name' => $slug])->one();
        $blogs = \common\models\Blogs::find()->where(['department_id' => $blog_details->department_id])->andWhere(['!=', 'id', $blog_details->id])->all();
        $this->view->title = $blog_details->meta_title;
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => $blog_details->meta_keyword]);
        $this->view->registerMetaTag(['name' => 'description', 'content' => $blog_details->meta_description]);
        return $this->render('blog-details', [
                    'language' => $language,
                    'blog_details' => $blog_details,
                    'blogs' => $blogs,
        ]);
    }

    /**
     * Displays privacy policy page.
     *
     * @return mixed
     */
    public function actionPrivacyPolicy($language) {
        $this->view->params['language'] = $language;
        $data = \common\models\Policies::find()->where(['id' => 1])->one();
        $meta_tags = \common\models\MetaTags::findOne(9);
        $this->view->title = $meta_tags->meta_title;
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => $meta_tags->meta_keyword]);
        $this->view->registerMetaTag(['name' => 'description', 'content' => $meta_tags->meta_description]);
        return $this->render('privacy-policy', [
                    'language' => $language,
                    'data' => $data,
        ]);
    }

    /**
     * Displays terms & conditions page.
     *
     * @return mixed
     */
    public function actionTermsAndConditions($language) {
        $this->view->params['language'] = $language;
        $data = \common\models\Policies::find()->where(['id' => 2])->one();
        $meta_tags = \common\models\MetaTags::findOne(10);
        $this->view->title = $meta_tags->meta_title;
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => $meta_tags->meta_keyword]);
        $this->view->registerMetaTag(['name' => 'description', 'content' => $meta_tags->meta_description]);
        return $this->render('terms-and-condition', [
                    'language' => $language,
                    'data' => $data,
        ]);
    }

    /**
     * Displays FAQ page.
     *
     * @return mixed
     */
    public function actionFaq($language) {
        $this->view->params['language'] = $language;
        $qry = \common\models\Faq::find()->select('department_id')->distinct();
        $departments = \common\models\Departments::find()->where(['status' => 1, 'id' => $qry])->orderBy([new \yii\db\Expression('-sort_order DESC, sort_order ASC')])->all();
        $services = \common\models\Services::find()->where(['status' => 1])->orderBy([new \yii\db\Expression('-sort_order DESC, sort_order ASC')])->all();
        $banner = \common\models\Banners::findOne(6);
        $meta_tags = \common\models\MetaTags::findOne(11);
        $this->view->title = $meta_tags->meta_title;
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => $meta_tags->meta_keyword]);
        $this->view->registerMetaTag(['name' => 'description', 'content' => $meta_tags->meta_description]);
        return $this->render('faq', [
                    'language' => $language,
                    'departments' => $departments,
                    'services' => $services,
                    'banner' => $banner,
        ]);
    }

    /**
     * Displays insurance page.
     *
     * @return mixed
     */
    public function actionInsurance($language) {
        $this->view->params['language'] = $language;
        $datas = \common\models\Insurance::find()->where(['status' => 1])->all();
        $banner = \common\models\Banners::findOne(7);
        $meta_tags = \common\models\MetaTags::findOne(12);
        $this->view->title = $meta_tags->meta_title;
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => $meta_tags->meta_keyword]);
        $this->view->registerMetaTag(['name' => 'description', 'content' => $meta_tags->meta_description]);
        return $this->render('insurance', [
                    'language' => $language,
                    'datas' => $datas,
                    'banner' => $banner,
        ]);
    }

    /**
     * Displays careers page.
     *
     * @return mixed
     */
    public function actionCareers($language) {
        $this->view->params['language'] = $language;
        $datas = \common\models\Careers::find()->where(['status' => 1])->orderBy(['id' => SORT_DESC])->all();
        $banner = \common\models\Banners::findOne(13);
        $meta_tags = \common\models\MetaTags::findOne(7);
        $this->view->title = $meta_tags->meta_title;
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => $meta_tags->meta_keyword]);
        $this->view->registerMetaTag(['name' => 'description', 'content' => $meta_tags->meta_description]);
        return $this->render('careers', [
                    'language' => $language,
                    'datas' => $datas,
                    'banner' => $banner,
        ]);
    }

    /**
     * Career Enquiry Submission
     *
     * @return mixed
     */
    public function actionCareerEnquiry($language) {
        if (Yii::$app->request->isAjax) {
            $flag = 0;
            if (!empty($_POST['honeypot'])) {
                $file = $_FILES['resume'];
                // File details
                $fileName = $file['name'];
                $fileTmpName = $file['tmp_name'];
                $fileSize = $file['size'];
                $fileError = $file['error'];

                // Get file extension
                $fileExt = explode('.', $fileName);
                $fileActualExt = strtolower(end($fileExt));

                // Allowed file types
                $allowed = array('doc', 'docx', 'pdf');
                if (in_array($fileActualExt, $allowed)) {
                    if ($fileError === 0) {
                        if ($fileSize < 5000000) { // 5MB limit
                            $fileNameNew = 'resume' . uniqid('', true) . "." . $fileActualExt;
                            $path = Yii::$app->basePath . '/web/uploads/career-enquiry';
                            FileHelper::createDirectory($path, $mode = 0775, $recursive = true);
                            $fileDestination = $path . '/' . $fileNameNew;
                            if (move_uploaded_file($fileTmpName, $fileDestination)) {
                                $model = new \common\models\CareerEnquiry();
                                $model->job_title = $_POST['job_id'];
                                $model->name = $_POST['name'];
                                $model->resume = $fileNameNew;
                                $model->email = $_POST['email'];
                                $model->phone = $_POST['phone'];
                                $model->date = date('Y-m-d H:i:s');
                                if ($model->save()) {
                                    $flag = 1;
                                }
                            }
//                            echo "File uploaded successfully.";
                        } else {
//                            echo "File is too large.";
                        }
                    } else {
//                        echo "Error uploading file.";
                    }
                } else {
//                    echo "Invalid file type.";
                }
            }
            return $flag;
        }
    }

    /**
     * Displays Media Library page.
     *
     * @return mixed
     */
    public function actionMediaLibrary($language) {
        $this->view->params['language'] = $language;
        $dep = '';
        $serv = '';
        $categories = \common\models\MediaLibraryCategory::find()->where(['status' => 1])->all();
        $qry = \common\models\MediaLibraryCategory::find()->where(['status' => 1])->select('id');
        $query = new \yii\db\Query;
        $query->select(['id'])->from('media_library')->where(['status' => 1, 'category' => $qry]);
        if (Yii::$app->request->post()) {
            if (isset($_POST['department']) && $_POST['department'] != '') {
                $query->andWhere(['department' => $_POST['department']]);
                $dep = $_POST['department'];
            }
            if (isset($_POST['service']) && $_POST['service'] != '') {
                $query->andWhere(['service' => $_POST['service']]);
                $serv = $_POST['service'];
            }
        }
        $command = $query->createCommand();
        $res = $command->queryAll();
        $libraries = \common\models\MediaLibrary::find()->where(['id' => $res])->all();
        $galleries = \common\models\MediaGallery::find()->where(['status' => 1])->all();
        $departments = \common\models\Departments::find()->where(['status' => 1])->orderBy([new \yii\db\Expression('-sort_order DESC, sort_order ASC')])->all();
        $services = \common\models\Services::find()->where(['status' => 1])->orderBy([new \yii\db\Expression('-sort_order DESC, sort_order ASC')])->all();
        $banner = \common\models\Banners::findOne(8);
        $meta_tags = \common\models\MetaTags::findOne(13);
        $this->view->title = $meta_tags->meta_title;
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => $meta_tags->meta_keyword]);
        $this->view->registerMetaTag(['name' => 'description', 'content' => $meta_tags->meta_description]);
        return $this->render('media-library', [
                    'language' => $language,
                    'categories' => $categories,
                    'libraries' => $libraries,
                    'galleries' => $galleries,
                    'departments' => $departments,
                    'services' => $services,
                    'banner' => $banner,
                    'dep' => $dep,
                    'serv' => $serv,
                    'res' => $res,
        ]);
    }

    /**
     * Displays testimonials page.
     *
     * @return mixed
     */
    public function actionTestimonials($language) {
        $this->view->params['language'] = $language;
        $dep = '';
        $serv = '';
        $query = new \yii\db\Query;
        $query->select(['id'])->from('testimonials')->where(['status' => 1]);
        if (Yii::$app->request->post()) {
            if (isset($_POST['department']) && $_POST['department'] != '') {
                $query->andWhere(new \yii\db\Expression('FIND_IN_SET(:department, department)'))->addParams([':department' => $_POST['department']]);
                $dep = $_POST['department'];
            }
            if (isset($_POST['service']) && $_POST['service'] != '') {
                $query->andWhere(new \yii\db\Expression('FIND_IN_SET(:service, service)'))->addParams([':service' => $_POST['service']]);
                $serv = $_POST['service'];
            }
        }
        $command = $query->createCommand();
        $res = $command->queryAll();
        $datas = \common\models\Testimonials::find()->where(['id' => $res])->orderBy(['id' => SORT_DESC])->all();
        $google_reviews = \common\models\GoogleReviews::find()->where(['status' => 1])->orderBy(['id' => SORT_DESC])->all();
        $departments = \common\models\Departments::find()->where(['status' => 1])->orderBy([new \yii\db\Expression('-sort_order DESC, sort_order ASC')])->all();
        $services = \common\models\Services::find()->where(['status' => 1])->orderBy([new \yii\db\Expression('-sort_order DESC, sort_order ASC')])->all();
        $banner = \common\models\Banners::findOne(9);
        $meta_tags = \common\models\MetaTags::findOne(14);
        $this->view->title = $meta_tags->meta_title;
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => $meta_tags->meta_keyword]);
        $this->view->registerMetaTag(['name' => 'description', 'content' => $meta_tags->meta_description]);
        return $this->render('testimonial', [
                    'language' => $language,
                    'datas' => $datas,
                    'departments' => $departments,
                    'services' => $services,
                    'google_reviews' => $google_reviews,
                    'banner' => $banner,
                    'dep' => $dep,
                    'serv' => $serv,
                    'res' => $res,
        ]);
    }

    /**
     * Displays gallery page.
     *
     * @return mixed
     */
    public function actionGallery($language) {
        $this->view->params['language'] = $language;
        $dep = '';
        $serv = '';
        $query1 = new \yii\db\Query;
        $query = new \yii\db\Query;
        $query->select(['id'])->from('gallery')->where(['status' => 1]);
        $query1->select(['id'])->from('treatment_results_gallery')->where(['status' => 1]);
        if (Yii::$app->request->post()) {
            if (isset($_POST['department']) && $_POST['department'] != '') {
                $query->andWhere(['department' => $_POST['department']]);
                $query1->andWhere(['department' => $_POST['department']]);
                $dep = $_POST['department'];
            }
            if (isset($_POST['service']) && $_POST['service'] != '') {
                $query->andWhere(['service' => $_POST['service']]);
                $query1->andWhere(['service' => $_POST['service']]);
                $serv = $_POST['service'];
            }
        }
        $command = $query->createCommand();
        $command1 = $query1->createCommand();
        $res = $command->queryAll();
        $res1 = $command1->queryAll();
        $galleries = \common\models\Gallery::find()->where(['id' => $res])->orderBy(['id' => SORT_DESC])->all();
        $treatment_galleries = \common\models\TreatmentResultsGallery::find()->where(['id' => $res1])->orderBy(['id' => SORT_DESC])->all();
        $departments = \common\models\Departments::find()->where(['status' => 1])->orderBy([new \yii\db\Expression('-sort_order DESC, sort_order ASC')])->all();
        $services = \common\models\Services::find()->where(['status' => 1])->orderBy([new \yii\db\Expression('-sort_order DESC, sort_order ASC')])->all();
        $banner = \common\models\Banners::findOne(10);
        $meta_tags = \common\models\MetaTags::findOne(15);
        $this->view->title = $meta_tags->meta_title;
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => $meta_tags->meta_keyword]);
        $this->view->registerMetaTag(['name' => 'description', 'content' => $meta_tags->meta_description]);
        return $this->render('gallery', [
                    'language' => $language,
                    'galleries' => $galleries,
                    'departments' => $departments,
                    'services' => $services,
                    'treatment_galleries' => $treatment_galleries,
                    'banner' => $banner,
                    'dep' => $dep,
                    'serv' => $serv,
                    'res' => $res,
        ]);
    }

    /**
     * Appointment form submission
     *
     * @return mixed
     */
//     public function actionAppointmentForm($language) {
//         $this->view->params['language'] = $language;
//         $model = new \common\models\AppointmentEnquiry();
//         if ($model->load(Yii::$app->request->post())) {
//             $date = new \DateTime(str_replace(',', '', $model->appointment_date));
           
           
//             // var_dump($date->format('Y-m-d'));exit;
           
//             $model->appointment_date = $date->format('Y-m-d');
//             $url = $model->page_url;
//             $model->created_at = date('Y-m-d H:i:s');
//             if ($model->validate() && $model->save()) {
               
//                 // Yii::$app->session->setFlash('success', 'Appointment Booked Successfully');
//                 Yii::$app->session['logerror'] = 1;
                // Yii::$app->SetValues->bookingemail($model);
                
                

// //                Yii::$app->params['booking_session'] = 1;
//                 // Yii::$app->response->redirect($url);
               
//                 return $this->redirect(['booking-success', 'language' => $language]);
//             }
//             // else{
//             //     var_dump($model->getErors());exit;
//             // }
          
//             return $this->redirect(Yii::$app->request->referrer);
//         }else{
//             $this->redirect(['/site/index','language' => $language]);
//         }
        
//     }

    public function actionAppointmentForm($language)
    {
        $this->view->params['language'] = $language;
        $model = new AppointmentEnquiryListing();
    
        if ($model->load(Yii::$app->request->post(), 'AppointmentEnquiry')) {
            if (!empty($model->appointment_date)) {
                try {
                    $cleanDate = str_replace(',', '', $model->appointment_date);
                    $date = new \DateTime($cleanDate);
                    $model->appointment_date = $date->format('Y-m-d');
                } catch (\Exception $e) {
                    Yii::$app->session->setFlash('error', 'Invalid appointment date format.');
                    return $this->redirect(Yii::$app->request->referrer);
                }
            }
    
            $model->created_at = date('Y-m-d H:i:s');
    
            if ($model->save()) {
                Yii::$app->session['logerror'] = 1;
                Yii::$app->SetValues->bookingemail($model);
    
                // $htmlBody = $this->renderPartial('@common/mail/aapointment-mail', ['model' => $model]);
    
                // Yii::$app->mailer->compose()
                //     ->setFrom([Yii::$app->params['senderEmail'] => 'Damas'])
                //     ->setTo(Yii::$app->params['adminEmail'])
                //     ->setSubject('New Contact Enquiry')
                //     ->setHtmlBody($htmlBody)
                //     ->send();
    
                return $this->redirect(['booking-success', 'language' => $language]);
            }
    
            // Fix: Model ke validation errors ko crash hone ke bajaye session mein set karein
            $firstError = current($model->getFirstErrors());
            Yii::$app->session->setFlash('error', $firstError ?: 'Please correct the errors in the form.');
            return $this->redirect(Yii::$app->request->referrer);
        }
    
        return $this->redirect(['/site/index', 'language' => $language]);
    }

    /**
     * Landing pages
     *
     * @return mixed
     */
    public function actionLandingPage($language, $slug) {
        $this->layout = 'landing';
        $this->view->params['language'] = $language;
        $page_details = \common\models\LandingPages::find()->where(['canonical_name' => $slug, 'status' => 1])->one();
        $sliders = \common\models\LandingPageBanner::find()->where(['landing_page_id' => $page_details->id, 'status' => 1])->all();
        $about = \common\models\LandingPageAbout::find()->where(['landing_page_id' => $page_details->id])->one();
        $video_section = \common\models\LandingPageVideoSection::find()->where(['landing_page_id' => $page_details->id])->one();
        $gallery_images = \common\models\LandingPageImageGallery::find()->where(['landing_page_id' => $page_details->id, 'status' => 1])->all();
        $videos = \common\models\LandingPageVideos::find()->where(['landing_page_id' => $page_details->id, 'status' => 1])->all();
        $services = [];
        if($page_details->services != ''){
            $services = \common\models\Services::find()->where(['status' => 1,'id' => explode(",",$page_details->services)])->orderBy([new \yii\db\Expression('-sort_order DESC, sort_order ASC')])->all();
        }
        $this->view->title = $page_details->meta_title;
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => $page_details->meta_keyword]);
        $this->view->registerMetaTag(['name' => 'description', 'content' => $page_details->meta_description]);
        $this->view->params['phone'] = $page_details->phone_no;
        $this->view->params['whatsapp'] = $page_details->whatsapp_no;
        
        $model = AppointmentEnquiryListing();
        if ($language == 'ar') {
            $service_list = ArrayHelper::map(Departments::find()->where(['status' => 1])->all(), 'id', 'department_name_arabic');
            $genders = ArrayHelper::map(Genders::find()->where(['status' => 1])->all(), 'id', 'gender_arabic');
        } else {
            $service_list = ArrayHelper::map(Departments::find()->where(['status' => 1])->all(), 'id', 'department_name');
            $genders = ArrayHelper::map(Genders::find()->where(['status' => 1])->all(), 'id', 'gender');
        }
        if ($model->load(Yii::$app->request->post())) {
            $dateString = $model->appointment_date ?? ''; // Use empty string if null
            $date = new \DateTime(str_replace(',', '', $dateString));
            $model->appointment_date = $date->format('Y-m-d');
            $url = $model->page_url;
            $model->created_at = date('Y-m-d H:i:s');
            if ($model->validate() && $model->save()) {
                Yii::$app->session['logerror'] = 1;
                Yii::$app->SetValues->bookingemail($model);
                // Yii::$app->response->redirect($url);
                return $this->redirect(['booking-success', 'language' => $language]);
            }
        }
        return $this->render('landing-page', [
                    'language' => $language,
                    'page_details' => $page_details,
                    'about' => $about,
                    'sliders' => $sliders,
                    'video_section' => $video_section,
                    'gallery_images' => $gallery_images,
                    'videos' => $videos,
                    'services' => $services,
                    'genders' => $genders,
                    'service_list' => $service_list,
                    'model' => $model,
        ]);
    }

    public function actionSearch($lang = 'en') {
        if (Yii::$app->request->get()) {
            $language = $_GET['language'] ?? 'en';
            $keyword = $_GET['keyword'] ?? '';
            $doctors = [];
            $services = [];
            $departments = [];
            $this->view->params['language'] = $language;
            if($keyword != ''){
            $doctors = \common\models\Doctors::find()->where(['or', ['like', 'doctor_name', $keyword], ['like', 'doctor_name_arabic', $keyword]])->andWhere(['status' => 1])->all();
            $services = \common\models\Services::find()->where(['or', ['like', 'service_name', $keyword], ['like', 'service_name_arabic', $keyword]])->andWhere(['status' => 1])->orderBy([new \yii\db\Expression('-sort_order DESC, sort_order ASC')])->all();
            $departments = \common\models\Departments::find()->where(['or', ['like', 'department_name', $keyword], ['like', 'department_name_arabic', $keyword]])->andWhere(['status' => 1])->orderBy([new \yii\db\Expression('-sort_order DESC, sort_order ASC')])->all();
            }
            return $this->render('search-result', [
                        'language' => $language,
                        'doctors' => $doctors,
                        'services' => $services,
                        'departments' => $departments,
            ]);
        } else {
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    /*
     * Get searck keywords
     */

    public function actionKeywordSearch($language) {
        if (Yii::$app->request->isAjax) {
            $keyword = $_POST['keyword'];
            $doctors = \common\models\Doctors::find()->where(['or', ['like', 'doctor_name', $keyword], ['like', 'doctor_name_arabic', $keyword]])->andWhere(['status' => 1])->all();
            $services = \common\models\Services::find()->where(['or', ['like', 'service_name', $keyword], ['like', 'service_name_arabic', $keyword]])->andWhere(['status' => 1])->orderBy([new \yii\db\Expression('-sort_order DESC, sort_order ASC')])->all();
            $departments = \common\models\Departments::find()->where(['or', ['like', 'department_name', $keyword], ['like', 'department_name_arabic', $keyword]])->andWhere(['status' => 1])->orderBy([new \yii\db\Expression('-sort_order DESC, sort_order ASC')])->all();
            $option = $this->renderPartial('keywords', [
                'doctors' => $doctors,
                'services' => $services,
                'departments' => $departments,
                'language' => $language,
            ]);
            return $option;
        }
    }

    /*
     * Add Service review
     */

    public function actionServiceReview($language) {
        if (Yii::$app->request->isAjax) {
            if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
                $model = new \common\models\ProductReview();
                $model->product_id = $_POST["service"];
                $model->name = $_POST["name"];
                $model->email = $_POST["email"];
                $model->review_title = $_POST["review_title"];
                $model->message = $_POST["message"];
                $model->rating = 5;
                $model->date = date('Y-m-d H:i:s');

                // Validate title and rating (you can add more validation as needed)
                if (!empty($model->name) && !empty($model->email)) {
                    // File path where the uploaded file will be stored
                    $targetDir = Yii::$app->basePath . '/web/uploads/product-reviews';
                    FileHelper::createDirectory($targetDir, $mode = 0775, $recursive = true);
                    $fileName = basename($_FILES["file"]["name"]);
                    $model->image = $fileName;
                    $targetFilePath = $targetDir . '/' . $fileName;

                    // Move the uploaded file to the specified directory
                    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                        $model->save(FALSE);
                        echo "Review submitted successfully.";
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                } else {
                    echo "Name, Email Review Title and message are required fields.";
                }
            } else {
                echo "0";
            }
        }
    }
    
    public function actionBookingSuccess($language) {
        $this->view->params['language'] = $language;
        return $this->render('booking-success', [
                    'language' => $language,
        ]);
    }

}
