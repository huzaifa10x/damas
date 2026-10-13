<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model
  common\models\Banners */
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
        <?= $form->field($model, 'description')->textarea(['rows' => 2]) ?>
    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 mt-2'>
        <?= $form->field($model, 'description_arabic')->textarea(['rows' => 2]) ?>
    </div>
    <div class='col-md-4 col-sm-4 col-xs-12 mt-2'>
        <?= $form->field($model, 'image')->fileInput()->hint('Dimensions : 1920 * 680') ?>
        <?php
        if ($model->image != '' && $model->id != "") {
            echo '<img width="75" style="border: 2px solid #d2d2d2;margin-right:.5em;" src="' . Yii::$app->request->baseUrl . '/../uploads/banners/' . $model->image . '?' . rand() . '" />';
            ?>
            <br>
            <?php }
            ?>
    </div>
    <div class='col-md-4 col-sm-4 col-xs-12 mt-2'>
        <?= $form->field($model, 'image_arabic')->fileInput()->hint('Dimensions : 1920 * 680') ?>
        <?php
        if ($model->image_arabic != '' && $model->id != "") {
            echo '<img width="75" style="border: 2px solid #d2d2d2;margin-right:.5em;" src="' . Yii::$app->request->baseUrl . '/../uploads/banners/' . $model->image_arabic . '?' . rand() . '" />';
            ?>
            <br>
            <?php }
            ?>
    </div>
    <div class='col-md-4 col-sm-4 col-xs-12 mt-2'>
        <?= $form->field($model, 'video')->fileInput() ?>
        <?php
        if ($model->video != '' && $model->id != "") {
            ?>
            <div class="img-box-3" style="border: 2px solid #d2d2d2;margin-right:.5em;width: 220px;padding: 4px;position: relative;">
                <?php
                echo '<video width="200" height="100" controls><source src="' . Yii::$app->request->baseUrl . '/../uploads/banners/' . $model->video . '?' . rand() . '" type="video/mp4"><source src="movie.ogg" type="video/ogg">Your browser does not support the video tag.</video>';
                ?>
                <a href="javascript:void(0);" class="remove-file" data-id="<?= $model->id ?>" data-param="video" style="position: absolute;top: -5px;color: red;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-delete"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
                </a>
            </div>
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
<script>
    $(document).ready(function () {

        $(document).on("click", ".remove-file", function (e) {
            var id = $(this).attr('data-id');
            var param = $(this).attr('data-param');
            $.ajax({
                type: 'POST',
                cache: false,
                data: {
                    id: id,
                    param: param
                },
                url: "<?= Yii::$app->homeUrl ?>banners/remove-file",
                success: function (data) {
                    if (data == 1) {
                        $(".img-box-3").remove();
                    }
                }
            });
        });

    });
</script>