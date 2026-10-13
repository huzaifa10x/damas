<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model
  common\models\Policies */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'description_arabic')->textarea(['rows' => 6]) ?>
    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 mt-2'>
        <?=
        $form->field($model, 'more_details')->widget(CKEditor::className(), [
            'editorOptions' => [
                'preset' => 'full',
                'inline' => false,
            ],
        ]);
        ?>
    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 mt-2'>
        <?=
        $form->field($model, 'more_details_arabic')->widget(CKEditor::className(), [
            'editorOptions' => [
                'preset' => 'full',
                'inline' => false,
            ],
        ]);
        ?>
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