<?php

/** @var yii\web\View $this */
use yii\helpers\Url;
use common\models\Words;

// $this->params['breadcrumbs'][] = $this->title;
// $this->title = 'Damas | ' . $department_details->department_name;
?>

<div id="pageWrapper" class="cosmetcPage">
    <section id="PageBanner">
        <?php if ($department_details->banner_video != '') { ?>
            <video id="myVideo" class="bannerBg" autoplay loop muted playsinline src="<?= $department_details->banner_video ?>"
                   type="video/mp4"></video>
               <?php } else { ?>
            <img src="<?= Yii::$app->homeUrl ?>uploads/departments/<?= $language == 'ar' ? $department_details->banner_image_arabic : $department_details->banner_image ?>" data-src="<?= Yii::$app->homeUrl ?>uploads/departments/<?= $language == 'ar' ? $department_details->banner_image_arabic : $department_details->banner_image ?>" class="lazy bannerBg"
                 loading="lazy" width="1920" height="535" alt="<?= $language == 'ar' ? $department_details->department_name_arabic : $department_details->department_name ?>"> 
             <?php }
             ?>
        <div class="container">
            <div class="mainBanner">
                <div class="captionBx">
                    <h1 class="mainHead"><?= $language == 'ar' ? $department_details->department_name_arabic : $department_details->department_name ?></h1>
                    <div class="tagLine"><?= $language == 'ar' ? $department_details->banner_description_arabic : $department_details->banner_description ?></div>
                </div>
            </div>
        </div>
    </section>
    
     <!-- Breadcrumb -->

    <section id="Breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="<?= Url::to(['site/index', 'language' => $language]); ?>"><?= Words::getValue($language, 'home') ?></a></li>
                <li><a href="<?= Url::to(['site/departments', 'language' => $language]); ?>">Department</a></li>
                <li class="active"><?= $language == 'ar' ? $department_details->department_name_arabic : $department_details->department_name ?></li>
            </ul>
        </div>
    </section>

    <!-- Breadcrumb end -->

    <section id="cosmeticSec">
        <div class="container">
            <div class="contentWrap">
                <div class="imgBx">
                    <img src="<?= Yii::$app->homeUrl ?>uploads/departments/<?= $department_details->department_image ?>" loading="lazy" width="689" height="586" alt="<?= $language == 'ar' ? $department_details->department_name_arabic : $department_details->department_name ?>">
                </div>
                <div class="cont">
                    <div class="tle"><?= $language == 'ar' ? $department_details->department_name_arabic : $department_details->department_name ?></div>
                    <?= $language == 'ar' ? $department_details->department_description_arabic : $department_details->department_description ?>
                </div>
            </div>
        </div>
    </section>
    <?php
    if($department_details->section3_title != '' && $department_details->section3_description !== '' ){
    ?>
    <section id="dentistrySec">
        
        <div class="Custom_container">
            <div class="dFlx">
                <div class="w50 lftbx">
                    <div class="cntWrap">
                        <div class="elememt">
                            <img src="<?= Yii::$app->homeUrl ?>images/dentElemnt.svg" loading="lazy" width="362" height="368" alt="image">
                        </div>
                        <div class="hd">
                            <?= $language == 'ar' ? $department_details->section3_title_arabic : $department_details->section3_title ?>
                        </div>
                        <?= $language == 'ar' ? $department_details->section3_description_arabic : $department_details->section3_description ?>
                    </div>
                </div>
                <?php
                if($department_details->section3_image != ''){
                ?>
                <div class="w50 rtBx">
                    <div class="imgWrap">
                        <img src="<?= Yii::$app->homeUrl ?>uploads/departments/<?= $department_details->section3_image ?>" width="768" height="768" alt="<?= $language == 'ar' ? $department_details->section3_title_arabic : $department_details->section3_title ?>">
                    </div>
                </div>
                <?php
                }
                ?>
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
    if($department_details->section7_title != '' || $department_details->section7_description != '' || !empty($proc_and_cons)){
    ?>
    <section id="contentSec">
        <div class="container">
            <div class="contentWrap">
                <div class="elememt">
                    <img src="<?= Yii::$app->homeUrl ?>images/dentElemnt.svg" loading="lazy" width="362" height="368" alt="image">
                </div>
                <?php
                if($department_details->section7_title != ''){
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
         if(!empty($dfaqs)){
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
                                if(!empty($faqs)){
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
                            <a href="<?= Url::to(['site/service-details', 'language' => $language, 'department' => $department_details->canonical_name, 'slug' => $related_service->canonical_name]); ?>"  class="relatedBox">
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

    function moveDivisor(sliderId) {
        var slider = document.getElementById(`${sliderId}`);
        var divisor = document.querySelector(`.divisor[data-slider-id="${sliderId}"]`);
        var handle = document.querySelector(`.handle[data-slider-id="${sliderId}"]`);

        var sliderValue = slider.value;
        var width = 100 - sliderValue;

        handle.style.left = slider.value + "%";
        divisor.style.width = slider.value + "%";

    }
    
   
    
 

    $(document).ready(function() {
        
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
    });



    
    var mydir = $("html").attr("dir");

    if (mydir == 'rtl') {
        var rtlVal = true
    } else {
        var rtlVal = false
    }
</script>
