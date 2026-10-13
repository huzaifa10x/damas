<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model
  common\models\ServiceVideos */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
        <?= $form->field($model, 'video')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
        <?= $form->field($model, 'thumb_image')->fileInput()->hint('Dimensions : 1350 * 596') ?>
        <?php
        if ($model->thumb_image != '' && $model->id != "") {
            echo '<img width="75" style="border: 2px solid #d2d2d2;margin-right:.5em;" src="' . Yii::$app->request->baseUrl . '/../uploads/service-videos/' . $model->thumb_image . '?' . rand() . '" />';
            ?>
            <br>
        <?php }
        ?>
    </div>
    
    <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
        <?= $form->field($model, 'status')->dropDownList(['1' => 'Active', '0' => 'Inactive']) ?>
    </div>
    <div class='col-md-4 col-sm-6 col-xs-12'>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success mb-1 mb-md-0', 'style' => 'margin-top:30px;']) ?>
            <?php if (!$model->isNewRecord) { ?>
                <?= Html::a('<span> Reset</span>', ['index', 's_id' => $s_id], ['class' => 'btn btn-primary', 'style' => 'margin-top:30px;']) ?>
            <?php }
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