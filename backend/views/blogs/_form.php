<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model
  common\models\Blogs */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?php
        $departments = \common\models\Departments::find()->all();
        ?>
        <?= $form->field($model, 'department_id')->dropDownList(\yii\helpers\ArrayHelper::map($departments, 'id', 'department_name'), ['prompt' => '--Select--']) ?>
    </div>
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
        <?= $form->field($model, 'main_image')->fileInput()->hint('Dimensions : 1375 * 785') ?>
        <?php
        if ($model->main_image != '' && $model->id != "") {
            echo '<img width="75" style="border: 2px solid #d2d2d2;margin-right:.5em;" src="' . Yii::$app->request->baseUrl . '/../uploads/blogs/' . $model->main_image . '?' . rand() . '" />';
            ?>
            <br>
        <?php }
        ?>
    </div>
    <div class='col-md-3 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'image1')->fileInput()->hint('Dimensions : 660 * 360') ?>
        <?php
        if ($model->image1 != '' && $model->id != "") {
            echo '<img width="75" style="border: 2px solid #d2d2d2;margin-right:.5em;" src="' . Yii::$app->request->baseUrl . '/../uploads/blogs/' . $model->image1 . '?' . rand() . '" />';
            ?>
            <br>
        <?php }
        ?>
    </div>
    <div class='col-md-3 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'image2')->fileInput()->hint('Dimensions : 660 * 360') ?>
        <?php
        if ($model->image2 != '' && $model->id != "") {
            echo '<img width="75" style="border: 2px solid #d2d2d2;margin-right:.5em;" src="' . Yii::$app->request->baseUrl . '/../uploads/blogs/' . $model->image2 . '?' . rand() . '" />';
            ?>
            <br>
        <?php }
        ?>
    </div>
    <div class='col-md-3 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'video')->fileInput() ?>
        <?php
        if ($model->video != '' && $model->id != "") {
            echo '<video width="200" height="100" controls><source src="' . Yii::$app->request->baseUrl . '/../uploads/blogs/' . $model->video . '?' . rand() . '" type="video/mp4"><source src="movie.ogg" type="video/ogg">Your browser does not support the video tag.</video>';
            ?>
            <br>
        <?php }
        ?>
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
    <div class='col-md-2 col-sm-6 col-xs-12 mt-2'>
        <?php
        if (!$model->isNewRecord) {
            $model->date = date('d-m-Y', strtotime($model->date));
        } else {
            $model->date = date('d-m-Y');
        }


        echo $form->field($model, 'date')->widget(DatePicker::className(), [
            'type' => DatePicker::TYPE_INPUT,
            'pluginOptions' => [
                'format' => 'dd-mm-yyyy',
                'autoclose' => true,
                'todayHighlight' => true,
            ]
        ])
        ?>
    </div>
    <div class='col-md-5 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-5 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'meta_keyword')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-8 col-sm-8 col-xs-12 mt-2'>
        <?= $form->field($model, 'meta_description')->textarea(['rows' => 2]) ?>
    </div>
    <div class='col-md-4 col-sm-4 col-xs-12 mt-2'>
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