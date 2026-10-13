<?php

/** @var yii\web\View $this */
use yii\helpers\Url;
use common\models\Words;

// $this->params['breadcrumbs'][] = $this->title;
// $this->title = 'Damas | ' . $banner->title;
?>

<div id="pageWrapper" class="gallaryPage">
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
    
    <!-- Breadcrumb -->

    <section id="Breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="<?= Url::to(['site/index', 'language' => $language]); ?>"><?= Words::getValue($language, 'home') ?></a></li>
                <li class="active"><?= Words::getValue($language, 'gallery') ?></li>
            </ul>
        </div>
    </section>

    <!-- Breadcrumb end -->
    <section id="gallSec">
        <div class="container">
            <div class="tleWrap">
                <div class="tle"><?= Words::getValue($language, 'gallery') ?></div>
                
            </div>
            <div class="gallWrap">
                <?php
                if (!empty($galleries)) {
                    foreach ($galleries as $gallery) {
                        if ($gallery->video != '') {
                            ?>
                            <div class="item">
                                <a href="<?= Yii::$app->homeUrl ?>uploads/gallery/<?= $gallery->video ?>" class="imgBx vdoBx" data-fancybox="proGal">
                                    <img alt="Gallery image" src="<?= Yii::$app->homeUrl ?>uploads/gallery/<?= $gallery->image ?>" data-src="<?= Yii::$app->homeUrl ?>uploads/gallery/<?= $gallery->image ?>" class="lazy" loading="lazy" width="426" height="296" />
                                    <div class="cont">
                                        <div class="iconwrap">
                                            <div class="iconBx">
                                                <div class="icon">
                                                    <img alt="image" src="<?= Yii::$app->homeUrl ?>images/utube.svg" class="lazy" width="9" height="10" />
                                                </div>
                                            </div>
                                            <div class="txt"><?= Words::getValue($language, 'watch_video') ?></div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php } else { ?>
                            <div class="item">
                                <a href="<?= Yii::$app->homeUrl ?>images/gall01.jpg" class="imgBx" data-fancybox="proGal">
                                    <img alt="image" src="<?= Yii::$app->homeUrl ?>uploads/gallery/<?= $gallery->image ?>" data-src="<?= Yii::$app->homeUrl ?>uploads/gallery/<?= $gallery->image ?>" class="lazy" loading="lazy" width="426" height="296" />
                                </a>
                            </div>   
                            <?php
                        }
                    }
                }
                ?>



            </div>
        </div>
    </section>
    <?php
    if (!empty($treatment_galleries)) {
        ?>
        <section id="treatmentSec">
            <div class="container">
                <div class="tle"><?= Words::getValue($language, 'treatment_result') ?></div>
                <div class="dFlex">
                    <?php
                    $k = 0;
                    foreach ($treatment_galleries as $before_after_image) {
                        $k++;
                        ?>
                        <div class="item">
                            <div class="coparisonBx">
                                <div id="comparison" class="comparison">
                                    <figure>
                                        <div class="imgBx">
                                            <img src="<?= Yii::$app->homeUrl ?>uploads/treatment-gallery/<?= $before_after_image->before_image ?>"
                                                 data-src="<?= Yii::$app->homeUrl ?>uploads/treatment-gallery/<?= $before_after_image->before_image ?>" class="lazy"
                                                 loading="lazy" width="312" height="395" alt="Treatments">
                                        </div>
                                        <div class="handle" data-slider-id="slider<?= $k ?>" style="left: 57%;">
                                        </div>
                                        <div class="divisor" data-slider-id="slider<?= $k ?>"
                                             style="background-image: url(<?= Yii::$app->homeUrl ?>uploads/treatment-gallery/<?= $before_after_image->after_image ?>); width: 57%;">
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
</div>
<!-- SELECT2 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- FANCY_BOX-->
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.6/jquery.fancybox.min.css">
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.6/jquery.fancybox.min.js">
</script>

<script>
    // SELECT2
    $(".select2").select2({
        minimumResultsForSearch: Infinity,
        theme: "bootstrap-5",
        closeOnSelect: true,
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
<script>
    $(document).ready(function () {
        $(".drop-change").change(function () {
            $("#media-search").submit();
        });
    });
</script>
