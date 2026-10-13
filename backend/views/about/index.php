<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AboutSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'About Us';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-content">
    <nav class="page-breadcrumb align-items-center d-flex">
        <ol class="breadcrumb w-50 mb-0">
           <li class="breadcrumb-item"><a href="<?= Url::to(['site/index']) ?>">
                    Dashboard                </a></li>
            <li class="breadcrumb-item active" aria-current="page">About Us</li>
        </ol>
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
                                    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

                                    <?=
                                    GridView::widget([
                                        'tableOptions' => [
                                            'class' => 'table table-bordered',
                                        ],
                                        'options' => [
                                            'class' => 'table-responsive',
                                        ],
                                        'dataProvider' => $dataProvider,
                                        // 'filterModel' => $searchModel,
                                        'columns' => [
                                                ['class' => 'yii\grid\SerialColumn'],
                                                [
                                                'attribute' => 'label',
                                                'format' => 'raw',
                                                'value' => function ($data) {
                                                    return ucwords(str_replace("_", " ", $data->label));
                                                },
                                            ],
//                                [
//                                'attribute' => 'value',
//                                'format' => 'raw',
//                                'value' => function ($data) {
//                                    if ($data->type == 2) {
//                                        $img = '';
//                                        if (!empty($data->value))
//                                            $img = '<img width="60" style = "border: 2px solid #d2d2d2;margin-right:.5em;" src="' . Yii::$app->homeUrl . '../uploads/about/' . $data->value . '?' . rand() . '"/>';
//                                        return $img;
//                                    } elseif ($data->type == 6) {
//                                        $img = '';
//                                        if (!empty($data->value))
//                                            $img = '<video width="100" height="50" controls><source src="' . Yii::$app->request->baseUrl . '/../uploads/about/' . $data->value . '?' . rand() . '" type="video/mp4"><source src="movie.ogg" type="video/ogg">Your browser does not support the video tag.</video>';
//                                        return $img;
//                                    } else {
//                                        return $data->value;
//                                    }
//                                },
//                            ],
                                            [
                                                'class' => 'yii\grid\ActionColumn',
                                                'contentOptions' => ['class' => 'action-head one'],
                                                'headerOptions' => ['class' => 'action-column'],
                                                'header' => 'Actions',
                                                'template' => '{update}',
                                                'buttons' => [
                                                    'update' => function ($url, $model) {
                                                        return Html::a('<i data-feather="edit"></i>', $url, [
                                                                    'title' => Yii::t('app', 'update'),
                                                                    'class' => 'btn btn-outline-primary btn-xs',
                                                        ]);
                                                    },
                                                ],
                                                'urlCreator' => function ($action, $model) {
                                                    if ($action === 'update') {
                                                        $url = Url::to(['update', 'id' => $model->id]);
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