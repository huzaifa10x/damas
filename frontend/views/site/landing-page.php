<?php

use yii\helpers\Url;
use common\models\Words;
use common\models\About;
use yii\widgets\ActiveForm;
$currentUrl = Url::to(Yii::$app->request->url, true);
?>
<div id="pageWrapper" class="landingPage">
    <?php
    if (!empty($sliders) && $page_details->is_enable_banner == 1) {
        ?>
        <section id="MainBanner" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-touch="false">
            <div class="carousel-inner">
                <?php
                $i = 0;
                foreach ($sliders as $slider) {
                    ?>
                    <div class="carousel-item <?= $i == 0 ? 'active' : '' ?>" data-bs-slide="<?= $i ?>" data-bs-interval="5000">
                        <div class="imBox">
                            <?php
                            if ($slider->video != '') {
                                ?>
                                <video id="myVideo" class="dsk" autoplay loop muted playsinline src="<?= Yii::$app->homeUrl ?>uploads/landing-page-banners/<?= $slider->video ?>"
                                       type="video/mp4"></video> 
                                       <?php
                                   }
                                   ?>
                            <img src="<?= Yii::$app->homeUrl ?>uploads/landing-page-banners/<?= $slider->desktop_image ?>" data-src="<?= Yii::$app->homeUrl ?>uploads/landing-page-banners/<?= $slider->desktop_image ?>" class="bannerBg lazy"
                                 loading="lazy" width="1920" height="875" alt="Banner <?= $language == 'ar' ? $slider->title_arabic : $slider->title ?>">
                        </div>
                        <div class="container">
                            <div class="bannerCaption">
                                <h1 class="mainTitle">
                                    <?= $language == 'ar' ? $slider->title_arabic : $slider->title ?>
                                </h1>
                                <div class="SubInfo"> <?= $language == 'ar' ? $slider->description_arabic : $slider->description ?></div>

                                <div class="btnSec">
                                    <a href="javascript:void(0)" class="cmnBtn white hoveranim" data-bs-toggle="modal"
                                       data-bs-target="#bookingModal">
                                        <span><?= Words::getValue($language, 'book_now') ?></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $i++;
                }
                ?>

            </div>



        </section>
        <?php
    }
    ?>
    <?php
    if (!empty($about) && $page_details->is_enable_about == 1) {
        ?>
        <section id="welcome">
            <div class="container">
                <div class="row">
                    <div class="col-xl-2 col-lg-3">
                        <div class="mainTitle">
                            <div class="title"><?= $language == 'ar' ? $about->welcome_title_arabic : $about->welcome_title ?></div>
                        </div>
                    </div>
                    <div class="col-xl-10 col-lg-9">
                        <div class="titleHead">
                            <?= $language == 'ar' ? $about->welcome_description_arabic : $about->welcome_description ?>
                        </div>
                    </div>

                </div>
                <div class="row cRow">
                    <div class="col-lg-4 col-sm-6">
                        <div class="imGbox">
                            <img src="<?= Yii::$app->homeUrl ?>uploads/landing-page-about/<?= $about->about_image1 ?>" data-src="<?= Yii::$app->homeUrl ?>uploads/landing-page-about/<?= $about->about_image1 ?>" class="lazy" loading="lazy"
                                 width="390" height="525" alt="Welcome Image">
                        </div>
                    </div>
                    <div class="col-lg-5 mdSec">
                        <div class="contentBx">
                            <?= $language == 'ar' ? $about->about_description1_arabic : $about->about_description1 ?>
                        </div>
                    </div>
                    <div class="col-lg-3 rightbX col-sm-6">
                        <div class="imGbox small">
                            <img src="<?= Yii::$app->homeUrl ?>uploads/landing-page-about/<?= $about->about_image2 ?>" data-src="<?= Yii::$app->homeUrl ?>uploads/landing-page-about/<?= $about->about_image2 ?>" class="lazy" loading="lazy"
                                 width="295" height="385" alt="About Image1">
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <section id="cosmetic">
            <div class="container">
                <div class="rflX">
                    <div class="rtSec">
                        <div class="imgBox">
                            <img src="<?= Yii::$app->homeUrl ?>uploads/landing-page-about/<?= $about->about_description2_image ?>" data-src="<?= Yii::$app->homeUrl ?>uploads/landing-page-about/<?= $about->about_description2_image ?>" class="lazy" loading="lazy"
                                 width="620" height="660" alt="About Image2">
                        </div>
                    </div>
                    <div class="lftSec">
                        <div class="mainTitle">
                            <?= $language == 'ar' ? $about->about_description2_title_arabic : $about->about_description2_title ?>
                        </div>

                        <?= $language == 'ar' ? $about->about_description2_arabic : $about->about_description2 ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
    ?>
    <?php
    if (!empty($video_section) && $page_details->is_enable_video_banner == 1) {
        ?>
        <section id="dental" data-anchor="dentalPage" data-jarallax data-type="scroll" class="jarallax">
            <img src="<?= Yii::$app->homeUrl ?>uploads/landing-page-video-section/<?= $video_section->image ?>" data-src="<?= Yii::$app->homeUrl ?>uploads/landing-page-video-section/<?= $video_section->image ?>" width="1920" height="850" alt="Video Banner"
                 loading="lazy" class="lazy jarallax-img">
            <div class="container">
                <div class="mainheading">
                    <div class="title"><?= $language == 'ar' ? $video_section->title_arabic : $video_section->title ?></div>
                    <div class="subT"><?= $language == 'ar' ? $video_section->description_arabic : $video_section->description ?></div>
                </div>
            </div>
        </section>
        <?php
    }
    ?>
    <?php
    if (!empty($gallery_images) && $page_details->is_enable_gallery == 1) {
        ?>
        <section id="gallery">
            <div class="container">
                <div class="flxBox wow animate__fadeInUp" data-wow-duration="1.5s">
                    <div class="leftSec">
                        <div class="mainHead">
                            <div class="head">Our Gallery </div>
                        </div>
                    </div>
                    <div class="rtSec">
                        <div class="NavflxBx wow animate__fadeInUp" data-wow-duration="1.5s">
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
                </div>
                <div class="gallerySlider owl-carousel wow animate__fadeInUp" data-wow-duration="1.5s">
                    <?php
                    $k = 0;
                    foreach ($gallery_images as $before_after_image) {
                        $k++;
                        ?>
                        <div class="item">
                            <div class="coparisonBx">
                                <div id="comparison" class="comparison">
                                    <figure>
                                        <div class="imgBx">
                                            <img src="<?= Yii::$app->homeUrl ?>uploads/landing-page-our-gallery/<?= $before_after_image->after_image ?> "
                                                 data-src="<?= Yii::$app->homeUrl ?>uploads/landing-page-our-gallery/<?= $before_after_image->after_image ?> " class="lazy"
                                                 loading="lazy" width="312" height="395" alt="Gallery Image<?= $k ?>">
                                        </div>
                                        <div class="handle" data-slider-id="slider<?= $k ?>" style="left: 57%;">
                                        </div>
                                        <div class="divisor" data-slider-id="slider<?= $k ?>"
                                             style="background-image: url(&quot;<?= Yii::$app->homeUrl ?>uploads/landing-page-our-gallery/<?= $before_after_image->before_image ?>&quot); width: 57%;">
                                        </div>
                                    </figure>
                                    <input type="range" min="0" max="100" value="50" id="slider<?= $k ?>"
                                           oninput="moveDivisor('slider<?= $k ?>')">
                                </div>
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
    if (!empty($videos) && $page_details->is_enable_our_video == 1) {
        ?>
        <section id="videoSec">
            <div class="sideTxt">Our video</div>
            <div class="container">
                <div class="flxBox wow animate__fadeInUp" data-wow-duration="1.5s">
                    <div class="leftSec">
                        <div class="mainHead">
                            <div class="head">Our Video</div>
                        </div>
                    </div>
                    <div class="rtSec">
                        <div class="NavflxBx wow animate__fadeInUp" data-wow-duration="1.5s">
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
                </div>
                <div class="videoSlider owl-carousel wow animate__fadeInUp" data-wow-duration="1.5s">
                    <?php foreach ($videos as $video) { ?>
                        <div class="item">
                            <a href="<?= Yii::$app->homeUrl ?>uploads/landing-page-our-videos/<?= $video->video ?>" class="cmnBoX" data-fancyBox="testmonial" target="_blank">
                                <div class="imgBox mb-0">
                                    <img src="<?= Yii::$app->homeUrl ?>uploads/landing-page-our-videos/<?= $video->thumb_image ?>" data-src="<?= Yii::$app->homeUrl ?>uploads/landing-page-our-videos/<?= $video->thumb_image ?>" alt="videoImg">
                                    <div class="plyBtn">
                                        <svg viewBox="0 0 11.132 13.036">
                                        <path id="Polygon_3" data-name="Polygon 3" d="M6.518,0l6.518,11.132H0Z"
                                              transform="translate(11.132) rotate(90)" fill="#763813" />
                                        </svg>
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
    ?>
    <?php
    if ($page_details->is_enable_services == 1 && !empty($services)) {
        ?>
        <section id="service">
            <div class="container">
                <div class="flxBox">
                    <div class="item">
                        <div class="logIcon">
                            <img src="<?= Yii::$app->homeUrl ?>images/log.svg" alt="our_service">
                        </div>
                        <div class="mainHead">
                            <div class="head"><?= Words::getValue($language, 'our_service') ?></div>
                            <div class="tagLine"><?= Words::getValue($language, 'our_service_description') ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    foreach ($services as $related_service) {
                        ?>
                        <div class="item">
                            <a href="javascript:void(0)" class="serviceBox">
                                <img src="<?= Yii::$app->homeUrl ?>uploads/services/<?= $related_service->service_image ?>" data-src="<?= Yii::$app->homeUrl ?>uploads/services/<?= $related_service->service_image ?>" class="lazy" loading="lazy"
                                     width="430" height="490" alt="<?= $language == 'ar' ? $related_service->service_name_arabic : $related_service->service_name ?>">

                                <div class="info">
                                    <div class="name"><?= $language == 'ar' ? $related_service->service_name_arabic : $related_service->service_name ?></div>
                                    <div class="cmnBtn"><span><?= Words::getValue($language, 'more_details') ?></span></div>
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
    ?>
    <?php
    if ($page_details->is_enable_appointment == 1) {
        ?>
        <section id="appointment" data-anchor="appointment" data-jarallax data-type="scroll" class="jarallax">
        <img src="<?= $language == 'ar' ? About::getValue('book_an_appointment_image_arabic', $language) : About::getValue('book_an_appointment_image', $language) ?>" data-src="<?= $language == 'ar' ? About::getValue('book_an_appointment_image_arabic', $language) : About::getValue('book_an_appointment_image', $language) ?>" class="lazy jarallax-img"
             loading="lazy" width="1920" height="720" alt="damasmc">
        <div class="container">
            <div class="appointMentBox wow animate__fadeInLeft" data-wow-duration="1.5s">
                <div class="imgBox">
                    <img src="<?= Yii::$app->homeUrl ?>images/logIcon.svg" alt="appointment">
                </div>
                <div class="title"><?= Words::getValue($language, 'book_appointment') ?></div>
                <?= \common\widgets\Alert::widget() ?>
                <?php $form = ActiveForm::begin(['id' => 'appointment-form2']); ?>
                <div class="row">
                    <input type="hidden" name="AppointmentEnquiryListing[page_url]" value="<?= $currentUrl ?>"/>
                    <div class="col-lg-12">
                        <?= $form->field($model, 'name')->textInput(['placeholder' => Words::getValue($language, 'name') . ' *'])->label(FALSE) ?>
                    </div>
                    <div class="col-lg-6">
                        <?= $form->field($model, 'age')->textInput(['placeholder' => Words::getValue($language, 'age') . ' *'])->label(FALSE) ?>
                    </div>
                    <div class="col-lg-6">
                        <?php
                        echo $form->field($model, 'gender')
                                ->dropDownList(
                                        $genders, // Flat array ('id'=>'label')
                                        ['prompt' => Words::getValue($language, 'gender') . ' *', 'class' => 'select2 select']    // options
                                )->label(FALSE);
                        ?>
                    </div>
                    <div class="col-lg-12">
                        <?= $form->field($model, 'phone_number')->textInput(['placeholder' => Words::getValue($language, 'phone_no') . ' *'])->label(FALSE) ?>
                    </div>
                    <div class="col-lg-12">
                        <?= $form->field($model, 'email')->textInput(['placeholder' => Words::getValue($language, 'email') . ' *'])->label(FALSE) ?>
                    </div>
                    <!--<div class="col-sm-12">-->
                    <!--    <?php // $form->field($model, 'appointment_date')->textInput(['placeholder' => Words::getValue($language, 'your_preferred_date') . ' *', 'id' => 'dateInput'])->label(FALSE)      ?>-->
                    <!--</div>-->
                    <div class="col-sm-12">
                        <div class="dateBx">
    <div class="icon">
        <svg id="Group_21637" data-name="Group 21637" xmlns="http://www.w3.org/2000/svg"
                                     width="18.895" height="18.895" viewBox="0 0 18.895 18.895">
                                <g id="Group_21636" data-name="Group 21636">
                                <g id="Group_21635" data-name="Group 21635">
                                <ellipse id="Ellipse_23" data-name="Ellipse 23" cx="1.176" cy="0.588"
                                         rx="1.176" ry="0.588" transform="translate(12.935 7.055)"
                                         fill="#888" />
                                <path id="Path_237" data-name="Path 237"
                                      d="M15.942,1.476h-.959V.738a.738.738,0,1,0-1.476,0v.738H10.148V.738a.738.738,0,0,0-1.476,0v.738H5.351V.738a.738.738,0,0,0-1.476,0v.738H2.952A2.956,2.956,0,0,0,0,4.428V15.942a2.956,2.956,0,0,0,2.952,2.952H8.6a.738.738,0,0,0,0-1.476H2.952a1.478,1.478,0,0,1-1.476-1.476V4.428A1.478,1.478,0,0,1,2.952,2.952h.923V3.69a.738.738,0,0,0,1.476,0V2.952H8.672V3.69a.738.738,0,1,0,1.476,0V2.952h3.358V3.69a.738.738,0,0,0,1.476,0V2.952h.959a1.478,1.478,0,0,1,1.476,1.476V8.635a.738.738,0,1,0,1.476,0V4.428A2.956,2.956,0,0,0,15.942,1.476Z"
                                      fill="#888" />
                                <path id="Path_238" data-name="Path 238"
                                      d="M274.465,270a4.465,4.465,0,1,0,4.465,4.465A4.47,4.47,0,0,0,274.465,270Zm0,7.454a2.989,2.989,0,1,1,2.989-2.989A2.993,2.993,0,0,1,274.465,277.454Z"
                                      transform="translate(-260.036 -260.036)" fill="#888" />
                                <path id="Path_239" data-name="Path 239"
                                      d="M372.808,331.513h-.332v-.775a.738.738,0,1,0-1.476,0v1.513a.738.738,0,0,0,.738.738h1.07a.738.738,0,0,0,0-1.476Z"
                                      transform="translate(-357.309 -317.822)" fill="#888" />
                                <ellipse id="Ellipse_24" data-name="Ellipse 24" cx="1.176" cy="0.588"
                                         rx="1.176" ry="0.588" transform="translate(9.407 7.055)"
                                         fill="#888" />
                                <circle id="Ellipse_25" data-name="Ellipse 25" cx="1.176" cy="1.176"
                                        r="1.176" transform="translate(7.055 9.407)" fill="#888" />
                                <ellipse id="Ellipse_26" data-name="Ellipse 26" cx="1.176" cy="0.588"
                                         rx="1.176" ry="0.588" transform="translate(3.528 7.055)"
                                         fill="#888" />
                                <circle id="Ellipse_27" data-name="Ellipse 27" cx="1.176" cy="1.176"
                                        r="1.176" transform="translate(3.528 9.407)" fill="#888" />
                                <circle id="Ellipse_28" data-name="Ellipse 28" cx="1.176" cy="1.176"
                                        r="1.176" transform="translate(3.528 12.935)" fill="#888" />
                                <circle id="Ellipse_29" data-name="Ellipse 29" cx="1.176" cy="1.176"
                                        r="1.176" transform="translate(7.055 12.935)" fill="#888" />
                                <ellipse id="Ellipse_30" data-name="Ellipse 30" cx="1.176" cy="0.588"
                                         rx="1.176" ry="0.588" transform="translate(7.055 7.055)"
                                         fill="#888" />
                                </g>
                                </g>
                                </svg>
    </div>

    <?= $form->field($model, 'appointment_date')->textInput([
        'id' => 'eventDate', 
        'class' => 'form-control datepicker', 
        'placeholder' => Words::getValue($language, 'your_preferred_date') . ' *',
        'type' => 'text', // Start as text, change to date on focus
        'data-input' => true
    ])->label(false) ?>
</div>
                    </div>
                    <div class="col-lg-12">
                        <?php
                        echo $form->field($model, 'service')
                                ->dropDownList(
                                        $service_list, // Flat array ('id'=>'label')
                                        ['prompt' => Words::getValue($language, 'select_department'), 'class' => 'select2 select']    // options
                                )->label(FALSE);
                        ?>
                    </div>
                    <div class="col-lg-12">
                        <?= $form->field($model, 'message')->textarea(['placeholder' => Words::getValue($language, 'message')])->label(FALSE) ?>
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
    </section>
        <?php
    }
    ?>


    <!-- JARALLAX --->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jarallax/2.0.3/jarallax.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jarallax/2.0.3/jarallax.min.js"></script>


    <!-- select2 -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <!-- owl carousel  -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
          integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
            integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script>
        var mydir = $("html").attr("dir");

    if (mydir == 'rtl') {
        var rtlVal = true
    } else {
        var rtlVal = false
    }

    $('.videoSlider').owlCarousel({

        rewind: true,
        autoplay: false,
        smartSpeed: 500,
        autoplayTimeout: 3500,
        autoplayHoverPause: true,
        nav: false,
        dots: false,
        items: 1,
        rtl: rtlVal,
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

    // video slide Nav 

    var videoSlider = $('.videoSlider');

    $('#videoSec .customSlideNav.OwlNext').click(function() {
        videoSlider.trigger('next.owl.carousel');
    });

    $('#videoSec .customSlideNav.OwlPrev').click(function() {
        videoSlider.trigger('prev.owl.carousel');
    });



    $('.gallerySlider').owlCarousel({

        rewind: false,
        autoplay: false,
        smartSpeed: 500,
        autoplayTimeout: 3500,
        autoplayHoverPause: true,
        nav: false,
        dots: false,
        items: 1,
        rtl: rtlVal,
        margin: 10,
        lazyLoad: true,
        responsiveClass: true,
        mouseDrag: false,
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
                items: 4,
                margin: 15,
            },
            1441: {
                items: 4,
                margin: 30,
            }
        }

    });

    // gallerySlider

    var gallerySlider = $('.gallerySlider');

    $('#gallery .customSlideNav.OwlNext').click(function() {
        gallerySlider.trigger('next.owl.carousel');
    });

    $('#gallery .customSlideNav.OwlPrev').click(function() {
        gallerySlider.trigger('prev.owl.carousel');
    });




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

</div>
