<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\DoctorGallerySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Doctor Galleries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-content">
    <nav class="page-breadcrumb align-items-center d-flex">
        <ol class="breadcrumb w-50 mb-0">
             <li class="breadcrumb-item"><?= Html::a('Dashboard', ['site/index']) ?></li>
            <li class="breadcrumb-item"><?= Html::a('Doctors', ['doctors/index']) ?></li>
            <li class="breadcrumb-item active" aria-current="page">Doctor Gallery </li>
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
                    <div id="wizard" role="application" class="wizard clearfix">
                        <div class="steps clearfix"><ul role="tablist">
                                <li role="tab" class="disabled" aria-disabled="false" aria-selected="true">
                                    <a id="wizard-t-0" href="<?= Url::to(['doctors/update', 'id' => $doctor_id]); ?>">
                                        <span class="current-info audible">current step: </span>
                                        Doctor Details
                                    </a></li>
                                <li role="tab" class="current" aria-disabled="true">
                                    <a id="wizard-t-1" href="<?= Url::to(['doctor-gallery/index', 'doctor_id' => $model->id]); ?>">
                                        Gallery
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <?= \common\widgets\Alert::widget() ?>
                    <div class="text-left colors-create frm-box">
                        <?=
                        $this->render('_form', [
                            'model' => $model,
                            'id' => $id,
                            'doctor_id' => $doctor_id,
                        ])
                        ?>
                    </div>
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
                                                [
                                                'attribute' => 'before_image',
                                                'format' => 'raw',
                                                'value' => function ($data) {
                                                    $img = '';
                                                    if (!empty($data->before_image))
                                                        $img = '<img width="45" style = "border: 2px solid #d2d2d2;margin-right:.5em;" src="' . Yii::$app->homeUrl . '../uploads/doctor-gallery/' . $data->before_image . '?' . rand() . '"/>';
                                                    return $img;
                                                },
                                            ],
                                                [
                                                'attribute' => 'after_image',
                                                'format' => 'raw',
                                                'value' => function ($data) {
                                                    $img = '';
                                                    if (!empty($data->after_image))
                                                        $img = '<img width="45" style = "border: 2px solid #d2d2d2;margin-right:.5em;" src="' . Yii::$app->homeUrl . '../uploads/doctor-gallery/' . $data->after_image . '?' . rand() . '"/>';
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
                                                'urlCreator' => function ($action, $model)use($doctor_id) {
                                                    if ($action === 'update') {
                                                        $url = Url::to(['index', 'doctor_id' => $doctor_id, 'id' => $model->id]);
                                                        return $url;
                                                    }
                                                    if ($action === 'delete') {
                                                        $url = Url::to(['delete', 'doctor_id' => $doctor_id, 'id' => $model->id]);
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