<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Products;

/* @var $this yii\web\View */
/* @var $model
  common\models\OrderMaster */
$this->title = '
Order Details';
$this->params['breadcrumbs'][] = ['label' =>
    'Orders',
    'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-content">
    <nav class="page-breadcrumb align-items-center d-flex">
        <ol class="breadcrumb w-50 mb-0">
            <li class="breadcrumb-item active" aria-current="page">
                <?= Html::encode($this->title) ?>
            </li>
        </ol>
        <div class="float-left d-flex  w-50">
            <?= Html::a('Manage
            Orders', ['index'], ['class' => 'btn btn-outline-primary ml-auto', 'style' => 'margin-left: auto;',])
            ?>
        </div>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="panel-heading">
                    </div>
                    <div class="form-box" style="padding:5px 20px;margin-bottom: 15px;">
                        <?php $form = ActiveForm::begin(['action' => 'update-order-status']); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="box" style="border: 1px solid #dbdbdb;padding:5px 20px;width: 50%;">
                                    <ul style="list-style: none;padding: 10px 0px 0px 0px;">
                                        <li><strong>Order No :</strong> <?= $order_master->order_id ?></li>
                                        <?php if (isset($order_master->order_reference_no_jeebly) && $order_master->order_reference_no_jeebly != '') { ?>
                                            <li><strong>AWB No :</strong> <?= $order_master->order_reference_no_jeebly ?></li>
                                        <?php } ?>
                                        <li><strong>Order Status :</strong> <span style="color:green;font-weight: 600;"><?= $order_status ?></span></li>
                                        <li><strong>Booking Date :</strong> <span style="color:green;font-weight: 600;"><?= $order_master->booking_date != '' ? date('d-m-Y', strtotime($order_master->booking_date)) : '' ?></span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="box" style="border: 1px solid #dbdbdb;padding:5px 20px;">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <?php
                                            if ($order_master->status == 4) {
                                                $status_datas = common\models\OrderStatus::find()->where(['>=', 'id', $order_master->status])->andWhere(['!=', 'id', 5])->all();
                                            } else {
                                                $status_datas = common\models\OrderStatus::find()->where(['>=', 'id', $order_master->status])->all();
                                            }
                                            ?>
                                            <?= $form->field($order_master, 'status')->dropDownList(\yii\helpers\ArrayHelper::map($status_datas, 'id', 'order_status'))->label('Change Order Status') ?>
                                        </div>
                                        <div class="col-md-4">
                                            <?= $form->field($order_master, 'payment_status')->dropDownList(['1' => 'Paid', '0' => 'Not Paid']) ?>
                                            <?= $form->field($order_master, 'id')->hiddenInput(['value' => $order_master->id])->label(FALSE) ?>
                                        </div>
                                        <div class="col-md-3">
                                            <?= Html::submitButton('Update', ['class' => 'btn btn-outline-success mb-1 mb-md-0', 'style' => 'margin-top: 25px;']) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                    <div class="row">
                        <div class="col-md-12">

                            <?= Html::a('<i class="fa fa-print"></i>', ['print', 'id' => $order_master->order_id], ['class' => 'print_button', 'target' => '_blank', 'style' => 'color: #1355ce;font-size: 25px;float: right;', 'title' => 'Print']) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-lg-4 bill-address-div address-div" style="color:#000000bd">
                            <div class="div-pdng order-div" style="">
                                <b class="bill-address">Address</b>
                                <table class="table table-bordered mb-0 table-centered" style="margin-top:5px;color: #000000bd;">
                                    <tr>
                                        <td>
                                            <p class="first-p" style="color:#000000bd;"><?= $bill_address->name ?></p>
                                            <!--<p style="color:#000000bd;"><?= $bill_address->address ?>,<?= $bill_address->area ?>,<?= $bill_address->flat_no ?><?= $bill_address->landmark ?>,<?= $bill_address->emirate != '' ? \common\models\Emirates::findOne($bill_address->emirate)->emirate : '' ?>,</p>-->
                                            <p style="color:#000000bd;">Age : <?= $bill_address->age ?></p>
                                            <p style="color:#000000bd;">Tel : <?= $bill_address->mobile_number ?></p>
                                            <p style="color:#000000bd;">Email : <?= $bill_address->email ?></p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-8 bill-address-div " style="color:#000000bd">
                            <div class="div-pdng order-div">
                                <b class="bill-address">Bill Details</b>
                                <table class="table table-bordered mb-0 table-centered" style="margin-top:5px;color: #000000bd;">
                                    <tr>
                                        <td>Order No</td>
                                        <td><b><?= $order_master->order_id ?></b></td>

                                        <td>Order Date</td>
                                        <td><b><?= date('d-m-Y', strtotime($order_master->order_date)) ?></b></td>
                                    </tr>

                                    <tr>
                                        <td>Customer</td>
                                        <td><b><?= $order_master->name ?></b></td>

                                        <td>Total</td>
                                        <?php
                                        $total = $order_master->total_amount;
                                        ?>
                                        <td><b><?= $total ?></b></td>
                                    </tr>



                                    <tr>
                                        <?php
                                        if ($order_master->promotion_discount != '' && $order_master->promotion_discount > 0) {
                                            ?>
                                            <td>
                                                Promotion Code Discount
                                            <td>
                                                <b><?= $order_master->promotion_discount ?></b>
                                            </td>
                                            <td>
                                                Shipping Amount 

                                            </td> 
                                            <td>

                                                <b><?= $order_master->shipping_charge ?></b>
                                            </td>
                                            <?php
                                        }
                                        ?>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php
                                            if ($order_master->vat_amount != '' && $order_master->vat_amount > 0) {
                                                echo 'VAT';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($order_master->vat_amount != '' && $order_master->vat_amount > 0) {
                                                echo $order_master->vat_amount;
                                            }
                                            ?>
                                        </td>
                                        <td>Net Amount</td>
                                        <td><b><?= $order_master->net_amount ?></b></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div style="margin-top: 10px">

                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th></th>
                                            <th>PRODUCT</th>
                                            <th>QUANTITY</th>
                                            <th>PRICE</th>
                                            <th>TOTAL</th>
                                            <!--<th>STATUS</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $o = 0;
                                        foreach ($order_details as $order_detail) {
                                            $o++;
                                            $product_detail = Products::findOne($order_detail->product_id);
                                            if(!empty($product_detail)){
                                            $price = $order_detail->amount;
                                            $sub_total = $order_detail->quantity * $order_detail->amount;
                                            $total = $sub_total;
                                            $varients = [];
                                            $variant_list = '';
                                            if ($order_detail->varient_values != '') {
                                                if ($order_detail->varient_values != '') {
                                                    $varients = json_decode($order_detail->varient_values, true);
                                                }
                                            }
                                            ?>
                                            <tr data-key="30">
                                                <td><?= $o ?></td>
                                                <td>
                                                    <?php
                                                    $image = '<img src="' . Yii::$app->homeUrl . '../uploads/noImage" alt="No Image" class="img-fluid" width="50"/>';
                                                    if(!empty($product_detail)){
                                                        $product_image = Yii::$app->basePath . '/../frontend/web/uploads/products/' . $product_detail->image;
                                                        if (file_exists($product_image)) {
                                                            $image = '<img src="' . Yii::$app->homeUrl . '../uploads/products/' . $product_detail->image . '" alt="' . $product_detail->canonical_name . '" class="img-fluid" width="50"/>';
                                                        }  
                                                    }
                                                    echo $image;
                                                    ?>
                                                </td>
                                                <td><?= $product_detail->product_name ?>
                                                    <p class="variants"><?= rtrim($variant_list, ','); ?><p>
                                                </td>
                                                <td><?= $order_detail->quantity ?></td>
                                                <td><?= round($price, 2) ?></td>
                                                <td><?= $total ?></td>
                                                <!--<td>-->
                                                <?php
//                                        if ($order_detail->status == 0) {
//                                            echo '<span class="cancel">Cancelled</span>';
//                                        } else {
//                                            echo '<span class="active">Active</span>';
//                                        }
                                                ?>
                                                <!--</td>-->
                                            </tr>
                                        <?php } 
                                        }?>
                                    </tbody></table>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>