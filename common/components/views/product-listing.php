<?php

use yii\helpers\Url;
use common\models\Words;

foreach ($related_products as $related_product) {
    $now_price = $related_product->price;
    $actual_price = 0;
    $percentage = 0;
    if ($related_product->offer_price > 0) {
        $actual_price = $related_product->price;
        $now_price = $related_product->offer_price;
        $percentage = round(100 - (($related_product->offer_price / $related_product->price) * 100));
    }
    ?>
    <div class="relatedBox">
        <div class="imGbox">
            <a href="<?= Url::to(['site/product-details', 'language' => $language, 'slug' => $related_product->canonical_name]); ?>" >
            <img src="<?= Yii::$app->homeUrl ?>uploads/products/<?= $related_product->image ?>" data-src="<?= Yii::$app->homeUrl ?>uploads/products/<?= $related_product->image ?>" class="lazy"
                 loading="lazy" width="400" height="245" alt="<?= $language == 'ar' ? $related_product->product_name_arabic : $related_product->product_name ?>">
                 <?php
                 if ($percentage > 0) {
                     ?>
                <div class="offerBx">
                    <div class="txt"><?= $percentage ?>% <?= Words::getValue($language, 'off') ?></div>
                </div>
                <?php
            }
            ?>
            </a>
        </div>
        <div class="infoBx">
            <div class="title"><?= $language == 'ar' ? $related_product->product_name_arabic : $related_product->product_name ?></div>
            <p><?= $language == 'ar' ? $related_product->short_description_arabic : $related_product->short_description ?></p>
            <div class="priceBx">
                <?php if ($actual_price > 0) { ?>
                    <div class="price"> <?= $now_price ?>AED </div>
                    <div class="offPrice"> <?= $actual_price ?>AED </div>
                <?php } else { ?>
                    <div class="price"> <?= $now_price ?>AED </div>
                <?php }
                ?>
            </div>
            <div class="btnSec">
                <div class="item">
                    <button href="javascript:void(0)" class="cmnBtn hoveranim" data-bs-toggle="modal" data-bs-target="#bookingModal">
                        <span><?= Words::getValue($language, 'book_an_appointment') ?></span>
                    </button>
                </div>
                <div class="item">
                    <a href="javascript:void(0)" class="cmnBtn offG hoveranim add-to-cart" data-product="<?= $related_product->id ?>" data-variant="">
                        <span><?= Words::getValue($language, 'pay_now') ?></span>
                    </a>
                </div>
            </div>
            <div class="btmSec">
                <!--<div class="txt"><?php // Words::getValue($language, 'transform_in_30_minute') ?></div>-->
                <a href="<?= $related_product->link ?? 'javascript:void(0)' ?>" class="moreDetails">
                    <?= Words::getValue($language, 'more_details') ?>
                </a>
            </div>
        </div>
    </div>
<?php }
?>