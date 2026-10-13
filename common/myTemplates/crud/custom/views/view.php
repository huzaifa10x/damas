<?php
use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */
$urlParams = $generator->generateUrlParams();
echo "<?php\n";
?>
use yii\helpers\Html;
use yii\widgets\DetailView;
/* @var $this yii\web\View */
/* @var $model
<?= ltrim($generator->modelClass, '\\') ?> */
$this->title = 'View
<?= Inflector::camel2words(StringHelper::basename($generator->modelClass)); ?> Details';
$this->params['breadcrumbs'][] = ['label' =>
<?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>,
'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-content">
    <nav class="page-breadcrumb align-items-center d-flex">
        <ol class="breadcrumb w-50 mb-0">
            <li class="breadcrumb-item"><a href="#">
                    <?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>
                </a></li>
            <li class="breadcrumb-item active" aria-current="page">
                <?= "<?= " ?>Html::encode($this->title) ?>
            </li>
        </ol>
        <div class="float-left d-flex  w-50">
            <?= "<?= " ?> Html::a('Manage
            <?= Inflector::camel2words(StringHelper::basename($generator->modelClass)); ?>', ['index'], ['class' => 'btn
            btn-primary m-1']) ?>
            <?= "<?= " ?>Html::a(
            <?= $generator->generateString('Update') ?>, ['update',
            <?= $urlParams ?>], ['class' => 'btn btn-secondary m-1']) ?>
            <?= "<?= " ?>Html::a(
            <?= $generator->generateString('Delete') ?>, ['delete',
            <?= $urlParams ?>], [
            'class' => 'btn btn-danger m-1',
            'data' => [
            'confirm' =>
            <?= $generator->generateString('Are you sure you want to delete this item?') ?>,
            'method' => 'post',
            ],
            ]) ?>
        </div>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <?= "<?= " ?>DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                    <?php
                    if (($tableSchema = $generator->getTableSchema()) === false) {
                        foreach ($generator->getColumnNames() as $name) {
                            echo "            '" . $name . "',\n";
                        }
                    } else {
                        foreach ($generator->getTableSchema()->columns as $column) {
                            $format = $generator->generateColumnFormat($column);
                            echo "            '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                        }
                    }
                    ?>
                    ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>