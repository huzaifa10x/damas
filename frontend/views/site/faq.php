<?php

/** @var yii\web\View $this */
use yii\helpers\Url;
use common\models\Words;

// $this->params['breadcrumbs'][] = $this->title;
// $this->title = 'Damas | ' . $banner->title;
?>
<div id="pageWrapper" class="faqPage">
    <section id="PageBanner">
        <?php if ($banner->video != '') { ?>
            <video id="myVideo" class="bannerBg" autoplay loop muted playsinline src="<?= Yii::$app->homeUrl ?>uploads/banners/<?= $banner->video ?>"
                   type="video/mp4"></video>
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

    <section id="faq">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="sideNav">
                        <ul>
                            <?php
                            foreach ($departments as $department) {
                                ?>
                                <li>
                                    <a href="javascript:void(0)" class="pageLink" data-bs-toggle="collapse"
                                       data-bs-target="#faqAccord<?= $department->id ?>" aria-expanded="false" aria-controls="faqAccord<?= $department->id ?>">
                                        <?= $language == 'ar' ? $department->department_name_arabic : $department->department_name ?></a>
                                </li>
                                <?php
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
                            $i++;
                            $faqs = \common\models\Faq::find()->where(['department_id' => $department->id, 'status' => 1])->all();
                            ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading<?= $department->id ?>">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#faqAccord<?= $department->id ?>" aria-expanded="false" aria-controls="faqAccord<?= $department->id ?>">
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
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    if (!empty($services)) {
        ?>
        <section id="service">
            <div class="floaticon">
                <img src="<?= Yii::$app->homeUrl ?>images/logoIcon.svg" alt="Service Icon">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 leftSec">
                        <div class="contentBx wow animate__fadeInUp" data-wow-duration="1.5s">
                            <div class="mainHead">
                                <div class="head"> <?= Words::getValue($language, 'our_service') ?> </div>
                            </div>
                            <p>
                                <?= Words::getValue($language, 'our_service_description') ?>
                            </p>
                        </div>


                        <div class="NavflxBx wow animate__fadeInUp" data-wow-duration="1.5s">
                            <div class="counterBx">
                                <div class="item">
                                    <div class="countList">
                                        01
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="countList total">
                                        <?= sprintf('%02d', count($services)); ?>
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
                        <div class="serviceSlider owl-carousel wow animate__fadeInUp" data-wow-duration="1.5s">
                            <?php foreach ($services as $service) { 
                                $department = \common\models\Departments::find()->where(['id' => $service->department])->one();
                            ?>
                                <div class="item">
                                    <a href="<?= Url::to(['site/service-details', 'language' => $language, 'department' => $department->canonical_name, 'slug' => $service->canonical_name]); ?>" class="serviceBox">
                                        <div class="imgBox">
                                            <img src="<?= Yii::$app->homeUrl ?>uploads/services/<?= $service->service_image ?>" data-src="<?= Yii::$app->homeUrl ?>uploads/services/<?= $service->service_image ?>"
                                                 class="lazy" loading="lazy" width="300" height="458" alt="<?= $language == 'ar' ? $service->service_name_arabic : $service->service_name ?>">
                                        </div>
                                        <div class="info">
                                            <div class="subT"><?= $language == 'ar' ? $service->service_name_arabic : $service->service_name ?></div>
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
    <!-- owl carousel  -->

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
          integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
            integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script>
        // serviceSlider

    // serviceSlider
    var mydir = $("html").attr("dir");

    if (mydir == 'rtl') {
        var rtlVal = true
    } else {
        var rtlVal = false
    }



    $('.serviceSlider').owlCarousel({

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



    // service section nav


    var serviceSlider = $('.serviceSlider');

    $('#service .customSlideNav.OwlNext').click(function() {
        serviceSlider.trigger('next.owl.carousel');
    });

    $('#service .customSlideNav.OwlPrev').click(function() {
        serviceSlider.trigger('prev.owl.carousel');
    });
    </script>
</div>