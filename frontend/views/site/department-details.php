<?php

/** @var yii\web\View $this */

use yii\helpers\Url;
use common\models\Words;
use yii\helpers\Html;
use yii\web\View;

$currentUrl = Url::to(Yii::$app->request->url, true);
$homeUrl    = Yii::$app->homeUrl;
$isAr       = ($language === 'ar');

// $this->params['breadcrumbs'][] = $this->title;
// $this->title = 'Damas | ' . $department_details->department_name;
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
                                    <style type="text/css">.st0 { fill: #FAF5EC; }.st1 { fill: #814826; }
                                    </style>
                                    <path class="st0" d="M137.432,250.574c-3.195,0-5.973-0.855-8.25-2.543c-2.914-2.155-4.271-5.217-4.833-8.176 c-3.108,3.687-7.457,5.852-12.367,5.852c-4.685,0-9.342-2.084-13.115-5.867c-5.649-5.665-10.718-11.77-15.619-17.673 c-2.002-2.412-4.072-4.905-6.119-7.289c-0.587-0.685-1.08-1.444-1.463-2.262l-0.572-1.218c-9.81-20.873-19.076-40.586-16.537-64.938 c1.952-18.706-0.934-35.598-7.717-45.188c-12.482-17.641-18.35-32.962-9.059-54.805c6.653-15.637,19.197-24.47,35.322-24.872 c0.629-0.016,1.258-0.023,1.889-0.023c9.186,0,18.229,1.623,26.633,3.377c1.748,0.365,3.462,0.542,5.242,0.542 c2.58,0,5.371-0.375,8.784-1.18l2.923-0.692c10.796-2.563,21.96-5.213,33.477-6.054c1.64-0.12,3.304-0.181,4.943-0.181 c19.301,0,35.188,8.191,42.499,21.912c8.529,15.999,7.199,33.644-4.068,53.942c-9.727,17.521-8.756,28.103-6.029,46.82 c3.733,25.633-2.676,51.584-20.17,81.672c-3.793,6.524-8.774,11.813-13.596,16.926c-1.572,1.671-3.059,3.246-4.482,4.845 c-2.51,2.812-6.273,4.979-10.336,5.957l-0.144,0.032C142.766,249.947,140.158,250.574,137.432,250.574z"></path>
                                    <path class="st1" d="M194.668,43.333c-7.021-13.177-23.322-17.527-37.889-16.46c-11.713,0.856-21.447,9.581-32.946,12.294 c-6.214,1.466-11.987,2.025-18.365,0.694c-8.606-1.796-19.391-9.151-28.117-8.934c-12.465,0.311-21.333,6.95-26.369,18.789 C43.319,67.731,48.258,79.646,59,94.833c9.571,13.53,11.334,34.419,9.5,52c-2.295,22.019,6.59,40.376,16.214,60.864 c7.029,8.188,13.633,16.796,21.23,24.414c5.454,5.469,11.76,2.938,13.09-4.773c0.67-3.88,0.502-8.046-0.062-11.97 c-0.911-6.354-14.271-46.86-15.307-53.201c-1.332-8.167-2.181-19.433,2.001-28.854c7.167-16.146,33.747-11.208,36.833-0.146 c4,14.334,2.201,34.61,0.834,42.001c-2.155,11.652-6.319,45.527-9.028,57.096c-0.535,2.282-0.509,6.078,0.823,7.064 c1.563,1.154,4.912,0.322,7.338-0.26c1.88-0.452,3.953-1.478,5.218-2.891c5.84-6.55,12.555-12.671,16.896-20.141 c13.739-23.631,22.795-48.6,18.92-75.205c-2.849-19.546-4.078-32.83,7.183-53.114C199.5,71.833,202.059,57.195,194.668,43.333z M153.957,86.79l-10.623,19.423L132.711,86.79l-19.423-10.623l19.423-10.623l10.623-19.423l10.623,19.423l19.423,10.623 L153.957,86.79z"></path>
                                </g>
                            </svg>f
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
                    
                    <div class="cont">
                        <div class="tle">
                           <h3> <?= $language == 'ar' ? $department_details->section3_title_arabic : $department_details->section3_title ?></h3>
                            
                        </div>
                        
                        <?= $language == 'ar' ? $department_details->section3_description_arabic : $department_details->section3_description ?>
                    </div>
                    
                    <div class="imgBx">
                        <img src="<?= $homeUrl ?>uploads/departments/<?= Html::encode($department_details->department_image) ?>" width="400px" height="400px" alt="<?= $language == 'ar' ? $department_details->section3_title_arabic : $department_details->section3_title ?>">
                    </div>
                </div>
            </div>
        </section>
    <?php
    }
    ?>


    <?php
    if (!empty($department_videos1) || !empty($department_videos2) || $department_details->section4_title != '' || $department_details->section4_description != '') {
    ?>
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
                <?php
                if (!empty($department_videos1)) {
                ?>
                    <div class="vdoWrap">
                        <a href="<?= $department_videos1->video ?>" class=" vdoBx" data-fancybox="proGal">
                            <img alt="<?= $language == 'ar' ? $department_details->section4_title_arabic : $department_details->section4_title ?>" src="<?= Yii::$app->homeUrl ?>uploads/department-videos/<?= $department_videos1->thumb_image ?>" data-src="<?= Yii::$app->homeUrl ?>uploads/department-videos/<?= $department_videos1->thumb_image ?>"
                                class="lazy" loading="lazy" width="426" height="296" />
                            <div class="iconBx">
                                <div class="icon">
                                    <img alt="image" src="<?= Yii::$app->homeUrl ?>images/utube.svg" class="lazy" width="9" height="10" />
                                </div>
                                <div class="txt">Watch Video</div>
                            </div>
                        </a>
                    </div>
                <?php
                }
                if (!empty($department_videos2)) {
                ?>
                    <div class="gridVdo">
                        <div class="dFlex">
                            <?php foreach ($department_videos2 as $department_vid2) { ?>
                                <div class="item">
                                    <a href="<?= $department_vid2->video ?>" class=" itmBx" data-fancybox="proGal">
                                        <img alt="<?= $language == 'ar' ? $department_details->section4_title_arabic : $department_details->section4_title ?>" src="<?= Yii::$app->homeUrl ?>uploads/department-videos/<?= $department_vid2->thumb_image ?>" data-src="<?= Yii::$app->homeUrl ?>uploads/department-videos/<?= $department_vid2->thumb_image ?>"
                                            class="lazy" loading="lazy" width="426" height="296" />
                                        <div class="iconBx">
                                            <div class="icon">
                                                <img alt="image" src="<?= Yii::$app->homeUrl ?>images/utube.svg" class="lazy" width="9" height="10" />
                                            </div>
                                            <div class="txt">Watch Video</div>
                                        </div>
                                    </a>
                                </div>
                            <?php }
                            ?>

                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </section>
    <?php
    }


    if (!empty($treatment_results)) {
    ?>
        <section id="treatmentSec">
            <div class="container">
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
                                            <img src="<?= Yii::$app->homeUrl ?>uploads/department-treatments/<?= $treatment_result->after_image ?>"
                                                loading="lazy" width="312" height="395" alt="Treatment Results">
                                        </div>
                                        <div class="handle" data-slider-id="slider1<?= $i ?>" style="left: 57%;"></div>
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
            </div>
        </section>
    <?php
    }
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
    if (!empty($related_services)) {
        ?>

        <section id="offerSec">
            <div class="container">
                <div class="tleWrap">
                    <div class="tle"><?= Words::getValue($language, 'related_services') ?></div>

                </div>

                <div class="dFlex">
                    <?php
                    foreach ($related_services as $related_service) {
                    ?>
                        <div class="itm">
                            <a href="<?= Url::to(['site/service-details', 'language' => $language, 'department' => $department_details->canonical_name, 'slug' => $related_service->canonical_name]); ?>" class="relatedBox">
                                <div class="imGbox">
                                    <img src="<?= Yii::$app->homeUrl ?>uploads/services/<?= $related_service->service_image ?>" data-src="<?= Yii::$app->homeUrl ?>uploads/services/<?= $related_service->service_image ?>" class="lazy" loading="lazy" width="400" height="245" alt="<?= $language == 'ar' ? $related_service->service_name_arabic : $related_service->service_name ?>">
                                </div>
                                <div class="infoBx">
                                    <div class="title"><?= $language == 'ar' ? $related_service->service_name_arabic : $related_service->service_name ?></div>
                                    <div class="btmSec">
                                        <div class="moreDetails">
                                            <?= Words::getValue($language, 'more_details') ?>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php }
                    ?>

                </div>
            </div>
        </section>
    <?php
    }
    if (!empty($our_doctors)) {
    ?>
        <section id="doctors">
            <img src="<?= Yii::$app->homeUrl ?>images/doctorsBg.webp" class="bannerBg lazy" data-src=" <?= Yii::$app->homeUrl ?>images/doctorsBg.webp"
                loading="lazy" width="1920" height="685" alt="Doctor Background Image">

            <div class="container">
                <div class="row">
                    <div class="col-lg-3 leftSec">
                        <div class="contentBx wow animate__fadeInUp" data-wow-duration="1.5s">
                            <div class="mainHead">
                                <div class="head"><?= Words::getValue($language, 'our_doctors') ?></div>
                            </div>
                            <p>
                                <?= Words::getValue($language, 'our_doctor_description') ?> </p>
                        </div>


                        <div class="NavflxBx wow animate__fadeInUp" data-wow-duration="1.5s">
                            <div class="counterBx">
                                <div class="item">
                                    <div class="countList current">
                                        01
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="countList total">
                                        <?= sprintf('%02d', count($our_doctors)); ?>
                                    </div>
                                </div>
                            </div>


                            <div class="navButtons">
                                <div class="item">
                                    <button class="OwlPrev customSlideNav" type="button">
                                        <div class="icon">
                                            <svg viewBox="0 0 18.156 9">
                                                <path id="Exclusion_2" data-name="Exclusion 2"
                                                    d="M13,0V3H0V6H13V9l5.156-4.516L13,0Z"
                                                    transform="translate(18.156 9) rotate(180)" />
                                            </svg>
                                        </div>
                                    </button>
                                </div>
                                <div class="item">
                                    <button class="OwlNext customSlideNav" type="button">
                                        <div class="icon">
                                            <svg viewBox="0 0 18.156 9">
                                                <path id="Exclusion_1" data-name="Exclusion 1"
                                                    d="M-3697-66v-3h-13v-3h13v-3l5.156,4.516L-3697-66Z"
                                                    transform="translate(3710 75)" />
                                            </svg>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>




                    </div>
                    <div class="col-lg-9">
                        <div class="doctorSlider owl-carousel wow animate__fadeInUp" data-wow-duration="1.5s">
                            <?php foreach ($our_doctors as $our_doctor) { ?>
                                <div class="item">
                                    <a class="serviceBox" href="<?= Url::to(['site/doctor-details', 'language' => $language, 'slug' => $our_doctor->canonical_name]); ?>">
                                        <div class="imgBox">
                                            <img src="<?= Yii::$app->homeUrl ?>uploads/doctors/<?= $our_doctor->image ?>" data-src="<?= Yii::$app->homeUrl ?>uploads/doctors/<?= $our_doctor->image ?>" class="lazy"
                                                loading="lazy" width="300" height="385" alt="<?= $language == 'ar' ? $our_doctor->doctor_name_arabic : $our_doctor->doctor_name ?>">
                                        </div>
                                        <div class="info">
                                            <div class="name"> <?= $language == 'ar' ? $our_doctor->doctor_name_arabic : $our_doctor->doctor_name ?></div>
                                            <div class="post"> <?= $language == 'ar' ? $our_doctor->designation_arabic : $our_doctor->designation ?></div>
                                        </div>
                                    </a>
                                </div>
                            <?php }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php
    }
    ?>
</div>


<!-- WOW -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"
    integrity="sha512-Eak/29OTpb36LLo2r47IpVzPBLXnAMPAVypbSZiZ4Qkf8p/7S/XRG5xp7OKWPPYfJT6metI+IORkR5G8F900+g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- SCROLL MAGIC -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.8/ScrollMagic.min.js"
    integrity="sha512-8E3KZoPoZCD+1dgfqhPbejQBnQfBXe8FuwL4z/c8sTrgeDMFEnoyTlH3obB4/fV+6Sg0a0XF+L/6xS4Xx1fUEg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>



<!-- owl carousel  -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
    integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
    integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>



<!-- FANCY_BOX-->
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.6/jquery.fancybox.min.css">
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.6/jquery.fancybox.min.js">
</script>


<!-- SELECT2 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


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

        var doctorSlider = $('.doctorSlider');

        doctorSlider.owlCarousel({
            rewind: true,
            autoplay: true, // Enable autoplay if needed
            smartSpeed: 500,
            autoplayTimeout: 3500,
            autoplayHoverPause: true,
            nav: false,
            dots: false,
            lazyLoad: true,
            items: 1,
            rtl: rtlVal, // Assuming rtlVal is defined elsewhere in your script
            margin: 10,
            responsiveClass: true,
            responsive: {
                520: {
                    items: 2,
                    margin: 15,
                },
                768: {
                    items: 3,
                    margin: 15,
                },
                992: {
                    items: 3,
                    margin: 15,
                },
                1441: {
                    items: 3,
                    margin: 22,
                }
            }
        });

        // doctorSlider section nav
        var doctorSliderCount = doctorSlider.find('.owl-item').length;

        // Set total slides count
        $('#doctors .NavflxBx .total').text(doctorSliderCount);

        // Initialize the current slide index
        var currentSlideIndexs = 1;
        $('#doctors .NavflxBx .current').text(currentSlideIndexs);

        // Update the current slide number on slide change (manual or auto)
        doctorSlider.on('translated.owl.carousel', function(event) {
            // Calculate the new slide index based on the event object
            var newSlideIndex = event.item.index + 1; // OwlCarousel uses zero-based index
            currentSlideIndexs = Math.min(doctorSliderCount, newSlideIndex);

            // Update current slide index in the UI
            $('#doctors .NavflxBx .current').text(currentSlideIndexs);
        });

        // Next button click handler
        $('#doctors .customSlideNav.OwlNext').click(function() {
            doctorSlider.trigger('next.owl.carousel');
        });

        // Previous button click handler
        $('#doctors .customSlideNav.OwlPrev').click(function() {
            doctorSlider.trigger('prev.owl.carousel');
        });



        (function(){
    document.querySelectorAll('.department-case__comparison').forEach(function(comparison){
        var range = comparison.querySelector('.department-case__range');
        var before = comparison.querySelector('[data-before]');
        var divider = comparison.querySelector('[data-divider]');
        function update(){
            var value = range.value + '%';
            before.style.width = value;
            divider.style.left = value;
        }
        range.addEventListener('input', update);
        update();
    });
})();


    });



</script>