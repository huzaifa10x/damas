<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\LandingPagesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="landing-pages-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'title_arabic') ?>

    <?= $form->field($model, 'canonical_name') ?>

    <?= $form->field($model, 'phone_no') ?>

    <?php // echo $form->field($model, 'whatsapp_no') ?>

    <?php // echo $form->field($model, 'is_enable_banner') ?>

    <?php // echo $form->field($model, 'is_enable_about') ?>

    <?php // echo $form->field($model, 'is_enable_video_banner') ?>

    <?php // echo $form->field($model, 'is_enable_gallery') ?>

    <?php // echo $form->field($model, 'is_enable_our_video') ?>

    <?php // echo $form->field($model, 'is_enable_services') ?>

    <?php // echo $form->field($model, 'is_enable_appointment') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
