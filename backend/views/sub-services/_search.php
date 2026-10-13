<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SubServicesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sub-services-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'service') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'title_arabic') ?>

    <?= $form->field($model, 'small_description') ?>

    <?php // echo $form->field($model, 'small_description_arabic') ?>

    <?php // echo $form->field($model, 'section1_title') ?>

    <?php // echo $form->field($model, 'section1_title_arabic') ?>

    <?php // echo $form->field($model, 'section1_description') ?>

    <?php // echo $form->field($model, 'section1_description_arabic') ?>

    <?php // echo $form->field($model, 'section2_title') ?>

    <?php // echo $form->field($model, 'section2_title_arabic') ?>

    <?php // echo $form->field($model, 'section2_description') ?>

    <?php // echo $form->field($model, 'section2_description_arabic') ?>

    <?php // echo $form->field($model, 'section3_title') ?>

    <?php // echo $form->field($model, 'section3_title_arabic') ?>

    <?php // echo $form->field($model, 'section3_description') ?>

    <?php // echo $form->field($model, 'section3_description_arabic') ?>

    <?php // echo $form->field($model, 'section4_description') ?>

    <?php // echo $form->field($model, 'section4_description_arabic') ?>

    <?php // echo $form->field($model, 'image') ?>

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
