<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model
  common\models\MediaLibrary */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class='col-md-4 col-sm-6 col-xs-12 mt-2'>
        <?php
        $departments = \common\models\Departments::find()->all();
        ?>
        <?= $form->field($model, 'department')->dropDownList(\yii\helpers\ArrayHelper::map($departments, 'id', 'department_name'), ['prompt' => '--Select--']) ?>
    </div>
    <div class='col-md-4 col-sm-6 col-xs-12 mt-2'>
        <?php
        $services = \common\models\Services::find()->all();
        ?>
        <?= $form->field($model, 'service')->dropDownList(\yii\helpers\ArrayHelper::map($services, 'id', 'service_name'), ['prompt' => '--Select--']) ?>
    </div>
    <div class='col-md-4 col-sm-6 col-xs-12 mt-2'>
        <?php
        $categories = \common\models\MediaLibraryCategory::find()->all();
        ?>
        <?= $form->field($model, 'category')->dropDownList(\yii\helpers\ArrayHelper::map($categories, 'id', 'category_name'), ['prompt' => '--Select--']) ?>
    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 mt-2'>
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 mt-2'>
        <?= $form->field($model, 'title_arabic')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-3 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'document')->fileInput() ?>
        <?php
        if ($model->document != '' && $model->id != "") {
            echo '<a href="' . Yii::$app->request->baseUrl . '/../uploads/media-library/' . $model->document . '?' . rand() . '" >View Document</a>';
            ?>
            <br>
        <?php }
        ?>
    </div>
    <div class='col-md-3 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'image')->fileInput()->hint('Dimensions : 430 * 290') ?>
        <?php
        if ($model->image != '' && $model->id != "") {
            echo '<img width="75" style="border: 2px solid #d2d2d2;margin-right:.5em;" src="' . Yii::$app->request->baseUrl . '/../uploads/media-library/' . $model->image . '?' . rand() . '" />';
            ?>
            <br>
        <?php }
        ?>
    </div>
    <div class='col-md-3 col-sm-6 col-xs-12 mt-2'>
        <?php
        if (!$model->isNewRecord) {
            $model->posted_date = date('d-m-Y', strtotime($model->posted_date));
        } else {
            $model->posted_date = date('d-m-Y');
        }


        echo $form->field($model, 'posted_date')->widget(DatePicker::className(), [
            'type' => DatePicker::TYPE_INPUT,
            'pluginOptions' => [
                'format' => 'dd-mm-yyyy',
                'autoclose' => true,
                'todayHighlight' => true,
            ]
        ])
        ?>
    </div>
    <div class='col-md-3 col-sm-6 col-xs-12 mt-2'>
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