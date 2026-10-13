<?php

/** @var yii\web\View $this */
use yii\helpers\Url;
use common\models\Words;
use yii\widgets\ListView;
use yii\widgets\ActiveForm;

// $this->params['breadcrumbs'][] = $this->title;
// $this->title = 'Damas | ' . $banner->title;

?>

<div id="pageWrapper" class="offerPage">
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
                <li class="active"><?= Words::getValue($language, 'offers') ?></li>
            </ul>
        </div>
    </section>

    <!-- Breadcrumb end -->
    <section id="offerSec">
        <div class="container">
            <div class="tleWrap">
                <div class="tle"> <?= Words::getValue($language, 'special_offers') ?></div>
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
                        'itemView' => function ($model, $key, $index, $widget) use($language) {
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
</div>


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



    $(document).ready(function () {

        $(".couseVid").on("mouseover", function (event) {

            this.play();

        }).on('mouseout', function (event) {
            this.pause();

        });
        $(".dep-change").change(function () {
            $("#service-search").submit();
        });
        $(".serv-change").change(function () {
            $("#service-search").submit();
        });
    });
</script>
