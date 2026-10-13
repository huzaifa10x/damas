<?php

use yii\widgets\ActiveForm;
use common\models\Words;

$this->title = 'Damas | Cart';
if (Yii::$app->user->isGuest) {
    $log_flag = 0;
} else {
    $log_flag = 1;
}
?>
<div id="pageWrapper" class="checkoutPage">
    <section id="checkoutSec">
        <div class="container">
            <div class="dFlex">
                <div class="lftCol">
                    <?php
                    if (!empty($cart_items)) {
                        foreach ($cart_items as $cart_item) {
                            $product_details = \common\models\Products::find()->where(['id' => $cart_item->product_id])->one();
                            $price = Yii::$app->CartFunctionality->getProductPrice($cart_item->product_id);
                            $image = Yii::$app->SetValues->GetOfferImage($product_details);
                            $pname = $language == 'ar' ? $product_details->product_name_arabic : $product_details->product_name;
                            $pdesc = $language == 'ar' ? $product_details->short_description_arabic : $product_details->short_description;
                            ?>

                            <div class="cartList">
                                <a href="" class="cartBx">
                                    <div class="innerBx">
                                        <div class="imgBx">
                                            <img alt="image" src="<?= $image ?>" loading="lazy" width="173"
                                                 height="106" alt="<?= $pname ?>" />
                                        </div>
                                        <div class="contWrap">
                                            <div class="contBx">
                                                <div class="cont">
                                                    <h1 class="tle"><?= $pname ?></h1>
                                                    <div class="info"><?= $pdesc ?></div>
                                                </div>
                                                <div class="prceBx">
                                                    <?= $price ?><?= Yii::$app->SetValues->GetCurrencySymbol() ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <?php
                        }
                    }
                    ?>
                    <input type="hidden" id="cart_count" value="<?= count($cart_items); ?>">
                </div>
                <div class="rytCol">
                    <div class="BillBox">
                        <div class="PriceDetl">
                            <div class="BoxTitle"><?= Words::getValue($language, 'price_details') ?></div>
                            <ul>
                                <li class="servce">
                                    <span class="label size"><?= Words::getValue($language, 'subtotal') ?></span>
                                    <span class="value"><?= Yii::$app->SetValues->GetCurrencySymbol() ?><?= Yii::$app->SetValues->GetPrice($cart_master->sub_total) ?></span>
                                </li>
                                <li>
                                    <span class="label"><?= Words::getValue($language, 'vat') ?> (5%)</span>
                                    <span class="value"><?= Yii::$app->SetValues->GetCurrencySymbol() ?><?= Yii::$app->SetValues->GetPrice($cart_master->gst) ?></span>
                                </li>
                            </ul>
                            <div class="Total">
                                <span class="label"><?= Words::getValue($language, 'total') ?></span>
                                <span class="value"> <strong><?= Yii::$app->SetValues->GetCurrencySymbol() ?><?= Yii::$app->SetValues->GetPrice($cart_master->grand_total) ?></strong></span>
                            </div>
                            <div class="btnWrap">
                                <?php $form = ActiveForm::begin(['id' => 'payment-form']); ?>
                                <button type="submit" class="cmnBtn hoveranim">
                                    <span><?= Words::getValue($language, 'pay_now') ?></span>
                                    
                                </button>
                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

</div>