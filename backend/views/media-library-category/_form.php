<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model
  common\models\MediaLibraryCategory */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class='col-md-4 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'category_name')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-4 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'category_name_arabic')->textInput(['maxlength' => true]) ?>
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