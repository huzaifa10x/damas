<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MetaTagsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Meta Tags';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-content">
    <nav class="page-breadcrumb align-items-center d-flex">
        <ol class="breadcrumb w-50 mb-0">
            <li class="breadcrumb-item"><?= Html::a('Dashboard', ['site/index']) ?></li>
            <li class="breadcrumb-item active" aria-current="page">Meta Tags</li>
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
                                            'page',
                                            'meta_title',
//                                            'meta_keyword',
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