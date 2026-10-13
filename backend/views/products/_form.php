<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model
  common\models\Products */
/* @var $form yii\widgets\ActiveForm */
?>
        <?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class='col-md-4 col-sm-6 col-xs-12 mt-2'>
        <?php
        $services = \common\models\Services::find()->all();
        ?>
        <?= $form->field($model, 'service')->dropDownList(\yii\helpers\ArrayHelper::map($services, 'id', 'service_name'), ['prompt' => '--Select--']) ?>
    </div>
    <div class='col-md-4 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'product_name')->textInput(['maxlength' => true, 'class' => 'form-control slug-change']) ?>
    </div>
    <div class='col-md-4 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'product_name_arabic')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'canonical_name')->textInput(['maxlength' => true, 'class' => 'form-control slug']) ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'image')->fileInput()->hint('Dimensions : 705 * 1055') ?>
        <?php
        if ($model->image != '' && $model->id != "") {
            echo '<img width="75" style="border: 2px solid #d2d2d2;margin-right:.5em;" src="' . Yii::$app->request->baseUrl . '/../uploads/products/' . $model->image . '?' . rand() . '" />';
            ?>
            <br>
            <br>
<?php }
?>
    </div>
</div>
<div class="row">
    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'short_description')->textarea(['rows' => 2]) ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'short_description_arabic')->textarea(['rows' => 2]) ?>
    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 mt-2'>
        <?=
        $form->field($model, 'description')->widget(CKEditor::className(), [
            'editorOptions' => [
                'preset' => 'full',
                'inline' => false,
            ],
        ]);
        ?>
    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 mt-2'>
        <?=
        $form->field($model, 'description_arabic')->widget(CKEditor::className(), [
            'editorOptions' => [
                'preset' => 'full',
                'inline' => false,
            ],
        ]);
        ?>
    </div>
    <div class='col-md-3 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'price')->textInput() ?>
    </div>
    <div class='col-md-3 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'offer_price')->textInput() ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 mt-2'>
        <?= $form->field($model, 'meta_keyword')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 mt-2'>
        <?= $form->field($model, 'meta_description')->textarea(['rows' => 2]) ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'meta_title_ar')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 mt-2'>
        <?= $form->field($model, 'meta_keyword_ar')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 mt-2'>
        <?= $form->field($model, 'meta_description_ar')->textarea(['rows' => 2]) ?>
    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 mt-2'>
        <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-3 col-sm-4 col-xs-12 mt-2'>
        <?= $form->field($model, 'tag')->textInput() ?>
    </div>
    <div class='col-md-3 col-sm-4 col-xs-12 mt-2'>
        <?= $form->field($model, 'sort_order')->textInput(['type' => 'number']) ?>
    </div>
    
    <div class='col-md-3 col-sm-4 col-xs-12 mt-2'>
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