<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\DoctorsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="doctors-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'department') ?>

    <?= $form->field($model, 'doctor_name') ?>

    <?= $form->field($model, 'doctor_name_arabic') ?>

    <?= $form->field($model, 'designation') ?>

    <?php // echo $form->field($model, 'designation_arabic') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'languages_known') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'description_arabic') ?>

    <?php // echo $form->field($model, 'overview') ?>

    <?php // echo $form->field($model, 'overview_arabic') ?>

    <?php // echo $form->field($model, 'qualifications') ?>

    <?php // echo $form->field($model, 'qualifications_arabic') ?>

    <?php // echo $form->field($model, 'work_experience') ?>

    <?php // echo $form->field($model, 'work_experience_arabic') ?>

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
