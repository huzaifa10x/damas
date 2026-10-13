<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\date\DatePicker;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\OrderMasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-content">
    <nav class="page-breadcrumb align-items-center d-flex">
        <ol class="breadcrumb w-50 mb-0">
            <li class="breadcrumb-item"><a href="<?= Yii::$app->homeUrl ?>">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">
                    Orders                </a></li>
        </ol>
        <div class="float-left d-flex  w-50">
        </div>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">
                        <?= Html::encode($this->title) ?>
                    </h4>
                    <div class="table-responsive">
                        <div id="zero_configuration_table_wrapper"
                             class="dataTables_wrapper container-fluid dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <?php
                                    $gridColumns = [
                                            ['class' => 'yii\grid\SerialColumn'],
                                        'order_id',
                                            [
                                            'attribute' => 'order_date',
                                            'filter' => DatePicker::widget([
                                                'model' => $searchModel,
                                                'attribute' => 'order_date',
                                                'pluginOptions' => [
                                                    'format' => 'yyyy-mm-dd',
                                                ]
                                            ]),
                                            'value' => function ($data) {
                                                return date("d-m-Y", strtotime($data->order_date));
                                            },
                                        ],
                                        'name',
                                        'email:email',
                                        'net_amount',
                                            [
                                            'attribute' => 'payment_status',
                                            'value' => function($model, $key, $index, $column) {
                                                if ($model->payment_status == 2) {
                                                    return 'Cash on delivery';
                                                } elseif ($model->payment_status == 1) {
                                                    return 'Paid';
                                                } else {
                                                    return 'Pending';
                                                }
                                            },
                                            'filter' => [1 => 'Paid', 0 => 'Pending', 2 => 'Cash on delivery'], 'filterInputOptions' => ['class' => 'form-control', 'prompt' => 'All'],
                                        ],
                                            [
                                            'class' => 'yii\grid\ActionColumn',
                                            'contentOptions' => ['class' => 'action-head one'],
                                            'headerOptions' => ['class' => 'action-column'],
                                            'header' => 'Actions',
                                            'template' => '{view}',
                                            'buttons' => [
                                                'view' => function ($url, $model) {
                                                    return Html::a('<i data-feather="eye"></i>', $url, [
                                                                'title' => Yii::t('app', 'view'),
                                                                'class' => 'btn btn-outline-primary btn-xs',
                                                    ]);
                                                },
                                            ],
                                            'urlCreator' => function ($action, $model) {
                                                if ($action === 'view') {
                                                    $url = Url::to(['view', 'id' => $model->id]);
                                                    return $url;
                                                }
                                            }
                                        ],
                                    ];
                                    $exportColumns = [
                                            ['class' => 'yii\grid\SerialColumn'],
                                        'order_id',
                                            [
                                            'attribute' => 'order_date',
                                            'filter' => DatePicker::widget([
                                                'model' => $searchModel,
                                                'attribute' => 'order_date',
                                                'pluginOptions' => [
                                                    'format' => 'yyyy-mm-dd',
                                                ]
                                            ]),
                                            'value' => function ($data) {
                                                return date("d-m-Y", strtotime($data->order_date));
                                            },
                                        ],
                                        'name',
                                        'email:email',
                                        'net_amount',
                                            [
                                            'attribute' => 'payment_status',
                                            'value' => function($model, $key, $index, $column) {
                                                if ($model->payment_status == 2) {
                                                    return 'Cash on delivery';
                                                } elseif ($model->payment_status == 1) {
                                                    return 'Paid';
                                                } else {
                                                    return 'Pending';
                                                }
                                            },
                                            'filter' => [1 => 'Paid', 0 => 'Pending', 2 => 'Cash on delivery'], 'filterInputOptions' => ['class' => 'form-control', 'prompt' => 'All'],
                                        ],
                                    ];
                                    ?>
                                    <?php
                                    // Renders a export dropdown menu
                                    echo \kartik\export\ExportMenu::widget([
                                        'dataProvider' => $dataProvider,
                                        'columns' => $exportColumns,
                                        'dropdownOptions' => [
                                            'label' => 'Export',
                                            'class' => 'btn btn-block bg-gradient-info'
                                        ],
                                        'filename' => 'Order-Details-' . date('Y-m-d'),
                                    ]);
                                    ?>
                                    <?php
                                    echo \kartik\grid\GridView::widget([
                                        'dataProvider' => $dataProvider,
                                        'filterModel' => $searchModel,
                                        'columns' => $gridColumns
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
<style>
    .dropdown .dropdown-toggle:after, .btn-group .dropdown-toggle:after {
        display:none;
    }
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>