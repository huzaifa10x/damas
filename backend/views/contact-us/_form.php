<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model
  common\models\ContactUs */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'address')->textarea(['rows' => 3]) ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'address_arabic')->textarea(['rows' => 3]) ?>
    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 mt-2'>
        <?= $form->field($model, 'location_link')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-3 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'phone1')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-3 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'phone2')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-3 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'whatsapp_no')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-3 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'facebook_link')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'instagram_link')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'youtube_link')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'twitter_link')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'linkedin_link')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'threads_link')->textInput(['maxlength' => true]) ?>
    </div>
     <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'snapchat')->textInput(['maxlength' => true]) ?>
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