<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model
common\models\OurHistory */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class='col-md-4 col-sm-6 col-xs-12 mt-2'>
    <?= $form->field($model, 'year')->textInput() ?>
</div>
<div class='col-md-4 col-sm-6 col-xs-12 mt-2'>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
</div>
<div class='col-md-4 col-sm-6 col-xs-12 mt-2'>
    <?= $form->field($model, 'title_arabic')->textInput(['maxlength' => true]) ?>
</div>
<div class='col-md-4 col-sm-6 col-xs-12 mt-2'>
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
</div>
<div class='col-md-4 col-sm-6 col-xs-12 mt-2'>
    <?= $form->field($model, 'description_arabic')->textarea(['rows' => 6]) ?>
</div>
<div class='col-md-4 col-sm-6 col-xs-12 mt-2'>
    <?= $form->field($model, 'status')->textInput() ?>
</div>
<div class='col-md-4 col-sm-6 col-xs-12 mt-2'>
    <?= $form->field($model, 'created_by')->textInput() ?>
</div>
<div class='col-md-4 col-sm-6 col-xs-12 mt-2'>
    <?= $form->field($model, 'updated_by')->textInput() ?>
</div>
<div class='col-md-4 col-sm-6 col-xs-12 mt-2'>
    <?= $form->field($model, 'created_at')->textInput() ?>
</div>
<div class='col-md-4 col-sm-6 col-xs-12 mt-2'>
    <?= $form->field($model, 'updated_at')->textInput() ?>
</div>
</div>
<div class="row">
    <div class='col-md-12 col-sm-12 col-xs-12 mt-4'>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ?
            'Create' :
            'Update', ['class' => $model->isNewRecord ? 'btn btn-primary me-2' : 'btn
            btn-primary me-2', 'style' => 'float:right;']) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>