<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ServiceVideosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Service Videos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-content">
    <nav class="page-breadcrumb align-items-center d-flex">
        <ol class="breadcrumb w-50 mb-0">
             <li class="breadcrumb-item"><a href="<?= Yii::$app->homeUrl ?>">
                    Dashboard                </a></li>
            <li class="breadcrumb-item">
                <?=  Html::a('
                Services', ['index']) ?>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Service Videos</li>
        </ol>
        <div class="float-left d-flex  w-50">
            
        </div>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="head-box">
                        <h6 class="card-title"><?= Html::encode($this->title) ?></h6>
                    </div>
                    <div id="wizard" role="application" class="wizard clearfix">
                        <div class="steps clearfix"><ul role="tablist">
                                <li role="tab" class="disabled" aria-disabled="false" aria-selected="true">
                                    <a id="wizard-t-0" href="<?= Url::to(['services/update', 'id' => $s_id]); ?>">
                                        <span class="current-info audible">current step: </span>
                                        Service Details
                                    </a></li>
                                <li role="tab" class="current" aria-disabled="true">
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
                                <li role="tab" class="disabled" aria-disabled="true">
                                    <a id="wizard-t-3" href="<?= Url::to(['sub-services/index', 's_id' => $s_id]); ?>">
                                        Sub Services
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
                            's_id' => $s_id,
                        ])
                        ?>
                    </div>
                    <div class="table-responsive pt-3 gridview">
                        <?php // echo $this->render('_search', ['model' => $searchModel]);   ?>

                        <?=
                        GridView::widget([
                            'tableOptions' => [
                                'class' => 'table table-bordered',
                            ],
                            'options' => [
                                'class' => 'table-responsive',
                            ],
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    [
                                    'attribute' => 'thumb_image',
                                    'format' => 'raw',
                                    'value' => function ($data) {
                                        $img = '';
                                        if (!empty($data->thumb_image))
                                            $img = '<img width="45" style = "border: 2px solid #d2d2d2;margin-right:.5em;" src="' . Yii::$app->homeUrl . '../uploads/service-videos/' . $data->thumb_image . '?' . rand() . '"/>';
                                        return $img;
                                    },
                                ],
                                    [
                                    'attribute' => 'video',
                                    'format' => 'raw',
                                    'value' => function ($data) {
                                        $img = '';
                                        if (!empty($data->video))
                                            $img = '<video width="100" height="50" controls><source src="' . $data->video . '" type="video/mp4"><source src="movie.ogg" type="video/ogg">Your browser does not support the video tag.</video>';
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
                                            $url = Url::to(['index', 's_id' => $s_id, 'id' => $model->id]);
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