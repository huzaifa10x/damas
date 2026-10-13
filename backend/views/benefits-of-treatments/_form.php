<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model
  common\models\BenefitsOfTreatments */
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
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-4 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'title_arabic')->textInput(['maxlength' => true]) ?>
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
    <div class='col-md-4 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'image')->fileInput()->hint('Dimensions : 1920 * 385') ?>
        <?php
        if ($model->image != '' && $model->id != "") {
            echo '<img width="75" style="border: 2px solid #d2d2d2;margin-right:.5em;" src="' . Yii::$app->request->baseUrl . '/../uploads/product-benefits/' . $model->image . '?' . rand() . '" />';
            ?>
            <br>
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