<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model
  common\models\LangingPageVideoSection */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'title_arabic')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'description')->textarea(['rows' => 4]) ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'description_arabic')->textarea(['rows' => 4]) ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'image')->fileInput()->hint('Dimensions : 1920 * 500') ?>
        <?php
        if ($model->image != '' && $model->id != "") {
            echo '<img width="75" style="border: 2px solid #d2d2d2;margin-right:.5em;" src="' . Yii::$app->request->baseUrl . '/../uploads/landing-page-video-section/' . $model->image . '?' . rand() . '" />';
            ?>
            <br>
            <br>
        <?php }
        ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'video')->fileInput() ?>
        <?php
        if ($model->video != '' && $model->id != "") {
            echo '<video width="200" height="100" controls><source src="' . Yii::$app->request->baseUrl . '/../uploads/landing-page-video-section/' . $model->video . '?' . rand() . '" type="video/mp4"><source src="movie.ogg" type="video/ogg">Your browser does not support the video tag.</video>';
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