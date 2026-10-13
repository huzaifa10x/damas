<?php

/** @var yii\web\View $this */
use yii\helpers\Url;
use common\models\Words;

// $this->params['breadcrumbs'][] = $this->title;
// $this->title = 'Damas | ' . $banner->title;
?>

<div id="pageWrapper" class="departmentPage">
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
                <li class="active"><?= Words::getValue($language, 'department') ?></li>
            </ul>
        </div>
    </section>

    <!-- Breadcrumb end -->
    <section id="departmentSec">
        <div class="container">
            <div class="dFlex">
                <?php
                if (!empty($departments)) {
                    foreach ($departments as $department) {
                        $services = \common\models\Services::find()->where(['department' => $department->id, 'status' => 1])->all();
                        ?>
                        <div class="item">
                            <a href="<?= Url::to(['site/department-details', 'language' => $language, 'slug' => $department->canonical_name]); ?>" class="imgBx">
                                <img src="<?= Yii::$app->homeUrl ?>uploads/departments/<?= $department->department_image ?>" data-src="<?= Yii::$app->homeUrl ?>uploads/departments/<?= $department->department_image ?>" alt="<?= $language == 'ar' ? $department->department_name_arabic : $department->department_name ?>"
                                     width="315" height="452" class="lazy" loading="lazy">
                                <div class="cont">
                                    <div class="tle"><?= $language == 'ar' ? $department->department_name_arabic : $department->department_name ?></div>
                                    <div class="innerCnt">
                                        <div class="icon">
                                            <img src="<?= Yii::$app->homeUrl ?>uploads/departments/<?= $department->department_image ?>" alt="icon" width="54" height="54"
                                                 class="lazy" loading="lazy">

                                        </div>
                                        <div class="hd"><?= $language == 'ar' ? $department->department_name_arabic : $department->department_name ?></div>
                                        <ul>
                                            <?php
                                            if (!empty($services)) {
                                                foreach ($services as $service) {
                                                    ?>
                                                    <li>
                                                        <?= $language == 'ar' ? $service->service_name_arabic : $service->service_name ?>
                                                    </li>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </ul>
                                    </div>

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

















