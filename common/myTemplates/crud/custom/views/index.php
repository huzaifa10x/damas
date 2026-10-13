<?php
use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */
$urlParams = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();
echo "<?php\n";
?>
use yii\helpers\Html;
use
<?= $generator->indexWidgetType === 'grid' ? "yii\\grid\\GridView" : "yii\\widgets\\ListView" ?>;
<?= $generator->enablePjax ? 'use yii\widgets\Pjax;' : '' ?>
/* @var $this yii\web\View */
<?= !empty($generator->searchModelClass) ? "/* @var \$searchModel " . ltrim($generator->searchModelClass, '\\') . " */\n" : '' ?>
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title =
<?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-content">
    <nav class="page-breadcrumb align-items-center d-flex">
        <ol class="breadcrumb w-50 mb-0">
            <li class="breadcrumb-item"><a href="#">
                    <?= Inflector::camel2words(StringHelper::basename($generator->modelClass)); ?>
                </a></li>
            <li class="breadcrumb-item active" aria-current="page">Index</li>
        </ol>
        <div class="float-left d-flex  w-50">
            <?= "<?= " ?> Html::a('<span> Create
                <?= Inflector::camel2words(StringHelper::basename($generator->modelClass)); ?>
            </span>', ['create'], ['class' =>
            'btn btn-outline-primary ml-auto','style' => 'margin-left: auto;',]) ?>
        </div>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">
                        <?= "<?= " ?>Html::encode($this->title) ?>
                    </h4>
                    <div class="table-responsive">
                        <div id="zero_configuration_table_wrapper"
                            class="dataTables_wrapper container-fluid dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <?php if (!empty($generator->searchModelClass)): ?>
                                        <?= "    <?php " . ($generator->indexWidgetType === 'grid' ? "// " : "") ?>echo
                                        $this->render('_search', ['model' => $searchModel]); ?>
                                    <?php endif; ?>
                                    <?= $generator->enablePjax ? '<?php Pjax::begin(); ?>' : '' ?>
                                    <?php if ($generator->indexWidgetType === 'grid'): ?>
                                        <?= "<?= " ?>GridView::widget([
                                        'dataProvider' => $dataProvider,
                                        <?= !empty($generator->searchModelClass) ? "'filterModel' => \$searchModel,\n        'columns' => [\n" : "'columns' => [\n"; ?>
                                        ['class' => 'yii\grid\SerialColumn'],
                                        <?php
                                        $count = 0;
                                        if (($tableSchema = $generator->getTableSchema()) === false) {
                                            foreach ($generator->getColumnNames() as $name) {
                                                if (++$count < 6) {
                                                    echo "            '" . $name . "',\n";
                                                } else {
                                                    echo "            // '" . $name . "',\n";
                                                }
                                            }
                                        } else {
                                            foreach ($tableSchema->columns as $column) {
                                                $format = $generator->generateColumnFormat($column);
                                                if (++$count < 6) {
                                                    echo "            '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                                                } else {
                                                    echo "            // '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                                                }
                                            }
                                        }
                                        ?>
                                        ['class' => 'yii\grid\ActionColumn'],
                                        ],
                                        ]); ?>
                                    <?php else: ?>
                                        <?= "<?= " ?>ListView::widget([
                                        'dataProvider' => $dataProvider,
                                        'itemOptions' => ['class' => 'item'],
                                        'itemView' => function ($model, $key, $index, $widget) {
                                        return Html::a(Html::encode($model->
                                        <?= $nameAttribute ?>), ['view',
                                        <?= $urlParams ?>]);
                                        },
                                        ]) ?>
                                    <?php endif; ?>
                                    <?= $generator->enablePjax ? '<?php Pjax::end(); ?>' : '' ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>