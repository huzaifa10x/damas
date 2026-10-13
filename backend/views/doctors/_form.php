<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model
  common\models\Doctors */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
        <?php
        $departments = yii\helpers\ArrayHelper::map(\common\models\Departments::find()->where(['status' => 1])->all(), 'id', 'department_name');
        if ($model->department != '') {
            $model->department = explode(',', $model->department);
        }
        ?>
        <?=
        $form->field($model, 'department')->widget(Select2::classname(), [
            'data' => $departments,
            'language' => 'en',
            'options' => ['placeholder' => 'Select', 'multiple' => true],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
        ?>
    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
        <?php
        $services = yii\helpers\ArrayHelper::map(\common\models\Services::find()->where(['status' => 1])->all(), 'id', 'service_name');
        if ($model->service != '') {
            $model->service = explode(',', $model->service);
        }
        ?>
        <?=
        $form->field($model, 'service')->widget(Select2::classname(), [
            'data' => $services,
            'language' => 'en',
            'options' => ['placeholder' => 'Select', 'multiple' => true],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
        ?>
    </div>
    <div class='col-md-4 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'doctor_name')->textInput(['maxlength' => true, 'class' => 'form-control slug-change']) ?>
    </div>
    <div class='col-md-4 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'doctor_name_arabic')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-4 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'canonical_name')->textInput(['maxlength' => true, 'class' => 'form-control slug']) ?>
    </div>
    <div class='col-md-4 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'designation')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-4 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'designation_arabic')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-4 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
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
    <div class='col-md-12 col-sm-12 col-xs-12 mt-2'>
        <?=
        $form->field($model, 'overview')->widget(CKEditor::className(), [
            'editorOptions' => [
                'preset' => 'full',
                'inline' => false,
            ],
        ]);
        ?>
    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 mt-2'>
        <?=
        $form->field($model, 'overview_arabic')->widget(CKEditor::className(), [
            'editorOptions' => [
                'preset' => 'full',
                'inline' => false,
            ],
        ]);
        ?>
    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 mt-2'>
        <?=
        $form->field($model, 'qualifications')->widget(CKEditor::className(), [
            'editorOptions' => [
                'preset' => 'full',
                'inline' => false,
            ],
        ]);
        ?>
    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 mt-2'>
        <?=
        $form->field($model, 'qualifications_arabic')->widget(CKEditor::className(), [
            'editorOptions' => [
                'preset' => 'full',
                'inline' => false,
            ],
        ]);
        ?>
    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 mt-2'>
        <?=
        $form->field($model, 'work_experience')->widget(CKEditor::className(), [
            'editorOptions' => [
                'preset' => 'full',
                'inline' => false,
            ],
        ]);
        ?>
    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 mt-2'>
        <?=
        $form->field($model, 'work_experience_arabic')->widget(CKEditor::className(), [
            'editorOptions' => [
                'preset' => 'full',
                'inline' => false,
            ],
        ]);
        ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?php
        $languages = yii\helpers\ArrayHelper::map(\common\models\Languages::find()->where(['status' => 1])->all(), 'id', 'language_name');
        if ($model->languages_known != '') {
            $model->languages_known = explode(',', $model->languages_known);
        }
        ?>
        <?=
        $form->field($model, 'languages_known')->widget(Select2::classname(), [
            'data' => $languages,
            'language' => 'en',
            'options' => ['placeholder' => 'Select', 'multiple' => true],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
        ?>
    </div>
    <div class='col-md-3 col-sm-3 col-xs-12 mt-2'>
        <?= $form->field($model, 'image')->fileInput()->hint('Dimensions : 300 * 380') ?>
        <?php
        if ($model->image != '' && $model->id != "") {
            echo '<img width="75" style="border: 2px solid #d2d2d2;margin-right:.5em;" src="' . Yii::$app->request->baseUrl . '/../uploads/doctors/' . $model->image . '?' . rand() . '" />';
            ?>
            <br>
            <br>
        <?php }
        ?>
    </div>
    <div class='col-md-3 col-sm-3 col-xs-12 mt-2'>
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