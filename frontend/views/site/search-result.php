<?php

use yii\helpers\Url;
use common\models\Words;
?>
<div id="pageWrapper" class="searchresultPage">
    <section id="searchPage">
        <div class="container">
            <?php
            if (!empty($departments) || !empty($doctors) || !empty($services)) {
            ?>
            <div class="infoBx">

                <div class="tleWrap">
                    <h1 class="tle"><?= Words::getValue($language, 'all_results') ?></h1>
                    <div class="subT"><?= count($doctors) + count($services) + count($departments) ?> <?= Words::getValue($language, 'search_results_found') ?> </div>
                </div>
                <p>
                   <?= Words::getValue($language, 'search_results_description') ?>
                </p>
            </div>


            <div class="dFlex">
                <?php
                if (!empty($departments)) {
                    foreach ($departments as $department) {
                        ?>
                        <div class="item">
                            <a href="<?= Url::to(['site/department-details', 'language' => $language, 'slug' => $department->canonical_name]); ?>" class="serviceBox">
                                <div class="imgBox">
                                    <img src="<?= Yii::$app->homeUrl ?>uploads/departments/<?= $department->department_image ?>" data-src="<?= Yii::$app->homeUrl ?>uploads/departments/<?= $department->department_image ?>" class="lazy" loading="lazy" width="300" height="385" alt="departments">
                                </div>
                                <div class="info">
                                    <div class="name"><?= $language == 'ar' ? $department->department_name_arabic : $department->department_name ?></div>
                                    <div class="post"> </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                }
                ?>
                <?php
                if (!empty($doctors)) {
                    foreach ($doctors as $doctor) {
                        ?>
                        <div class="item">
                            <a href="<?= Url::to(['site/doctor-details', 'language' => $language, 'slug' => $doctor->canonical_name]); ?>" class="serviceBox">
                                <div class="imgBox">
                                    <img src="<?= Yii::$app->homeUrl ?>uploads/doctors/<?= $doctor->image ?>" data-src="<?= Yii::$app->homeUrl ?>uploads/doctors/<?= $doctor->image ?>" class="lazy" loading="lazy" width="300" height="385" alt="doctor-details">
                                </div>
                                <div class="info">
                                    <div class="name"> <?= $language == 'ar' ? $doctor->doctor_name_arabic : $doctor->doctor_name ?></div>
                                    <div class="post"> <?= $language == 'ar' ? $doctor->designation_arabic : $doctor->designation ?></div>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                }
                ?>
                <?php
                if (!empty($services)) {
                    ?>
                    <?php
                    foreach ($services as $service) {
                        $department = common\models\Departments::find()->where(['id'=>$service->department])->one();
                        ?>
                        <div class="item">
                            <a href="<?= Url::to(['site/service-details', 'language' => $language, 'department' => $department->canonical_name, 'slug' => $service->canonical_name]); ?>" class="serviceBox">
                                <div class="imgBox">
                                    <img src="<?= Yii::$app->homeUrl ?>uploads/services/<?= $service->service_image ?>" data-src="<?= Yii::$app->homeUrl ?>uploads/services/<?= $service->service_image ?>" class="lazy" loading="lazy" width="300" height="385" alt="service-details">
                                </div>
                                <div class="info">
                                    <div class="name"> <?= $language == 'ar' ? $service->service_name_arabic : $service->service_name ?></div>
                                    <div class="post"> </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                }
                ?>

            </div>
            <?php
            }else{
            ?>
            <div class="empty-search-result">
                <h2>No Results Found</h2>
                <p>We couldn't find any results for your search.</p>
            </div>
            <?php
            }
            ?>
        </div>
    </section>

</div>