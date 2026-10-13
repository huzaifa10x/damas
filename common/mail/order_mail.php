<?php

use common\models\OrderDetails;
use common\models\OrderMaster;
use common\models\Products;
use common\models\OrderPromotions;

$order_master = OrderMaster::find()->where(['id' => $orderid])->one();
$order_products = OrderDetails::find()->where(['master_id' => $order_master->id])->all();
// $promotions = OrderPromotions::find()->where(['order_master_id' => $order_master->id])->sum('promotion_discount');
$user_detail = common\models\User::findOne($order_master->user_id);
$bill_address = \common\models\OrderAddress::find()->where(['id' => $order_master->billing_address])->one();
$contact_data = common\models\ContactUs::findOne(1);
?>
<div style="margin:auto; width:600px;background: #ffffff;">
    <table id="Table_01" width="600" border="0" cellpadding="0" cellspacing="0" align="center">

        <thead>
            <tr>
                <td>
                    <table width="700" style="margin: auto; background-color: #d5ae692b;" border="0" cellpadding="0"
                           cellspacing="0" align="center">
                        <tbody>
                            <tr>
                                <td style="text-align:center;padding: 10px 0;">
                                    <a style="display: block; margin: auto;" href="#!" target="_blank">
                                        <img src="<?= Yii::$app->params['filepath'] ?>images/logo.png" width="110"
                                             height="93">
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td style="padding: 50px 110px 0px;">
                    <table width="400" style="margin: auto; text-align: center;">
                        <tbody>
                            <tr>
                                <td style="padding: 0px 0 45px;">
                                    <h1
                                        style="color: #763813; font-size: 20px;line-height: 27px; font-weight: 600; text-align: center; padding: 0 0 10px;margin: 0;font-family: 'Open Sans', sans-serif;">
                                        Hi <?= $bill_address->name ?></h1>
                                    <p
                                        style="text-align: center; margin: auto;font-family: 'Open Sans', sans-serif; font-size: 14px; font-weight: 400; color: #272525; line-height: 26px; margin-top:0px; margin-bottom: 0px;">
                                        We are pleased to inform you that the service booking for <?= $order_master->order_id ?> has been successfully completed.
                                    </p>
                                    
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 0px 17px 0px;">
                    <table width="100%" style="margin: auto; background: #fbf7f0;">
                        <tbody>
                            <tr>
                                <td style="background: #fbf7f0;padding: 0px;">
                                    <table width="100%" style="margin: auto; background: #fbf7f0;">
                                        <tbody>
                                            <tr>
                                                <td style="padding: 25px 30px 25px;">
                                                    <h1
                                                        style="color: #000; font-size: 18px;font-family: 'Open Sans', sans-serif; font-weight: 400; text-align: center; padding: 0 0 5px;margin: 0;">
                                                        View the booking details</h1>
                                                    <!--<p-->
                                                    <!--    style="text-align: center; font-family: 'Open Sans', sans-serif; font-size: 14px; font-weight: 400; color: #000; line-height: 26px; margin-top:0px; margin-bottom: 0px;">-->
                                                    <!--    To see the status of your order visit-->
                                                    <!--    <a href="<?php // Yii::$app->params['filepath'] ?>"-->
                                                    <!--       style="text-align: center; font-family: 'Open Sans', sans-serif; font-size: 14px; font-weight: 400; color: #000; text-decoration: underline; line-height: 26px; margin-top:0px; margin-bottom: 0px;">-->
                                                    <!--        My Order-->
                                                    <!--    </a>-->
                                                    <!--    section in your account.-->
                                                    <!--</p>-->
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 0px 17px 0px;">
                    <table width="100%" style="margin: auto; background: #ffffff;">
                        <tbody>
                            <tr>
                                <td style="background: #ffffff; padding: 25px 0 50px 30px;">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td style="margin: 0px; text-align: left;">
                                                    <p
                                                        style="font-size: 16px;color: #000000;font-family: 'Open Sans', sans-serif; font-weight: 700; padding-bottom: 15px; margin-bottom: 0px; margin-top: 0px; line-height: 22px; text-align: left;">
                                                        Customer Details
                                                    </p>
                                                    <p
                                                        style="font-size: 14px;font-family: 'Open Sans', sans-serif; color: #444444; font-weight: 400; margin-bottom: 0px; margin-top: 0px; line-height: 22px; text-align: left;">
                                                        Name:
                                                        <span
                                                            style="font-size: 14px;font-family: 'Open Sans', sans-serif; color: #444444; padding-bottom: 10px; font-weight: 400; margin-bottom: 0px; margin-top: 0px; line-height: 22px; text-align: left;">
                                                                <?= $bill_address->name ?>
                                                        </span>
                                                    </p>
                                                    <p
                                                        style="font-size: 14px;color: #444444;font-family: 'Open Sans', sans-serif; font-weight: 400; margin-bottom: 0px; margin-top: 0px; line-height: 22px; text-align: left;">
                                                        Email:
                                                        <a href="mailto:steevdavid1@gmail.com"
                                                           style="font-size: 14px;color: #444444; text-decoration: none; padding-bottom: 10px; font-weight: 400; margin-bottom: 0px; margin-top: 0px; line-height: 22px; text-align: left;">
                                                               <?= $bill_address->email ?>

                                                        </a>
                                                    </p>
                                                    <p
                                                        style="font-family: 'Open Sans', sans-serif;font-size: 14px;color: #444444; font-weight: 400; margin-bottom: 0px; margin-top: 0px; line-height: 22px; text-align: left;">
                                                        Phone Number:
                                                        <a href="tel:<?= $bill_address->mobile_number ?>" 
                                                           style="font-family: 'Open Sans', sans-serif; font-size: 14px;color: #444444; text-decoration:
                                                           none; padding-bottom: 10px; font-weight: 400;
                                                           margin-bottom: 0px; margin-top: 0px; line-height: 22px;
                                                           text-align: left;">
                                                           <?= $bill_address->mobile_number ?>
                                                        </a>
                                                    </p>
                                                    <p
                                                        style="font-family: 'Open Sans', sans-serif; font-size: 14px;color: #444444; font-weight: 400; margin-bottom: 0px; margin-top: 0px; line-height: 22px; text-align: left;">
                                                        Address:
                                                        <span
                                                            style="font-family: 'Open Sans', sans-serif; font-size: 14px;color: #444444; padding-bottom: 10px; font-weight: 400; margin-bottom: 0px; margin-top: 0px; line-height: 22px; text-align: left;">
                                                            <?= $bill_address->address ?>,<?= $bill_address->city ?>
                                                        </span>
                                                    </p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 0px 17px 0px;">
                    <table width="100%" style="margin: auto; background: #763813; height: 30px;">
                        <tbody>
                            <tr>
                                <td style="background: #763813;">
                                    <h1
                                        style="font-family: 'Open Sans', sans-serif; color: #ffffff; font-size: 14px; font-weight: 400; text-align: center;margin: 0;">
                                        Order Id: <?= $order_master->order_id ?></h1>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>

            <tr>
                <td style="padding: 0px 17px 0px;">
                    <table width="100%" style="margin: auto; background: #F8F8F4; height: 30px;">
                        <tbody>
                            <tr>
                                <td style="background: #F8F8F4; border-radius: 0px;padding: 15px 0 20px;margin: auto;">
                                    <p
                                        style="font-family: 'Open Sans', sans-serif; font-size: 14px;color: #000000; font-weight: 500; margin-bottom: 0px; margin-top: 0px; line-height: 22px; text-align: center;">
                                        Your Preferred Date - <?= $order_master->booking_date ?>

                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 0px 17px 0px;">
                    <table width="100%" style="margin: auto; background: #F8F8F4;">
                        <tbody>
                            <tr>
                                <td style="background: #F8F8F4; padding: 0px 20px 20px 20px;margin: auto;">
                                    <table style="width: 100%;">
                                        <tbody>
                                            <tr>
                                                <td
                                                    style="margin: auto;">
                                                        <?php
                                                        $tax_amount = 0;
                                                        $count = count($order_products);
                                                        $total_amount = 0;
                                                        $p = 0;
                                                        foreach ($order_products as $order_product) {
                                                            $p++;
                                                            $tax = 0;

                                                            $product_details = Products::find()->where(['id' => $order_product->product_id])->one();
                                                            $image = Yii::$app->SetValues->GetOfferImage($product_details);
                                                            $price = $order_product->amount;
                                                            $total_amount += $order_product->rate;
                                                            ?>
                                                        <table
                                                            style="width: 100%; margin: auto; height: 40px; padding: 10px; background-color: #fff; margin-bottom: 2px;">
                                                            <tbody>
                                                                <tr>
                                                                    <td
                                                                        style="width: 20%; margin-bottom: 0px; margin-top: 0px;">
                                                                        <img src="<?= $image ?>" alt="" width="67" height="67">
                                                                    </td>
                                                                    <td
                                                                        style="width: 60%; margin-bottom: 0px; margin-top: 0px;">
                                                                        <p style="font-size: 14px; font-family: 'Open Sans', sans-serif;color: #1A2D14; font-weight: 600;margin: 0px; padding-bottom: 6px;"><?= $product_details->product_name; ?></p>
                                                                        <p style="font-family: 'Open Sans', sans-serif;font-size: 10px; margin: 0px; color: #1A2D14;">Qty:<?= $order_product->quantity ?></p>
                                                                    </td>
                                                                    <td
                                                                        style="width: 20%; font-size: 12px;color: #000000; font-weight: 500; margin-bottom: 0px; margin-top: 0px; line-height: 22px; text-align: center;">
                                                                        <p style="font-family: 'Open Sans', sans-serif;font-size: 12px; color: #A9AA98; text-decoration: line-through; margin: 0px;"><?= sprintf('%0.2f', $order_product->orginal_price) ?> <?= Yii::$app->SetValues->GetCurrencySymbol() ?></p>
                                                                        <p style="font-family: 'Open Sans', sans-serif;font-size: 14px; color: #763813; margin: 0px;"><?= sprintf('%0.2f', $order_product->amount) ?> <?= Yii::$app->SetValues->GetCurrencySymbol() ?></p>
                                                                    </td>

                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    <?php } ?>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 0px 17px 0px;">
                    <table width="100%" style="margin: auto; background: #F8F8F4;padding: 0 20px 15px;" border="0" cellpadding="0"
                           cellspacing="0">
                        <tbody>
                            <tr>
                                <td style="margin: 0px; text-align: left;">
                                    <p
                                        style="font-size: 14px;font-family: 'Open Sans', sans-serif; color: #000000; font-weight: 600; margin-bottom: 0px; margin-top: 0px; line-height: 22px; text-align: left;">
                                        Price (<?= count($order_products) ?> Items)
                                    </p>
                                    <p
                                        style="font-family: 'Open Sans', sans-serif; font-size: 12px;color: #000000; font-weight: 500; margin-bottom: 0px; margin-top: 0px; line-height: 22px; text-align: left;">
                                        VAT (5%)
                                    </p>
                                </td>
                                <td style="margin: 0px; text-align: right;">
                                    <p
                                        style="font-family: 'Open Sans', sans-serif; font-size: 12px;color: #535353; font-weight: 400; margin-bottom: 0px; margin-top: 0px; line-height: 22px; text-align: right;">
                                        <?= sprintf('%0.2f', $order_master->total_amount) ?> <?= Yii::$app->SetValues->GetCurrencySymbol() ?>
                                    </p>
                                    <p
                                        style="font-family: 'Open Sans', sans-serif; font-size: 12px;color: #535353; font-weight: 400; margin-bottom: 0px; margin-top: 0px; line-height: 22px; text-align: right;">
                                        <?= sprintf('%0.2f', $order_master->vat_amount) ?> <?= Yii::$app->SetValues->GetCurrencySymbol() ?>
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
<!--            <tr>
                <td style="padding: 0px 17px 0px;">
                    <table width="100%"
                           style="padding-top: 15px; background: #F8F8F4; padding-bottom: 15px; padding: 0px 20px 10px 20px; margin: auto;"
                           border="0" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td style="margin: 0px; text-align: left;">
                                    <p
                                        style="font-family: 'Open Sans', sans-serif;font-size: 12px;color: #000000; font-weight: 400; margin-bottom: 0px; margin-top: 0px; line-height: 20px; text-align: left;">
                                        Discount
                                    </p>
                                    <p
                                        style="font-family: 'Open Sans', sans-serif;font-size: 11px;color: #000000; font-weight: 400; margin-bottom: 0px; margin-top: 0px; line-height: 20px; text-align: left;">
                                        Delivery Fee
                                    </p>
                                </td>
                                <td style="margin: 0px; text-align: right;">
                                    <p
                                        style="font-family: 'Open Sans', sans-serif;font-size: 12px;color: #535353; font-weight: 400; margin-bottom: 0px; margin-top: 0px; line-height: 20px; text-align: right;">
                                        -5.00 AED
                                    </p>
                                    <p
                                        style="font-family: 'Open Sans', sans-serif;font-size: 12px;color: #535353; font-weight: 400; margin-bottom: 0px; margin-top: 0px; line-height: 20px; text-align: right;">
                                        1.00 AED
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>-->
            <tr>
                <td style="padding: 0px 17px 35px;">
                    <table  width="100%" style="border-spacing:0px; ">
                        <tr>
                            <td style="padding: 0 20px; background: #F8F8F4;">
                                <table width="100%" style=" margin: auto; " border="0"
                                       cellpadding="0" cellspacing="0">
                                    <tbody>
                                        <tr>
                                            <td style="padding: 15px 0; margin: 0px; text-align: left; border-top: 1px solid #EFEFEC;">
                                                <p
                                                    style="font-family: 'Open Sans', sans-serif;font-size: 14px;color: #000000; font-weight: 500; margin-bottom: 0px; margin-top: 0px; line-height: 22px; text-align: left;">
                                                    Total
                                                </p>
                                            </td>
                                            <td style="padding: 15px 0; margin: 0px; text-align: right; border-top: 1px solid #EFEFEC;">
                                                <p
                                                    style="font-family: 'Open Sans', sans-serif;font-size: 12px;color: #031717; font-weight: 700; margin-bottom: 0px; margin-top: 0px; line-height: 22px; text-align: right;">
                                                    <?= sprintf('%0.2f', $order_master->net_amount) ?> <?= Yii::$app->SetValues->GetCurrencySymbol() ?>
                                                </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 0px 0 30px;">
                    <p
                        style="font-size: 16px;font-family: 'Open Sans', sans-serif; color: #7E7E7E; font-weight: 400;margin: 0; text-align: center; margin-bottom: 0px; padding: 30px 60px 6px;">
                        Thanks for Registering with  <a href="#"
                                                        style="color: #763813;font-weight: 700; text-decoration: none;margin-left: 2px;">Damas Medical Center

                        </a>

                    </p>
                    <p
                        style="font-size: 16px;font-family: 'Open Sans', sans-serif; color: #7E7E7E; font-weight: 400;margin: 0; text-align: center; margin-bottom: 0px; padding: 0px 60px 20px 60px;">
                        Please feel free to contact us if you have any queries about us

                    </p>
                </td>


            </tr>

            <tr>
                <td style="padding: 0 60px 0 60px;">
                    <table style="padding: 0px 0 45px 0; width: 100%; border-bottom: 1px solid #EAEAEA;">
                        <tbody>
                            <tr>
                                <td style="width: 50%;">
                                    <table align="left">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a href="mailto:<?= $contact_data->email ?>"
                                                       style="font-size: 14px; font-family: 'Open Sans', sans-serif; text-decoration: none; font-weight: 700; color: #434242; display: block; margin-bottom: 5px;"><?= $contact_data->email ?>

                                                    </a>
                                                    <p
                                                        style="font-size: 14px; font-family: 'Open Sans', sans-serif; margin: 0px; font-weight: 700; color: #434242;">
                                                        Whatsapp No. 
                                                        <a href="tel:<?= $contact_data->whatsapp_no ?>" style="text-decoration: none; color: #434242;">
                                                            <?= $contact_data->whatsapp_no ?>
                                                        </a>
                                                    </p>
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td style="width: 50%;">
                                    <table align="right">
                                        <tbody>
                                            <tr>
                                                <td >
                                                    <a href="<?= $contact_data->facebook_link ?>"
                                                       style="width: 17px; height: 17px;">
                                                        <img src="<?= Yii::$app->params['filepath'] ?>images/fb.png"
                                                             style="width: 17px; height: 17px;">
                                                    </a>

                                                </td>
                                                <td >
                                                    <p style="font-size: 13px; font-family: 'Open Sans', sans-serif; text-decoration: none; font-weight: 400; color: #2F2F2F;padding-bottom: 5px;margin-left: 12px;">facebook</p>

                                                </td>

                                                <td style="padding-left: 25px;">
                                                    <a href="<?= $contact_data->instagram_link ?>"
                                                       style="width: 17px; height: 17px;">
                                                        <img src="<?= Yii::$app->params['filepath'] ?>images/insta.png"
                                                             style="width: 17px; height: 17px;">
                                                    </a>

                                                </td>
                                                <td >
                                                    <p style="font-size: 13px; font-family: 'Open Sans', sans-serif; text-decoration: none; font-weight: 400; color: #2F2F2F;padding-bottom: 5px;margin-left: 12px;">instagram</p>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td style="padding: 27px 0px 35px;">
                    <p
                        style="color: #323232; font-size: 14px; font-family: 'Open Sans', sans-serif; font-weight: 400; text-align: center; padding: 25px 0 35px;margin: 0;">
                        Copyright © 2022 Damas Medical Center. All Rights Reserved.</p>
                </td>

            </tr>
        </tfoot>
    </table>
</div>
