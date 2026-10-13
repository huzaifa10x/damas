<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\About */
/* @var $form yii\widgets\ActiveForm */
?>


<?php $form = ActiveForm::begin(); ?>
<div class="row">
    <?php if ($model->type == 1) { ?>
        <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'value_arabic')->textInput(['maxlength' => true]) ?>
        </div>
    <?php } elseif ($model->type == 2) {
        ?>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'value')->fileInput(['accept' => 'image/png, image/gif, image/jpeg'])->label('Image') ?>
            <?php
            if ($model->value != '' && $model->id != "") {
                $id = Yii::$app->EncryptDecrypt->encrypt('encrypt', $model->id);
                echo '<img width="75" style="border: 2px solid #d2d2d2;margin-right:.5em;" src="' . Yii::$app->request->baseUrl . '/../uploads/about/' . $model->value . '?' . rand() . '" />';
                ?>
                <br>
                <br>
            <?php }
            ?>
        </div>
    <?php } elseif ($model->type == 3) {
        ?>

        <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
            <?=
            $form->field($model, 'value')->widget(CKEditor::className(), [
                'editorOptions' => [
                    'preset' => 'full', 
                    'inline' => false, 
                ],
            ]);
            ?>
        </div>
        <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
            <?=
            $form->field($model, 'value_arabic')->widget(CKEditor::className(), [
                'editorOptions' => [
                    'preset' => 'full', 
                    'inline' => false, 
                ],
            ]);
            ?>
        </div>
    <?php } elseif ($model->type == 4) { ?>
        <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'value')->textarea(['rows' => 3]) ?>
        </div>
        <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'value_arabic')->textarea(['rows' => 3]) ?>
        </div>
    <?php } elseif ($model->type == 5) { ?>
        <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'value')->textInput(['maxlength' => true, 'type' => 'number']) ?>
        </div>
    <?php } elseif ($model->type == 6) {
        ?>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'value')->fileInput(['accept' => 'video/mp4,video/x-m4v,video/*'])->label('Video') ?>
            <?php
        if ($model->value != '' && $model->id != "") {
            echo '<video width="200" height="100" controls><source src="' . Yii::$app->request->baseUrl . '/../uploads/about/' . $model->value . '?' . rand() . '" type="video/mp4"><source src="movie.ogg" type="video/ogg">Your browser does not support the video tag.</video>';
            ?>
            <br>
        <?php }
        ?>
        </div>
    <?php }elseif ($model->type == 7) { ?>
        <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
            <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>
        </div>
    <?php }
    ?>
</div>
<div class="row">
    <div class='col-md-12 col-sm-12 col-xs-12'>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success mb-1 mb-md-0', 'style' => 'float:right;']) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>

