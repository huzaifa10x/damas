<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model
  common\models\LandingPages */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'class' => 'form-control slug-change']) ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'title_arabic')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'canonical_name')->textInput(['maxlength' => true, 'class' => 'form-control slug']) ?>
    </div>
    <div class='col-md-3 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'phone_no')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-3 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'whatsapp_no')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-3 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'is_enable_banner')->dropDownList(['1' => 'Yes', '0' => 'No']) ?>
    </div>
    <div class='col-md-3 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'is_enable_about')->dropDownList(['1' => 'Yes', '0' => 'No']) ?>
    </div>
    <div class='col-md-3 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'is_enable_video_banner')->dropDownList(['1' => 'Yes', '0' => 'No']) ?>
    </div>
    <div class='col-md-3 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'is_enable_gallery')->dropDownList(['1' => 'Yes', '0' => 'No']) ?>
    </div>
    <div class='col-md-3 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'is_enable_our_video')->dropDownList(['1' => 'Yes', '0' => 'No']) ?>
    </div>
    <div class='col-md-3 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'is_enable_services')->dropDownList(['1' => 'Yes', '0' => 'No']) ?>
    </div>
    <div class='col-md-3 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'is_enable_appointment')->dropDownList(['1' => 'Yes', '0' => 'No']) ?>
    </div>
    
    <div class='col-md-3 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'status')->dropDownList(['1' => 'Active', '0' => 'Inactive']) ?>
    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
        <?php
        $services = yii\helpers\ArrayHelper::map(\common\models\Services::find()->where(['status' => 1])->all(), 'id', 'service_name');
        if ($model->services != '') {
            $model->services = explode(',', $model->services);
        }
        ?>
        <?=
        $form->field($model, 'services')->widget(Select2::classname(), [
            'data' => $services,
            'language' => 'en',
            'options' => ['placeholder' => 'Select', 'multiple' => true],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
        ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'meta_keyword')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 mt-2'>
        <?= $form->field($model, 'meta_description')->textInput(['maxlength' => true]) ?>
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