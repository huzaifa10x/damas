<?php

use yii\widgets\Pjax;
use yii\helpers\Url;
use common\models\Words;
use yii\widgets\ActiveForm;

$this->title = 'Damas | Cart';
if (Yii::$app->user->isGuest) {
    $log_flag = 0;
} else {
    $log_flag = 1;
}
?>
<div id="pageWrapper" class="checkoutPage payoutPage">
    <section id="checkoutSec">
        <div class="container">
            <?php $form = ActiveForm::begin(['id' => 'checkout-form']); ?>
            <div class="dFlex">
                <div class="lftCol">
                    <div class="payoutBx">
                        <div class="appointMentBox ">
                            <div class="imgBox">
                                <img src="<?= Yii::$app->homeUrl ?>images/logIcon.svg" alt="checkoutPage">
                            </div>
                            <h1 class="title"><?= Words::getValue($language, 'checkout') ?></h1>
                            <div class="row">
                                <div class="col-lg-12">
                                    <?= $form->field($model, 'name')->textInput(['placeholder' => Words::getValue($language, 'name') . ' *'])->label(FALSE) ?>
                                </div>
                                <div class="col-sm-12">
                                    <?= $form->field($model, 'email')->textInput(['placeholder' => Words::getValue($language, 'email') . ' *'])->label(FALSE) ?>
                                </div>
                                <div class="col-sm-6">
                                    <?= $form->field($model, 'age')->textInput(['placeholder' => Words::getValue($language, 'age') . ' *'])->label(FALSE) ?>
                                </div>
                                <div class="col-sm-6">
                                    <?php
                                    echo $form->field($model, 'gender')
                                            ->dropDownList(
                                                    $genders, // Flat array ('id'=>'label')
                                                    ['prompt' => Words::getValue($language, 'gender') . ' *', 'class' => 'select select2']    // options
                                            )->label(FALSE);
                                    ?>
                                </div>
                                <div class="col-sm-6">
                                    <?= $form->field($model, 'mobile_number')->textInput(['placeholder' => Words::getValue($language, 'phone_no') . ' *'])->label(FALSE) ?>
                                </div>

                                <div class="col-sm-6">
                                        <?=
                                        $form->field($model, 'booking_date')->textInput([
                                            'placeholder' => Words::getValue($language, 'your_preferred_date') . ' *',
                                            'type' => 'date',
                                            'min' => date('Y-m-d') // Set minimum date to today
                                        ])->label(false)
                                        ?>
                                </div>
                                <div class="col-sm-12">
                                    <?= $form->field($model, 'address')->textInput(['placeholder' => Words::getValue($language, 'address') . ' *'])->label(FALSE) ?>
                                </div>
                                <div class="col-sm-12">
                                    <?= $form->field($model, 'city')->textInput(['placeholder' => Words::getValue($language, 'city') . ' *'])->label(FALSE) ?>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <div class="rytCol">
                    <div class="BillBox">
                        <?php
                        if (!empty($cart_items)) {
                            foreach ($cart_items as $cart_item) {
                                $product_details = \common\models\Products::find()->where(['id' => $cart_item->product_id])->one();
                                $price = Yii::$app->CartFunctionality->getProductPrice($cart_item->product_id);
                                $image = Yii::$app->SetValues->GetOfferImage($product_details);
                                $pname = $language == 'ar' ? $product_details->product_name_arabic : $product_details->product_name;
                                $pdesc = $language == 'ar' ? $product_details->short_description_arabic : $product_details->short_description;
                                ?>
                                
                                       
                                
                                <!--product info section -->
                                
                                <div class="itemList">
                                    <div class="item">
                                        <div class="productInfo">
                                            <div class="imgBx">
                                                <img src="<?= $image ?>"
                                                    class="lazy" loading="lazy" alt="productImg">
                                            </div>
                                            <div class="info">
                                                <div class="name"><?= $pname ?></div>
                                                <div class="price"><?= $price ?><?= Yii::$app->SetValues->GetCurrencySymbol() ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                 <!--product info section end-->

                                <?php
                            }
                        }
                        ?>
                        <input type="hidden" id="cart_count" value="<?= count($cart_items); ?>">
                        <div class="PriceDetl">
                            <div class="BoxTitle"><?= Words::getValue($language, 'price_details') ?></div>
                            <ul>
                                <li class="servce">
                                    <span class="label size"><?= Words::getValue($language, 'subtotal') ?></span>
                                    <span class="value sub_tot"><?= Yii::$app->SetValues->GetCurrencySymbol() ?><?= Yii::$app->SetValues->GetPrice($cart_master->sub_total) ?></span>
                                </li>
                                <li>
                                    <!--<span class="label"><?php // Words::getValue($language, 'vat') ?> (5%)</span>-->
                                    <span class="label"><?= Words::getValue($language, 'vat') ?></span>
                                    <span class="value vat_amount"><?= Yii::$app->SetValues->GetCurrencySymbol() ?><?= Yii::$app->SetValues->GetPrice($cart_master->gst) ?></span>
                                </li>
                            </ul>
                            <div class="Total">
                                <span class="label"><?= Words::getValue($language, 'total') ?></span>
                                <span class="value"> <strong class="cart_grand_tot"><?= Yii::$app->SetValues->GetCurrencySymbol() ?><?= Yii::$app->SetValues->GetPrice($cart_master->grand_total) ?></strong></span>
                            </div>
                            <div class="btnWrap">
                                <button type="submiy" class="cmnBtn hoveranim">
                                    <span><?= Words::getValue($language, 'pay_now') ?></span>

                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </section>

</div>