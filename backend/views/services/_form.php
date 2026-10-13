<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model
  common\models\Services */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?php
        $departments = \common\models\Departments::find()->all();
        ?>
        <?= $form->field($model, 'department')->dropDownList(\yii\helpers\ArrayHelper::map($departments, 'id', 'department_name'), ['prompt' => '--Select--']) ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>
        <?= $form->field($model, 'service_name')->textInput(['maxlength' => true, 'class' => 'form-control slug-change']) ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>
        <?= $form->field($model, 'service_name_arabic')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>
        <?= $form->field($model, 'canonical_name')->textInput(['maxlength' => true, 'class' => 'form-control slug']) ?>
    </div>
    <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
        <?= $form->field($model, 'service_image')->fileInput()->hint('Dimensions : 315 * 450') ?>
        <?php
        if ($model->service_image != '' && $model->id != "") {
            echo '<img width="75" style="border: 2px solid #d2d2d2;margin-right:.5em;" src="' . Yii::$app->request->baseUrl . '/../uploads/services/' . $model->service_image . '?' . rand() . '" />';
            ?>
            <br>
            <br>
        <?php }
        ?>
    </div>
    <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
        <?= $form->field($model, 'banner_image')->fileInput()->hint('Dimensions : 1920 * 715') ?>
        <?php
        if ($model->banner_image != '' && $model->id != "") {
            echo '<img width="75" style="border: 2px solid #d2d2d2;margin-right:.5em;" src="' . Yii::$app->request->baseUrl . '/../uploads/services/' . $model->banner_image . '?' . rand() . '" />';
            ?>
            <br>
            <br>
        <?php }
        ?>
    </div>
    <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
        <?= $form->field($model, 'banner_image_arabic')->fileInput()->hint('Dimensions : 1920 * 715') ?>
        <?php
        if ($model->banner_image_arabic != '' && $model->id != "") {
            echo '<img width="75" style="border: 2px solid #d2d2d2;margin-right:.5em;" src="' . Yii::$app->request->baseUrl . '/../uploads/services/' . $model->banner_image_arabic . '?' . rand() . '" />';
            ?>
            <br>
            <br>
        <?php }
        ?>
    </div>
    <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
        <?= $form->field($model, 'banner_video')->fileInput() ?>
        <?php
        if ($model->banner_video != '' && $model->id != "") {
            echo '<video width="200" height="100" controls><source src="' . Yii::$app->request->baseUrl . '/../uploads/services/' . $model->banner_video . '?' . rand() . '" type="video/mp4"><source src="movie.ogg" type="video/ogg">Your browser does not support the video tag.</video>';
            ?>
            <br>
        <?php }
        ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>
        <?= $form->field($model, 'banner_description')->textarea(['rows' => 2]) ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>
        <?= $form->field($model, 'banner_description_arabic')->textarea(['rows' => 2]) ?>
    </div>

    <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
        <?=
        $form->field($model, 'service_description')->widget(CKEditor::className(), [
            'editorOptions' => [
                'preset' => 'full',
                'inline' => false,
            ],
        ]);
        ?>
    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
        <?=
        $form->field($model, 'service_description_arabic')->widget(CKEditor::className(), [
            'editorOptions' => [
                'preset' => 'full',
                'inline' => false,
            ],
        ]);
        ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>
        <?= $form->field($model, 'section3_title')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>
        <?= $form->field($model, 'section3_title_arabic')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
        <?=
        $form->field($model, 'section3_description')->widget(CKEditor::className(), [
            'editorOptions' => [
                'preset' => 'full',
                'inline' => false,
            ],
        ]);
        ?>
    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
        <?=
        $form->field($model, 'section3_description_arabic')->widget(CKEditor::className(), [
            'editorOptions' => [
                'preset' => 'full',
                'inline' => false,
            ],
        ]);
        ?>
    </div>
    <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
        <?= $form->field($model, 'section3_image')->fileInput()->hint('Dimensions : 765 * 655') ?>
        <?php
        if ($model->section3_image != '' && $model->id != "") {
            ?>
            <div class="img-box-3" style="border: 2px solid #d2d2d2;margin-right:.5em;width: 80px;padding: 4px;position: relative;">
                <img style="width: -webkit-fill-available;" src="<?= Yii::$app->request->baseUrl ?>/../uploads/services/<?= $model->section3_image ?>?<?= rand() ?>"/>
                <a href="javascript:void(0);" class="remove-image" data-id="<?= $model->id ?>" data-param="section3_image" style="position: absolute;top: -5px;color: red;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-delete"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
                </a>
            </div>
            <br>
            <br>
        <?php }
        ?>
    </div>
    <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
        <?= $form->field($model, 'section4_title')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
        <?= $form->field($model, 'section4_title_arabic')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>
        <?= $form->field($model, 'section4_description')->textarea(['rows' => 4]) ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>
        <?= $form->field($model, 'section4_description_arabic')->textarea(['rows' => 4]) ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>
        <?= $form->field($model, 'sub_service_title')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>
        <?= $form->field($model, 'sub_service_title_arabic')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-6 col-sm-12 col-xs-12 left_padd'>
        <?=
        $form->field($model, 'sub_service_description')->widget(CKEditor::className(), [
            'editorOptions' => [
                'preset' => 'full',
                'inline' => false,
            ],
        ]);
        ?>
    </div>
    <div class='col-md-6 col-sm-12 col-xs-12 left_padd'>
        <?=
        $form->field($model, 'sub_service_description_arabic')->widget(CKEditor::className(), [
            'editorOptions' => [
                'preset' => 'full',
                'inline' => false,
            ],
        ]);
        ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>
        <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>
        <?= $form->field($model, 'meta_keyword')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>
        <?= $form->field($model, 'meta_description')->textarea(['rows' => 2]) ?>
    </div>
    
    <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>
        <?= $form->field($model, 'meta_title_ar')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>
        <?= $form->field($model, 'meta_keyword_ar')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>
        <?= $form->field($model, 'meta_description_ar')->textarea(['rows' => 2]) ?>
    </div>
    
    <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
        <?= $form->field($model, 'sort_order')->textInput(['type' => 'number']) ?>
    </div>
    <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
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

        $(document).on("click", ".remove-image", function (e) {
            var id = $(this).attr('data-id');
            var param = $(this).attr('data-param');
            $.ajax({
                type: 'POST',
                cache: false,
                data: {
                    id: id,
                    param: param
                },
                url: "<?= Yii::$app->homeUrl ?>services/remove-image",
                success: function (data) {
                    if (data == 1) {
                        $(".img-box-3").remove();
                    }
                }
            });
        });

    });
</script>