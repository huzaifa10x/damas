<?php

/** @var yii\web\View $this */
use yii\helpers\Url;
use common\models\Words;

// $this->params['breadcrumbs'][] = $this->title;
// تعيين عنوان الصفحة
// $this->title = $language == 'ar' ? $details->title_arabic : $details->title;
// $this->title = 'Damas | ' .$details->title;


// إضافة العنوان إلى الـ breadcrumbs
// $this->params['breadcrumbs'][] = $this->title;
?>

<div id="pageWrapper" class="cosmetcPage">

    <section id="facialDetails">
        <div class="container">
            <div class="mainHead">
                <h1 class="head"><?= $language == 'ar' ? $details->title_arabic : $details->title ?></h1>
            </div>
            <p>
                <?= $language == 'ar' ? $details->small_description_arabic : $details->small_description ?>
            </p>
            <div class="imgBx">
                <img src="<?= Yii::$app->homeUrl ?>uploads/sub-services/<?= $details->image ?>" data-src="<?= Yii::$app->homeUrl ?>uploads/sub-services/<?= $details->image ?>" class="lazy"
                     loading="lazy" alt="<?= $language == 'ar' ? $details->title_arabic : $details->title ?>">
            </div>
            <div class="cmnTitle"><?= $language == 'ar' ? $details->section1_title_arabic : $details->section1_title ?></div>
            <?= $language == 'ar' ? $details->section1_description_arabic : $details->section1_description ?>


            <div class="flxBx">
                <?php
                if ($details->section2_title != '' && $details->section2_description != '') {
                    ?>
                    <div class="item">
                        <div class="cmnBox">
                            <div class="cmnTitle"><?= $language == 'ar' ? $details->section2_title_arabic : $details->section2_title ?></div>
                            <?= $language == 'ar' ? $details->section2_description_arabic : $details->section2_description ?>
                        </div>
                    </div>
                    <?php
                }
                if ($details->section3_title != '' && $details->section3_description != '') {
                    ?>
                    <div class="item">
                        <div class="cmnBox">
                            <div class="cmnTitle"><?= $language == 'ar' ? $details->section3_title_arabic : $details->section3_title ?></div>
                            <?= $language == 'ar' ? $details->section3_description_arabic : $details->section3_description ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>

            <?= $language == 'ar' ? $details->section4_description_arabic : $details->section4_description ?>

        </div>
    </section>
</div>
