<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\DepartmentProsAndCons */
/* @var $form yii\widgets\ActiveForm */
?>


<?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class='col-md-5 col-sm-6 col-xs-12 left_padd'>
        <?= $form->field($model, 'section7_title')->textInput() ?>
    </div>
    <div class='col-md-5 col-sm-6 col-xs-12 left_padd'>
        <?= $form->field($model, 'section7_title_arabic')->textInput(['maxlength' => true]) ?>
    </div>

    <div class='col-md-2 col-sm-6 col-xs-12'>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success mb-1 mb-md-0', 'style' => 'margin-top:30px;']) ?>
        </div>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>
        <?=
        $form->field($model, 'section7_description')->widget(CKEditor::className(), [
            'editorOptions' => [
                'preset' => 'full',
                'inline' => false,
            ],
        ]);
        ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>
        <?=
        $form->field($model, 'section7_description_arabic')->widget(CKEditor::className(), [
            'editorOptions' => [
                'preset' => 'full',
                'inline' => false,
            ],
        ]);
        ?>
    </div>
</div>
<?php ActiveForm::end(); ?>

