<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model
  common\models\TreatmentResultsGallery */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
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
            'options' => ['placeholder' => 'Select'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
        ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?php
        if (!$model->isNewRecord && $model->department != '') {
            $services = yii\helpers\ArrayHelper::map(\common\models\Services::find()->where(['status' => 1, 'department' => $model->department])->all(), 'id', 'service_name');
        } else {
            $services = yii\helpers\ArrayHelper::map(\common\models\Services::find()->where(['status' => 1])->all(), 'id', 'service_name');
        }
        if ($model->service != '') {
            $model->service = explode(',', $model->service);
        }
        ?>
        <?=
        $form->field($model, 'service')->widget(Select2::classname(), [
            'data' => $services,
            'language' => 'en',
            'options' => ['placeholder' => 'Select'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
        ?>
    </div>
    <div class='col-md-4 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'before_image')->fileInput()->hint('Dimensions : 320 * 320') ?>
        <?php
        if ($model->before_image != '' && $model->id != "") {
            echo '<img width="75" style="border: 2px solid #d2d2d2;margin-right:.5em;" src="' . Yii::$app->request->baseUrl . '/../uploads/treatment-gallery/' . $model->before_image . '?' . rand() . '" />';
            ?>
            <br>
        <?php }
        ?>
    </div>
    <div class='col-md-4 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'after_image')->fileInput()->hint('Dimensions : 320 * 320') ?>
        <?php
        if ($model->after_image != '' && $model->id != "") {
            echo '<img width="75" style="border: 2px solid #d2d2d2;margin-right:.5em;" src="' . Yii::$app->request->baseUrl . '/../uploads/treatment-gallery/' . $model->after_image . '?' . rand() . '" />';
            ?>
            <br>
        <?php }
        ?>
    </div>
    <div class='col-md-4 col-sm-6 col-xs-12 mt-2'>
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
<script>
    $(document).ready(function () {

        $(document).on("change", "#treatmentresultsgallery-department", function (e) {
            e.preventDefault();
                var department = $(this).val();
                if (department != '') {
                    $.ajax({
                        type: 'POST',
                        cache: false,
                        data: {department: department},
                        url: "<?= Yii::$app->homeUrl ?>services/get-services",
                        success: function (data) {
                                $("#treatmentresultsgallery-service").html(data);
                        }
                    });
                }
        });
    });
</script>