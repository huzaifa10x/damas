<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel common\models\HomeBannerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title =
'Home Banners';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-content">
    <nav class="page-breadcrumb align-items-center d-flex">
        <ol class="breadcrumb w-50 mb-0">
            <li class="breadcrumb-item"><a href="<?= Url::to(['site/index']) ?>">
                    Dashboard                </a></li>
            <li class="breadcrumb-item active" aria-current="page">Home Banner</li>
        </ol>
        <div class="float-left d-flex  w-50">
            <?=  Html::a('<span> Create
                Home Banner            </span>', ['create'], ['class' =>
            'btn btn-outline-primary ml-auto','style' => 'margin-left: auto;',]) ?>
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
                                'attribute' => 'type',
                                'format' => 'raw',
                                'value' => function($model, $key, $index, $column) {
                                    if ($model->type == 1) {
                                        return 'Video';
                                    } else {
                                        return 'Image';
                                    }
                                },
                                'filter' => [0 => 'Image', 1 => 'Video'],
                            ],
                                [
                                'attribute' => 'image',
                                'label' => 'File',
                                'format' => 'raw',
                                'value' => function ($data) {
                                    $img = '';
                                    if ($data->type == 1) {
                                        if (!empty($data->video))
                                            $img = '<video width="100" height="50" controls><source src="' . Yii::$app->request->baseUrl . '/../uploads/home-banners/' . $data->video . '?' . rand() . '" type="video/mp4"><source src="movie.ogg" type="video/ogg">Your browser does not support the video tag.</video>';
                                    } else {
                                        if (!empty($data->desktop_image))
                                            $img = '<img width="45" style = "border: 2px solid #d2d2d2;margin-right:.5em;" src="' . Yii::$app->homeUrl . '../uploads/home-banners/' . $data->desktop_image . '?' . rand() . '"/>';
                                    }
                                    return $img;
                                },
                            ],
                                [
                                'attribute' => 'title',
                                'format' => 'raw',
                                'value' => function ($data) {
                                    return $data->title;
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
                                'urlCreator' => function ($action, $model) {
                                    if ($action === 'update') {
                                        $url = Url::to(['update', 'id' => $model->id]);
                                        return $url;
                                    }
                                    if ($action === 'delete') {
                                        $url = Url::to(['delete', 'id' => $model->id]);
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