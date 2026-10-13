<?php
use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */
/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}
echo "<?php\n";
?>
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model
<?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
?>
<?= "<?php " ?>$form = ActiveForm::begin(); ?>
<div class="row">
    <?php
    foreach ($generator->getColumnNames() as $attribute) {
        if (in_array($attribute, $safeAttributes)) {
            echo "<div class='col-md-4 col-sm-6 col-xs-12 mt-2'>\n";
            echo "    <?= " . $generator->generateActiveField($attribute) . " ?>\n";
            echo "</div>\n";
        }
    }
    ?>
</div>
<div class="row">
    <div class='col-md-12 col-sm-12 col-xs-12 mt-4'>
        <div class="form-group">
            <?= "<?= " ?>Html::submitButton($model->isNewRecord ?
            <?= $generator->generateString('Create') ?> :
            <?= $generator->generateString('Update') ?>, ['class' => $model->isNewRecord ? 'btn btn-primary me-2' : 'btn
            btn-primary me-2', 'style' => 'float:right;']) ?>
        </div>
    </div>
</div>
<?= "<?php " ?>ActiveForm::end(); ?>