<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ServicesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="services-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'department') ?>

    <?= $form->field($model, 'service_name') ?>

    <?= $form->field($model, 'service_name_arabic') ?>

    <?= $form->field($model, 'canonical_name') ?>

    <?php // echo $form->field($model, 'banner_image') ?>

    <?php // echo $form->field($model, 'banner_description') ?>

    <?php // echo $form->field($model, 'banner_description_arabic') ?>

    <?php // echo $form->field($model, 'service_image') ?>

    <?php // echo $form->field($model, 'service_description') ?>

    <?php // echo $form->field($model, 'service_description_arabic') ?>

    <?php // echo $form->field($model, 'section3_title') ?>

    <?php // echo $form->field($model, 'section3_title_arabic') ?>

    <?php // echo $form->field($model, 'section3_description') ?>

    <?php // echo $form->field($model, 'section3_description_arabic') ?>

    <?php // echo $form->field($model, 'section3_image') ?>

    <?php // echo $form->field($model, 'section4_title') ?>

    <?php // echo $form->field($model, 'section4_title_arabic') ?>

    <?php // echo $form->field($model, 'section4_description') ?>

    <?php // echo $form->field($model, 'section4_description_arabic') ?>

    <?php // echo $form->field($model, 'section7_title') ?>

    <?php // echo $form->field($model, 'section7_title_arabic') ?>

    <?php // echo $form->field($model, 'section7_description') ?>

    <?php // echo $form->field($model, 'section7_description_arabic') ?>

    <?php // echo $form->field($model, 'meta_title') ?>

    <?php // echo $form->field($model, 'meta_keyword') ?>

    <?php // echo $form->field($model, 'meta_description') ?>

    <?php // echo $form->field($model, 'other_meta_tags') ?>

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
