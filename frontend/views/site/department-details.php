<?php

/** @var yii\web\View $this */

use yii\helpers\Url;
use common\models\Words;
use common\models\Departments;
use common\models\About;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\View;
use yii\widgets\ActiveForm;

$currentUrl = Url::to(Yii::$app->request->url, true);
$controller = Yii::$app->controller->id;
$action     = Yii::$app->controller->action->id;
$homeUrl    = Yii::$app->homeUrl;
$isAr       = ($language === 'ar');
$action_url = $controller . '/' . $action;
$language   = !empty($this->params['language']) ? $this->params['language'] : 'en';


// $this->params['breadcrumbs'][] = $this->title;
// $this->title = 'Damas | ' . $department_details->department_name;
$this->registerCssFile($homeUrl . 'lib/owl.carousel-2.3.4.min.css', ['media' => 'print', 'onload' => "this.media='all';this.onload=null"]);
$this->registerCss('#appointment{position:relative;overflow:hidden;isolation:isolate}#appointment .parallax-img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:center left;z-index:-1}@media (min-width:1024px) and (hover:hover){#appointment .parallax-img{height:130%;top:-15%;will-change:transform}}');


$insuranceDepts = [];
if (!empty($insurances)) {
    $deptIds = array_unique(array_map(function ($i) {
        return $i->department;
    }, $insurances));
    $insuranceDepts = Departments::find()->where(['id' => $deptIds])->indexBy('id')->all();
}

$bookImage     = $isAr ? About::getValue('book_an_appointment_image_arabic', $language) : About::getValue('book_an_appointment_image', $language);
?>

<div id="pageWrapper" class="cosmetcPage">


    <section id="PageBanner">
        <img src="<?= Yii::$app->homeUrl ?>uploads/departments/<?= $language == 'ar' ? $department_details->banner_image_arabic : $department_details->banner_image ?>"
            data-src="<?= Yii::$app->homeUrl ?>uploads/departments/<?= $language == 'ar' ? $department_details->banner_image_arabic : $department_details->banner_image ?>"
            class="lazy bannerBg" loading="lazy" width="1920" height="535"
            alt="<?= $language == 'ar' ? $department_details->department_name_arabic : $department_details->department_name ?>">
        <div class="container">
            <div class="mainBanner">
                <div class="captionBx">
                    <h1 class="mainHead"><?= $language == 'ar' ? $department_details->department_name_arabic : $department_details->department_name ?></h1>
                    <div class="tagLine"><?= $language == 'ar' ? $department_details->banner_description_arabic : $department_details->banner_description ?></div>
                    <section id="Breadcrumb">
                        <div class="container">
                            <ul class="breadcrumb">
                                <li><a href="<?= Url::to(['site/index', 'language' => $language]) ?>"><?= Words::getValue($language, 'home') ?></a></li>
                                <li class="active"><?= $language == 'ar' ? $department_details->department_name_arabic : $department_details->department_name ?></li>
                            </ul>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>

    <section id="cosmeticSec">
        <div class="container">
            <div class="contentWrap">
                <?php $departmentName = $isAr ? $department_details->department_name_arabic : $department_details->department_name; ?>
                <div class="cont">
                    <h2 class="tle"><?= Html::encode($departmentName) ?></h2>
                    <div class="cosmeticTags">
                        <span class="cosmeticTag">
                            <svg version="1.1" id="dentist" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 256 256" xml:space="preserve" fill="#000000">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <style type="text/css">
                                        .st0 {
                                            fill: #FAF5EC;
                                        }

                                        .st1 {
                                            fill: #814826;
                                        }
                                    </style>
                                    <path class="st0" d="M137.432,250.574c-3.195,0-5.973-0.855-8.25-2.543c-2.914-2.155-4.271-5.217-4.833-8.176 c-3.108,3.687-7.457,5.852-12.367,5.852c-4.685,0-9.342-2.084-13.115-5.867c-5.649-5.665-10.718-11.77-15.619-17.673 c-2.002-2.412-4.072-4.905-6.119-7.289c-0.587-0.685-1.08-1.444-1.463-2.262l-0.572-1.218c-9.81-20.873-19.076-40.586-16.537-64.938 c1.952-18.706-0.934-35.598-7.717-45.188c-12.482-17.641-18.35-32.962-9.059-54.805c6.653-15.637,19.197-24.47,35.322-24.872 c0.629-0.016,1.258-0.023,1.889-0.023c9.186,0,18.229,1.623,26.633,3.377c1.748,0.365,3.462,0.542,5.242,0.542 c2.58,0,5.371-0.375,8.784-1.18l2.923-0.692c10.796-2.563,21.96-5.213,33.477-6.054c1.64-0.12,3.304-0.181,4.943-0.181 c19.301,0,35.188,8.191,42.499,21.912c8.529,15.999,7.199,33.644-4.068,53.942c-9.727,17.521-8.756,28.103-6.029,46.82 c3.733,25.633-2.676,51.584-20.17,81.672c-3.793,6.524-8.774,11.813-13.596,16.926c-1.572,1.671-3.059,3.246-4.482,4.845 c-2.51,2.812-6.273,4.979-10.336,5.957l-0.144,0.032C142.766,249.947,140.158,250.574,137.432,250.574z"></path>
                                    <path class="st1" d="M194.668,43.333c-7.021-13.177-23.322-17.527-37.889-16.46c-11.713,0.856-21.447,9.581-32.946,12.294 c-6.214,1.466-11.987,2.025-18.365,0.694c-8.606-1.796-19.391-9.151-28.117-8.934c-12.465,0.311-21.333,6.95-26.369,18.789 C43.319,67.731,48.258,79.646,59,94.833c9.571,13.53,11.334,34.419,9.5,52c-2.295,22.019,6.59,40.376,16.214,60.864 c7.029,8.188,13.633,16.796,21.23,24.414c5.454,5.469,11.76,2.938,13.09-4.773c0.67-3.88,0.502-8.046-0.062-11.97 c-0.911-6.354-14.271-46.86-15.307-53.201c-1.332-8.167-2.181-19.433,2.001-28.854c7.167-16.146,33.747-11.208,36.833-0.146 c4,14.334,2.201,34.61,0.834,42.001c-2.155,11.652-6.319,45.527-9.028,57.096c-0.535,2.282-0.509,6.078,0.823,7.064 c1.563,1.154,4.912,0.322,7.338-0.26c1.88-0.452,3.953-1.478,5.218-2.891c5.84-6.55,12.555-12.671,16.896-20.141 c13.739-23.631,22.795-48.6,18.92-75.205c-2.849-19.546-4.078-32.83,7.183-53.114C199.5,71.833,202.059,57.195,194.668,43.333z M153.957,86.79l-10.623,19.423L132.711,86.79l-19.423-10.623l19.423-10.623l10.623-19.423l10.623,19.423l19.423,10.623 L153.957,86.79z"></path>
                                </g>
                            </svg>
                            <?= Html::encode($departmentName) ?></span>
                        <a class="cosmeticTag cosmeticTagLink" href="<?= Url::to(['site/contact', 'language' => $language]) ?>"><?= Html::encode($isAr ? 'ابدأ بالاستشارة' : 'Consultation First') ?>
                            <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path d="M13.2328 16.4569C12.9328 16.7426 12.9212 17.2173 13.2069 17.5172C13.4926 17.8172 13.9673 17.8288 14.2672 17.5431L13.2328 16.4569ZM19.5172 12.5431C19.8172 12.2574 19.8288 11.7827 19.5431 11.4828C19.2574 11.1828 18.7827 11.1712 18.4828 11.4569L19.5172 12.5431ZM18.4828 12.5431C18.7827 12.8288 19.2574 12.8172 19.5431 12.5172C19.8288 12.2173 19.8172 11.7426 19.5172 11.4569L18.4828 12.5431ZM14.2672 6.4569C13.9673 6.17123 13.4926 6.18281 13.2069 6.48276C12.9212 6.78271 12.9328 7.25744 13.2328 7.5431L14.2672 6.4569ZM19 12.75C19.4142 12.75 19.75 12.4142 19.75 12C19.75 11.5858 19.4142 11.25 19 11.25V12.75ZM5 11.25C4.58579 11.25 4.25 11.5858 4.25 12C4.25 12.4142 4.58579 12.75 5 12.75V11.25ZM14.2672 17.5431L19.5172 12.5431L18.4828 11.4569L13.2328 16.4569L14.2672 17.5431ZM19.5172 11.4569L14.2672 6.4569L13.2328 7.5431L18.4828 12.5431L19.5172 11.4569ZM19 11.25L5 11.25V12.75L19 12.75V11.25Z" fill="#ffffff"></path>
                                </g>
                            </svg></a>
                    </div>
                    <div class="cosmeticDescription">
                        <?= $isAr ? $department_details->department_description_arabic : $department_details->department_description ?>
                    </div>
                </div>

                <div class="imgBx">

                    <img src="<?= $homeUrl ?>uploads/departments/<?= Html::encode($department_details->department_image) ?>" loading="lazy" decoding="async" width="689" height="586" alt="<?= Html::encode($departmentName) ?>">
                </div>
            </div>
        </div>
    </section>

    <?php
    if ($department_details->section3_title != '' && $department_details->section3_description !== '') {
    ?>
        <section id="dentistrySec">

            <div class="container">
                <div class="contentWrap">

                    <div class="imgBx">
                        <img src="<?= $homeUrl ?>uploads/departments/<?= Html::encode($department_details->section3_image) ?>" alt="<?= $language == 'ar' ? $department_details->section3_title_arabic : $department_details->section3_title ?>">
                    </div>
                    <div class="cont">
                        <div class="text">
                            <h3> <?= $language == 'ar' ? $department_details->section3_title_arabic : $department_details->section3_title ?></h3>
                            <?= $language == 'ar' ? $department_details->section3_description_arabic : $department_details->section3_description ?>

                        </div>
                        <div class="tle"><?= Words::getValue($language, 'treatment_result') ?></div>
                        <div class="dFlex">

                            <?php
                            $i = 0;
                            foreach ($treatment_results as $treatment_result) {

                                $i++;
                            ?>
                                <div class="item">
                                    <div class="coparisonBx">
                                        <div id="comparison<?= $i ?>" class="comparison">
                                            <figure>
                                                <div class="imgBx">
                                                    <vr style="width: 3px; height: 135px; display: flex; color: #000; background: #ffffff; z-index: 3; 
                                                    position: absolute; top: 0; left: 50%;"></vr>
                                                    <img src="<?= Yii::$app->homeUrl ?>uploads/department-treatments/<?= $treatment_result->after_image ?>"
                                                        loading="lazy" width="312" height="395" alt="Treatment Results">
                                                    <vr style="width: 3px; height: 135px; display: flex; color: #000; background: #ffffff; z-index: 3; 
                                                    position: absolute;  bottom: 0; left: 50%;"></vr>

                                                </div>
                                                <div class="handle" data-slider-id="slider1<?= $i ?>" style="left: 57%;">

                                                </div>
                                                <div class="divisor" data-slider-id="slider1<?= $i ?>"
                                                    style="background-image: url(<?= Yii::$app->homeUrl ?>uploads/department-treatments/<?= $treatment_result->before_image ?>); width: 57%;">
                                                </div>
                                            </figure>
                                            <input type="range" min="0" max="100" value="50" id="slider1<?= $i ?>"
                                                oninput="moveDivisor('slider1<?= $i ?>')">
                                        </div>
                                    </div>
                                </div>
                            <?php }
                            ?>
                        </div>

                        <a href="<?= Url::to(['site/gallery', 'language' => $language]) ?>" class="cmnBtn hoveranim aboutLearnMore">
                            <span><?= Html::encode($isAr ? 'عرض المزيد من الحالات' : 'See More Cases') ?></span>
                        </a>
                    </div>

                </div>
            </div>
        </section>
    <?php
    }
    ?>

    <?php
    $processField = static function (string $field) use ($language, $department_details): string {
        $key = $language === 'ar' ? $field . '_ar' : $field;
        return htmlspecialchars((string) ($department_details->{$key} ?? ''), ENT_QUOTES, 'UTF-8');
    };
    $processHeading = $processField('process_heading');

    if ($processHeading !== ''):
    ?>

        <section class="process-section" aria-labelledby="process-heading" <?= $language === 'ar' ? ' dir="rtl" lang="ar"' : ' lang="en"' ?>>
            <div class="process-section__inner">
                <header class="process-section__header">
                    <span class="process-section__eyebrow"><?= $language == 'ar' ? 'خطوة' : 'STEP' ?></span>
                    <h2 class="process-section__title" id="process-heading"><?= $processHeading ?></h2>
                </header>

                <ul class="process-grid">
                    <li class="process-card">
                        <div class="process-card__top">
                            <span class="process-card__number" aria-hidden="true">01</span>
                            <h3 class="process-card__title"><?= $processField('step_01_label') ?></h3>
                        </div>
                        <p class="process-card__description"><?= $processField('step_01_desc') ?></p>
                    </li>
                    <li class="process-card">
                        <div class="process-card__top">
                            <span class="process-card__number" aria-hidden="true">02</span>
                            <h3 class="process-card__title"><?= $processField('step_02_label') ?></h3>
                        </div>
                        <p class="process-card__description"><?= $processField('step_02_desc') ?></p>
                    </li>
                    <li class="process-card">
                        <div class="process-card__top">
                            <span class="process-card__number" aria-hidden="true">03</span>
                            <h3 class="process-card__title"><?= $processField('step_03_label') ?></h3>
                        </div>
                        <p class="process-card__description"><?= $processField('step_03_desc') ?></p>
                    </li>
                    <li class="process-card">
                        <div class="process-card__top">
                            <span class="process-card__number" aria-hidden="true">04</span>
                            <h3 class="process-card__title"><?= $processField('step_04_label') ?></h3>
                        </div>
                        <p class="process-card__description"><?= $processField('step_04_desc') ?></p>
                    </li>
                    <li class="process-card">
                        <div class="process-card__top">
                            <span class="process-card__number" aria-hidden="true">05</span>
                            <h3 class="process-card__title"><?= $processField('step_05_label') ?></h3>
                        </div>
                        <p class="process-card__description"><?= $processField('step_05_desc') ?></p>
                    </li>
                </ul>
            </div>
        </section>
    <?php endif; ?>

    <section id="ourValues2" class="ourValues2" dir="<?= $isAr ? 'rtl' : 'ltr' ?>">
        <div class="ourValuesIntro2">
            <div class="ourValuesIntroInner2">
                <div class="ourValuesEyebrow2"><?= Html::encode($isAr ? 'قيمنا' : 'OUR VALUE') ?></div>
                <h2><?= Html::encode($isAr ? 'ما يحصل عليه كل مريض، في كل مرة' : 'What Every Patient Gets, Every Time') ?></h2>
                <p style="color:#fff;"><?= Html::encode($isAr ? 'نتمتع بقيمة فريدة، وهذا ما يميزنا عن الآخرين' : 'We Have A Unique Value, This Sets Us Apart From Others') ?></p>
            </div>
        </div>
        <div class="ourValuesCardsArea2">
            <div class="ourValuesCards2">
                <article class="ourValueCard2"><span class="ourValueIcon2" aria-hidden="true">
                        <svg fill="#814826" width="30px" height="30px" viewBox="0 0 48 48" enable-background="new 0 0 48 48" id="Layer_3" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path d="M25.691,47.992C25.794,47.993,25.896,48,26,48s0.206-0.007,0.309-0.008H25.691z"></path>
                                <g>
                                    <rect height="6" width="6" x="7.5" y="24"></rect>
                                    <rect height="6" width="6" x="16.667" y="24"></rect>
                                    <rect height="6" width="6" x="7.5" y="33"></rect>
                                    <rect height="6" width="6" x="16.667" y="33"></rect>
                                    <polygon points="14,0 10,0 10,4 0,4 0,15.9 0,19.9 0,48 22.667,48 22.667,44 4,44 4,19.9 22.667,19.9 22.667,15.9 4,15.9 4,8 10,8 10,12 14,12 14,8 22.667,8 22.667,4 14,4 "></polygon>
                                    <path d="M25.98,4h0.039C26.013,4,26.007,4,26,4S25.987,4,25.98,4z"></path>
                                    <path d="M26.502,4.012v4.013C36.209,8.293,44,16.228,44,26c0,9.771-7.791,17.706-17.498,17.975v4.013C38.42,47.72,48,37.982,48,26 S38.42,4.28,26.502,4.012z"></path>
                                    <polygon points="40,28 40,24 30.501,24 30.501,12.083 26.502,12.083 26.502,24 26.502,28 30.501,28 "></polygon>
                                </g>
                            </g>
                        </svg>
                    </span>
                    <h3><?= Html::encode($isAr ? 'الجودة' : 'Quality') ?></h3>
                    <p> <?= Html::encode($isAr ? 'تتسم رحلة كل فرد بكونها فريدة من نوعها. ونحن نكرس جهودنا لتقديم رعاية مخصصة تحترم هذا التنوع وتحتفي به، لنضمن أن تكون مسيرة كل شخص نحو الجمال والثقة فريدةً بقدر تفرده هو ذاته.' : 'Every individual journey is unique. We dedicate ourselves to providing personalized care that respects and celebrates this diversity, ensuring that each person path to beauty and confidence is as unique as they are.') ?> </p>
                </article>
                <article class="ourValueCard2"><span class="ourValueIcon2" aria-hidden="true">
                        <svg width="30px" height="30px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="#814826" stroke="#814826">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path d="M9 9H4v1h5V9z"></path>
                                <path d="M7 12V7H6v5h1z"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M5 3l1-1h7l1 1v7l-1 1h-2v2l-1 1H3l-1-1V6l1-1h2V3zm1 2h4l1 1v4h2V3H6v2zm4 1H3v7h7V6z"></path>
                            </g>
                        </svg>
                    </span>
                    <h3><?= Html::encode($isAr ? 'الأمان' : 'Safety') ?></h3>
                    <p> <?= Html::encode($isAr ? 'سعينا نحو التميز لا يعرف الكلل؛ فنحن نطمح إلى وضع أعلى المعايير وتجاوزها في كل ما نقوم به، لنضمن لمرضانا الحصول على أفضل رعاية وتجربة ممكنة.' : 'Our pursuit of excellence is relentless. We aim to set and surpass the highest standards in all we do, ensuring that our patients receive the best possible care and experiences.') ?></p>

                </article>
                <article class="ourValueCard2"><span class="ourValueIcon2" aria-hidden="true">
                        <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path d="M13.5 6.50024C13.5 7.32867 12.8284 8.00024 12 8.00024C11.1716 8.00024 10.5 7.32867 10.5 6.50024C10.5 5.67182 11.1716 5.00024 12 5.00024C12.8284 5.00024 13.5 5.67182 13.5 6.50024Z" fill="#814826"></path>
                                <path d="M6.05132 8.68402C5.87667 9.20796 6.15983 9.77428 6.68377 9.94893C6.85906 10.0071 7.03576 10.0613 7.21265 10.1143C7.5363 10.2114 7.98911 10.3408 8.50746 10.4704C9.08908 10.6158 9.78094 10.7687 10.4783 10.8727C10.4323 11.7654 10.3205 12.4059 10.2166 12.8309L8.10557 17.053C7.85858 17.547 8.05881 18.1477 8.55279 18.3947C9.04677 18.6417 9.64744 18.4414 9.89443 17.9475L12 13.7363L14.1056 17.9475C14.3526 18.4414 14.9532 18.6417 15.4472 18.3947C15.9412 18.1477 16.1414 17.547 15.8944 17.053L13.7834 12.8309C13.6795 12.4059 13.5677 11.7654 13.5217 10.8727C14.2191 10.7687 14.9109 10.6158 15.4925 10.4704C16.0109 10.3408 16.4637 10.2114 16.7873 10.1143C16.963 10.0616 17.1384 10.0077 17.3125 9.95015C17.8261 9.77972 18.1201 9.19822 17.9487 8.68402C17.7741 8.16012 17.2078 7.87697 16.6839 8.05151C16.5277 8.10318 16.3703 8.15138 16.2127 8.19867C15.9113 8.28907 15.4891 8.40969 15.0075 8.5301C14.0216 8.77657 12.8709 9.00024 12 9.00024C11.1291 9.00024 9.97843 8.77657 8.99254 8.5301C8.51089 8.40969 8.0887 8.28907 7.78735 8.19867C7.63167 8.15196 7.47632 8.10404 7.32186 8.05342C6.80235 7.88161 6.22544 8.16164 6.05132 8.68402Z" fill="#814826"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M23 12.0002C23 18.0754 18.0751 23.0002 12 23.0002C5.92487 23.0002 1 18.0754 1 12.0002C1 5.92511 5.92487 1.00024 12 1.00024C18.0751 1.00024 23 5.92511 23 12.0002ZM3.00683 12.0002C3.00683 16.967 7.03321 20.9934 12 20.9934C16.9668 20.9934 20.9932 16.967 20.9932 12.0002C20.9932 7.03345 16.9668 3.00707 12 3.00707C7.03321 3.00707 3.00683 7.03345 3.00683 12.0002Z" fill="#814826"></path>
                            </g>
                        </svg>
                    </span>
                    <h3><?= Html::encode($isAr ? 'الثقة' : 'Trust') ?></h3>
                    <p> <?= Html::encode($isAr ? 'نحن ملتزمون بالابتكار، ونسعى باستمرار إلى استكشاف وتبنّي أحدث التطورات في مجال الرعاية التجميلية، بهدف الارتقاء بخدماتنا وتحسين النتائج التي نحققها.' : 'We are committed to innovation, constantly seeking out and embracing the latest advancements in aesthetic healthcare to improve our services and outcomes.') ?></p>

                </article>
                <article class="ourValueCard2"><span class="ourValueIcon2" aria-hidden="true">
                        <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.55428 21.5288C5.35132 22.75 8.49749 21.4915 14.7898 18.9746C16.132 18.4377 16.8031 18.1693 17.3295 17.7076C17.4637 17.59 17.59 17.4637 17.7076 17.3295C18.1693 16.8031 18.4377 16.132 18.9746 14.7898C21.4915 8.49749 22.75 5.35132 21.5288 3.55428C21.2393 3.1282 20.8718 2.7607 20.4457 2.47117C18.6487 1.25001 15.5025 2.50848 9.21017 5.02542C7.86802 5.56228 7.19695 5.8307 6.67048 6.29238C6.53633 6.41002 6.41002 6.53633 6.29238 6.67048C5.8307 7.19695 5.56228 7.86802 5.02542 9.21017C2.50848 15.5025 1.25001 18.6487 2.47117 20.4457C2.76071 20.8718 3.1282 21.2393 3.55428 21.5288ZM8.25 12C8.25 9.92893 9.92893 8.25 12 8.25C14.0711 8.25 15.75 9.92893 15.75 12C15.75 14.0711 14.0711 15.75 12 15.75C9.92893 15.75 8.25 14.0711 8.25 12ZM9.75 12C9.75 10.7574 10.7574 9.75 12 9.75C13.2426 9.75 14.25 10.7574 14.25 12C14.25 13.2426 13.2426 14.25 12 14.25C10.7574 14.25 9.75 13.2426 9.75 12Z" fill="#814826"></path>
                            </g>
                        </svg>
                    </span>
                    <h3><?= Html::encode($isAr ? 'الخبرة' : 'Expertise') ?></h3>
                    <p> <?= Html::encode($isAr ? 'يمثل التعاون ركيزة أساسية لتميّزنا؛ فمن خلال الجمع بين مواهب ووجهات نظر متنوعة، نرسّخ ثقافة قائمة على النجاح المشترك والتعلم المستمر.' : 'Collaboration is at the heart of our excellence. By bringing together with diverse talents and perspectives, we cultivate a culture of shared success and continuous learning.') ?></p>

                </article>
                <article class="ourValueCard2"><span class="ourValueIcon2" aria-hidden="true">
                        <svg width="30px" height="30px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <g id="icomoon-ignore"> </g>
                                <path d="M20.462 10.824l-9.265 9.196 0.753 0.756 9.265-9.196z" fill="#814826"> </path>
                                <path d="M6.937 21.864c-3.234 0-5.864-2.631-5.864-5.864s2.631-5.864 5.864-5.864c1.566 0 2.987 0.621 4.040 1.624l0.001-0.006 0.054 0.047 2.076 2.066h-1.905v1.066h3.732v-3.732h-1.066v1.918l-2.084-2.074-0.005 0.005c-1.251-1.224-2.959-1.982-4.842-1.982-3.821 0-6.931 3.109-6.931 6.931s3.109 6.931 6.931 6.931c1.971 0 3.747-0.831 5.011-2.156l-0.753-0.754c-1.070 1.132-2.581 1.844-4.258 1.844z" fill="#814826"> </path>
                                <path d="M25.063 9.069c-1.765 0-3.373 0.668-4.597 1.759l0.753 0.753c1.030-0.898 2.373-1.446 3.844-1.446 3.234 0 5.864 2.631 5.864 5.864s-2.631 5.864-5.864 5.864c-1.56 0-2.976-0.616-4.028-1.613l-0.002 0.010-3.531-3.518-0.757 0.751 3.535 3.522 0.006-0.006c1.245 1.187 2.925 1.921 4.776 1.921 3.821 0 6.931-3.109 6.931-6.931s-3.109-6.931-6.931-6.931z" fill="#814826"> </path>
                            </g>
                        </svg>
                    </span>
                    <h3><?= Html::encode($isAr ? 'التطوير المستمر' : 'Continuous Development') ?></h3>
                    <p> <?= Html::encode($isAr ? 'نحن ملتزمون بالابتكار، ونسعى باستمرار إلى استكشاف وتبنّي أحدث التطورات في مجال الرعاية التجميلية، بهدف الارتقاء بخدماتنا وتحسين النتائج التي نحققها.' : 'We are committed to innovation, constantly seeking out and embracing the latest advancements in aesthetic healthcare to improve our services and outcomes.') ?></p>

                </article>
                <article class="ourValueCard2"><span class="ourValueIcon2" aria-hidden="true">
                        <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path d="M4 21V18.5C4 15.4624 6.46243 13 9.5 13H13.5M8 21V18M16 6.5C16 8.70914 14.2091 10.5 12 10.5C9.79086 10.5 8 8.70914 8 6.5C8 4.29086 9.79086 2.5 12 2.5C14.2091 2.5 16 4.29086 16 6.5ZM17.5 12.9998C17.0439 12.3927 16.3178 12 15.5 12C14.1193 12 13 13.1193 13 14.5C13 15.1195 13.2253 15.6864 13.5985 16.1231L17.5 21L21.4015 16.1231C21.7747 15.6864 22 15.1195 22 14.5C22 13.1193 20.8807 12 19.5 12C18.6822 12 17.9561 12.3927 17.5 12.9998Z" stroke="#814826" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.4"></path>
                            </g>
                        </svg>
                    </span>
                    <h3><?= Html::encode($isAr ? 'راحة المريض' : 'Patient Comfort') ?></h3>
                    <p> <?= Html::encode($isAr ? 'يمثل التعاون ركيزة أساسية لتميّزنا؛ فمن خلال الجمع بين مواهب ووجهات نظر متنوعة، نرسّخ ثقافة قائمة على النجاح المشترك والتعلم المستمر.' : 'Collaboration is at the heart of our excellence. By bringing together with diverse talents and perspectives, we cultivate a culture of shared success and continuous learning.') ?></p>

                </article>
            </div>
        </div>
    </section>

    <section id="insurance">
        <div class="container">
            <div class="flxBox wow animate__fadeInUp" data-wow-duration="1.5s">
                <div class="leftSec">
                    <div class="mainHead">
                        <div class="head"><?= Words::getValue($language, 'insurance') ?></div>
                    </div>
                </div>
                <div class="rtSec">
                    <a href="<?= Url::to(['site/insurance', 'language' => $language]) ?>" class="cmnBtnLinks"><?= Words::getValue($language, 'view_all') ?></a>
                </div>
            </div>
            <div class="owl-carousel owl-theme insuranceSlider wow animate__fadeInUp" data-wow-duration="1s">
                <?php foreach ($insurances as $insurance):
                    $department = $insuranceDepts[$insurance->department] ?? null;
                    if (!$department) continue;
                    $insImg   = $homeUrl . 'uploads/insurance/' . $insurance->image;
                    $deptName = $isAr ? $department->department_name_arabic : $department->department_name; ?>
                    <div class="item">
                        <a href="<?= Url::to(['site/department-details', 'language' => $language, 'slug' => $department->canonical_name]) ?>" class="insurencBx">
                            <div class="imgBox">
                                <img src="<?= $insImg ?>" data-src="<?= $insImg ?>" class="lazy" loading="lazy" decoding="async" width="238" height="140" alt="<?= $deptName ?>">
                            </div>
                            <div class="contentBx">
                                <div class="subT"><?= $deptName ?></div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="whyChooseUs" class="whyChooseUs">
        <div class="container">
            <header class="whyChooseUs__header">
                <span class="whyChooseUs__eyebrow"><?= Html::encode($isAr ? 'لماذا تختارنا' : 'WHY CHOOSE US') ?></span>
                <h2><?= Html::encode($isAr ? 'شريكك الصحي الذي كنت تبحث عنه' : 'The Health Partner You\'ve Been Looking For') ?></h2>
            </header>

            <?php
            $whyLeft = [
                [
                    'title' => $isAr ? '19 عاماً من الخبرة' : '19 years of experience',
                    'desc' => $isAr ? '19 عاماً من الخبرة' : '19 years of experience',
                    'svg' => '<svg height="30px" width="30px" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css"> .st0{fill:#ffffff;} </style> <g> <path class="st0" d="M78.641,118.933c22.88,0,41.416-18.551,41.416-41.414c0-22.887-18.536-41.423-41.416-41.423 c-22.887,0-41.422,18.536-41.422,41.423C37.218,100.382,55.754,118.933,78.641,118.933z"></path> <path class="st0" d="M255.706,228.73v0.062c0.101,0,0.194-0.031,0.294-0.031c0.101,0,0.194,0.031,0.294,0.031v-0.062 c15.562-0.317,28.082-12.976,28.082-28.601c0-15.648-12.52-28.299-28.082-28.616v-0.063c-0.101,0-0.194,0.031-0.294,0.031 c-0.1,0-0.193-0.031-0.294-0.031v0.063c-15.563,0.317-28.082,12.968-28.082,28.616C227.623,215.754,240.143,228.413,255.706,228.73 z"></path> <path class="st0" d="M433.359,118.933c22.887,0,41.423-18.551,41.423-41.414c0-22.887-18.536-41.423-41.423-41.423 c-22.88,0-41.416,18.536-41.416,41.423C391.944,100.382,410.48,118.933,433.359,118.933z"></path> <path class="st0" d="M470.097,138.553h-36.312h-18.404c-21.106,0-40.432,11.831-50.033,30.622l-33.494,97.967 c-1.154,2.246-3.298,3.84-5.792,4.282c-2.493,0.442-5.048-0.309-6.914-2.036l-20.836-18.04c-6.233-5.769-14.408-8.973-22.902-8.973 H256h-19.41c-8.494,0-16.669,3.204-22.902,8.973l-20.835,18.04c-1.866,1.727-4.421,2.478-6.914,2.036 c-2.492-0.442-4.637-2.036-5.791-4.282l-33.495-97.967c-9.6-18.791-28.926-30.622-50.032-30.622H78.215H41.902 C21.834,138.553,0,160.387,0,180.464v139.211c0,10.034,8.13,18.171,18.164,18.171c4.939,0,0,0,12.682,0l6.906,118.725 c0,10.676,8.664,19.332,19.34,19.332c4.506,0,12.814,0,21.122,0c8.308,0,16.616,0,21.122,0c10.676,0,19.34-8.656,19.34-19.332 l6.906-118.725l-0.085-84.766c0-1.339,0.914-2.493,2.222-2.818c1.309-0.31,2.648,0.309,3.26,1.502l26.572,65.401 c3.206,6.256,9.152,10.654,16.074,11.885c6.922,1.231,14.022-0.844,19.186-5.613l25.426-18.729 c0.852-0.782,2.083-0.984,3.136-0.542c1.061,0.473,1.743,1.518,1.743,2.663l0.093,73.508l4.777,82.187 c0,7.387,6.001,13.379,13.395,13.379c3.113,0,8.865,0,14.618,0c5.753,0,11.506,0,14.618,0c7.394,0,13.394-5.992,13.394-13.379 l4.778-82.187l0.093-73.508c0-1.146,0.681-2.19,1.742-2.663c1.053-0.442,2.284-0.24,3.136,0.542l25.427,18.729 c5.164,4.769,12.264,6.844,19.186,5.613c6.922-1.231,12.868-5.629,16.073-11.885l26.573-65.401 c0.611-1.192,1.951-1.812,3.259-1.502c1.309,0.325,2.222,1.478,2.222,2.818l-0.085,84.766l6.906,118.725 c0,10.676,8.664,19.332,19.341,19.332c4.507,0,12.814,0,21.122,0c8.308,0,16.616,0,21.121,0c10.677,0,19.342-8.656,19.342-19.332 l6.906-118.725c12.682,0,7.742,0,12.682,0c10.034,0,18.164-8.137,18.164-18.171V180.464 C512,160.387,490.166,138.553,470.097,138.553z"></path> </g> </g></svg>',
                ],
                [
                    'title' => $isAr ? 'أطباء بخبرة تزيد على 10 سنوات' : 'Doctors with over 10 years of experience',
                    'desc' => $isAr ? 'أطباء بخبرة تزيد على 10 سنوات' : 'Doctors with over 10 years of experience',
                    'svg' => '<svg fill="#ffffff" width="30px" height="30px" viewBox="0 0 14 14" role="img" focusable="false" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="m 7.75,4.05953 0,-0.43453 0.375,0 C 8.3321875,3.625 8.5,3.45719 8.5,3.25 l 0,-0.375 C 8.5,2.66781 8.3321875,2.5 8.125,2.5 l -2.25,0 C 5.6678125,2.5 5.5,2.66781 5.5,2.875 l 0,0.375 c 0,0.20719 0.1678125,0.375 0.375,0.375 l 0.375,0 0,0.43453 C 3.7067969,4.42445 1.75,6.60578 1.75,9.25 l 10.5,0 c 0,-2.64422 -1.956797,-4.82555 -4.5,-5.19047 z M 12.625,10 1.375,10 C 1.1678125,10 1,10.16781 1,10.375 l 0,0.75 C 1,11.33219 1.1678125,11.5 1.375,11.5 l 11.25,0 C 12.832188,11.5 13,11.33219 13,11.125 l 0,-0.75 C 13,10.16781 12.832188,10 12.625,10 Z"></path></g></svg>',
                ],
                [
                    'title' => $isAr ? 'قصص نجاح حقيقية' : 'Real successful cases',
                    'desc' => $isAr ? 'أطباء بخبرة تزيد على 10 سنوات' : 'Doctors with over 10 years of experience',
                    'svg' => '<svg fill="#ffffff" width="30px" height="30px" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M505.04 442.66l-99.71-99.69c-4.5-4.5-10.6-7-17-7h-16.3c27.6-35.3 44-79.69 44-127.99C416.03 93.09 322.92 0 208.02 0S0 93.09 0 207.98s93.11 207.98 208.02 207.98c48.3 0 92.71-16.4 128.01-44v16.3c0 6.4 2.5 12.5 7 17l99.71 99.69c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.59.1-33.99zm-297.02-90.7c-79.54 0-144-64.34-144-143.98 0-79.53 64.35-143.98 144-143.98 79.54 0 144 64.34 144 143.98 0 79.53-64.35 143.98-144 143.98zm27.11-152.54l-45.01-13.5c-5.16-1.55-8.77-6.78-8.77-12.73 0-7.27 5.3-13.19 11.8-13.19h28.11c4.56 0 8.96 1.29 12.82 3.72 3.24 2.03 7.36 1.91 10.13-.73l11.75-11.21c3.53-3.37 3.33-9.21-.57-12.14-9.1-6.83-20.08-10.77-31.37-11.35V112c0-4.42-3.58-8-8-8h-16c-4.42 0-8 3.58-8 8v16.12c-23.63.63-42.68 20.55-42.68 45.07 0 19.97 12.99 37.81 31.58 43.39l45.01 13.5c5.16 1.55 8.77 6.78 8.77 12.73 0 7.27-5.3 13.19-11.8 13.19h-28.1c-4.56 0-8.96-1.29-12.82-3.72-3.24-2.03-7.36-1.91-10.13.73l-11.75 11.21c-3.53 3.37-3.33 9.21.57 12.14 9.1 6.83 20.08 10.77 31.37 11.35V304c0 4.42 3.58 8 8 8h16c4.42 0 8-3.58 8-8v-16.12c23.63-.63 42.68-20.54 42.68-45.07 0-19.97-12.99-37.81-31.59-43.39z"></path></g></svg>',


                ],
            ];
            $whyRight = [
                [
                    'title' => $isAr ? 'تقييم 4.4 على Google' : '4.4 rating on Google',
                    'desc' => $isAr ? 'أطباء بخبرة تزيد على 10 سنوات' : 'Doctors with over 10 years of experience',
                    'svg' => '<svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M7 6H5.2C4.0799 6 3.51984 6 3.09202 6.21799C2.71569 6.40973 2.40973 6.71569 2.21799 7.09202C2 7.51984 2 8.0799 2 9.2V17.8C2 18.9201 2 19.4802 2.21799 19.908C2.40973 20.2843 2.71569 20.5903 3.09202 20.782C3.51984 21 4.0799 21 5.2 21H18.8C19.9201 21 20.4802 21 20.908 20.782C21.2843 20.5903 21.5903 20.2843 21.782 19.908C22 19.4802 22 18.9201 22 17.8V9.2C22 8.07989 22 7.51984 21.782 7.09202C21.5903 6.71569 21.2843 6.40973 20.908 6.21799C20.4802 6 19.9201 6 18.8 6H17M2 10H4M20 10H22M2 14H4M20 14H22M12 6V10M10 8H14M17 21V6.2C17 5.0799 17 4.51984 16.782 4.09202C16.5903 3.71569 16.2843 3.40973 15.908 3.21799C15.4802 3 14.9201 3 13.8 3H10.2C9.07989 3 8.51984 3 8.09202 3.21799C7.71569 3.40973 7.40973 3.71569 7.21799 4.09202C7 4.51984 7 5.0799 7 6.2V21H17ZM14 21V17C14 15.8954 13.1046 15 12 15C10.8954 15 10 15.8954 10 17V21H14Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>',

                ],
                [
                    'title' => $isAr ? 'خيارات دفع مرنة' : 'Flexible ways to pay',
                    'desc' => $isAr ? 'أطباء بخبرة تزيد على 10 سنوات' : 'Doctors with over 10 years of experience',
                    'svg' => '<svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M8 5.00005C7.01165 5.00082 6.49359 5.01338 6.09202 5.21799C5.71569 5.40973 5.40973 5.71569 5.21799 6.09202C5 6.51984 5 7.07989 5 8.2V17.8C5 18.9201 5 19.4802 5.21799 19.908C5.40973 20.2843 5.71569 20.5903 6.09202 20.782C6.51984 21 7.07989 21 8.2 21H15.8C16.9201 21 17.4802 21 17.908 20.782C18.2843 20.5903 18.5903 20.2843 18.782 19.908C19 19.4802 19 18.9201 19 17.8V8.2C19 7.07989 19 6.51984 18.782 6.09202C18.5903 5.71569 18.2843 5.40973 17.908 5.21799C17.5064 5.01338 16.9884 5.00082 16 5.00005M8 5.00005V7H16V5.00005M8 5.00005V4.70711C8 4.25435 8.17986 3.82014 8.5 3.5C8.82014 3.17986 9.25435 3 9.70711 3H14.2929C14.7456 3 15.1799 3.17986 15.5 3.5C15.8201 3.82014 16 4.25435 16 4.70711V5.00005M12 11H9M15 15H9" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>',

                ],
                [
                    'title' => $isAr ? 'جميع الأقسام تحت سقف واحد' : 'All departments under one roof',
                    'desc' => $isAr ? 'أطباء بخبرة تزيد على 10 سنوات' : 'Doctors with over 10 years of experience',
                    'svg' => '<svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M4.5 9.45728C4.5 7.13366 6.38366 5.25 8.70728 5.25C9.77775 5.25 10.7533 5.64881 11.4962 6.30708L11.5918 6.39185L11.9753 6.77533L12 6.75349L12.0246 6.77534L12.4081 6.3919L12.5038 6.30708C13.2467 5.64881 14.2222 5.25 15.2927 5.25C17.6163 5.25 19.4999 7.13366 19.4999 9.45728C19.4999 10.524 19.104 11.4963 18.4499 12.2382L18.2646 12.4354L12 18.7L8.03033 14.7303L6.96967 15.791L12 20.8213L19.3416 13.4796L19.5582 13.2492L19.5655 13.241C20.4575 12.2343 20.9999 10.9082 20.9999 9.45728C20.9999 6.30523 18.4447 3.75 15.2927 3.75C14.0969 3.75 12.9859 4.11843 12.0686 4.74733L11.9999 4.67867L11.9313 4.74731C11.014 4.11842 9.90307 3.75 8.70728 3.75C5.55523 3.75 3 6.30523 3 9.45728C3 10.9045 3.53349 12.2379 4.42798 13.2474L5.55066 12.2526C4.89489 11.5125 4.5 10.5314 4.5 9.45728ZM12.75 12.4393L9.75 9.43934L4.93934 14.25H3V15.75H5.56066L9.75 11.5607L12.75 14.5607L15.3107 12H17.25V10.5H14.6893L12.75 12.4393Z" fill="#ffffff"></path> </g></svg>',

                ],
            ];
            ?>

            <div class="whyChooseUs__grid">
                <div class="whyChooseUs__side whyChooseUs__side--left">
                    <?php foreach ($whyLeft as $index => $item): ?>
                        <article class="whyChooseUs__item">
                            <div class="whyChooseUs__copy">
                                <h3><?= Html::encode($item['title']) ?></h3>
                                <p><?= Html::encode($item['desc']) ?></p>
                            </div>
                            <span class="whyChooseUs__icon" aria-hidden="true"> <?= ($item['svg']) ?></span>
                        </article>
                    <?php endforeach; ?>
                </div>

                <div class="whyChooseUs__doctor" aria-hidden="true">
                    <img src="<?= $homeUrl ?>uploads/doctors/doctor_transparent.png" alt="" loading="lazy" decoding="async" width="306" height="600">
                </div>

                <div class="whyChooseUs__side whyChooseUs__side--right">
                    <?php foreach ($whyRight as $index => $item): ?>
                        <article class="whyChooseUs__item">
                            <span class="whyChooseUs__icon" aria-hidden="true"> <?= ($item['svg']) ?></span>
                            <div class="whyChooseUs__copy">
                                <h3><?= Html::encode($item['title']) ?></h3>
                                <p><?= Html::encode($item['desc']) ?></p>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>


    <section id="videoSec">
        <div class="container">
            <div class="tleWrap">
                <div class="flxWrap">
                    <div class="tle"><?= $language == 'ar' ? $department_details->section4_title_arabic : $department_details->section4_title ?></div>
                    <div class="info">
                        <?= $language == 'ar' ? $department_details->section4_description_arabic : $department_details->section4_description ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="appointment" data-anchor="appointment">
        <!-- TODO: this WebP is 133 KB; re-export at quality ~70 (Lighthouse est. 97 KiB saving on mobile) -->
        <img src="<?= $bookImage ?>" data-src="<?= $bookImage ?>" class="lazy parallax-img" loading="lazy" decoding="async" width="1920" height="720" alt="">
        <div class="container">
            <div class="appointMentBox wow animate__fadeInLeft" data-wow-duration="1.5s">
                <div class="imgBox"><img src="<?= $homeUrl ?>images/logIcon.svg" alt="appointment" loading="lazy" width="60" height="60"></div>
                <div class="title"><?= Words::getValue($language, 'book_appointment') ?></div>
                <?= \common\widgets\Alert::widget() ?>
                <?php $form = ActiveForm::begin(['id' => 'appointment-form2']); ?>
                <div class="row">
                    <input type="hidden" name="AppointmentEnquiryListing[page_url]" value="<?= $currentUrl ?>" />
                    <div class="col-lg-12"><?= $form->field($model, 'name')->textInput(['placeholder' => Words::getValue($language, 'name') . ' *'])->label(false) ?></div>
                    <div class="col-lg-6"><?= $form->field($model, 'age')->textInput(['placeholder' => Words::getValue($language, 'age') . ' *'])->label(false) ?></div>
                    <div class="col-lg-6"><?= $form->field($model, 'gender')->dropDownList($genders, ['prompt' => Words::getValue($language, 'gender') . ' *', 'class' => 'select2 select'])->label(false) ?></div>
                    <div class="col-lg-12"><?= $form->field($model, 'phone_number')->textInput(['placeholder' => Words::getValue($language, 'phone_no') . ' *'])->label(false) ?></div>
                    <div class="col-lg-12"><?= $form->field($model, 'email')->textInput(['placeholder' => Words::getValue($language, 'email') . ' *'])->label(false) ?></div>
                    <div class="col-sm-12">
                        <div class="dateBx">
                            <?= $form->field($model, 'appointment_date')->textInput([
                                'id'          => 'eventDate',
                                'class'       => 'form-control datepicker',
                                'placeholder' => Words::getValue($language, 'your_preferred_date') . ' *',
                                'type'        => 'date',
                                'data-input'  => true,
                            ])->label(false) ?>
                        </div>
                    </div>
                    <div class="col-lg-12"><?= $form->field($model, 'service')->dropDownList($services, ['prompt' => Words::getValue($language, 'select_department'), 'class' => 'select2 select'])->label(false) ?></div>
                    <div class="col-lg-12"><?= $form->field($model, 'message')->textarea(['placeholder' => Words::getValue($language, 'message')])->label(false) ?></div>
                    <!-- reCAPTCHA: api.js is loaded when this section scrolls into view (or the booking modal opens), not on page load -->
                    <div class="col-lg-12 mb-3">
                        <div class="g-recaptcha" data-sitekey="6LeIN5stAAAAAH4T1_W3wKcBxlKmq8P-8bzJTga4"></div>
                        <?php if ($model->hasErrors('reCaptcha')): ?>
                            <div class="text-danger" style="margin-top:5px;"><?= $model->getFirstError('reCaptcha') ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-12">
                        <button class="cmnBtn hoveranim cmnBtn"><span><?= Words::getValue($language, 'book_now') ?></span></button>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </section>

     <section id="appointment" data-anchor="appointment" class="appointment-redesign">
    <!-- Existing background image and lazy-loading behavior -->
    <div class="container appointment-redesign__container">
        <div class="appointment-redesign__info">
            <span class="appointment-redesign__eyebrow">BOOKING</span>
            <h2>Book Your Appointment</h2>
            <p>Tell us which department you need and when suits you. Our team will call to confirm your time. Evening and weekend slots are usually available.</p>
            <div class="appointment-redesign__support">
                <span class="appointment-redesign__support-icon" aria-hidden="true">☎</span>
                <div>
                    <span>To Book An Appointment</span>
                    <a href="tel:+97165067444">+971 6 506 7444</a>
                </div>
            </div>
            <dl class="appointment-redesign__hours">
                <div><dt>Saturday – Thursday</dt><dd>9:00 AM – 10:00 PM</dd></div>
                <div><dt>Friday</dt><dd>12:00 PM – 10:00 PM</dd></div>
            </dl>
        </div>

        <div class="appointMentBox appointment-redesign__form wow animate__fadeInLeft" data-wow-duration="1.5s">
            <div class="imgBox"><img src="<?= $homeUrl ?>images/logIcon.svg" alt="appointment" loading="lazy" width="60" height="60"></div>
            <div class="title"><?= Words::getValue($language, 'book_appointment') ?></div>
            <?= \common\widgets\Alert::widget() ?>
            <?php $form = ActiveForm::begin(['id' => 'appointment-form2']); ?>
            <div class="row">
                <input type="hidden" name="AppointmentEnquiryListing[page_url]" value="<?= $currentUrl ?>" />
                <div class="col-lg-12"><?= $form->field($model, 'name')->textInput(['placeholder' => Words::getValue($language, 'name') . ' *'])->label(false) ?></div>
                <div class="col-lg-12"><?= $form->field($model, 'email')->textInput(['placeholder' => Words::getValue($language, 'email') . ' *'])->label(false) ?></div>
                <div class="col-lg-12"><?= $form->field($model, 'phone_number')->textInput(['placeholder' => Words::getValue($language, 'phone_no') . ' *'])->label(false) ?></div>

                <div class="col-lg-12">
                    <?= $form->field($model, 'fk_appointment_department')->dropDownList(
                        $departmentOptions,
                        [
                            'id'     => 'appointment-department',
                            'prompt' => Words::getValue($language, 'select_department'),
                            'class'  => 'select2 select',
                        ]
                    )->label(false) ?>
                </div>

                <div class="col-lg-12">
                    <?= $form->field($model, 'service')->dropDownList(
                        [],
                        [
                            'id'       => 'appointment-service',
                            'prompt'   => Words::getValue($language, 'select_department_first'),
                            'class'    => 'select2 select',
                            'disabled' => true,
                        ]
                    )->label(false) ?>
                </div>
                <div class="col-sm-12">
                    <div class="dateBx">
                        <?= $form->field($model, 'appointment_date')->textInput([
                            'id'          => 'eventDate1',
                            'class'       => 'form-control datepicker',
                            'placeholder' => Words::getValue($language, 'your_preferred_date') . ' *',
                            'data-input'  => true,
                        ])->label(false) ?>
                    </div>
                </div>

                <!-- Existing reCAPTCHA and validation -->
                <div class="col-lg-12 mb-3">
                    <div class="g-recaptcha" data-sitekey="6LeIN5stAAAAAH4T1_W3wKcBxlKmq8P-8bzJTga4"></div>
                    <?php if ($model->hasErrors('reCaptcha')): ?>
                        <div class="text-danger" style="margin-top:5px;"><?= $model->getFirstError('reCaptcha') ?></div>
                    <?php endif; ?>
                </div>
                <div class="col-lg-12">
                    <button class="cmnBtn hoveranim cmnBtn"><span><?= Words::getValue($language, 'book_now') ?></span></button>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
            <?php
            $jsFlags   = JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE;
            $optionsJs = json_encode($serviceOptionsByDepartment, $jsFlags);
            $promptJs  = json_encode(Words::getValue($language, 'select_services'), $jsFlags);
            $chooseJs  = json_encode(Words::getValue($language, 'select_department_first'), $jsFlags);
            $selectedJs = json_encode((string) $model->service, $jsFlags);

            $this->registerJs(<<<JS
            (() => {
                const options  = {$optionsJs};
                const prompt   = {$promptJs};
                const choose   = {$chooseJs};
                const selected = {$selectedJs};

                document.querySelectorAll('select[name$="[fk_appointment_department]"]').forEach(department => {
                    const form = department.closest('form');
                    const service = form && form.querySelector('select[name$="[service]"]');
                    if (!service) return;

                    let keep = selected;
                    function refresh() {
                        const id = department.value;
                        service.replaceChildren(new Option(id ? prompt : choose, ''));
                        (options[id] || []).forEach(([value, label]) => service.add(new Option(label, value)));
                        service.disabled = !id;
                        service.value = keep && service.querySelector('option[value="' + keep + '"]') ? keep : '';
                        keep = '';
                        if (window.jQuery && jQuery.fn.select2) jQuery(service).trigger('change.select2');
                    }

                    if (window.jQuery) {
                        jQuery(department).on('change select2:select select2:clear', refresh);
                    } else {
                        department.addEventListener('change', refresh);
                    }
                    refresh();
                });
            })();
            JS, \yii\web\View::POS_READY);
            ?>
        </div>
    </div>
</section>

    

    <?php

    if ($department_details->section7_title != '' || $department_details->section7_description != '' || !empty($proc_and_cons)) {
    ?>
        <section id="contentSec">
            <div class="container">
                <div class="contentWrap">
                    <div class="elememt">
                        <img src="<?= Yii::$app->homeUrl ?>images/dentElemnt.svg" loading="lazy" width="362" height="368" alt="image">
                    </div>
                    <?php
                    if ($department_details->section7_title != '') {
                    ?>
                        <div class="tleWrap">
                            <div class="tle"><?= $language == 'ar' ? $department_details->section7_title_arabic : $department_details->section7_title ?></div>
                            <div class="info">
                                <?= $language == 'ar' ? $department_details->section7_description_arabic : $department_details->section7_description ?>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="dFlex">
                        <div class="itmMain">
                            <?php
                            if (!empty($proc_and_cons)) {
                                $totcount = count($proc_and_cons);
                                $count = ceil(count($proc_and_cons) / 2);
                                $i = 0;
                                foreach ($proc_and_cons as $proc_and_cons) {
                                    $i++;
                            ?>
                                    <div class="contItm">
                                        <div class="contBx">
                                            <div class="subT"><?= $language == 'ar' ? $proc_and_cons->title_arabic : $proc_and_cons->title ?> </div>
                                            <p>
                                                <?= $language == 'ar' ? $proc_and_cons->description_arabic : $proc_and_cons->description ?>

                                        </div>
                                    </div>
                                    <?php if ($i == $count) { ?>
                        </div>
                        <div class="itmMain">
                <?php
                                    }
                                }
                            }
                ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
    if (!empty($departments)) {
        $dfaqs = \common\models\DepartmentFaq::find()->where(['status' => 1])->all();
        if (!empty($dfaqs)) {
        ?>
            <section id="faq">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="mainHead">
                                <div class="head"> <?= Words::getValue($language, 'faq') ?> </div>
                            </div>
                            <p><?= Words::getValue($language, 'faq_description') ?></p>
                            <div class="sideNav">

                                <ul>
                                    <?php
                                    foreach ($departments as $department) {
                                        $faqs = \common\models\DepartmentFaq::find()->where(['department_id' => $department->id, 'status' => 1])->all();
                                        if (!empty($faqs)) {
                                    ?>
                                            <li>
                                                <a href="javascript:void(0)" class="pageLink" data-bs-toggle="collapse"
                                                    data-bs-target="#faqAccord<?= $department->id ?>" aria-expanded="<?= $department->id == $department_details->id ? 'true' : 'false' ?>" aria-controls="faqAccord<?= $department->id ?>">
                                                    <?= $language == 'ar' ? $department->department_name_arabic : $department->department_name ?></a>
                                            </li>
                                    <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="accordion  faqAccord" id="faqAccord">
                                <?php
                                $i = 0;
                                foreach ($departments as $department) {
                                    $faqs = \common\models\DepartmentFaq::find()->where(['department_id' => $department->id, 'status' => 1])->all();
                                    if (!empty($faqs)) {
                                        $i++;
                                ?>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading<?= $department->id ?>">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#faqAccord<?= $department->id ?>" aria-expanded="<?= $department->id == $department_details->id ? 'true' : 'false' ?>" aria-controls="faqAccord<?= $department->id ?>">
                                                    <?= $language == 'ar' ? $department->department_name_arabic : $department->department_name ?>
                                                </button>
                                            </h2>
                                            <div id="faqAccord<?= $department->id ?>" class="accordion-collapse collapse <?= $i == 1 ? 'show' : '' ?>" aria-labelledby="headingOne"
                                                data-bs-parent="#faqAccord">
                                                <div class="accordion-body">

                                                    <div class="accordion cmnAccord" id="mainLandAccord">
                                                        <?php
                                                        if (!empty($faqs)) {
                                                            $j = 0;
                                                            foreach ($faqs as $faq) {
                                                                $j++;
                                                        ?>
                                                                <div class="accordion-item">
                                                                    <h2 class="accordion-header" id="headingOne">
                                                                        <button class="accordion-button collapsed" type="button"
                                                                            data-bs-toggle="collapse" data-bs-target="#mainLandAccord<?= $faq->id ?>"
                                                                            aria-expanded="false" aria-controls="mainLandAccord<?= $faq->id ?>">
                                                                            <div class="numTxt">
                                                                                <?= sprintf('%02d', $j); ?>.
                                                                            </div>
                                                                            <?= $language == 'ar' ? $faq->question_arabic : $faq->question ?>
                                                                        </button>
                                                                    </h2>
                                                                    <div id="mainLandAccord<?= $faq->id ?>" class="accordion-collapse collapse  "
                                                                        aria-labelledby="heading<?= $faq->id ?>" data-bs-parent="#mainLandAccord">
                                                                        <div class="accordion-body">
                                                                            <?= $language == 'ar' ? $faq->answer_arabic : $faq->answer ?>
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
                                <?php
                                    }
                                }
                                ?>

                            </div>

                        </div>
                    </div>
                </div>
            </section>
        <?php
        }
    }


    $offerModels = $offersDataProvider->getModels();
    $isArabic = $language === 'ar';
    if (!empty($offerModels)): ?>


        <section class="department-offers" aria-labelledby="department-offers-title" <?= $isArabic ? ' dir="rtl" lang="ar"' : ' lang="en"' ?>>
            <div class="department-offers__inner">
                <div class="department-offers__heading-row">
                    <div class="department-offers__heading">
                        <!-- <span class="department-offers__eyebrow"></span> -->
                        <h2 class="department-offers__title" id="department-offers-title">
                            <?= $isArabic ? 'العروض' : 'OFFERS' ?>
                        </h2>
                    </div>
                    <a class="department-offers__all" href="<?= \yii\helpers\Url::to(['site/offers', 'language' => $language]) ?>">
                        <?= $isArabic ? 'عرض كل العروض' : 'See All Offers' ?><span aria-hidden="true">→</span>
                    </a>
                </div>

                <div class="department-offers__grid">
                    <?php foreach ($offerModels as $offer):
                        // Adjust these attribute names to match your Products model.
                        $offerName = $isArabic ? ($offer->product_name_arabic ?? $offer->product_name) : $offer->product_name;
                        $offerDescription = $isArabic ? ($offer->description_arabic ?? $offer->description) : $offer->description;
                        $offerImage = $offer->image;
                        $offerUrl = \yii\helpers\Url::to(['site/offer-details', 'language' => $language, 'slug' => $offer->canonical_name]);
                        $price = $offer->price;
                        $offer_price = $offer->offer_price;

                        $now_price = $price;
                        $actual_price = 0;
                        $percentage = 0;
                        if ($offer_price > 0) {
                            $actual_price = $price;
                            $now_price = $offer_price;
                            $percentage = round((($price - $offer_price) / $price) * 100);
                        }
                    ?>
                        <article class="department-offers__card">
                            <a class="department-offers__image-link" href="<?= $offerUrl ?>">
                                <div class="department-offers__image">
                                    <img src="<?= $homeUrl . 'uploads/products/' . $offerImage ?>"
                                        alt="<?= Html::encode($offerName) ?>"
                                        loading="lazy" decoding="async">
                                </div>
                                <h3 class="department-offers__card-title"><?= Html::encode($offerName) ?></h3>
                            </a>
                            <div class="department-offers__card-body">
                                <div class="department-offers__description">
                                    <?= $offerDescription ?>
                                </div>
                                <div class="priceBx">
                                    <?php if ($actual_price > 0) { ?>
                                        <div class="price"> <?= $now_price ?>AED </div>
                                        <div class="offPrice"> <?= $actual_price ?>AED </div>
                                    <?php } else { ?>
                                        <div class="price"> <?= $now_price ?>AED </div>
                                    <?php }
                                    ?>
                                </div>
                                <div class="btnSec">
                                    <div class="item">
                                        <button href="javascript:void(0)" class="cmnBtn hoveranim" data-bs-toggle="modal" data-bs-target="#bookingModal">
                                            <span><?= Words::getValue($language, 'book_an_appointment') ?></span>
                                        </button>
                                    </div>
                                    <div class="item">
                                        <a href="javascript:void(0)" class="cmnBtn offG hoveranim add-to-cart"
                                            data-product="<?= Html::encode($offer->id) ?>"
                                            data-variant="">
                                            <span><?= Words::getValue($language, 'pay_now') ?></span>
                                        </a>
                                    </div>
                                </div>
                                <a class="department-offers__learn" href="<?= $offerUrl ?>">
                                    <?= $isArabic ? 'مزيد من التفاصيل' : 'More Details' ?><span aria-hidden="true">→</span>
                                </a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif ?>
</div>


<script defer src="<?= $homeUrl ?>lib/home.min.js?v=1"></script>
<script>
    // SELECT2
    $(".select2").select2({
        minimumResultsForSearch: Infinity,
        theme: "bootstrap-5",
        closeOnSelect: true,
    });

    $(document).ready(function() {
        var rtlVal = document.documentElement.getAttribute('dir') === 'rtl';

        // Initialize the doctorSlider

        // var doctorSlider = $('.doctorSlider');

        // doctorSlider.owlCarousel({
        //     rewind: true,
        //     autoplay: true, // Enable autoplay if needed
        //     smartSpeed: 500,
        //     autoplayTimeout: 3500,
        //     autoplayHoverPause: true,
        //     nav: false,
        //     dots: false,
        //     lazyLoad: true,
        //     items: 1,
        //     rtl: rtlVal, // Assuming rtlVal is defined elsewhere in your script
        //     margin: 10,
        //     responsiveClass: true,
        //     responsive: {
        //         520: {
        //             items: 2,
        //             margin: 15,
        //         },
        //         768: {
        //             items: 3,
        //             margin: 15,
        //         },
        //         992: {
        //             items: 3,
        //             margin: 15,
        //         },
        //         1441: {
        //             items: 3,
        //             margin: 22,
        //         }
        //     }
        // });

        // // doctorSlider section nav
        // var doctorSliderCount = doctorSlider.find('.owl-item').length;

        // // Set total slides count
        // $('#doctors .NavflxBx .total').text(doctorSliderCount);

        // // Initialize the current slide index
        // var currentSlideIndexs = 1;
        // $('#doctors .NavflxBx .current').text(currentSlideIndexs);

        // // Update the current slide number on slide change (manual or auto)
        // doctorSlider.on('translated.owl.carousel', function(event) {
        //     // Calculate the new slide index based on the event object
        //     var newSlideIndex = event.item.index + 1; // OwlCarousel uses zero-based index
        //     currentSlideIndexs = Math.min(doctorSliderCount, newSlideIndex);

        //     // Update current slide index in the UI
        //     $('#doctors .NavflxBx .current').text(currentSlideIndexs);
        // });

        // // Next button click handler
        // $('#doctors .customSlideNav.OwlNext').click(function() {
        //     doctorSlider.trigger('next.owl.carousel');
        // });

        // // Previous button click handler
        // $('#doctors .customSlideNav.OwlPrev').click(function() {
        //     doctorSlider.trigger('prev.owl.carousel');
        // });

    });

    document.addEventListener('DOMContentLoaded', function() {

        document.querySelectorAll('.comparison').forEach(function(comparison) {
            var slider = comparison.querySelector('input[type="range"]');
            var divisor = comparison.querySelector('.divisor');
            var handle = comparison.querySelector('.handle');
            var vrElements = comparison.querySelectorAll('vr');

            if (!slider || !divisor || !handle) return;

            function update() {
                var value = slider.value; // 0 to 100

                // Update the clipping mask for the before image
                divisor.style.clipPath = 'inset(0 ' + (100 - value) + '% 0 0)';

                // Move the handle
                handle.style.left = value + '%';

                // Move all <vr> elements to match the slider position
                vrElements.forEach(function(vr) {
                    vr.style.left = value + '%';
                });
            }

            slider.addEventListener('input', update);
            update();
        });


        /* ---- Parallax on #appointment: passive scroll listener, one transform per frame, reads batched in rAF (replaces Jarallax) ---- */
        var pxImg = document.querySelector('#appointment .parallax-img');
        if (pxImg && window.matchMedia('(min-width:1024px) and (hover:hover)').matches && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            var pxSection = pxImg.parentNode,
                pxTicking = false;
            var pxUpdate = function() {
                pxTicking = false;
                var r = pxSection.getBoundingClientRect();
                if (r.bottom < 0 || r.top > window.innerHeight) return;
                var progress = (window.innerHeight - r.top) / (window.innerHeight + r.height); // 0..1 through the viewport
                pxImg.style.transform = 'translate3d(0,' + ((progress - 0.5) * r.height * 0.3) + 'px,0)';
            };
            var pxOnScroll = function() {
                if (!pxTicking) {
                    pxTicking = true;
                    requestAnimationFrame(pxUpdate);
                }
            };
            window.addEventListener('scroll', pxOnScroll, {
                passive: true
            });
            window.addEventListener('resize', pxOnScroll, {
                passive: true
            });
            pxUpdate();
        }


        $(function() {
            $('.insuranceSlider').owlCarousel({
                loop: true,
                margin: 20,
                nav: true,
                dots: false,
                autoplay: true,
                autoplayTimeout: 4000,
                autoplayHoverPause: true,
                smartSpeed: 600,
                responsive: {
                    0: {
                        items: 1
                    },
                    576: {
                        items: 2
                    },
                    768: {
                        items: 3
                    },
                    992: {
                        items: 4
                    },
                    1200: {
                        items: 5
                    }
                }
            });
        });


        var homeUrl = <?= Json::encode($homeUrl) ?>;
        var language = <?= Json::encode($language) ?>;
        var actionUrl = <?= Json::encode($action_url) ?>;

        /* Add to cart */
        $(document).on('click', '.add-to-cart', function(e) {
            e.preventDefault();
            var canname = $(this).attr('data-product');
            if (!canname) return;
            $.post(homeUrl + language + '/ajax/add-to-cart', {
                product: canname,
                qty: 1,
                combo: $(this).attr('data-variant'),
                type: 1,
                current_url: ''
            }, function(data) {
                if (data != 0) {
                    window.location.href = <?= Json::encode(Url::to(['cart/index', 'language' => $language])) ?>;
                }
            });
        });

    });

      document.addEventListener('DOMContentLoaded', function() {
          document.querySelectorAll('form').forEach(function(form) {
                if (form.closest('.modal')) return;
                if (form.querySelector('select:not(.selectpicker)')) whenNear(form, function() {
                    initSelect2(form);
                });
            });
            initSelect2($('select:not(.selectpicker)').filter(function() {
                return !$(this).closest('form').length;
            }).parent());

            /* Booking modal: init select2 + datepicker + lazy-load reCAPTCHA on first open only (window.loadRecaptcha is defined above) */
            $('#bookingModal').on('show.bs.modal', function() {
                initSelect2(this);
                window.loadRecaptcha();
            }).on('shown.bs.modal', function() {
                if (window.flatpickr) {
                    flatpickr('#eventDate1', {
                        dateFormat: "F, d Y",
                        minDate: "today",
                        disable: [{
                            from: "1700-01-01",
                            to: "1800-01-01"
                        }]
                    });
                }
            });
            whenNear(document.getElementById('eventDate'), function() {
                if (window.flatpickr) flatpickr("#eventDate", {
                    dateFormat: "F, d Y",
                    disable: [{
                        from: "1700-01-01",
                        to: "1800-01-01"
                    }]
                });
            });
     });
</script>