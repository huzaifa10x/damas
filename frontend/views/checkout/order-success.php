<?php
/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'Order Success';
if (!empty($order_master)) {
    $order_details = \common\models\OrderDetails::find()->where(['master_id' => $order_master->id])->all();
    $user_detail = common\models\User::findOne($order_master->user_id);
}
?>

<div id="pageWrapper" class="checkoutPage">
    <section id="confirmtnSec" class="confirmtnSec">
        <div class="container">
            <div class="confirmBx">
                <div class="innerBx">
                    <div class="icon">
                        <svg id="Group_767" data-name="Group 767" xmlns="http://www.w3.org/2000/svg" width="22.016"
                            height="15.842" viewBox="0 0 22.016 15.842">
                            <path id="Path_527" data-name="Path 527"
                                d="M21.5,72.3a1.746,1.746,0,0,0-2.469,0L7.921,83.414l-4.94-4.94a1.746,1.746,0,0,0-2.47,2.47l6.174,6.174a1.746,1.746,0,0,0,2.47,0L21.5,74.769A1.746,1.746,0,0,0,21.5,72.3Z"
                                transform="translate(0.001 -71.788)" fill="#349980" />
                        </svg>

                    </div>
                    <h1 class="txt">Thank you! <h1>
                        Your order was successfully submitted
                    </div>
                    <div class="id">
                        <a href="<?= Url::to(['site/index', 'language' => $language]); ?>" class="back hoveranim"><span>Back to Home</span></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>