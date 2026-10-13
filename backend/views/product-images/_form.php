<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model
  common\models\ProductImages */
/* @var $form yii\widgets\ActiveForm */
?>
        <?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class='col-md-4 col-sm-6 col-xs-12 mt-2'>
        <?php
        $products = \common\models\Products::find()->all();
        ?>
        <?= $form->field($model, 'product_id')->dropDownList(\yii\helpers\ArrayHelper::map($products, 'id', 'product_name'), ['prompt' => '--Select--']) ?>
    </div>
    <div class='col-md-4 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'before_image')->fileInput()->hint('Dimensions : 320 * 320') ?>
        <?php
        if ($model->before_image != '' && $model->id != "") {
            echo '<img width="75" style="border: 2px solid #d2d2d2;margin-right:.5em;" src="' . Yii::$app->request->baseUrl . '/../uploads/product-gallery/' . $model->before_image . '?' . rand() . '" />';
            ?>
            <br>
<?php }
?>
    </div>
    <div class='col-md-4 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'after_image')->fileInput()->hint('Dimensions : 320 * 320') ?>
        <?php
        if ($model->after_image != '' && $model->id != "") {
            echo '<img width="75" style="border: 2px solid #d2d2d2;margin-right:.5em;" src="' . Yii::$app->request->baseUrl . '/../uploads/product-gallery/' . $model->after_image . '?' . rand() . '" />';
            ?>
            <br>
<?php }
?>
    </div>
    <div class='col-md-4 col-sm-6 col-xs-12 mt-2'>
<?= $form->field($model, 'status')->dropDownList(['1' => 'Active', '0' => 'Inactive']) ?>
    </div>
</div>
<div class="row">
    <div class='col-md-12 col-sm-12 col-xs-12 mt-4'>
        <div class="form-group">
            <?=
            Html::submitButton($model->isNewRecord ?
                            'Create' :
                            'Update', ['class' => $model->isNewRecord ? 'btn btn-primary me-2' : 'btn
            btn-primary me-2', 'style' => 'float:right;'])
            ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
<script>
    $(document).ready(function () {
        $(document).on('beforeSubmit', 'form', function (event) {
            $(this).find('[type=submit]').attr('disabled', true).addClass('disabled');
        });
    });
</script>