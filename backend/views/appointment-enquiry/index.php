<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AppointmentEnquirySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Appointment Enquiries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-content">
    <nav class="page-breadcrumb align-items-center d-flex">
        <ol class="breadcrumb w-50 mb-0">
            <li class="breadcrumb-item"><a href=<?= Yii::$app->homeUrl ?>>
                    Dashboard                </a></li>
            <li class="breadcrumb-item active" aria-current="page">Appointment Enquiry</li>
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
                    <?= \common\widgets\Alert::widget() ?>
                    <div class="table-responsive">
                        <div id="zero_configuration_table_wrapper"
                             class="dataTables_wrapper container-fluid dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <?php
                                    $gridColumns = [
                                            ['class' => 'yii\grid\SerialColumn'],
                                        'name',
                                        'age',
                                            [
                                            'attribute' => 'gender',
                                            'filter' => \yii\helpers\ArrayHelper::map(\common\models\Genders::find()->all(), 'id', 'gender'),
                                            'value' => function($model) {
                                                if (isset($model->gender) && $model->gender != '') {
                                                    return common\models\Genders::findOne($model->gender)->gender;
                                                } else {
                                                    return '';
                                                }
                                            }
                                        ],
                                        'email:email',
                                        'phone_number',
                                            [
                                            'attribute' => 'service',
                                            'filter' => \yii\helpers\ArrayHelper::map(\common\models\Departments::find()->all(), 'id', 'department_name'),
                                            'value' => function($model) {
                                                if (!empty($model->service)) {
                                                    $department = \common\models\Departments::findOne($model->service);
                                                    return $department ? $department->department_name : '';
                                                } else {
                                                    return '';
                                                }
                                            }
                                        ],
                                        'appointment_date',
//                                            'appointment_time',
//                                             'page_url:url',
                                        [
                                            'attribute' => 'status',
                                            'format' => 'raw',
                                            'value' => function($model, $key, $index, $column) {
                                                if ($model->status == 2) {
                                                    return 'Rejected';
                                                } elseif ($model->status == 1) {
                                                    return 'Approved';
                                                } else {
                                                    return 'Pending';
                                                }
                                            },
                                            'filter' => [0 => 'Pending', 1 => 'Approved', 2 => 'Rejected'],
                                        ],
                                            [
                                            'attribute' => 'message',
                                            'format' => 'raw', // Set the format to 'raw' to allow HTML tags
                                            'contentOptions' => ['style' => 'white-space: normal;'], // Allow line breaks
                                        ],
                                            [
                                            'class' => 'yii\grid\ActionColumn',
                                            'contentOptions' => ['class' => 'action-head two'],
                                            'headerOptions' => ['class' => 'action-column'],
                                            'header' => 'Actions',
                                            'template' => '{approve}{reject}',
                                            'buttons' => [
                                                'approve' => function ($url, $model) {
                                                    if ($model->status != 1) {
                                                        return Html::a('<i data-feather="check-square"></i>', $url, [
                                                                    'title' => Yii::t('app', 'approve'),
                                                                    'class' => 'btn btn-info action-btn-edit',
                                                        ]);
                                                    }
                                                },
                                                'reject' => function ($url, $model) {
                                                    if ($model->status != 2) {
                                                        return Html::a('<i data-feather="delete"></i>', $url, [
                                                                    'title' => Yii::t('app', 'reject'),
                                                                    'class' => 'btn btn-danger action-btn-delete',
                                                        ]);
                                                    }
                                                },
                                            ],
                                            'urlCreator' => function ($action, $model) {
                                                if ($action === 'approve') {
                                                    $url = Url::to(['approve', 'id' => $model->id]);
                                                    return $url;
                                                }
                                                if ($action === 'reject') {
                                                    $url = Url::to(['reject', 'id' => $model->id]);
                                                    return $url;
                                                }
                                            }
                                        ],
                                    ];
                                    $exportColumns = [
                                            ['class' => 'yii\grid\SerialColumn'],
                                        'name',
                                        'age',
                                            [
                                            'attribute' => 'gender',
                                            'filter' => \yii\helpers\ArrayHelper::map(\common\models\Genders::find()->all(), 'id', 'gender'),
                                            'value' => function($model) {
                                                if (isset($model->gender) && $model->gender != '') {
                                                    return common\models\Genders::findOne($model->gender)->gender;
                                                } else {
                                                    return '';
                                                }
                                            }
                                        ],
                                        'email:email',
                                        'phone_number',
                                            [
                                            'attribute' => 'service',
                                            'filter' => \yii\helpers\ArrayHelper::map(\common\models\Departments::find()->all(), 'id', 'department_name'),
                                            'value' => function($model) {
                                                if (!empty($model->service)) {
                                                    $department = \common\models\Departments::findOne($model->service);
                                                    return $department ? $department->department_name : '';
                                                } else {
                                                    return '';
                                                }
                                            }
                                        ],
                                        'appointment_date',
//                                            'appointment_time',
//                                             'page_url:url',
                                        [
                                            'attribute' => 'status',
                                            'format' => 'raw',
                                            'value' => function($model, $key, $index, $column) {
                                                if ($model->status == 2) {
                                                    return 'Rejected';
                                                } elseif ($model->status == 1) {
                                                    return 'Approved';
                                                } else {
                                                    return 'Pending';
                                                }
                                            },
                                            'filter' => [0 => 'Pending', 1 => 'Approved', 2 => 'Rejected'],
                                        ],
                                            [
                                            'attribute' => 'message',
                                            'format' => 'raw', // Set the format to 'raw' to allow HTML tags
                                            'contentOptions' => ['style' => 'white-space: normal;'], // Allow line breaks
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
                                        'filename' => 'Appointment-Enquiry-' . date('Y-m-d'),
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