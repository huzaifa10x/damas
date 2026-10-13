<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model
  common\models\ServiceFaq */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class='col-md-6 col-sm-4 col-xs-12 left_padd'>
        <?php
        $services = \common\models\Services::find()->all();
        ?>
        <?= $form->field($model, 'service')->dropDownList(\yii\helpers\ArrayHelper::map($services, 'id', 'service_name'), ['prompt' => '--Select--']) ?>
    </div>
    <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
        <?= $form->field($model, 'status')->dropDownList(['1' => 'Active', '0' => 'Inactive']) ?>
    </div>
</div>
<div class="row">
    <div class='col-md-6 col-sm-12 col-xs-12 left_padd'>
        <?= $form->field($model, 'question')->textarea(['rows' => 2]) ?>
    </div>
    <div class='col-md-6 col-sm-12 col-xs-12 left_padd'>
        <?= $form->field($model, 'question_arabic')->textarea(['rows' => 2]) ?>
    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
        <?=
            $form->field($model, 'answer')->widget(CKEditor::className(), [
                'editorOptions' => [
                    'preset' => 'full', 
                    'inline' => false, 
                ],
            ]);
            ?>
    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
        <?=
            $form->field($model, 'answer_arabic')->widget(CKEditor::className(), [
                'editorOptions' => [
                    'preset' => 'full', 
                    'inline' => false, 
                ],
            ]);
            ?>
    </div>
</div>
<div class="row">
    <div class='col-md-12 col-sm-12 col-xs-12'>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success mb-1 mb-md-0', 'style' => 'float:right;']) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>