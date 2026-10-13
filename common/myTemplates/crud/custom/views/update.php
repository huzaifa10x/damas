<?php
use yii\helpers\Inflector;
use yii\helpers\StringHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */
$urlParams = $generator->generateUrlParams();
echo "<?php\n";
?>
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model
<?= ltrim($generator->modelClass, '\\') ?> */
$this->title =
<?= $generator->generateString('Update {modelClass}: ', ['modelClass' => Inflector::camel2words(StringHelper::basename($generator->modelClass))]) ?>
. $model->
<?= $generator->getNameAttribute() ?>;
$this->params['breadcrumbs'][] = ['label' =>
<?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>,
'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->
<?= $generator->getNameAttribute() ?>, 'url' => ['view',
<?= $urlParams ?>]];
$this->params['breadcrumbs'][] =
<?= $generator->generateString('Update') ?>;
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
            <?= Inflector::camel2words(StringHelper::basename($generator->modelClass)); ?>',
            ['index'], ['class' => 'btn btn-outline-primary ml-auto','style' => 'margin-left: auto;',]) ?>
        </div>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <?= "<?= " ?>$this->render('_form', [
                    'model' => $model,
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>