<?php
use common\models\Words;
use yii\helpers\Url;
?>
<div id="pageWrapper" class="legalPage">

    <section id="legalBanner">
        <div class="container">
            <div class="bnrWrap">
                <div class="tleWrap">
                    <h1 class="tle"><?= Words::getValue($language, 'privacy_policy') ?></h1>
                    <div class="info">
                        <?= $language == 'ar' ? $data->description_arabic : $data->description ?>
                    </div>
                </div>
                <div class="iconBx">
                    <img src="<?= Yii::$app->homeUrl ?>images/leglImg.svg" data-src="<?= Yii::$app->homeUrl ?>images/leglImg.svg" alt="missionTransform" width="1920" height="520" class="lazy" loading="lazy">
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb -->

    <section id="Breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="<?= Url::to(['site/index', 'language' => $language]); ?>"><?= Words::getValue($language, 'home') ?></a></li>
                <li class="active"><?= Words::getValue($language, 'privacy_policy') ?></li>
            </ul>
        </div>
    </section>

    <!-- Breadcrumb end -->


    <section id="content">
        <div class="container">

            <div class="contenetBx">
                <?= $language == 'ar' ? $data->more_details_arabic : $data->more_details ?>
            </div>

        </div>
    </section>

</div>
