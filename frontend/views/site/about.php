<?php

/** @var yii\web\View $this */
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\About;
use common\models\Words;
use yii\widgets\ActiveForm;

// $this->params['breadcrumbs'][] = $this->title;
// $this->title = 'Damas | About Us';
$currentUrl = Url::to(Yii::$app->request->url, true);
?>


<?php
// Register the Google reCAPTCHA script in the view
$this->registerJsFile(
    'https://www.google.com/recaptcha/api.js',
    ['position' => \yii\web\View::POS_HEAD, 'async' => true, 'defer' => true]
);
?>


<div id="pageWrapper" class="aboutPage">
    <section id="PageBanner">
        <?php if ($banner->video != '') { ?>
            <!--<video id="myVideo" class="bannerBg" autoplay loop muted playsinline src="<?= Yii::$app->homeUrl ?>uploads/banners/<?= $banner->video ?>"-->
            <!--       type="video/mp4"></video>-->
                   
                    <video id="myVideo" class="bannerBg" autoplay loop muted playsinline >
                        <source src="<?= Yii::$app->homeUrl ?>uploads/banners/<?= $banner->video ?>" type="video/mp4"> 
                      
                    </video>
                    
               <?php } else { ?>
            <img src="<?= Yii::$app->homeUrl ?>uploads/banners/<?= $language == 'ar' ? $banner->image_arabic : $banner->image ?>" data-src="<?= Yii::$app->homeUrl ?>uploads/banners/<?= $language == 'ar' ? $banner->image_arabic : $banner->image ?>" class="lazy bannerBg"
                 loading="lazy" width="1920" height="535" alt="<?= $language == 'ar' ? $banner->title_arabic : $banner->title ?>"> 
             <?php }
             ?>
        <div class="container">
            <div class="mainBanner">
                <div class="captionBx">
                    <h1 class="mainHead"><?= $language == 'ar' ? $banner->title_arabic : $banner->title ?></h1>
                    <div class="tagLine"><?= $language == 'ar' ? $banner->description_arabic : $banner->description ?></div>
                </div>

            </div>
        </div>
    </section>
    
     <!-- Breadcrumb -->

    <section id="Breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="<?= Url::to(['site/index', 'language' => $language]); ?>"><?= Words::getValue($language, 'home') ?></a></li>
                <li class="active"><?= Words::getValue($language, 'about_us') ?></li>
            </ul>
        </div>
    </section>

    <!-- Breadcrumb end -->

    <section id="about">
        <div class="floaticon">
            <img src="<?= Yii::$app->homeUrl ?>images/logoIcon.svg" alt="logoIcon">
        </div>
        <div class="container">
            <div class="flxBx">
                <div class="lftbx">
                    <div class="imgBox  wow animate__fadeInUp" data-wow-duration="1.5s">
                        <img src="<?= About::getValue('our_story_image', $language) ?>" data-src="<?= About::getValue('our_story_image', $language) ?>" width="805" height="450"
                             class="lazy" loading="lazy" alt="Our Story">
                    </div>
                </div>
                <div class="rtBx">

                    <div class="contentBx wow animate__fadeInUp" data-wow-duration="1.5s">
                        <div class="title"><?= Words::getValue($language, 'our_story') ?></div>
                        <?= About::getValue('our_story', $language) ?>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="health">
        <div class="videoBx">
            <video id="myVideo" autoplay loop muted playsinline src="<?= About::getValue('about_video_link', $language) ?>"></video>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="contentBox wow animate__fadeInUp" data-wow-duration="1.5s">
                        <div class="mainHead">
                            <div class="head white"><?= About::getValue('video_title', $language) ?>
                            </div>
                        </div>
                        <p><?= About::getValue('video_description', $language) ?>
                        </p>
                        <a href="javascript:void(0)" class="cmnBtn hoveranim white wow animate__fadeInUp"
                           data-wow-duration="1.5s" data-bs-toggle="modal" data-bs-target="#bookingModal">
                            <span><?= Words::getValue($language, 'book_now') ?></span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="flxBox">
                        <div class="item wow animate__fadeInUp" data-wow-duration="1.5s">
                            <div class="couterBx">
                                <div class="icon">
                                    <img src="<?= Yii::$app->homeUrl ?>images/c1.svg" alt="Year of experience">
                                </div>
                                <div class="info">
                                    <div class="numTxt"><span data-count="<?= About::getValue('year_of_experience', $language) ?>">0</span></div>
                                    <div class="txt"><?= Words::getValue($language, 'years_of_experience') ?></div>
                                </div>
                            </div>
                        </div>

                        <div class="item wow animate__fadeInUp" data-wow-duration="1.5s">
                            <div class="couterBx">
                                <div class="icon">
                                    <img src="<?= Yii::$app->homeUrl ?>images/c2.svg" alt="treatments">
                                </div>
                                <div class="info">
                                    <div class="numTxt"><span data-count="<?= About::getValue('treatments', $language) ?>">0</span></div>
                                    <div class="txt"><?= Words::getValue($language, 'treatments') ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="item wow animate__fadeInUp" data-wow-duration="2s">
                            <div class="couterBx">
                                <div class="icon">
                                    <img src="<?= Yii::$app->homeUrl ?>images/c3.svg" alt="branches">
                                </div>
                                <div class="info">
                                    <div class="numTxt"><span data-count="<?= About::getValue('branches', $language) ?>">0</span></div>
                                    <div class="txt"><?= Words::getValue($language, 'branches') ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="item wow animate__fadeInUp" data-wow-duration="2.5s">
                            <div class="couterBx">
                                <div class="icon">
                                    <img src="<?= Yii::$app->homeUrl ?>images/c4.svg" alt="happy_clients">
                                </div>
                                <div class="info">
                                    <div class="numTxt"><span data-count="<?= About::getValue('happy_clients', $language) ?>">0</span></div>
                                    <div class="txt"><?= Words::getValue($language, 'happy_clients') ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    if (!empty($our_history)) {
        ?>
        <section id="histroy">
            <div class="container">
                <div class="mainHead">
                    <div class="head"><?= Words::getValue($language, 'our_history') ?></div>
                    <div class="tagLine"><?= About::getValue('our_history_title', $language) ?></div>
                </div>
                <div class="SliderFlex">

                    <div id="MainSlide" class="splide MainSlide">
                        <div class="splide__track">
                            <ul class="splide__list">
                                <?php foreach ($our_history as $our_hstory) { ?>
                                    <li class="splide__slide">
                                        <div class="row">
                                            <div class="col-lg-5">
                                                <div class="yearBox">
                                                    <div class="logIcon">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/log.svg" alt="<?= $language == 'ar' ? $our_hstory->title_arabic : $our_hstory->title ?>">
                                                    </div>
                                                    <div class="year"><?= $our_hstory->year ?></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-7 rtBx">
                                                <div class="contentWrap">
                                                    <div class="subTxt"><?= $language == 'ar' ? $our_hstory->title_arabic : $our_hstory->title ?></div>
                                                     <div class="contentwrpaBx">
                                                        <?= $language == 'ar' ? $our_hstory->description_arabic : $our_hstory->description ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                <?php }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div id="ThumbSlide" class="splide ThumbSlide">
                        <div class="splide__track">
                            <ul class="splide__list">
                                <?php foreach ($our_history as $our_hstory) { ?>
                                    <li class="splide__slide">
                                        <div class="Dot">
                                            <span></span>
                                        </div>
                                        <div class="yearTxt"><?= $our_hstory->year ?></div>
                                    </li>
                                    <?php
                                }
                                ?>

                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <?php
    }
    ?>
    <section id="appointment" data-anchor="appointment" data-jarallax data-type="scroll" class="jarallax">
        <img src="<?= $language == 'ar' ? About::getValue('book_an_appointment_image_arabic', $language) : About::getValue('book_an_appointment_image', $language) ?>" data-src="<?= $language == 'ar' ? About::getValue('book_an_appointment_image_arabic', $language) : About::getValue('book_an_appointment_image', $language) ?>" class="lazy jarallax-img"
             loading="lazy" width="1920" height="720" alt="Appointment Form Background">
        <div class="container">
            <div class="appointMentBox wow animate__fadeInLeft" data-wow-duration="1.5s">
                <div class="imgBox">
                    <img src="<?= Yii::$app->homeUrl ?>images/logIcon.svg" alt="Logo">
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


    <?= $form->field($model, 'appointment_date')->textInput([
        'id' => 'eventDate', 
        'class' => 'form-control datepicker', 
        'placeholder' => Words::getValue($language, 'your_preferred_date') . ' *',
        'type' => 'date', // Start as text, change to date on focus
        'data-input' => true
    ])->label(false) ?>
</div>
                    </div>
                    <div class="col-lg-12">
                        <?php
                        echo $form->field($model, 'service')
                                ->dropDownList(
                                        $services, // Flat array ('id'=>'label')
                                        ['prompt' => Words::getValue($language, 'select_department'), 'class' => 'select2 select']    // options
                                )->label(FALSE);
                        ?>
                    </div>
                    <div class="col-lg-12">
                        <?= $form->field($model, 'message')->textarea(['placeholder' => Words::getValue($language, 'message')])->label(FALSE) ?>
                    </div>
                    <div class="col-lg-12">
    <div class="g-recaptcha" data-sitekey="6LeIN5stAAAAAH4T1_W3wKcBxlKmq8P-8bzJTga4"></div>
    
    <?php if ($model->hasErrors('reCaptcha')): ?>
        <div class="text-danger" style="margin-top: 5px;">
            <?= $model->getFirstError('reCaptcha') ?>
        </div>
    <?php endif; ?>
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

    <section id="vision">
        <div class="container">
            <div class="itemList">
                 <div class="item">
                    <div class="cmnBox">
                        <div class="ftBx">
                            <!-- <div class="lftbx"> -->
                                <div class="imgBox">
                                    <img src="<?= About::getValue('our_vision_image', $language) ?>" data-src="<?= About::getValue('our_vision_image', $language) ?>"
                                        class="lazy" loading="lazy" width="800" height="450" alt="Our Vision">
                                </div>
                            <!-- </div> -->
                        </div>
                        <div class="rtBx">
                            <div class="contentBx">
                                <div class="floaticon">
                                    <img src="<?= Yii::$app->homeUrl ?>images/logoIcon.svg" alt="Our Vision Logo">
                                </div>
                                <div class="mainHead">
                                    <div class="head"><?= Words::getValue($language, 'our_vision') ?></div>
                                </div>
                                <?= About::getValue('our_vision', $language) ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="cmnBox">
                        <div class="ftBx">
                            <div class="imgBox">
                                <img src="<?= About::getValue('our_mission_image', $language) ?>" data-src="<?= About::getValue('our_mission_image', $language) ?>" class="lazy"
                                    loading="lazy" width="800" height="450" alt="Our Mission">
                            </div>
                        </div>
                        <div class="rtBx">
                            <div class="floaticon">
                                <img src="<?= Yii::$app->homeUrl ?>images/logoIcon.svg" alt="Our Mission Logo">
                            </div>
                            <div class="mainHead">
                                <div class="head"><?= Words::getValue($language, 'our_mission') ?></div>
                            </div>
                           <?= About::getValue('our_mission', $language) ?>
                        </div>
                    </div>
                </div>
                <?php
                $values = About::getValue('values', $language);
                if($values != ''){ ?>
                     <div class="item">
                    <div class="cmnBox">
                        <div class="rtBx">
                            <div class="floaticon">
                                <img src="<?= Yii::$app->homeUrl ?>images/logoIcon.svg" alt="Our Values">
                            </div>
                            <div class="mainHead">
                                <div class="head"><?= Words::getValue($language, 'values') ?></div>
                            </div>
                           <?= About::getValue('values', $language) ?>
                        </div>
                    </div>
                </div>
            <?php    }
                ?>
            </div>
        </div>
    </section>

    <section id="medical" data-anchor="medicalSection" data-jarallax data-type="scroll" class="jarallax">
        <img src="<?= About::getValue('bottom_banner_image', $language) ?>" data-src="<?= About::getValue('bottom_banner_image', $language) ?>" width="1920" height="850" alt="Bottom Banner"
             loading="lazy" class="lazy jarallax-img">
        <div class="container">
            <div class="mainheading">
                <div class="title"><?= About::getValue('bottom_banner_title', $language) ?></div>
                <div class="subT"><?= About::getValue('bottom_banner_description', $language) ?></div>
            </div>
        </div>
    </section>


    <section id="ceo">
        <div class="container">
            <div class="mainHead center">
                <div class="head"><?= Words::getValue($language, 'ceo_message') ?></div>
                <div class="tagLine"><?= About::getValue('ceo_message_heading', $language) ?></div>
            </div>
            <div class="d_flx">
                <div class="imgWrap">
                    <div class="imgBox">
                        <img src="<?= About::getValue('ceo_image', $language) ?>" data-src="<?= About::getValue('ceo_image', $language) ?>" class="lazy" loading="lazy"
                             width="520" height="585" alt="<?= About::getValue('ceo_name', $language) ?>">
                    </div>
                </div>
                <div class="content">
                    <div class="ceoBx">
                        <div class="contentWarp">
                            <?= About::getValue('ceo_message', $language) ?>
                        </div>
                        <div class="signature">
                            <img src="<?= About::getValue('ceo_signature', $language) ?>" data-src="<?= About::getValue('ceo_signature', $language) ?>" class="lazy"
                                 loading="lazy" alt="<?= About::getValue('ceo_name', $language) ?>">
                        </div>
                        <div class="name"><?= About::getValue('ceo_name', $language) ?></div>
                        <div class="post"><?= About::getValue('ceo_designation', $language) ?></div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- WOW -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"
            integrity="sha512-Eak/29OTpb36LLo2r47IpVzPBLXnAMPAVypbSZiZ4Qkf8p/7S/XRG5xp7OKWPPYfJT6metI+IORkR5G8F900+g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- SCROLL MAGIC -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.8/ScrollMagic.min.js"
            integrity="sha512-8E3KZoPoZCD+1dgfqhPbejQBnQfBXe8FuwL4z/c8sTrgeDMFEnoyTlH3obB4/fV+6Sg0a0XF+L/6xS4Xx1fUEg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <!-- JARALLAX --->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jarallax/2.0.3/jarallax.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jarallax/2.0.3/jarallax.min.js"></script>

   


    <!-- SPLIDE --->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/splidejs/4.1.4/css/splide.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/splidejs/4.1.4/js/splide.min.js"></script>
    <script
        src="https://cdn.jsdelivr.net/npm/@splidejs/splide-extension-auto-scroll@0.5.3/dist/js/splide-extension-auto-scroll.min.js">
    </script>


    <script>
        // WOW REVEAL

        new WOW().init();
        // counter


        $(document).ready(function () {
            var controller = new ScrollMagic.Controller();

            var scene = new ScrollMagic.Scene({
                triggerElement: '#health .flxBox  ',
                triggerHook: 0.9
            })
                    .setClassToggle('#health .flxBox .couterBx ', 'isVisible')
                    .on("enter", function () {
                        $('.numTxt span').each(function () {
                            var $this = $(this),
                                    countTo = $this.attr('data-count');

                            $({
                                countNum: $this.text()
                            }).animate({
                                countNum: countTo
                            }, {

                                duration: 2000,
                                easing: 'linear',
                                step: function () {
                                    $this.text(Math.floor(this.countNum));
                                },
                                complete: function () {
                                    $this.text((this.countNum));
                                }

                            });

                        });
                    })
                    .on("leave", function () {
                        $('.numTxt span ').each(function () {
                            $(this).text(0);
                        });
                    })
                    .reverse(true)
                    .addTo(controller);
        });


        document.addEventListener('DOMContentLoaded', function () {
            var main = new Splide('#histroy #MainSlide', {
                type: 'fade',
                rewind: true,
                pagination: false,
                arrows: false,
                autoplay: true,
                pauseOnHover: false,
                interval: 2500,
            });

            var thumbnails = new Splide('#histroy #ThumbSlide', {
                // gap         : 10,

                width: "100%",
                height: "100%",
                rewind: true,
                pagination: false,
                cover: true,
                arrows: false,
                isNavigation: true,
                perPage: 7,
                perMove: 1,

            });
            main.sync(thumbnails);
            main.mount();
            thumbnails.mount();
        });
    </script>


</div>
