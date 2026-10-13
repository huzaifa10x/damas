<?php
/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'Order Failed';
?>

<div id="pageWrapper" class="checkoutPage">
    <section id="failed" class="failed">
        <div class="container">
            <div class="failedBx">
                <div class="imgBx">
                    <img src="<?= Yii::$app->homeUrl ?>images/failed.png" alt="checkoutPage">
                </div>
                <h1 class="title">
                    Oops...
                </h1>
                <div class="subTxt">
                    Something went wrong. please try again.
                </div>
                <div class="btns">
                    <a href="<?= Url::to(['site/index', 'language' => $language]); ?>" class="btn1">
                        Back to Home
                    </a>
                    <!-- <a href="#" class="btn2">
                        Live Chat With Us
                    </a> -->
                </div>
                <!--<a href="#" class="customerSer">Speak To Our Customer Service Team</a>-->
            </div>
        </div>
    </section>
</div>

