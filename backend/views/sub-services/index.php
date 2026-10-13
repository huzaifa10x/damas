<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SubServicesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Sub Services';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-content">
    <nav class="page-breadcrumb align-items-center d-flex">
        <ol class="breadcrumb w-50 mb-0">
             <li class="breadcrumb-item"><a href="<?= Yii::$app->homeUrl ?>">
                    Dashboard                </a></li>
            <li class="breadcrumb-item">
                <?=  Html::a('
                Services', ['index', 's_id' => $s_id]) ?>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Sub Services </li>
        </ol>
        <div class="float-left d-flex  w-50">
            <?=
            Html::a('<span> Add
                Sub Services            </span>', ['create', 's_id' => $s_id], ['class' =>
                'btn btn-outline-primary ml-auto', 'style' => 'margin-left: auto;',])
            ?>
        </div>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">
                        <?= Html::encode($this->title) ?> : <?= $service->service_name ?>
                    </h4>
                    <div id="wizard" role="application" class="wizard clearfix">
                        <div class="steps clearfix"><ul role="tablist">
                                <li role="tab" class="disabled" aria-disabled="true">
                                    <a id="wizard-t-0" href="<?= Url::to(['services/update', 'id' => $s_id]); ?>">
                                        <span class="current-info audible">current step: </span>
                                        Service Details
                                    </a></li>
                                <li role="tab" class="disabled" aria-disabled="true">
                                    <a id="wizard-t-1" href="<?= Url::to(['service-videos/index', 's_id' => $s_id]); ?>">
                                        Service Videos
                                    </a>
                                </li>
                                <li role="tab" class="disabled" aria-disabled="true">
                                    <a id="wizard-t-2" href="<?= Url::to(['service-treatment-results/index', 's_id' => $s_id]); ?>">
                                        Service Treatment Results
                                    </a>
                                </li>
                                <li role="tab" class="disabled" aria-disabled="true">
                                    <a id="wizard-t-3" href="<?= Url::to(['service-pros-and-cons/index', 's_id' => $s_id]); ?>">
                                        Service Pros & Cons
                                    </a>
                                </li>
                                <li role="tab" class="current" aria-disabled="false" aria-selected="true">
                                    <a id="wizard-t-3" href="<?= Url::to(['sub-services/index', 's_id' => $s_id]); ?>">
                                        Sub Services
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <?= \common\widgets\Alert::widget() ?>
                    <div class="table-responsive">
                        <div id="zero_configuration_table_wrapper"
                             class="dataTables_wrapper container-fluid dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <?php
                                    // echo
                                    $this->render('_search', ['model' => $searchModel]);
                                    ?>
                                    <?=
                                    GridView::widget([
                                        'dataProvider' => $dataProvider,
                                        'filterModel' => $searchModel,
                                        'columns' => [
                                                ['class' => 'yii\grid\SerialColumn'],
                                            'title',
                                                [
                                                'attribute' => 'image',
                                                'format' => 'raw',
                                                'value' => function ($data) {
                                                    $img = '';
                                                    if (!empty($data->image))
                                                        $img = '<img width="75" style = "border: 2px solid #d2d2d2;margin-right:.5em;" src="' . Yii::$app->homeUrl . '../uploads/sub-services/' . $data->image . '?' . rand() . '"/>';
                                                    return $img;
                                                },
                                            ],
                                                [
                                                'attribute' => 'status',
                                                'format' => 'raw',
                                                'value' => function($model, $key, $index, $column) {
                                                    if ($model->status == 1) {
                                                        return 'Active';
                                                    } else {
                                                        return 'Inactive';
                                                    }
                                                },
                                                'filter' => [1 => 'Active', 0 => 'Inactive'],
                                            ],
                                                [
                                                'class' => 'yii\grid\ActionColumn',
                                                'contentOptions' => ['class' => 'action-head two'],
                                                'headerOptions' => ['class' => 'action-column'],
                                                'header' => 'Actions',
                                                'template' => '{update}{delete}',
                                                'buttons' => [
                                                    'update' => function ($url, $model) {
                                                        return Html::a('<i data-feather="edit"></i>', $url, [
                                                                    'title' => Yii::t('app', 'update'),
                                                                    'class' => 'btn btn-outline-primary btn-xs',
                                                        ]);
                                                    },
                                                    'delete' => function ($url, $model) {
                                                        return Html::a('<i data-feather="trash"></i>', $url, [
                                                                    'title' => Yii::t('app', 'delete'),
                                                                    'class' => 'btn btn-outline-danger btn-xs',
                                                                    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete?'),
                                                                    'data-method' => 'post',
                                                        ]);
                                                    },
                                                ],
                                                'urlCreator' => function ($action, $model)use($s_id) {
                                                    if ($action === 'update') {
                                                        $url = Url::to(['update', 's_id' => $s_id, 'id' => $model->id]);
                                                        return $url;
                                                    }
                                                    if ($action === 'delete') {
                                                        $url = Url::to(['delete', 's_id' => $s_id, 'id' => $model->id]);
                                                        return $url;
                                                    }
                                                }
                                            ],
                                        ],
                                    ]);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>