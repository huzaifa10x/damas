<?php

use yii\widgets\Pjax;
use yii\helpers\Url;
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
                                <div class="cartBx cart_box-<?= yii::$app->EncryptDecrypt->Encrypt('encrypt', $cart_item->id); ?>">
                                    
                                    <a href="javascript:void(0)" class="remove remove_cart"
                                data-product_id="<?= yii::$app->EncryptDecrypt->Encrypt('encrypt', $cart_item->id); ?>">
                                <div class="icon">
                                    <svg width="26" height="26" viewBox="0 0 26 26" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_1_5458)">
                                            <path
                                                d="M13.2568 25.321C6.36425 25.321 0.756836 19.7136 0.756836 12.821C0.756836 5.92846 6.36425 0.321045 13.2568 0.321045C20.1494 0.321045 25.7568 5.92846 25.7568 12.821C25.7568 19.7136 20.1494 25.321 13.2568 25.321ZM13.2568 2.1067C7.34901 2.1067 2.5425 6.91322 2.5425 12.821C2.5425 18.7289 7.34901 23.5354 13.2568 23.5354C19.1647 23.5354 23.9712 18.7289 23.9712 12.821C23.9712 6.91322 19.1647 2.1067 13.2568 2.1067Z"
                                                fill="#D20F0F"></path>
                                            <path
                                                d="M17.7209 18.1782C17.4924 18.1782 17.2639 18.091 17.0895 17.9165L8.16105 8.98803C7.8122 8.63918 7.8122 8.07422 8.16105 7.72556C8.50972 7.37689 9.07487 7.3767 9.42353 7.72556L18.352 16.654C18.7009 17.0029 18.7009 17.5679 18.352 17.9165C18.1777 18.091 17.9494 18.1782 17.7209 18.1782Z"
                                                fill="#D20F0F"></path>
                                            <path
                                                d="M8.7922 18.1782C8.5637 18.1782 8.33539 18.091 8.16105 17.9165C7.8122 17.5678 7.8122 17.0027 8.16105 16.654L17.0895 7.72551C17.4384 7.37665 18.0034 7.37665 18.352 7.72551C18.7007 8.07417 18.7009 8.63932 18.352 8.98798L9.42353 17.9165C9.2492 18.091 9.0207 18.1782 8.7922 18.1782Z"
                                                fill="#D20F0F"></path>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_1_5458">
                                                <rect width="25" height="25" fill="white"
                                                    transform="translate(0.756836 0.321045)"></rect>
                                            </clipPath>
                                        </defs>
                                    </svg>

                                </div>
                            </a>
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
                                </div>
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
                                    <span class="value sub_tot"><?= Yii::$app->SetValues->GetCurrencySymbol() ?><?= Yii::$app->SetValues->GetPrice($cart_master->sub_total) ?></span>
                                </li>
                                <li>
                                    <span class="label"><?= Words::getValue($language, 'vat') ?> </span>
                                    <span class="value vat_amount"><?= Yii::$app->SetValues->GetCurrencySymbol() ?><?= Yii::$app->SetValues->GetPrice($cart_master->gst) ?></span>
                                </li>
                            </ul>
                            <div class="Total">
                                <span class="label"><?= Words::getValue($language, 'total') ?></span>
                                <span class="value"> <strong class="cart_grand_tot"><?= Yii::$app->SetValues->GetCurrencySymbol() ?><?= Yii::$app->SetValues->GetPrice($cart_master->grand_total) ?></strong></span>
                            </div>
                            <div class="btnWrap">
                                <a href="<?= Url::to(['checkout/index', 'language' => $language]); ?>" class="cmnBtn hoveranim">
                                    <span><?= Words::getValue($language, 'proceed_to_checkout') ?></span>
                                    
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

</div>
<script>
    $(document).ready(function () {
        /*
         * This function remove products from cart page
         */

        $(document).on('click', '.remove_cart', function (e) {
            e.preventDefault();
            var $id = $(this).attr('data-product_id');
            var $count = $('#cart_count').val();
            $.ajax({
                url: '<?= Yii::$app->homeUrl ?><?= $language?>/ajax/cart-remove',
                type: "post",
                data: {
                    id: $id,
                    count: $count
                },
                success: function (data) {
                    var $data = JSON.parse(data);
                    if ($data.subtotal != 0) {
                        if ($data.msg === "success") {
                            $('.sub_tot').text($data.currency + ' ' + $data.sub_total);
                            $('.vat_amount').text($data.currency + ' ' + $data.vat_total);
                            $('.cart_grand_tot').text($data.currency + ' ' + $data.grand_tot);
                            $('.cart_box-' + $id).remove();
                            if ($data.count == 0) {
                                location.reload();
                            }
                        }
                    } else {
                        location.reload();
                    }
                },
                error: function () {
                    $('.error_' + $id).html('Cannot Find');
                    location.reload();
                }
            });
        });
    });
</script>