<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\DepartmentVideos */
/* @var $form yii\widgets\ActiveForm */
?>


<?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class='col-md-3 col-sm-6 col-xs-12 left_padd img-div'>
        <?= $form->field($model, 'desktop_image')->fileInput()->hint('Dimensions : 375 * 235') ?>
        <?php
        if ($model->desktop_image != '' && $model->id != "") {
            echo '<img width="75" style="border: 2px solid #d2d2d2;margin-right:.5em;" src="' . Yii::$app->request->baseUrl . '/../uploads/landing-page-banners/' . $model->desktop_image . '?' . rand() . '" />';
            ?>
            <br>
            <br>
        <?php }
        ?>
    </div>
    <div class='col-md-3 col-sm-6 col-xs-12 left_padd img-div'>
        <?= $form->field($model, 'mobile_image')->fileInput()->hint('Dimensions : 1920 * 715') ?>
        <?php
        if ($model->mobile_image != '' && $model->id != "") {
            echo '<img width="75" style="border: 2px solid #d2d2d2;margin-right:.5em;" src="' . Yii::$app->request->baseUrl . '/../uploads/landing-page-banners/' . $model->mobile_image . '?' . rand() . '" />';
            ?>
            <br>
            <br>
        <?php }
        ?>
    </div>
    
    <div class='col-md-3 col-sm-6 col-xs-12 left_padd video-div'>
        <?= $form->field($model, 'video')->fileInput() ?>
        <?php
        if ($model->video != '' && $model->id != "") {
            echo '<video width="200" height="100" controls><source src="' . Yii::$app->request->baseUrl . '/../uploads/home-banners/' . $model->video . '?' . rand() . '" type="video/mp4"><source src="movie.ogg" type="video/ogg">Your browser does not support the video tag.</video>';
            ?>
            <br>
            <br>
        <?php }
        ?>
    </div>
    <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
        <?= $form->field($model, 'status')->dropDownList(['1' => 'Active', '0' => 'Inactive']) ?>
    </div>
    
    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'title_arabic')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-3 col-sm-6 col-xs-12'>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success mb-1 mb-md-0', 'style' => 'margin-top:30px;']) ?>
            <?php if (!$model->isNewRecord) { ?>
                <?= Html::a('<span> Reset</span>', ['banner', 'page_id' => $page_id], ['class' => 'btn btn-primary', 'style' => 'margin-top:30px;']) ?>
            <?php }
            ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>

