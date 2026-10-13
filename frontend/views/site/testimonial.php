<?php

/** @var yii\web\View $this */
use yii\helpers\Url;
use common\models\Words;

// $this->params['breadcrumbs'][] = $this->title;
// $this->title = 'Damas | ' . $banner->title;

?>

<div id="pageWrapper" class="testimonialPage">
    <section id="PageBanner">
        <?php if ($banner->video != '') { ?>
            <video id="myVideo" class="bannerBg" autoplay loop muted playsinline src="<?= Yii::$app->homeUrl ?>uploads/banners/<?= $banner->video ?>"
                   type="video/mp4"></video>
               <?php } else { ?>
            <img src="<?= Yii::$app->homeUrl ?>uploads/banners/<?= $language == 'ar' ? $banner->image_arabic : $banner->image ?>" data-src="<?= Yii::$app->homeUrl ?>uploads/banners/<?= $language == 'ar' ? $banner->image_arabic : $banner->image ?>" class="lazy bannerBg"
                 loading="lazy" width="1920" height="535" alt="aboutBanner"> 
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
                <li class="active"><?= Words::getValue($language, 'testimonials') ?></li>
            </ul>
        </div>
    </section>

    <section id="testimonialSec">
        <div class="container">
            <div class="tleWrap">
                <div class="tle"><?= Words::getValue($language, 'testimonials') ?></div>
                <div class="inutBx">
                    <form method="post" id="media-search">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select name="department" class="select2 drop-change">
                                        <option value="" hidden><?= Words::getValue($language, 'department') ?></option>
                                        <?php
                                        if (!empty($departments)) {
                                            foreach ($departments as $department) {
                                                ?>
                                                <option <?= $dep == $department->id ? 'selected' : '' ?> value="<?= $department->id ?>"><?= $language == 'ar' ? $department->department_name_arabic : $department->department_name ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group selectd">
                                    <select name="service" class="select2 drop-change">
                                        <option value="" hidden><?= Words::getValue($language, 'services') ?></option>
                                        <?php
                                        if (!empty($services)) {
                                            foreach ($services as $service) {
                                                ?>
                                                <option <?= $serv == $service->id ? 'selected' : '' ?> value="<?= $service->id ?>"><?= $language == 'ar' ? $service->service_name_arabic : $service->service_name ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="testWrap">
                <div class="dFlex">
                    <?php
                    if (!empty($datas)) {
                        foreach ($datas as $data) {
                            $video_link = $data->video;
                            $img_link = Yii::$app->homeUrl . 'uploads/testimonials/' . $data->image;
                            ?>
                            <div class="item">
                                <a href="<?= $data->video != '' ? $video_link : 'javascript:void(0);' ?>" class="testimonialBox" data-fancyBox="testmonial" target="_blank">
                                    <div class="imgBox">
                                        <img src="<?= $img_link ?>" data-src="<?= $img_link ?>" alt="testImg">
                                        <div class="plyBtn">
                                            <svg viewBox="0 0 11.132 13.036">
                                            <path id="Polygon_3" data-name="Polygon 3" d="M6.518,0l6.518,11.132H0Z" transform="translate(11.132) rotate(90)" fill="#763813" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="info">
                                        <div class="name"><?= $language == 'ar' ? $data->name_arabic : $data->name ?></div>
                                        <div class="post"><?= $language == 'ar' ? $data->designation_arabic : $data->designation ?></div>
                                    </div>
                                </a>
                            </div> 
                            <?php
                        }
                    }
                    ?>

                </div>
            </div>
        </div>
    </section>

    <?php
    if (!empty($google_reviews)) {
        ?>
        <section id="review">
            <div class="Element">
                <img src="<?= Yii::$app->homeUrl ?>images/googleElement.svg" alt="review">
            </div>
            <div class="container">
                <div class="flxBox wow animate__fadeInUp" data-wow-duration="1.5s">
                    <div class="leftSec">
                        <div class="mainHead">
                            <div class="head"><?= Words::getValue($language, 'google_reviews') ?></div>
                        </div>
                    </div>

                </div>
                <div class="reviewSlider owl-carousel wow animate__fadeInUp" data-wow-duration="1.5s">
                    <?php foreach ($google_reviews as $google_review) { ?>
                        <div class="item">
                            <a href="javascript:void(0)" class="reviewBx">
                                <div class="goImg">
                                    <img src="<?= Yii::$app->homeUrl ?>images/google.svg" alt="damasmc-reviews">
                                </div>
                                <div class="avtBx">
                                    <div class="avImg">
                                        <div class="icon">
                                            <img src="<?= Yii::$app->homeUrl ?>uploads/google-reviews/<?= $google_review->image ?>" data-src="<?= Yii::$app->homeUrl ?>uploads/google-reviews/<?= $google_review->image ?>" class="lazy" loading="lazy" width="45" height="45" alt="damasmc-reviews">
                                        </div>
                                    </div>
                                    <div class="info">
                                        <div class="name"><?= $language == 'ar' ? $google_review->name_arabic : $google_review->name ?></div>
                                        <div class="post"><?= date("d F Y", strtotime($google_review->date)); ?></div>
                                    </div>
                                </div>
                                <div class="rateBx">
                                    <div class="stars" data-rating="5">
                                    </div>
                                </div>
                                <div class="content">
                                    <p><?= $language == 'ar' ? $google_review->message_arabic : $google_review->message ?></p>
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
</div>

<!-- SELECT2 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<!-- owl carousel  -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
    integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
    integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<!-- STAR RATING -->
<link rel="stylesheet" type="text/css" href="<?= Yii::$app->homeUrl ?>rating/star-rating-svg.css">
<script type="text/javascript" src="<?= Yii::$app->homeUrl ?>rating/star-rating-svg.js"></script>



<script>
// SELECT2
$(".select2").select2({
    minimumResultsForSearch: Infinity,
    theme: "bootstrap-5",
    closeOnSelect: true,
});

var mydir = $("html").attr("dir");

if (mydir == 'rtl') {
    var rtlVal = true
} else {
    var rtlVal = false
}

$('.reviewSlider').owlCarousel({

    rewind: true,
    autoplay: false,
    smartSpeed: 500,
    autoplayTimeout: 3500,
    autoplayHoverPause: true,
    nav: false,
    dots: false,
    items: 1,
    margin: 10,
    rtl: rtlVal,
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

$(".stars").starRating({
    totalStars: 5,
    emptyColor: '#ffff',
    hoverColor: '#FFC107',
    activeColor: '#FFC107',
    initialRating: 4,
    strokeWidth: 40,
    strokeColor: '#FFC107',
    useGradient: false,
    starSize: 22,
    readOnly: true,

});
</script>
<script>
    $(document).ready(function () {
        $(".drop-change").change(function () {
            $("#media-search").submit();
        });
    });
</script>
