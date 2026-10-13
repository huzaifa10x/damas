<?php

/** @var yii\web\View $this */
use yii\helpers\Url;
use common\models\Words;

// $this->params['breadcrumbs'][] = $this->title;
// $this->title = 'Damas | ' . $banner->title;

?>

<div id="pageWrapper" class="insurancePage">
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
                <li class="active"><?= Words::getValue($language, 'insurance') ?></li>
            </ul>
        </div>
    </section>

    <!-- Breadcrumb end -->

    <section id="insuranceSec">
        <div class="container">
            <div class="dFlex">
                <?php
                if (!empty($datas)) {
                    foreach ($datas as $data) {
                        $department = common\models\Departments::find()->where(['id' => $data->department])->one();
                        ?>
                        <div class="item">
                            <a href="<?= Url::to(['site/department-details', 'language' => $language, 'slug' => $department->canonical_name]); ?>" class="insurencBx">
                                <div class="imgBox">
                                    <img src="<?= Yii::$app->homeUrl ?>uploads/insurance/<?= $data->image ?>" data-src="<?= Yii::$app->homeUrl ?>uploads/insurance/<?= $data->image ?>" class="lazy" loading="lazy" width="238" height="140" alt="<?= $language == 'ar' ? $department->department_name_arabic : $department->department_name ?>">
                                </div>
                                <div class="contentBx">
                                    <div class="subT"><?= $language == 'ar' ? $department->department_name_arabic : $department->department_name ?></div>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                }
                ?>

            </div>
        </div>
    </section>



</div>
