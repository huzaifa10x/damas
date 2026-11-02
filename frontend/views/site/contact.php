<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use common\models\Words;

// $this->params['breadcrumbs'][] = $this->title;
// $this->title = 'Damas | Contact Us';
?>

<?php
// Register the Google reCAPTCHA script in the view
$this->registerJsFile(
    'https://www.google.com/recaptcha/api.js',
    ['position' => \yii\web\View::POS_HEAD, 'async' => true, 'defer' => true]
);
?>

<div id="pageWrapper" class="contactPage">
    <section id="PageBanner">

        <img src="<?= Yii::$app->homeUrl ?>uploads/banners/<?= $language == 'ar' ? $banner->image_arabic : $banner->image ?>" data-src="<?= Yii::$app->homeUrl ?>uploads/banners/<?= $language == 'ar' ? $banner->image_arabic : $banner->image ?>" class="lazy bannerBg"
            loading="lazy" width="1920" height="535" alt="<?= $language == 'ar' ? $banner->title_arabic : $banner->title ?>">
        <div class="container">
            <div class="mainBanner">
                <div class="captionBx">
                    <h1 class="mainHead"><?= $language == 'ar' ? $banner->title_arabic : $banner->title ?></h1>
                    <div class="tagLine"><?= $language == 'ar' ? $banner->description_arabic : $banner->description ?></div>

                    <section id="Breadcrumb">
                        <div class="container">
                            <ul class="breadcrumb">
                                <li><a href="<?= Url::to(['site/index', 'language' => $language]); ?>"><?= Words::getValue($language, 'home') ?></a></li>
                                <li class="active"><?= Words::getValue($language, 'contact_us') ?></li>
                            </ul>
                        </div>
                    </section>
                </div>

            </div>
        </div>
    </section>

<section id="contact" class="appointmentSection" dir="<?= $language === 'ar' ? 'rtl' : 'ltr' ?>">
    <div class="container">
      
        <div class="appointmentSection__layout">
            <div class="appointmentSection__intro">
                <span class="appointmentSection__eyebrow"><?= $language === 'ar' ? 'حجز موعد' : 'BOOKING' ?></span>
                <h2><?= $language === 'ar' ? 'احجز موعدك' : 'Book Your Appointment' ?></h2>
                <p><?= $language === 'ar' ? 'أخبرنا بالقسم الذي تحتاجه والوقت المناسب لك. سيتصل بك فريقنا لتأكيد موعدك. تتوفر عادةً مواعيد مسائية وفي عطلة نهاية الأسبوع.' : 'Tell us which department you need and when suits you. Our team will call to confirm your time. Evening and weekend slots are usually available.' ?></p>

                <a class="appointmentSection__phone" href="tel:+97165067444">
                    <span class="appointmentSection__phoneIcon" aria-hidden="true">
                        <svg viewBox="0 0 24 24"><path d="M6.6 10.8a15.5 15.5 0 0 0 6.6 6.6l2.2-2.2a1 1 0 0 1 1.02-.24c1.12.37 2.32.57 3.58.57a1 1 0 0 1 1 1V20a1 1 0 0 1-1 1C10.6 21 3 13.4 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.26.2 2.46.57 3.58a1 1 0 0 1-.25 1.02l-2.22 2.2Z"/></svg>
                    </span>
                    <span><small><?= $language === 'ar' ? 'لحجز موعد' : 'To Book An Appointment' ?></small><strong>+971 6 506 7444</strong></span>
                </a>

                <div class="appointmentSection__hours" aria-label="<?= $language === 'ar' ? 'ساعات العمل' : 'Opening hours' ?>">
                    <div><strong><?= $language === 'ar' ? 'السبت – الخميس' : 'Saturday – Thursday' ?></strong><span><?= $language === 'ar' ? '9:00 ص – 10:00 م' : '9:00 AM – 10:00 PM' ?></span></div>
                    <div><strong><?= $language === 'ar' ? 'الجمعة' : 'Friday' ?></strong><span><?= $language === 'ar' ? '12:00 م – 10:00 م' : '12:00 PM – 10:00 PM' ?></span></div>
                </div>
            </div>

            <div class="appointmentSection__formCard contactUs">
                <h3><?= $language === 'ar' ? 'احجز موعداً' : 'Book An Appointment' ?></h3><?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                    <input type="text" value="1" name="honeypot" style="display: none;">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="itemList">
                                <div class="item">
                                    <div class="rd_bx ">
                                        <input type="radio" class="type" id="type" name="ContactEnquiry[type]" value="0"
                                            required="" data-trigger="contactus" checked="">
                                        <label for="type">
                                            <?= Words::getValue($language, 'enquiry') ?>
                                        </label>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="rd_bx ">
                                        <input type="radio" class="trigger type" id="type1" name="ContactEnquiry[type]"
                                            value="1" required="" data-trigger="contactus">
                                        <label for="type1">
                                            <?= Words::getValue($language, 'feedback') ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <?= $form->field($model, 'name')->textInput(['placeholder' => Words::getValue($language, 'enter_your_name')])->label(FALSE) ?>
                        </div>
                        <div class="col-lg-6">
                            <?= $form->field($model, 'phone_number')->textInput(['placeholder' => Words::getValue($language, 'enter_your_phone_number')])->label(FALSE) ?>
                        </div>
                        <div class="col-lg-12">
                            <?= $form->field($model, 'email')->textInput(['placeholder' => Words::getValue($language, 'enter_your_email_id')])->label(FALSE) ?>
                        </div>
                        <div class="col-lg-12">
                            <?= $form->field($model, 'message')->textarea(['placeholder' => Words::getValue($language, 'message')])->label(FALSE) ?>
                        </div>

                        <!-- reCAPTCHA Checkbox -->
                        <div class="col-lg-12 mb-3">
                            <div class="g-recaptcha" data-sitekey="6LeIN5stAAAAAH4T1_W3wKcBxlKmq8P-8bzJTga4"></div>

                            <?php if ($model->hasErrors('reCaptcha')): ?>
                                <div class="text-danger" style="margin-top: 5px;">
                                    <?= $model->getFirstError('reCaptcha') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-12">
                            <?= Html::submitButton('<span>' . Words::getValue($language, "submit_message") . '</span>', ['class' => 'hoveranim cmnBtn']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>                </div>
            </div>
        </div>
    </div>
</section>

</div>