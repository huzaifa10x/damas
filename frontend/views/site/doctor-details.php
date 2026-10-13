<?php

/** @var yii\web\View $this */
use yii\helpers\Url;
use common\models\Words;

// $this->params['breadcrumbs'][] = $this->title;
// $this->title = 'Damas | ' . $doctor_details->doctor_name;
?>

<div id="pageWrapper" class="doctordetailPage">
    <!-- Breadcrumb -->

    <section id="Breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="<?= Url::to(['site/index', 'language' => $language]); ?>"><?= Words::getValue($language, 'home') ?></a></li>
                <li class="active"><?= Words::getValue($language, 'our_doctors') ?></li>
            </ul>
        </div>
    </section>
    <section id="doctrDetailSec">
        <div class="container">
            <div class="dFlex">
                <div class="lft">
                    <div class="imgWrap">
                        <div class="imgBx">
                            <img src="<?= Yii::$app->homeUrl ?>uploads/doctors/<?= $doctor_details->image ?>" data-src="<?= Yii::$app->homeUrl ?>uploads/doctors/<?= $doctor_details->image ?>" class="lazy"
                                 loading="lazy" width="342" height="336" alt="blogImg">
                        </div>
                        <div class="lnkWrap">
                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                       data-bs-target="#bookingModal" class="bookLnk hoveranim">
                                <span class="txt"><?= Words::getValue($language, 'book_now') ?></span>
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="7.156" height="11"
                                         viewBox="0 0 7.156 11">
                                        <path id="arrow" d="M0,0,7.156,5.519h0L0,11Z" fill="#fff" />
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="contWrap">
                        <?php
                        if ($doctor_details->email != '') {
                            ?>
                            <div class="tle"><?= Words::getValue($language, 'contact') ?> </div>
                            <div class="mailBx"><?= Words::getValue($language, 'email') ?>: <br>
                                    <a href="mailto:<?= $doctor_details->email ?>" class="mail"> <?= $doctor_details->email ?></a>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="langWrap">
                            <div class="tle"><?= Words::getValue($language, 'known_languages') ?></div>
                            <div class="flexBx">
                                <?php
                                if (!empty($language_list)) {
                                    foreach ($language_list as $language_li) {
                                        ?>
                                        <div class="lagItm">
                                            <div class="langBx">
                                                <div class="icon">
                                                    <img src="<?= Yii::$app->homeUrl ?>uploads/languages/<?= $language_li->flag ?>" alt="<?= $language_li->language_name ?>">
                                                </div>
                                                <div class="lang"><?= $language_li == 'ar' ? $language_li->language_name_arabic : $language_li->language_name ?></div>
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
                <div class="ryt">
                    <div class="contBx">
                        <div class="elememt">
                            <img src="<?= Yii::$app->homeUrl ?>images/dentElemnt.svg" loading="lazy" width="362" height="368" alt="image">
                        </div>
                        <h1 class="tle"><?= $language == 'ar' ? $doctor_details->doctor_name_arabic : $doctor_details->doctor_name ?></h1>
                        <div class="subT"><?= $language == 'ar' ? $doctor_details->designation_arabic : $doctor_details->designation ?></div>
                        <div class="cont">
                            <?= $language == 'ar' ? $doctor_details->description_arabic : $doctor_details->description ?>
                        </div>
                    </div>
                    <div class="doctAcc">
                        <div class="accordHead">
                            <?php
                            if($doctor_details->overview != ''){
                            ?>
                            <div class="accordion-header" id="headingOne">
                                <button class="accordion-button " type="button" data-bs-toggle="collapse"
                                        data-bs-target="#detailAccord1" aria-expanded="true" aria-controls="detailAccord1">
                                    <?= Words::getValue($language, 'overview') ?>
                                </button>
                            </div>
                            <?php
                            }
                            if($doctor_details->qualifications != ''){
                            ?>
                            <div class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#detailAccord2" aria-expanded="false" aria-controls="detailAccord2">
                                    <?= Words::getValue($language, 'qualifications') ?>
                                </button>
                            </div>
                            <?php
                            }
                            if($doctor_details->work_experience != ''){
                            ?>
                            <div class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#detailAccord3" aria-expanded="false" aria-controls="detailAccord3">
                                    <?= Words::getValue($language, 'work_experience') ?>
                                </button>
                            </div>
                            <?php
                            }
                            if(!empty($gallery_images)){
                            ?>
                            <div class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#detailAccord4" aria-expanded="false" aria-controls="detailAccord4">

                                    <?= Words::getValue($language, 'gallery') ?>
                                </button>
                            </div>
                            <?php
                            }
                            ?>

                        </div>

                        <div class="accordion" id="detailAccord">
                             <?php
                            if($doctor_details->overview != ''){
                            ?>
                            <div class="accordion-item">
                                <div class="accordion-header" id="headingOne">
                                    <button class="accordion-button detlccBtn" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#detailAccord1" aria-expanded="true"
                                            aria-controls="detailAccord1">
                                        <?= Words::getValue($language, 'overview') ?>
                                    </button>
                                </div>
                                <div id="detailAccord1" class="accordion-collapse collapse show"
                                     aria-labelledby="headingOne" data-bs-parent="#detailAccord">
                                    <div class="accordion-body">
                                        <div class="contentWrap">
                                            <div class="tle"></div>
                                            <?= $language == 'ar' ? $doctor_details->overview_arabic : $doctor_details->overview ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                             <?php
                            }
                            if($doctor_details->qualifications != ''){
                            ?>
                            <div class="accordion-item">
                                <div class="accordion-header" id="headingTwo">
                                    <button class="accordion-button detlccBtn collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#detailAccord2" aria-expanded="false"
                                            aria-controls="detailAccord2">
                                        <?= Words::getValue($language, 'qualifications') ?>
                                    </button>
                                </div>
                                <div id="detailAccord2" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                     data-bs-parent="#detailAccord">
                                    <div class="accordion-body">
                                        <div class="contentWrap">
                                            <?= $language == 'ar' ? $doctor_details->qualifications_arabic : $doctor_details->qualifications ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            }
                            if($doctor_details->work_experience != ''){
                            ?>
                            <div class="accordion-item">
                                <div class="accordion-header" id="headingThree">
                                    <button class="accordion-button detlccBtn collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#detailAccord3" aria-expanded="false"
                                            aria-controls="detailAccord3">
                                        <?= Words::getValue($language, 'work_experience') ?>
                                    </button>
                                </div>
                                <div id="detailAccord3" class="accordion-collapse collapse"
                                     aria-labelledby="headingThree" data-bs-parent="#detailAccord">
                                    <div class="accordion-body">
                                        <div class="contentWrap">
                                            <?= $language == 'ar' ? $doctor_details->work_experience_arabic : $doctor_details->work_experience ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            }
                            if(!empty($gallery_images)){
                            ?>
                            <div class="accordion-item">
                                <div class="accordion-header" id="headingThree">
                                    <button class="accordion-button detlccBtn collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#detailAccord4" aria-expanded="false"
                                            aria-controls="detailAccord4">
                                        <?= Words::getValue($language, 'gallery') ?>
                                    </button>
                                </div>
                                <div id="detailAccord4" class="accordion-collapse collapse"
                                     aria-labelledby="headingThree" data-bs-parent="#detailAccord">
                                    <div class="accordion-body">
                                        <div class="contentWrap">
                                            <div class="dFlex">
                                                
                                                <!--<div class="emptyBx">-->
                                                <!--    <div class="title">No data found</div>-->
                                                <!--</div>-->
                                        
                                                <?php
                                                if (!empty($gallery_images)) {
                                                    $i = 0;
                                                    foreach ($gallery_images as $gallery_image) {
                                                        $i++;
                                                        ?>
                                                        <div class="item">
                                                            <div class="coparisonBx">
                                                                <div id="comparison" class="comparison">
                                                                    <figure>
                                                                        <div class="imgBx">
                                                                            <img src="<?= Yii::$app->homeUrl ?>uploads/doctor-gallery/<?= $gallery_image->after_image ?>"
                                                                                 data-src="<?= Yii::$app->homeUrl ?>uploads/doctor-gallery/<?= $gallery_image->after_image ?>"
                                                                                 class="lazy" loading="lazy" width="312"
                                                                                 height="395" alt="comparison">
                                                                        </div>
                                                                        <div class="handle" data-slider-id="slider<?= $i ?>"
                                                                             style="left: 57%;"></div>
                                                                        <div class="divisor" data-slider-id="slider<?= $i ?>"
                                                                             style="background-image: url(&quot; <?= Yii::$app->homeUrl ?>uploads/doctor-gallery/<?= $gallery_image->before_image ?>&quot); width: 57%;">
                                                                        </div>
                                                                    </figure>
                                                                    <input type="range" min="0" max="100" value="50"
                                                                           id="slider<?= $i ?>" oninput="moveDivisor('slider<?= $i ?>')">
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
                            <?php
                            }
                            ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>


<!-- FANCY_BOX-->
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.6/jquery.fancybox.min.css">
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.6/jquery.fancybox.min.js">
    </script>

    <script>
        // image comparison

        function moveDivisor(sliderId) {
            var slider = document.getElementById(`${sliderId}`);
            var divisor = document.querySelector(`.divisor[data-slider-id="${sliderId}"]`);
            var handle = document.querySelector(`.handle[data-slider-id="${sliderId}"]`);

            var sliderValue = slider.value;
            var width = 100 - sliderValue;

            handle.style.left = slider.value + "%";
            divisor.style.width = slider.value + "%";

        }
    </script>
