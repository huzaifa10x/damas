<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model
  common\models\LandingPageAbout */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'welcome_title')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'welcome_title_arabic')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'welcome_description')->textarea(['rows' => 6]) ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'welcome_description_arabic')->textarea(['rows' => 6]) ?>
    </div>

    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?=
        $form->field($model, 'about_description1')->widget(CKEditor::className(), [
            'options' => ['rows' => 6],
        ])
        ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?=
        $form->field($model, 'about_description1_arabic')->widget(CKEditor::className(), [
            'options' => ['rows' => 6],
        ])
        ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'about_image1')->fileInput()->hint('Dimensions : 380 * 515') ?>
        <?php
        if ($model->about_image1 != '' && $model->id != "") {
            echo '<img width="75" style="border: 2px solid #d2d2d2;margin-right:.5em;" src="' . Yii::$app->request->baseUrl . '/../uploads/landing-page-about/' . $model->about_image1 . '?' . rand() . '" />';
            ?>
            <br>
            <br>
        <?php }
        ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'about_image2')->fileInput()->hint('Dimensions : 285 * 385') ?>
        <?php
        if ($model->about_image2 != '' && $model->id != "") {
            echo '<img width="75" style="border: 2px solid #d2d2d2;margin-right:.5em;" src="' . Yii::$app->request->baseUrl . '/../uploads/landing-page-about/' . $model->about_image2 . '?' . rand() . '" />';
            ?>
            <br>
            <br>
        <?php }
        ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'about_description2_title')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'about_description2_title_arabic')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?=
        $form->field($model, 'about_description2')->widget(CKEditor::className(), [
            'options' => ['rows' => 6],
        ])
        ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?=
        $form->field($model, 'about_description2_arabic')->widget(CKEditor::className(), [
            'options' => ['rows' => 6],
        ])
        ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'about_description2_image')->fileInput()->hint('Dimensions : 550 * 585') ?>
        <?php
        if ($model->about_description2_image != '' && $model->id != "") {
            echo '<img width="75" style="border: 2px solid #d2d2d2;margin-right:.5em;" src="' . Yii::$app->request->baseUrl . '/../uploads/landing-page-about/' . $model->about_description2_image . '?' . rand() . '" />';
            ?>
            <br>
            <br>
        <?php }
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