<?php
/** @var \yii\web\View $this */

/** @var string $content */
use frontend\assets\AppAsset;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use common\models\Words;
use common\models\About;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Services;
use common\models\Genders;

AppAsset::register($this);
$controller = Yii::$app->controller->id;
$action = Yii::$app->controller->action->id;
$action_url = $controller . '/' . $action;
$language = $this->params['language'];
$phone = $this->params['phone'];
$whatsapp = $this->params['whatsapp'];
if ($language == '') {
    $language = 'en';
}
$departments = \common\models\Departments::find()->where(['status' => 1])->all();
$booking_session = Yii::$app->session['logerror'];
$currentUrl = Url::to(Yii::$app->request->url, true);
// Access the model component
$model = Yii::$app->AppointmentModelHelper;
if ($language == 'ar') {
    $service_list = ArrayHelper::map(Services::find()->where(['status' => 1])->all(), 'id', 'service_name_arabic');
} else {
    $service_list = ArrayHelper::map(Services::find()->where(['status' => 1])->all(), 'id', 'service_name');
}
$contact_data = common\models\ContactUs::findOne(1);
$genders = ArrayHelper::map(Genders::find()->where(['status' => 1])->all(), 'id', 'gender');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= $language ?>" class="h-100">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <link rel="icon" type="image/png" sizes="16x16" href="<?= Yii::$app->homeUrl ?>images/favicon.ico">
        <link rel="manifest" href="<?= Yii::$app->homeUrl ?>images/manifest.json">

        <meta name="msapplication-TileColor" content="#39AA7E">
        <meta name="theme-color" content="#060606">


        <!-- FONTS -->

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
              rel="stylesheet">

        <!-- JQUERY --->

        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
                integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <!-- BOOTSTRAP --->

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>


        <!-- LAZY LOAD --->

        <script type="text/javascript"
                src="//cdn.jsdelivr.net/npm/intersection-observer@0.7.0/intersection-observer.min.js">
        </script>
        <script src="//cdn.jsdelivr.net/npm/vanilla-lazyload@17.8.3/dist/lazyload.min.js"></script>

        <!-- SCROLL TRIGGER --->
        <script src="//cdnjs.cloudflare.com/ajax/libs/ScrollTrigger/1.0.6/ScrollTrigger.min.js"
                integrity="sha512-+LXqbM6YLduaaxq6kNcjMsQgZQUTdZp7FTaArWYFt1nxyFKlQSMdIF/WQ/VgsReERwRD8w/9H9cahFx25UDd+g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <!-- GSAP --->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollTrigger/1.0.6/ScrollTrigger.min.js"
                integrity="sha512-+LXqbM6YLduaaxq6kNcjMsQgZQUTdZp7FTaArWYFt1nxyFKlQSMdIF/WQ/VgsReERwRD8w/9H9cahFx25UDd+g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"
                integrity="sha512-16esztaSRplJROstbIIdwX3N97V1+pZvV33ABoG1H2OyTttBxEGkTsoIVsiP1iaTtM8b3+hu2kB6pQ4Clr5yug=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <!--SELECT PICKER-->

        <link rel="stylesheet"
              href="//cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
        <script src="//cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>



        <!-- BOOTSTRAP_SELECTPICKER -->

        <!--<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">-->
        <!--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.min.css">

        <script src="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.min.js
        "></script>


        <!-- ANIMATE CSS --->

        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />



        <!-- INCLUDES -->

        <link rel="stylesheet preload" href="<?= Yii::$app->homeUrl ?>css/app.min.css" as="style"
              onload="this.onload = null;this.rel = 'stylesheet'">
        <noscript>
        <link rel="stylesheet" href="<?= Yii::$app->homeUrl ?>css/app.min.css">
        </noscript>
        <link rel="stylesheet" href="<?= Yii::$app->homeUrl ?>css/style.css">
        <?php $this->head() ?>
    </head>
    <body id="body">
        <?php $this->beginBody() ?>
        <header id="Header">
            <div class="Background"></div>
            <section class="HeaderMenu">

                <div class="container">
                    <div class="FlexRow">

                        <div class="lftSec">
                            <a href="<?= Url::to(['site/index', 'language' => $language]); ?>" class="LogoSec" aria-label="logo">
                                <img src="<?= Yii::$app->homeUrl ?>images/logo.svg" alt="damasmc">
                            </a>

                        </div>

                        <div class="ritSec">

                            <div class="modal fade" id="HeaderPOP" tabindex="-1" role="dialog"
                                 aria-labelledby="bookingModalLabel" aria-hidden="true">
                                <div class="modal-dialog mobile-menu" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="accordion" id="AccordMenu">
                                                <div class="accordion-item dropDownBx">
                                                    <div class="accordion-header">
                                                        <a href="<?= Url::to(['site/departments', 'language' => $language]); ?>" class="accordion-button collapsed"  class="<?= $action_url == 'site/departments' || $action_url == 'site/department-details' ? 'active' : '' ?>"
                                                           data-bs-toggle="collapse" data-bs-target="#AccordMenuTwo"
                                                           aria-expanded="false" aria-controls="AccordMenuTwo" onclick="window.location.href='<?= Url::to(['site/departments', 'language' => $language]); ?>'">
                                                               <?= Words::getValue($language, 'department') ?>
                                                        </a>
                                                    </div>
                                                    <div id="AccordMenuTwo" class="accordion-collapse dropBox collapse"
                                                         aria-labelledby="headingTwo" data-bs-parent="#AccordMenu">
                                                        <div class="accordion-body">
                                                            <div class="container">
                                                                <div class="rowFlx accordion" id="submenuAccord">
                                                                    <div class="leftSec">
                                                                        <ul>
                                                                            <?php
                                                                            if (!empty($departments)) {
                                                                                $i = 0;
                                                                                foreach ($departments as $department) {
                                                                                    $i++;
                                                                                    ?>
                                                                                    <li>
                                                                                        <a href="<?= Url::to(['site/department-details', 'language' => $language, 'slug' => $department->canonical_name]); ?>" data-val="<?= Yii::$app->homeUrl ?>uploads/departments/<?= $department->department_image ?>"
                                                                                           class="cmnBtnLink department-change"
                                                                                           data-bs-toggle="collapse"
                                                                                           data-bs-target="#submenuAccord<?= $department->id ?>"
                                                                                           aria-expanded="<?= $i == 1 ? 'true' : '' ?>"
                                                                                           aria-controls="submenuAccord<?= $department->id ?>" onclick="window.location.href='<?= Url::to(['site/department-details', 'language' => $language, 'slug' => $department->canonical_name]); ?>'">
                                                                                               <?= $language == 'ar' ? $department->department_name_arabic : $department->department_name ?>
                                                                                        </a>
                                                                                    </li>
                                                                                    <?php
                                                                                }
                                                                            }
                                                                            ?>

                                                                        </ul>

                                                                    </div>
                                                                    <div class="rtSec">
                                                                        <div class="accordionBx">
                                                                            <?php
                                                                            if (!empty($departments)) {
                                                                                $j = 0;
                                                                                foreach ($departments as $department) {
                                                                                    $j++;
                                                                                    $services = common\models\Services::find()->where(['department' => $department->id, 'status' => 1])->all();
                                                                                    ?>
                                                                                    <div class="accordion-item">
                                                                                        <div class="accordion-header"
                                                                                             id="heading<?= $department->id ?>">
                                                                                            <button class="accordion-button department-change" data-val="<?= Yii::$app->homeUrl ?>uploads/departments/<?= $department->department_image ?>"
                                                                                                    type="button"
                                                                                                    data-bs-toggle="collapse"
                                                                                                    data-bs-target="#submenuAccord<?= $department->id ?>"
                                                                                                    aria-expanded="<?= $j == 1 ? 'true' : '' ?>"
                                                                                                    aria-controls="submenuAccord<?= $department->id ?>">
                                                                                                        <?= $language == 'ar' ? $department->department_name_arabic : $department->department_name ?>
                                                                                            </button>
                                                                                        </div>
                                                                                        <div id="submenuAccord<?= $department->id ?>"
                                                                                             class="accordion-collapse collapse <?= $j == 1 ? 'show' : '' ?>"
                                                                                             aria-labelledby="heading<?= $department->id ?>"
                                                                                             data-bs-parent="#submenuAccord">
                                                                                            <div class="accordion-body">
                                                                                                <div class="flxBox">
                                                                                                    <div class="lefBx">
                                                                                                        <ul>
                                                                                                            <?php
                                                                                                            if (!empty($services)) {
                                                                                                                foreach ($services as $service) {
                                                                                                                    ?>
                                                                                                                    <li>
                                                                                                                        <a href="<?= Url::to(['site/service-details', 'language' => $language, 'slug' => $service->canonical_name]); ?>"
                                                                                                                           class="pageLinks"><?= $language == 'ar' ? $service->service_name_arabic : $service->service_name ?></a>
                                                                                                                    </li>
                                                                                                                    <?php
                                                                                                                }
                                                                                                            }
                                                                                                            ?>
                                                                                                        </ul>
                                                                                                    </div>
                                                                                                    <div class="rtBx">
                                                                                                        <div class="item">
                                                                                                            <div class="imgBox">
                                                                                                                <img src="<?= Yii::$app->homeUrl ?>images/menu1.jpg"
                                                                                                                     data-src="<?= Yii::$app->homeUrl ?>images/menu1.jpg"
                                                                                                                     class="lazy"
                                                                                                                     loading="lazy"
                                                                                                                     width="300"
                                                                                                                     height="360"
                                                                                                                     alt="Department Image"
                                                                                                                     id="dep-image">
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="item">
                                                                                                            <div class="contactBx">
                                                                                                                <div
                                                                                                                    class="imgBxBg">
                                                                                                                    <img src="<?= Yii::$app->homeUrl ?>images/iconLg.svg"
                                                                                                                         alt="damasmc">
                                                                                                                </div>
                                                                                                                <a href="tel:<?= $phone ?>" target="_blank"
                                                                                                                   class="callBtn">
                                                                                                                       <?= $phone ?>
                                                                                                                </a>
                                                                                                                <div class="flx">
                                                                                                                    <div
                                                                                                                        class="item">
                                                                                                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#bookingModal"
                                                                                                                           class="cmnBtns hoveranim">
                                                                                                                            <span><?= Words::getValue($language, 'book_an_appointment') ?></span>
                                                                                                                        </a>
                                                                                                                    </div>
                                                                                                                    <div
                                                                                                                        class="item">
                                                                                                                        <a href="https://api.whatsapp.com/send?phone=<?= str_replace(' ', '', $whatsapp) ?>&text=Help Me ?" target="_blank"
                                                                                                                           class="cmnBtns hoveranim green">
                                                                                                                            <span><?= Words::getValue($language, 'chat_with_whatsapp') ?></span>
                                                                                                                            <div
                                                                                                                                class="icon">
                                                                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                                                     width="20.234"
                                                                                                                                     height="20.403"
                                                                                                                                     viewBox="0 0 20.234 20.403">
                                                                                                                                <g id="icon"
                                                                                                                                   transform="translate(0)">
                                                                                                                                <path
                                                                                                                                    id="Path_10023"
                                                                                                                                    data-name="Path 10023"
                                                                                                                                    d="M55.617,41A10.121,10.121,0,0,0,39.4,52.711l-1.074,5.213a.381.381,0,0,0,.062.3.389.389,0,0,0,.413.161l5.1-1.211A10.121,10.121,0,0,0,55.609,41ZM54.022,53.718a7.935,7.935,0,0,1-9.127,1.5l-.714-.354-3.133.741v-.04l.66-3.16-.349-.687a7.924,7.924,0,0,1,12.663-9.2l.035.048a7.925,7.925,0,0,1-.04,11.162Z"
                                                                                                                                    transform="translate(-38.299 -37.997)"
                                                                                                                                    fill="#fff" />
                                                                                                                                <path
                                                                                                                                    id="Path_10024"
                                                                                                                                    data-name="Path 10024"
                                                                                                                                    d="M65.331,64.113a2.647,2.647,0,0,1-1.4,1.222c-1.074.258-2.708,0-4.755-1.892l-.026-.024c-1.781-1.662-2.253-3.048-2.148-4.145a2.627,2.627,0,0,1,1.02-1.557.584.584,0,0,1,.913.215l.659,1.491a.58.58,0,0,1-.071.593l-.335.43a.569.569,0,0,0-.045.634,6.229,6.229,0,0,0,1.132,1.259,6.7,6.7,0,0,0,1.568,1.123.569.569,0,0,0,.621-.131l.384-.391a.582.582,0,0,1,.586-.163L65,63.224a.589.589,0,0,1,.331.889Z"
                                                                                                                                    transform="translate(-50.915 -51.343)"
                                                                                                                                    fill="#fff" />
                                                                                                                                </g>
                                                                                                                                </svg>

                                                                                                                            </div>
                                                                                                                        </a>
                                                                                                                    </div>
                                                                                                                    <div
                                                                                                                        class="item">
                                                                                                                        <a href="<?= Url::to(['site/offers', 'language' => $language]); ?>"
                                                                                                                           class="cmnBtns hoveranim brwn">
                                                                                                                            <span>
                                                                                                                                <?= Words::getValue($language, 'our_offers') ?>
                                                                                                                            </span>

                                                                                                                        </a>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <?php
                                                                                }
                                                                            }
                                                                            ?>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="accordion-item">
                                                    <div class="accordion-header">
                                                        <a href="<?= Url::to(['site/about', 'language' => $language]); ?>"
                                                           class="accordion-button <?= $action_url == 'site/about' ? 'active' : '' ?>">
                                                               <?= Words::getValue($language, 'about_us') ?> 
                                                        </a>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="contCtBx">
                                <ul>
                                    <li>
                                        <a href="tel:<?= $contact_data->phone1 ?>" class="cmnBTN hoveranim">
                                            <div class="icon">
                                                <svg viewBox="0 0 15.844 17">
                                                <g id="Group_22054" data-name="Group 22054"
                                                   transform="translate(-0.872 0)">
                                                <path id="Path_11214" data-name="Path 11214"
                                                      d="M14.941,11.832c-1.027-.878-2.069-1.41-3.084-.533l-.606.53c-.443.385-1.267,2.183-4.453-1.482s-1.29-4.23-.846-4.611L6.562,5.2c1.009-.879.628-1.986-.1-3.125l-.439-.69C5.292.253,4.5-.493,3.484.385L2.938.862a5.132,5.132,0,0,0-2,3.4c-.365,2.414.786,5.177,3.423,8.21S9.573,17.026,12.016,17a5.145,5.145,0,0,0,3.64-1.507l.549-.478c1.009-.877.382-1.77-.646-2.65Z"
                                                      transform="translate(0 0)" />
                                                </g>
                                                </svg>

                                            </div>

                                            <span><?= $contact_data->phone1 ?></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" class="hoveranim cmnBTN brown" data-bs-toggle="modal" data-bs-target="#bookingModal">
                                            <span><?= Words::getValue($language, 'book_an_appointment') ?></span>
                                            <div class="icon white">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="5.156" height="9"
                                                     viewBox="0 0 5.156 9">
                                                <path id="Exclusion_3" data-name="Exclusion 3"
                                                      d="M-3697-75l5.156,4.516h0L-3697-66Z"
                                                      transform="translate(3697 75)" />
                                                </svg>

                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= Url::to(['site/offers', 'language' => $language]); ?>" class="hoveranim cmnBTN ligt">
                                            <div class="icon">
                                                <svg viewBox="0 0 21.398 22.301">
                                                <g id="Group_22056" data-name="Group 22056"
                                                   transform="translate(-3839.77 1827.385)">
                                                <g id="Group_22022" data-name="Group 22022"
                                                   transform="translate(3839.77 -1827.385)">
                                                <g id="Group_22021" data-name="Group 22021"
                                                   transform="translate(0 0)">
                                                <path id="Path_11234" data-name="Path 11234"
                                                      d="M30.726,11.437a.654.654,0,0,1,0-.578l.832-1.7a1.936,1.936,0,0,0-.835-2.571L29.049,5.7a.654.654,0,0,1-.34-.467l-.327-1.865A1.936,1.936,0,0,0,26.2,1.778l-1.875.265a.654.654,0,0,1-.549-.179L22.41.548a1.936,1.936,0,0,0-2.7,0L18.345,1.865a.654.654,0,0,1-.549.179l-1.875-.265a1.936,1.936,0,0,0-2.187,1.589l-.327,1.865a.654.654,0,0,1-.34.467l-1.673.888a1.936,1.936,0,0,0-.835,2.571l.832,1.7a.654.654,0,0,1,0,.578l-.832,1.7a1.936,1.936,0,0,0,.835,2.571l1.673.888a.654.654,0,0,1,.34.467l.327,1.865a1.935,1.935,0,0,0,1.908,1.609,1.989,1.989,0,0,0,.278-.02l1.875-.265a.653.653,0,0,1,.549.179l1.361,1.317a1.936,1.936,0,0,0,2.7,0l1.361-1.317a.654.654,0,0,1,.549-.179l1.875.265a1.936,1.936,0,0,0,2.187-1.589l.327-1.865a.654.654,0,0,1,.34-.467l1.673-.888a1.936,1.936,0,0,0,.835-2.571Zm-.606,3.136-1.673.888a1.932,1.932,0,0,0-1,1.381l-.327,1.865a.655.655,0,0,1-.74.538L24.5,18.98a1.931,1.931,0,0,0-1.624.528l-1.361,1.317a.655.655,0,0,1-.915,0L19.24,19.508a1.93,1.93,0,0,0-1.347-.547,1.974,1.974,0,0,0-.277.02l-1.875.265a.655.655,0,0,1-.74-.538l-.327-1.865a1.931,1.931,0,0,0-1-1.381L12,14.573a.655.655,0,0,1-.283-.87l.832-1.7a1.932,1.932,0,0,0,0-1.707l-.832-1.7A.655.655,0,0,1,12,7.724l1.673-.888a1.932,1.932,0,0,0,1-1.381L15,3.589a.655.655,0,0,1,.74-.538l1.875.265a1.932,1.932,0,0,0,1.624-.528L20.6,1.473a.655.655,0,0,1,.915,0l1.361,1.317a1.931,1.931,0,0,0,1.624.528l1.875-.265a.655.655,0,0,1,.74.538l.327,1.865a1.931,1.931,0,0,0,1,1.381l1.673.888a.655.655,0,0,1,.283.87l-.832,1.7a1.932,1.932,0,0,0,0,1.707l.832,1.7A.655.655,0,0,1,30.119,14.573Z"
                                                      transform="translate(-10.359 0.002)" />
                                                </g>
                                                </g>
                                                <g id="Group_22024" data-name="Group 22024"
                                                   transform="translate(3845.581 -1821.122)">
                                                <g id="Group_22023" data-name="Group 22023"
                                                   transform="translate(0)">
                                                <path id="Path_11235" data-name="Path 11235"
                                                      d="M153.378,143.98a.643.643,0,0,0-.909,0l-8.489,8.489a.643.643,0,1,0,.909.91l8.489-8.489A.643.643,0,0,0,153.378,143.98Z"
                                                      transform="translate(-143.791 -143.791)" />
                                                </g>
                                                </g>
                                                <g id="Group_22026" data-name="Group 22026"
                                                   transform="translate(3845.538 -1822.022)">
                                                <g id="Group_22025" data-name="Group 22025">
                                                <path id="Path_11236" data-name="Path 11236"
                                                      d="M145.16,123.116a2.358,2.358,0,1,0,2.358,2.358A2.361,2.361,0,0,0,145.16,123.116Zm0,3.43a1.072,1.072,0,1,1,1.072-1.072A1.073,1.073,0,0,1,145.16,126.546Z"
                                                      transform="translate(-142.802 -123.116)" />
                                                </g>
                                                </g>
                                                <g id="Group_22028" data-name="Group 22028"
                                                   transform="translate(3850.683 -1815.162)">
                                                <g id="Group_22027" data-name="Group 22027">
                                                <path id="Path_11237" data-name="Path 11237"
                                                      d="M263.28,280.61a2.358,2.358,0,1,0,2.358,2.358A2.361,2.361,0,0,0,263.28,280.61Zm0,3.43a1.072,1.072,0,1,1,1.072-1.072A1.073,1.073,0,0,1,263.28,284.04Z"
                                                      transform="translate(-260.922 -280.61)" />
                                                </g>
                                                </g>
                                                </g>
                                                </svg>
                                            </div>
                                            <span><?= Words::getValue($language, 'select_department') ?></span>
                                            <div class="icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="5.156" height="9"
                                                     viewBox="0 0 5.156 9">
                                                <path id="Exclusion_3" data-name="Exclusion 3"
                                                      d="M-3697-75l5.156,4.516h0L-3697-66Z"
                                                      transform="translate(3697 75)" />
                                                </svg>

                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://api.whatsapp.com/send?phone=<?= str_replace(' ', '', $contact_data->whatsapp_no) ?>&text=Help Me ?" target="_blank"" class="wtap">
                                            <div class="icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="27.929" height="27.929"
                                                     viewBox="0 0 27.929 27.929">
                                                <path id="Path_11233" data-name="Path 11233"
                                                      d="M14.372,28.056a13.733,13.733,0,0,1-6.627-1.693L.154,28.775l2.474-7.3A13.466,13.466,0,0,1,.661,14.451a13.711,13.711,0,1,1,13.711,13.6Zm0-25.043A11.5,11.5,0,0,0,2.845,14.451a11.321,11.321,0,0,0,2.2,6.706L3.6,25.4,8.03,24A11.468,11.468,0,1,0,14.372,3.013ZM21.3,17.584c-.084-.139-.308-.222-.644-.389s-1.989-.974-2.3-1.085-.533-.167-.757.167-.868,1.085-1.064,1.307-.392.251-.728.084a9.2,9.2,0,0,1-2.7-1.655A10.041,10.041,0,0,1,11.234,13.7c-.2-.334-.021-.514.147-.68.151-.15.336-.389.5-.584a2.254,2.254,0,0,0,.336-.556.609.609,0,0,0-.028-.584c-.084-.167-.757-1.808-1.036-2.475s-.56-.556-.756-.556-.42-.028-.644-.028a1.24,1.24,0,0,0-.9.417,3.729,3.729,0,0,0-1.176,2.781,6.452,6.452,0,0,0,1.372,3.449c.168.222,2.324,3.7,5.741,5.034s3.418.89,4.034.834A3.4,3.4,0,0,0,21.1,19.17a2.778,2.778,0,0,0,.2-1.586Z"
                                                      transform="translate(-0.154 -0.846)" fill="#2aa81a"
                                                      fill-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>


                        <div class="MenuIcon">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#HeaderPOP">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
            </section>

        </header>

        <div class="fixedRit">

            <ul>
                <li>
                    <a href="#appointment" class="bookNow hoveranim" data-bs-toggle="modal" data-bs-target="#bookingModal">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30.494" height="30" viewBox="0 0 30.494 30">
                            <g id="Group_21433" data-name="Group 21433"
                               transform="translate(-35.905 -285.506) rotate(-90)">
                            <path id="Path_5" data-name="Path 5"
                                  d="M-77.653,65.906l-1.43-1.509,1.151-1.034,3.5,3.418c1.032-.8,2.065-1.629,3.02-2.5a8.011,8.011,0,0,1-.279,4.451c-1.153,2.822-3.816,5.246-7.154,5.086a7.8,7.8,0,0,1-4.609-1.987c.516-.437,1.073-.914,1.629-1.39a32,32,0,0,0,4.172-4.53m-3.775-3.973-.953-1.034,1.032-.874,1,.954Zm10.81,1.55a7.193,7.193,0,0,0,.756-.795c2.5-2.624,4.053-4.571,3.3-8.5A7.6,7.6,0,0,0-73.321,48.1,8.847,8.847,0,0,0-78.8,49.374c-2.583-2.265-5.166-3.616-7.71-3.457a7.625,7.625,0,0,0-7.191,5.563A7.233,7.233,0,0,0-92.713,58c-2.465,2.98-3.936,5.882-3.617,8.623A7.493,7.493,0,0,0-90.41,73.5a7.149,7.149,0,0,0,6.24-1.152l.2.239c2.5,2.622,4.369,4.292,8.345,3.695a7.5,7.5,0,0,0,6.4-6.438,9.413,9.413,0,0,0-1.391-6.358m-17.167,4.292,3.895-3.577-1.073-1.112-1.828,1.55a32,32,0,0,1-4.253-4.412,17.555,17.555,0,0,1-1.111-1.43c-1.511,1.509-2.385,3.576-1.63,6.914.954,2.9,3.418,5.484,6.756,5.564a8.079,8.079,0,0,0,1.709-.2,28.436,28.436,0,0,1-2.464-3.3m9.935-9.141,2.106-1.947a39.043,39.043,0,0,1,4.649,6,7.6,7.6,0,0,0,2.225-5.166c-.039-3.337-2.583-5.882-5.444-6.875a9.437,9.437,0,0,0-3.378-.278c1.113,1.073,2.265,2.344,3.419,3.695L-78.726,57.8Zm6.04,4.57a8.817,8.817,0,0,0-2.622-2.94c-.319.277-.637.556-.954.874.834.835,1.668,1.708,2.5,2.583a6.751,6.751,0,0,0,1.073-.517m-9.737,3.417c-1.112.994-2.185,1.947-3.257,2.9a6.661,6.661,0,0,0,.516,1.232,5.493,5.493,0,0,0,3.537-3.338Zm-3.139-8.186-4.171-4.451c-.954.914-1.869,1.789-2.664,2.663a11.031,11.031,0,0,1-.118-1.669c.238-3.338,2.98-5.642,5.922-6.437,2.859-.516,4.728.119,6.118,1.271a34.684,34.684,0,0,0-6.516,5.523l2.345,2.305Zm5.882-7.829a17.618,17.618,0,0,1,1.151,1.669c-1.151,1.034-2.3,2.026-3.5,3.06-.478-.516-.994-1.034-1.511-1.51A7.649,7.649,0,0,1-78.8,50.606M-87.27,60.7l-.834.755a5.56,5.56,0,0,1-3.1-3.5c.238-.159.516-.357.755-.516,1.033,1.073,2.105,2.146,3.178,3.258"
                                  transform="translate(-219.133 -10)" fill="#d5ae69" fill-rule="evenodd" />
                            </g>
                            </svg>
                        </div>
                        <span>
                            <?= Words::getValue($language, 'book_now') ?>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="https://api.whatsapp.com/send?phone=<?= str_replace(' ', '', $contact_data->whatsapp_no) ?>&text=Help Me ?" target="_blank" id="whatsapp" class="socialLink">
                        <div class="align">
                            <svg id="Layer_2" data-name="Layer 2" xmlns="http://www.w3.org/2000/svg" width="68" height="68"
                                 viewBox="0 0 68 68">
                            <g id="_08.whatsapp" data-name="08.whatsapp">
                            <circle id="background" cx="34" cy="34" r="34" fill="#2aa81a" />
                            <g id="icon" transform="translate(15 15)">
                            <path id="Path_10023" data-name="Path 10023"
                                  d="M67.914,43.135A17.307,17.307,0,0,0,40.186,63.159L38.35,72.074a.652.652,0,0,0,.106.519.666.666,0,0,0,.707.275l8.722-2.07A17.307,17.307,0,0,0,67.9,43.135ZM65.187,64.881a13.57,13.57,0,0,1-15.608,2.557l-1.221-.606L43,68.1V68.03l1.129-5.4-.6-1.175A13.55,13.55,0,0,1,65.187,45.72l.06.083a13.551,13.551,0,0,1-.069,19.088Z"
                                  transform="translate(-36.592 -37.276)" fill="#fff" />
                            <path id="Path_10024" data-name="Path 10024"
                                  d="M71.257,68.753a4.527,4.527,0,0,1-2.4,2.09c-1.836.441-4.632,0-8.132-3.236l-.044-.04c-3.045-2.843-3.853-5.212-3.673-7.089a4.493,4.493,0,0,1,1.745-2.663,1,1,0,0,1,1.561.367l1.128,2.549a.992.992,0,0,1-.121,1.014l-.573.735a.973.973,0,0,0-.077,1.084,10.652,10.652,0,0,0,1.936,2.152,11.449,11.449,0,0,0,2.681,1.921.973.973,0,0,0,1.062-.224l.657-.668a1,1,0,0,1,1-.279l2.681.768a1.006,1.006,0,0,1,.566,1.521Z"
                                  transform="translate(-44.897 -46.194)" fill="#fff" />
                            </g>
                            </g>
                            </svg>

                        </div>

                    </a>
                </li>
                <li>
                    <a href="tel:<?= $contact_data->phone1 ?>" target="_blank" id="call" class="socialLink">
                        <div class="align">
                            <svg xmlns="http://www.w3.org/2000/svg" width="68" height="68" viewBox="0 0 68 68">
                            <g id="chat" transform="translate(0.327 0.071)">
                            <g id="Ellipse_89" data-name="Ellipse 89" transform="translate(-0.327 -0.071)"
                               fill="#d5ae69" stroke="#e5bb70" stroke-width="1">
                            <circle cx="34" cy="34" r="34" stroke="none" />
                            <circle cx="34" cy="34" r="33.5" fill="none" />
                            </g>
                            <path id="Path_10022" data-name="Path 10022"
                                  d="M166.512,150.708c-.28-.158-.6-.336-.979-.566-.213-.129-.481-.305-.766-.492-1.459-.958-2.564-1.636-3.5-1.636a1.711,1.711,0,0,0-.619.111,5.983,5.983,0,0,0-2.156,1.987,10.536,10.536,0,0,1-.791.924,15.567,15.567,0,0,1-7.562-7.57,10.458,10.458,0,0,1,.928-.8,5.993,5.993,0,0,0,1.981-2.15c.407-1.057-.339-2.32-1.524-4.127-.187-.284-.363-.553-.491-.765-.231-.384-.409-.7-.567-.981-.646-1.149-1.073-1.909-2.677-1.909-1.041,0-2.513.985-3.511,1.961a6.667,6.667,0,0,0-2.247,4.618c0,4.236,2.365,9.09,6.48,13.323.007.007.014.009.021.016,4.23,4.119,9.084,6.475,13.316,6.475h0a6.646,6.646,0,0,0,4.613-2.239c.977-1,1.962-2.46,1.962-3.5C168.419,151.782,167.66,151.355,166.512,150.708Z"
                                  transform="translate(-121.351 -111.806)" fill="#fff" />
                            </g>
                            </svg>

                        </div>

                    </a>
                </li>
                <li>
                    <a href="<?= $contact_data->instagram_link ?>" target="_blank" id="insta" class="socialLink">
                        <div class="align">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="68"
                                 height="68" viewBox="0 0 68 68">
                            <defs>
                            <linearGradient id="linear-gradient" x1="0.146" y1="0.146" x2="0.854" y2="0.854"
                                            gradientUnits="objectBoundingBox">
                            <stop offset="0" stop-color="#fae100" />
                            <stop offset="0.15" stop-color="#fcb720" />
                            <stop offset="0.3" stop-color="#ff7950" />
                            <stop offset="0.5" stop-color="#ff1c74" />
                            <stop offset="1" stop-color="#6c1cd1" />
                            </linearGradient>
                            </defs>
                            <g id="Layer_2" data-name="Layer 2" transform="translate(0.03 0.029)">
                            <g id="Circle" transform="translate(0.007 0)">
                            <g id="_03.Instagram" data-name="03.Instagram" transform="translate(0 0)">
                            <rect id="Background" width="68" height="68" rx="34"
                                  transform="translate(-0.038 -0.029)" fill="url(#linear-gradient)" />
                            <g id="Group_21885" data-name="Group 21885">
                            <path id="Shade"
                                  d="M59.86,11.683A121.751,121.751,0,0,1,39.042,39.047a121.913,121.913,0,0,1-27.351,20.8q-.858-.746-1.667-1.555A34.147,34.147,0,1,1,58.308,10q.8.814,1.551,1.684Z"
                                  transform="translate(-0.016 0)" fill="#fff" opacity="0.1" />
                            <g id="Icon" transform="translate(16.169 16.176)">
                            <path id="Path_11177" data-name="Path 11177"
                                  d="M62.061,36H45.885A9.885,9.885,0,0,0,36,45.885V62.061a9.885,9.885,0,0,0,9.885,9.885H62.061a9.885,9.885,0,0,0,9.885-9.885V45.885A9.885,9.885,0,0,0,62.061,36ZM68.8,60.641a8.16,8.16,0,0,1-8.16,8.16H47.305a8.16,8.16,0,0,1-8.16-8.16V47.305a8.16,8.16,0,0,1,8.16-8.16H60.641a8.16,8.16,0,0,1,8.16,8.16Z"
                                  transform="translate(-36 -36)" fill="#fff" />
                            <path id="Path_11178" data-name="Path 11178"
                                  d="M71.333,58.129l-.085-.085-.072-.072a9.058,9.058,0,0,0-6.4-2.642,9.22,9.22,0,0,0-9.157,9.288,9.324,9.324,0,0,0,2.7,6.565,9.072,9.072,0,0,0,6.479,2.7,9.315,9.315,0,0,0,6.538-15.749ZM64.777,70.711a6.093,6.093,0,1,1,6.008-6.093A6.093,6.093,0,0,1,64.777,70.711Z"
                                  transform="translate(-46.804 -46.644)" fill="#fff" />
                            <path id="Path_11179" data-name="Path 11179"
                                  d="M97.095,51.682a2.193,2.193,0,0,1-2.179,2.211,2.161,2.161,0,0,1-1.537-.643,2.215,2.215,0,0,1,1.541-3.77,2.166,2.166,0,0,1,1.389.5l.045.045a1.371,1.371,0,0,1,.2.2l.049.054a2.211,2.211,0,0,1,.494,1.4Z"
                                  transform="translate(-67.246 -43.423)" fill="#fff" />
                            </g>
                            </g>
                            </g>
                            </g>
                            </g>
                            </svg>

                        </div>

                    </a>
                </li>

            </ul>
        </div>



        <div id="viewport">
            <?= $content ?>
            <footer>
                <section id="footersec">
                    <div class="bannerBg">
                        <img src="<?= Yii::$app->homeUrl ?>images/footerBg.svg" alt="damasmc">
                    </div>
                    <div class="container">

                        <div class="accordion" id="footerAccord">
                            <div class="row">
                                <div class="col-md-3 col-lg-4 cmnSec">
                                    <div class="accordion-item">
                                        <div class="accordion-header" id="headingOne">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#footerAccordOne" aria-expanded="true"
                                                    aria-controls="footerAccordOne">
                                                <div class="headTitle">Information
                                                </div>
                                            </button>
                                        </div>
                                        <div id="footerAccordOne" class="accordion-collapse collapse  " aria-labelledby="headingOne"
                                             data-bs-parent="#footerAccord">
                                            <div class="accordion-body">

                                                <div class="headTitle"><?= Words::getValue($language, 'information') ?> </div>
                                                <ul class="links info">
                                                    <li>
                                                        <a href="<?= Url::to(['site/about', 'language' => $language]); ?>" class="linkBtn"> <?= Words::getValue($language, 'about_us') ?> </a>
                                                    </li>
                                                    <!--<li>-->
                                                        <!--<a href="<?php // Url::to(['site/services', 'language' => $language]);                       ?>" class="linkBtn"> Services </a>-->
                                                    <!--</li>-->
                                                    <li>
                                                        <a href="<?= Url::to(['site/our-doctors', 'language' => $language]); ?>" class="linkBtn"> <?= Words::getValue($language, 'our_doctors') ?> </a>
                                                    </li>
                                                    <li>
                                                        <a href="<?= Url::to(['site/privacy-policy', 'language' => $language]); ?>" class="linkBtn"><?= Words::getValue($language, 'privacy_policy') ?> </a>
                                                    </li>
                                                    <li>
                                                        <a href="<?= Url::to(['site/terms-and-conditions', 'language' => $language]); ?>" class="linkBtn"> <?= Words::getValue($language, 'terms_and_condition') ?> </a>
                                                    </li>
                                                    <li>
                                                        <a href="<?= Url::to(['site/contact', 'language' => $language]); ?>" class="linkBtn"> <?= Words::getValue($language, 'contact_us') ?></a>
                                                    </li>
                                                    <li>
                                                        <a href="<?= Url::to(['site/media-library', 'language' => $language]); ?>" class="linkBtn"><?= Words::getValue($language, 'media_library') ?></a>
                                                    </li>
                                                    <li>
                                                        <a href="<?= Url::to(['site/insurance', 'language' => $language]); ?>" class="linkBtn"><?= Words::getValue($language, 'insurance') ?></a>
                                                    </li>
                                                    <li>
                                                        <a href="<?= Url::to(['site/blogs', 'language' => $language]); ?>" class="linkBtn"><?= Words::getValue($language, 'blogs') ?></a>
                                                    </li>
                                                    <li>
                                                        <a href="<?= Url::to(['site/faq', 'language' => $language]); ?>" class="linkBtn"><?= Words::getValue($language, 'faq') ?></a>
                                                    </li>
                                                    <li>
                                                        <a href="<?= Url::to(['site/gallery', 'language' => $language]); ?>" class="linkBtn"><?= Words::getValue($language, 'gallery') ?></a>
                                                    </li>
                                                </ul>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 col-lg-4  ">

                                    <div class="accordion-item">
                                        <div class="accordion-header" id="headingTwo">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#footerAccordTwo" aria-expanded="true"
                                                    aria-controls="footerAccordTwo">
                                                <div class="headTitle"><?= Words::getValue($language, 'contact') ?>
                                                </div>
                                            </button>
                                        </div>
                                        <div id="footerAccordTwo" class="accordion-collapse collapse  " aria-labelledby="headingTwo"
                                             data-bs-parent="#footerAccord">
                                            <div class="accordion-body">

                                                <div class="headTitle"><?= Words::getValue($language, 'contact') ?></div>
                                                <ul class="links cnt">
                                                    <li>
                                                        <div class="mainTxt"><?= Words::getValue($language, 'address') ?></div>
                                                        <a href="javascript:void(0)" class="linkBtn contLink">
                                                            <span>
                                                                <?= $language == 'ar' ? $contact_data->address_arabic : $contact_data->address ?> 
                                                            </span>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <div class="mainTxt"><?= Words::getValue($language, 'phone') ?></div>

                                                        <a href="tel:<?= $contact_data->phone1 ?>" class="linkBtn contLink">
                                                            <span> <?= $contact_data->phone1 ?> </span>
                                                            <div class="Txt"><?= Words::getValue($language, 'phone_no1_description') ?></div>
                                                        </a>
                                                        <a href="tel:<?= $contact_data->phone2 ?>" class="linkBtn contLink">
                                                            <span> <?= $contact_data->phone2 ?> </span>
                                                            <div class="Txt"><?= Words::getValue($language, 'phone_no2_description') ?></div>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <div class="mainTxt"><?= Words::getValue($language, 'email') ?></div>
                                                        <a href="mailto:<?= $contact_data->email ?>" class="linkBtn contLink">
                                                            <span><?= $contact_data->email ?></span>
                                                        </a>
                                                    </li>
                                                </ul>

                                                <div class="socialBx">
                                                    <div class="mainTxt"><?= Words::getValue($language, 'social_media') ?></div>
                                                    <ul>
                                                        <li>
                                                            <a href="<?= $contact_data->facebook_link ?>" target="_blank" class="links">
                                                                <div class="icon">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="13.247"
                                                                         height="23.339" viewBox="0 0 13.247 23.339">
                                                                    <path id="facebook"
                                                                          d="M9.929,5.777c.032-.036.181-.153.766-.153h1.919A1.133,1.133,0,0,0,13.746,4.49V1.136A1.134,1.134,0,0,0,12.616,0L9.766,0A5.866,5.866,0,0,0,5.441,1.678,6.159,6.159,0,0,0,3.812,6.091V7.9H1.632A1.133,1.133,0,0,0,.5,9.032v3.612a1.133,1.133,0,0,0,1.132,1.132H3.812v8.43a1.133,1.133,0,0,0,1.132,1.132H8.682a1.133,1.133,0,0,0,1.132-1.132v-8.43H12.48a1.133,1.133,0,0,0,1.132-1.132V9.032a1.136,1.136,0,0,0-.582-.99,1.15,1.15,0,0,0-.56-.142H9.814V6.471c0-.466.063-.634.115-.694Zm0,0"
                                                                          transform="translate(-0.5 0)" />
                                                                    </svg>

                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="<?= $contact_data->instagram_link ?>" target="_blank" class="links">
                                                                <div class="icon">
                                                                    <svg id="instagram" xmlns="http://www.w3.org/2000/svg"
                                                                         width="23.72" height="23.72" viewBox="0 0 23.72 23.72">
                                                                    <g id="Group_183" data-name="Group 183"
                                                                       transform="translate(0)">
                                                                    <g id="Group_182" data-name="Group 182">
                                                                    <path id="Path_143" data-name="Path 143"
                                                                          d="M17.795,0H5.935A5.948,5.948,0,0,0,0,5.93V17.79a5.948,5.948,0,0,0,5.93,5.93h11.86a5.948,5.948,0,0,0,5.93-5.93V5.93A5.948,5.948,0,0,0,17.795,0Zm3.953,17.79a3.958,3.958,0,0,1-3.953,3.953H5.935A3.958,3.958,0,0,1,1.982,17.79V5.93A3.958,3.958,0,0,1,5.935,1.977h11.86A3.957,3.957,0,0,1,21.748,5.93V17.79Z"
                                                                          transform="translate(-0.005 0)" />
                                                                    </g>
                                                                    </g>
                                                                    <g id="Group_185" data-name="Group 185"
                                                                       transform="translate(16.802 3.953)">
                                                                    <g id="Group_184" data-name="Group 184">
                                                                    <ellipse id="Ellipse_14" data-name="Ellipse 14"
                                                                             cx="1.482" cy="1.482" rx="1.482" ry="1.482" />
                                                                    </g>
                                                                    </g>
                                                                    <g id="Group_187" data-name="Group 187"
                                                                       transform="translate(5.93 5.93)">
                                                                    <g id="Group_186" data-name="Group 186">
                                                                    <path id="Path_144" data-name="Path 144"
                                                                          d="M108.335,102.4a5.93,5.93,0,1,0,5.93,5.93A5.929,5.929,0,0,0,108.335,102.4Zm0,9.884a3.953,3.953,0,1,1,3.953-3.954A3.953,3.953,0,0,1,108.335,112.284Z"
                                                                          transform="translate(-102.405 -102.4)" />
                                                                    </g>
                                                                    </g>
                                                                    </svg>

                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="<?= $contact_data->youtube_link ?>" target="_blank" class="links">
                                                                <div class="icon" id="youtube">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30.018"
                                                                         height="21.692" viewBox="0 0 30.018 21.692">
                                                                    <path id="youtube"
                                                                          d="M15.006,22.192H15c-.906-.006-8.913-.079-11.182-.693A4.639,4.639,0,0,1,.552,18.237,34.047,34.047,0,0,1,0,11.375,34.688,34.688,0,0,1,.55,4.461l0-.006A4.737,4.737,0,0,1,3.812,1.171l.012,0C6.067.578,14.091.506,15,.5h.016c.908.006,8.937.079,11.185.694A4.638,4.638,0,0,1,29.46,4.451a33.031,33.031,0,0,1,.553,6.95,34.141,34.141,0,0,1-.55,6.852l0,.006a4.64,4.64,0,0,1-3.266,3.263l-.006,0c-2.243.589-10.266.661-11.174.668h-.008ZM2.817,5.062a33.545,33.545,0,0,0-.472,6.3v.031a31.521,31.521,0,0,0,.472,6.239,2.287,2.287,0,0,0,1.61,1.6c1.674.453,8.2.6,10.579.612,2.39-.017,8.921-.155,10.583-.59a2.288,2.288,0,0,0,1.607-1.6,31.629,31.629,0,0,0,.472-6.239c0-.012,0-.025,0-.037A30.528,30.528,0,0,0,27.2,5.07v0a2.288,2.288,0,0,0-1.611-1.608c-1.658-.453-8.19-.6-10.579-.612-2.388.017-8.913.155-10.58.589a2.352,2.352,0,0,0-1.61,1.628ZM28.329,17.954h0Zm-16.311-1.86V6.6l8.208,4.749Zm0,0"
                                                                          transform="translate(0.002 -0.5)" />
                                                                    </svg>

                                                                </div>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="<?= $contact_data->twitter_link ?>" target="_blank" class="links">
                                                                <div class="icon">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21.407"
                                                                         height="20.793" viewBox="0 0 21.407 20.793">
                                                                    <path id="Path_321" data-name="Path 321"
                                                                          d="M24.711,8.381,31.921,0H30.213l-6.26,7.277L18.952,0H13.185l7.561,11-7.561,8.789h1.709L21.5,12.108l5.281,7.685h5.767L24.711,8.381Zm-2.34,2.72-.766-1.1-6.1-8.719h2.624l4.919,7.037.766,1.1,6.395,9.146H27.589L22.371,11.1Z"
                                                                          transform="translate(-12.095 0.5)" stroke-width="1" />
                                                                    </svg>

                                                                </div>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="<?= $contact_data->threads_link ?>" target="_blank" class="links">
                                                                <div class="icon">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="23.158"
                                                                         height="26.396" viewBox="0 0 23.158 26.396">
                                                                    <path id="threads"
                                                                          d="M43.186,26.4h-.008c-3.938-.027-6.966-1.325-9-3.86-1.811-2.256-2.744-5.395-2.776-9.328v-.019c.031-3.934.965-7.072,2.776-9.328,2.033-2.535,5.062-3.834,9-3.86h.015A12.149,12.149,0,0,1,50.7,2.306a11.108,11.108,0,0,1,3.86,6.013l-2.243.626C51.1,4.59,48.032,2.364,43.185,2.329c-3.2.023-5.619,1.029-7.192,2.989C34.52,7.153,33.759,9.8,33.731,13.2c.029,3.394.79,6.045,2.262,7.879,1.573,1.96,3.992,2.966,7.192,2.989,2.884-.021,4.793-.693,6.38-2.248a4.724,4.724,0,0,0,1.2-5.276,4.238,4.238,0,0,0-1.8-1.923,7.266,7.266,0,0,1-1.413,3.6,5.383,5.383,0,0,1-4.1,1.969A6.037,6.037,0,0,1,39.87,19.3a4.125,4.125,0,0,1-.466-6.649,6.5,6.5,0,0,1,3.94-1.419,15.076,15.076,0,0,1,3.321.157,3.824,3.824,0,0,0-.822-1.932,3.318,3.318,0,0,0-2.6-.98h-.032a3.452,3.452,0,0,0-2.994,1.451l-1.933-1.3a5.715,5.715,0,0,1,4.926-2.48h.048c3.514.022,5.607,2.171,5.815,5.925.12.05.237.1.353.157A6.814,6.814,0,0,1,52.9,15.609a7.038,7.038,0,0,1-1.7,7.874c-2.032,1.99-4.5,2.889-8,2.913h-.007Zm1.1-12.859c-.266,0-.536.008-.812.024-2.02.114-3.279,1.039-3.207,2.357.075,1.38,1.6,2.022,3.061,1.943,1.347-.072,3.1-.6,3.394-4.081a11.7,11.7,0,0,0-2.435-.242Z"
                                                                          transform="translate(-31.403)" />
                                                                    </svg>

                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="<?= $contact_data->linkedin_link ?>" target="_blank" class="links">
                                                                <div class="icon">
                                                                    <svg id="Group_176" data-name="Group 176"
                                                                         xmlns="http://www.w3.org/2000/svg"
                                                                         xmlns:xlink="http://www.w3.org/1999/xlink" width="22.755"
                                                                         height="21.749" viewBox="0 0 22.755 21.749">
                                                                    <defs>
                                                                    <clipPath id="clip-path">
                                                                        <rect id="Rectangle_91" data-name="Rectangle 91"
                                                                              width="22.754" height="21.749" />
                                                                    </clipPath>
                                                                    </defs>
                                                                    <g id="Group_175" data-name="Group 175">
                                                                    <g id="Group_174" data-name="Group 174"
                                                                       clip-path="url(#clip-path)">
                                                                    <path id="Path_139" data-name="Path 139"
                                                                          d="M2.759,0A2.542,2.542,0,1,0,2.7,5.071h.032A2.543,2.543,0,1,0,2.759,0" />
                                                                    <rect id="Rectangle_90" data-name="Rectangle 90"
                                                                          width="4.878" height="14.675"
                                                                          transform="translate(0.288 7.074)" />
                                                                    <path id="Path_140" data-name="Path 140"
                                                                          d="M230.273,189.108c-2.631,0-4.4,2.473-4.4,2.473v-2.128H221v14.675h4.878v-8.195a3.343,3.343,0,0,1,.161-1.19,2.67,2.67,0,0,1,2.5-1.784c1.765,0,2.471,1.346,2.471,3.318v7.85h4.877v-8.414c0-4.507-2.407-6.6-5.616-6.6"
                                                                          transform="translate(-213.134 -182.378)" />
                                                                    </g>
                                                                    </g>
                                                                    </svg>

                                                                </div>
                                                            </a>
                                                        </li>

                                                    </ul>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-4  ">

                                    <div class="accordion-item">
                                        <div class="accordion-header" id="headingOne">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#footerAccordThree" aria-expanded="true"
                                                    aria-controls="footerAccordThree">
                                                <div class="headTitle"> <?= Words::getValue($language, 'get_a_free_quote') ?> </div>
                                            </button>
                                        </div>
                                        <div id="footerAccordThree" class="accordion-collapse collapse  "
                                             aria-labelledby="headingOne" data-bs-parent="#footerAccord">
                                            <div class="accordion-body">
                                                <div class="addressBx">
                                                    <div class="headTitle"><?= Words::getValue($language, 'get_a_free_quote') ?></div>
                                                    <p>
                                                        <?= Words::getValue($language, 'get_a_free_quote_description') ?>

                                                    </p>

                                                    <div class="btnSec">
                                                        <div class="item">
                                                            <a href="javascript:void(0)" class="hoveranim cmnBtn"
                                                               data-bs-toggle="modal" data-bs-target="#bookingModal">
                                                                <span><?= Words::getValue($language, 'book_now') ?></span>
                                                            </a>
                                                        </div>
                                                        <div class="item">
                                                            <a href="<?= $contact_data->location_link ?>" class="cmnBtn white locatn">
                                                                <div class="locatnBx">
                                                                    <iframe
                                                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d225.3692133810375!2d55.38607616654417!3d25.340887679898216!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f5bc8b1a00bc9%3A0x143896d2e20e3108!2sCorniche%20Plaza%20I%20%26%20II!5e0!3m2!1sen!2sin!4v1704862596845!5m2!1sen!2sin"
                                                                        style="border:0;" allowfullscreen="" loading="lazy"
                                                                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                                                                </div>

                                                                <span> <?= Words::getValue($language, 'our_location_map') ?></span>

                                                                <div class="icon">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="13.693"
                                                                         height="16.736" viewBox="0 0 13.693 16.736">
                                                                    <g id="Layer_2" data-name="Layer 2"
                                                                       transform="translate(-3.001 -0.999)">
                                                                    <path id="Path_11174" data-name="Path 11174"
                                                                          d="M14.2,2.558A6.844,6.844,0,1,0,5.68,13.273a11.6,11.6,0,0,1,2.983,3.208l.533.886a.761.761,0,0,0,1.3,0l.51-.851a9.677,9.677,0,0,1,2.722-3.043A6.839,6.839,0,0,0,14.2,2.555Zm-4.35,8.331A3.043,3.043,0,1,1,12.89,7.846,3.043,3.043,0,0,1,9.847,10.889Z"
                                                                          transform="translate(0 0)" fill="#763813" />
                                                                    </g>
                                                                    </svg>

                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="Txt"><?= Words::getValue($language, 'copyright') ?> © <?= date('Y') ?> <br><?= Words::getValue($language, 'copyright_description') ?>
                                                    </div>
                                                    <div class="Txt  ">
                                                        <?= Words::getValue($language, 'designed_by') ?>: <a href="javascript:void(0)"><?= Words::getValue($language, 'intersmart') ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>


            </footer>

            <!-- Booking Success Modal -->
            <div class="modal fade PopupModals" id="bookingSuccessModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <h5><?= Words::getValue($language, 'book_appointment_success_message') ?></h5>
                            <button type="button" class="close-btn" data-bs-dismiss="modal">OK</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <!-- CUSTOME --->
        <script type="text/javascript" src="<?= Yii::$app->homeUrl ?>js/app.min.js"></script>

        <!-- AOS --->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/themes/dark.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.js"></script>
        <!-- booking popup -->


        <div class="modal fade bookingModal" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <a href="javascript:void(0)" class="closeBtn" data-bs-dismiss="modal" aria-label="Close">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="27.764" height="27.764"
                                 viewBox="0 0 27.764 27.764">
                            <g id="Group_11467" data-name="Group 11467" transform="translate(-2 -2)">
                            <path id="Path_12146" data-name="Path 12146"
                                  d="M9.185,8.2a.694.694,0,0,0-.982.982l4.368,4.368L8.2,17.921a.694.694,0,0,0,.982.982l4.368-4.368L17.921,18.9a.694.694,0,1,0,.982-.982l-4.368-4.368L18.9,9.185a.694.694,0,0,0-.982-.982l-4.368,4.368Z"
                                  transform="translate(2.329 2.329)" />
                            <path id="Path_12147" data-name="Path 12147"
                                  d="M2,8.941A6.941,6.941,0,0,1,8.941,2H22.823a6.941,6.941,0,0,1,6.941,6.941V22.823a6.941,6.941,0,0,1-6.941,6.941H8.941A6.941,6.941,0,0,1,2,22.823ZM8.941,3.388H22.823a5.553,5.553,0,0,1,5.553,5.553V22.823a5.553,5.553,0,0,1-5.553,5.553H8.941a5.553,5.553,0,0,1-5.553-5.553V8.941A5.553,5.553,0,0,1,8.941,3.388Z"
                                  fill-rule="evenodd" />
                            </g>
                            </svg>
                        </div>
                    </a>

                    <div class="modal-body">
                        <div class="flxBx">
                            <div class="lftBx">
                                <div class="imgBx">
                                    <img src="<?= About::getValue('book_an_appointment_image', $language) ?>" data-src="<?= About::getValue('book_an_appointment_image', $language) ?>" width="700"
                                         height="630" alt="popupBg">
                                </div>
                            </div>
                            <div class="rtSec">
                                <div class="appointMentBox ">
                                    <div class="imgBox">
                                        <img src="<?= Yii::$app->homeUrl ?>images/logIcon.svg" alt="damasmc">
                                    </div>
                                    <div class="title"><?= Words::getValue($language, 'book_appointment') ?></div>
                                    <?php
                                    $form = ActiveForm::begin([
                                                'id' => 'appointment-form',
                                                'action' => Url::to(['site/appointment-form', 'language' => $language]),
                                                'method' => 'post',
                                    ]);
                                    ?>
                                    <div class="row">
                                        <input type="hidden" name="AppointmentEnquiry[page_url]" value="<?= $currentUrl ?>"/>
                                        <div class="col-lg-12">
                                            <?= $form->field($model->getAppointmentModel(), 'name')->textInput(['placeholder' => Words::getValue($language, 'name') . ' *'])->label(FALSE) ?>
                                        </div>
                                        <div class="col-lg-6">
                                            <?= $form->field($model->getAppointmentModel(), 'age')->textInput(['placeholder' => Words::getValue($language, 'age') . ' *'])->label(FALSE) ?>
                                        </div>
                                        <div class="col-lg-6">
                                            <?php
                                            echo $form->field($model->getAppointmentModel(), 'gender')
                                                    ->dropDownList(
                                                            $genders, // Flat array ('id'=>'label')
                                                            ['prompt' => Words::getValue($language, 'gender') . ' *', 'class' => 'select']    // options
                                                    )->label(FALSE);
                                            ?>
                                        </div>
                                        <div class="col-lg-12">
                                            <?= $form->field($model->getAppointmentModel(), 'phone_number')->textInput(['placeholder' => Words::getValue($language, 'phone_no') . ' *'])->label(FALSE) ?>
                                        </div>
                                        <div class="col-lg-12">
                                            <?= $form->field($model->getAppointmentModel(), 'email')->textInput(['placeholder' => Words::getValue($language, 'email') . ' *'])->label(FALSE) ?>
                                        </div>
                                        <div class="col-sm-12">
                                            <?= $form->field($model->getAppointmentModel(), 'appointment_date')->textInput(['placeholder' => Words::getValue($language, 'your_preferred_date') . ' *', 'id' => 'dateInput'])->label(FALSE) ?>
                                        </div>
                                        <div class="col-lg-12">
                                            <?php
                                            echo $form->field($model->getAppointmentModel(), 'service')
                                                    ->dropDownList(
                                                            $service_list, // Flat array ('id'=>'label')
                                                            ['prompt' => Words::getValue($language, 'what_do_you_prefer'), 'class' => 'select']    // options
                                                    )->label(FALSE);
                                            ?>
                                        </div>

                                        <div class="col-lg-12">
                                            <button class="hoveranim cmnBtn">
                                                <span><?= Words::getValue($language, 'book_now') ?></span>
                                            </button>
                                        </div>
                                    </div>
                                    <?php ActiveForm::end(); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>




        <script>
                    AOS.init({
                        duration: 600,
                    });


                    $("select:not(.selectpicker)").select2({
                        minimumResultsForSearch: Infinity,
                        theme: "bootstrap-5",
                        containerCssClass: "select2--small", // For Select2 v4.0
                        selectionCssClass: "select2--small", // For Select2 v4.1
                        dropdownCssClass: "select2--small",
                    });



                    // datepicker

                   flatpickr("#eventDate", {
                dateFormat: "F, d Y",
                disable: [{
                        from: "1700-01-01",
                        to: "1800-01-01"
                    }]
            });

                    $('#dateBtn').on('click', function () {
                        $(".label").hide();
                    });
        </script>
        <script>
            $(document).ready(function () {
                // Hover and Click
                $(".department-change").on({
                    mouseenter: function () {
                        var src = $(this).attr('data-val');
                        $("#dep-image").attr("src", src);
                        $("#dep-image").attr("data-src", src);
                    },
                    click: function () {
                        var src = $(this).attr('data-val');
                        $("#dep-image").attr("src", src);
                        $("#dep-image").attr("data-src", src);
                    }
                });
            });
        </script>
        <script>
            $(document).ready(function () {
                var booking_sess = <?= $booking_session ?>;
                if (booking_sess == 1) {
                    $("#bookingSuccessModal").modal('show');
                    $.ajax({
                        url: '<?= Yii::$app->homeUrl ?>en/change-session',
                        type: 'post',
                        data: {
                            booking_sess: booking_sess
                        },
                        success: function (data) {
                        }
                    });
                }
            });
        </script>
        <script>
            // Get the input element
            var dateInput = document.getElementById('dateInput');

            // Add focus event listener
            dateInput.addEventListener('focus', function () {
                // Create a new date input element
                var datepicker = document.createElement('input');
                datepicker.type = 'date';

                // Copy the attributes from the original input
                datepicker.value = dateInput.value;
                datepicker.name = dateInput.name;
                datepicker.id = dateInput.id;
                datepicker.className = dateInput.className;
                datepicker.style = dateInput.style;

                // Replace the original input with the datepicker
                dateInput.parentNode.replaceChild(datepicker, dateInput);

                // Add blur event listener to update the original input when focus is lost
                datepicker.addEventListener('blur', function () {
                    dateInput.value = datepicker.value;
                });
            });
        </script>
        <?php $this->endBody() ?>
    </body>
</html>
<?php
$this->endPage();
