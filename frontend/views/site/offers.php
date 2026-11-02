<?php

/** @var yii\web\View $this */

use common\models\Departments;
use yii\helpers\Url;
use common\models\Words;
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\ActiveForm;

// $this->params['breadcrumbs'][] = $this->title;
// $this->title = 'Damas | ' . $banner->title;
$insuranceDepts = [];
if (!empty($insurances)) {
    $deptIds = array_unique(array_map(function ($i) {
        return $i->department;
    }, $insurances));
    $insuranceDepts = Departments::find()->where(['id' => $deptIds])->indexBy('id')->all();
}

$homeUrl    = Yii::$app->homeUrl;
$isAr       = ($language === 'ar');

?>

<div id="pageWrapper" class="offerPage">
    <section id="PageBanner">

        <img src="<?= Yii::$app->homeUrl ?>uploads/banners/<?= $language == 'ar' ? $banner->image_arabic : $banner->image ?>" data-src="<?= Yii::$app->homeUrl ?>uploads/banners/<?= $language == 'ar' ? $banner->image_arabic : $banner->image ?>" class="lazy bannerBg"
            loading="lazy" width="1920" height="535" alt="<?= $language == 'ar' ? $banner->title_arabic : $banner->title ?>">
        <div class="container">
            <div class="mainBanner">
                <div class="captionBx">
                    <h1 class="mainHead"><?= $language == 'ar' ? $banner->title_arabic : $banner->title ?></h1>
                    <div class="tagLine"><?= $language == 'ar' ? $banner->description_arabic : $banner->description ?></div>

                    <section id="Breadcrumb">
                        <div class="container">
                            <ul class="breadcrumb">
                                <li><a href="<?= Url::to(['site/index', 'language' => $language]); ?>"><?= Words::getValue($language, 'home') ?></a></li>
                                <li class="active"><?= Words::getValue($language, 'offers_and_packages') ?></li>
                            </ul>
                        </div>
                    </section>
                </div>

            </div>
        </div>
    </section>

    <section id="offerSec">
        <div class="container">
            <div class="tleWrap">
                <div class="tle">
                    <span class="offerEyebrow"><?= Html::encode($language == 'ar' ? 'عروض خاصة' : 'SPECIAL OFFERS') ?></span>
                    <h2><?= Words::getValue($language, 'special_offers') ?> </h2>
                    <p><?= Html::encode($language == 'ar' ? 'أسعار لفترة محدودة تشمل خدمات طب الأسنان، والجلدية، والليزر، والعناية بالبشرة. يبدأ كل عرض بجلسة استشارية، كما يمكن تقسيط التكلفة عبر خدمات "تابي" (Tabby) أو "تمارا" (Tamara) أو "توث باي" (ToothPay) أو "يسر" (Yusr).'
                            : 'Limited-time prices across dental, derma, laser and skincare. Every offer starts with a consultation, 
                      and every price can be split with Tabby, Tamara, ToothPay or Yusr') ?></p>
                </div>
                <div class="inutBx">
                    <?php
                    $form = ActiveForm::begin([
                        'id' => 'service-search',
                        'method' => 'post',
                    ]);
                    ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <select name="department" class="select2 dep-change">
                                    <option value="" hidden><?= Words::getValue($language, 'department') ?></option>
                                    <?php
                                    if (!empty($departments)) {
                                        foreach ($departments as $department) {
                                    ?>
                                            <option <?= $dep_id == $department->id ? 'selected' : '' ?> value="<?= $department->id ?>"><?= $language == 'ar' ? $department->department_name_arabic : $department->department_name ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <div class="help-block danger d-none">Invalid Input</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group selectd">
                                <select name="service" class="select2 serv-change">
                                    <option value="" hidden><?= Words::getValue($language, 'services') ?></option>
                                    <?php
                                    if (!empty($services)) {
                                        foreach ($services as $service) {
                                    ?>
                                            <option <?= $serv_id == $service->id ? 'selected' : '' ?> value="<?= $service->id ?>"><?= $language == 'ar' ? $service->service_name_arabic : $service->service_name ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <div class="help-block danger d-none">Invalid Input</div>
                            </div>
                        </div>

                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
            <?=
            $dataProvider->totalcount > 0 ? ListView::widget([
                'summary' => '',
                'dataProvider' => $dataProvider,
                'itemView' => function ($model, $key, $index, $widget) use ($language) {
                    return $this->render('_service_view', [
                        'model' => $model,
                        'index' => $index,
                        'language' => $language,
                    ]);
                },
                'options' => [
                    'tag' => 'div',
                    'class' => 'dFlex'
                ],
                'pager' => [
                    'options' => ['class' => 'pagination'],
                    'prevPageLabel' => '<', // Set the label for the "previous" page button
                    'nextPageLabel' => '>', // Set the label for the "next" page button
                    'firstPageLabel' => 'First', // Set the label for the "first" page button
                    'lastPageLabel' => 'Last', // Set the label for the "last" page button
                    'nextPageCssClass' => '>', // Set CSS class for the "next" page button
                    'prevPageCssClass' => '<', // Set CSS class for the "previous" page button
                    'firstPageCssClass' => '<<', // Set CSS class for the "first" page button
                    'lastPageCssClass' => '>>', // Set CSS class for the "last" page button
                    'maxButtonCount' => 5, // Set maximum number of page buttons that can be displayed
                ],
                'itemOptions' => ['tag' => null],
            ]) : 'No Service Found !';
            ?>
            <div class="dFlex">
                <div class="itm">

                </div>


            </div>


        </div>
    </section>


    <section id="insurance" style="margin-top: 0px;">
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
</div>


<!-- SELECT2 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- SPLIDE --->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/splidejs/4.1.4/css/splide.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/splidejs/4.1.4/js/splide.min.js"></script>
    <script
        src="https://cdn.jsdelivr.net/npm/@splidejs/splide-extension-auto-scroll@0.5.3/dist/js/splide-extension-auto-scroll.min.js">
    </script>


    <script defer src="<?= $homeUrl ?>lib/home.min.js?v=1"></script>


<script>
    // SELECT2
    $(".select2").select2({
        minimumResultsForSearch: Infinity,
        theme: "bootstrap-5",
        closeOnSelect: true,
    });



    $(document).ready(function() {

        $(".couseVid").on("mouseover", function(event) {

            this.play();

        }).on('mouseout', function(event) {
            this.pause();

        });
        $(".dep-change").change(function() {
            $("#service-search").submit();
        });
        $(".serv-change").change(function() {
            $("#service-search").submit();
        });

    });

    document.addEventListener('DOMContentLoaded', function() {
            var rtlVal = document.documentElement.getAttribute('dir') === 'rtl';

        if ($.fn.owlCarousel) {
            var near = function(el, fn, margin) {
                if (!el) return;
                var target = $(el).closest('section')[0] || el.parentNode;
                (window.whenNear || function(e, f) {
                    f();
                })(target, fn, margin);
            };

            near($('.insuranceSlider')[0], function() {
                $('.insuranceSlider').owlCarousel({
                    loop: true,
                    autoplay: true,
                    smartSpeed: 500,
                    autoplayTimeout: 2000,
                    autoplayHoverPause: true,
                    responsiveClass: true,
                    nav: true,
                    dots: false,
                    rtl: rtlVal,
                    margin: 15,
                    responsive: {
                        0: {
                            items: 3
                        },
                        578: {
                            items: 4
                        },
                        768: {
                            items: 5
                        },
                        1200: {
                            items: 5,
                            margin: 20
                        }
                    }
                });
            }, '600px');

        }
    });
</script>