<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ContactEnquirySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Contact Enquiries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-content">
    <nav class="page-breadcrumb align-items-center d-flex">
        <ol class="breadcrumb w-50 mb-0">
            <li class="breadcrumb-item"><a href="<?= Yii::$app->homeUrl ?>">
                    Dashboard              </a></li>
            <li class="breadcrumb-item active" aria-current="page">Contact Enquiry  </li>
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
                                            [
                                            'attribute' => 'type',
                                            'format' => 'raw',
                                            'value' => function($model, $key, $index, $column) {
                                                if ($model->type == 1) {
                                                    return 'Feedback';
                                                } else {
                                                    return 'Enquiry';
                                                }
                                            },
                                            'filter' => [1 => 'Feedback', 0 => 'Enquiry'],
                                        ],
                                        'name',
                                        'email:email',
                                        'phone_number',
                                            [
                                            'attribute' => 'message',
                                            'format' => 'raw', // Set the format to 'raw' to allow HTML tags
                                            'contentOptions' => ['style' => 'white-space: normal;'], // Allow line breaks
                                        ],
                                            [
                                            'attribute' => 'date',
                                            'filter' => DatePicker::widget([
                                                'model' => $searchModel,
                                                'attribute' => 'date',
                                                'pluginOptions' => [
                                                    'format' => 'yyyy-mm-dd',
                                                ]
                                            ]),
                                            'value' => function ($data) {
                                                return date("d-m-Y", strtotime($data->date));
                                            },
                                        ],
                                            [
                                            'class' => 'yii\grid\ActionColumn',
                                            'contentOptions' => ['class' => 'action-head one'],
                                            'headerOptions' => ['class' => 'action-column'],
                                            'header' => 'Actions',
                                            'template' => '{delete}',
                                            'buttons' => [
                                                'delete' => function ($url, $model) {
                                                    return Html::a('<i data-feather="trash"></i>', $url, [
                                                                'title' => Yii::t('app', 'delete'),
                                                                'class' => 'btn btn-outline-danger btn-xs',
                                                                'data-confirm' => Yii::t('yii', 'Are you sure you want to delete?'),
                                                                'data-method' => 'post',
                                                    ]);
                                                },
                                            ],
                                            'urlCreator' => function ($action, $model) {
                                                if ($action === 'delete') {
                                                    $url = Url::to(['delete', 'id' => $model->id]);
                                                    return $url;
                                                }
                                            }
                                        ],
                                    ];
                                    $exportColumns = [
                                            ['class' => 'yii\grid\SerialColumn'],
                                            [
                                            'attribute' => 'type',
                                            'format' => 'raw',
                                            'value' => function($model, $key, $index, $column) {
                                                if ($model->type == 1) {
                                                    return 'Feedback';
                                                } else {
                                                    return 'Enquiry';
                                                }
                                            },
                                            'filter' => [1 => 'Feedback', 0 => 'Enquiry'],
                                        ],
                                        'name',
                                        'email:email',
                                        'phone_number',
                                            [
                                            'attribute' => 'message',
                                            'format' => 'raw', // Set the format to 'raw' to allow HTML tags
                                            'contentOptions' => ['style' => 'white-space: normal;'], // Allow line breaks
                                        ],
                                            [
                                            'attribute' => 'date',
                                            'filter' => DatePicker::widget([
                                                'model' => $searchModel,
                                                'attribute' => 'date',
                                                'pluginOptions' => [
                                                    'format' => 'yyyy-mm-dd',
                                                ]
                                            ]),
                                            'value' => function ($data) {
                                                return date("d-m-Y", strtotime($data->date));
                                            },
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
                                        'filename' => 'Contact-Enquiry-' . date('Y-m-d'),
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