<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProductReviewSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Product Reviews';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-content">
    <nav class="page-breadcrumb align-items-center d-flex">
        <ol class="breadcrumb w-50 mb-0">
             <li class="breadcrumb-item"><?= Html::a('Dashboard', ['site/index']) ?></li>
            <li class="breadcrumb-item active" aria-current="page">Product Review </li>
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
                                                'attribute' => 'product_id',
                                                'filter' => \yii\helpers\ArrayHelper::map(\common\models\Products::find()->all(), 'id', 'product_name'),
                                                'value' => function($model) {
                                                    if (isset($model->product_id) && $model->product_id != '') {
                                                       $product = common\models\Products::findOne($model->product_id);
if ($product !== null) {
    return $product->product_name;
} else {
    return '';
}
                                                    } else {
                                                        return '';
                                                    }
                                                }
                                            ],
                                            'name',
                                            'email:email',
//                                            'phone',
                                            [
                                                'attribute' => 'message',
                                                'format' => 'raw', // Set the format to 'raw' to allow HTML tags
                                                'contentOptions' => ['style' => 'white-space: normal;'], // Allow line breaks
                                            ],
                                                [
                                                'attribute' => 'status',
                                                'format' => 'raw',
                                                'value' => function($model, $key, $index, $column) {
                                                    if ($model->status == 2) {
                                                        return 'Rejected';
                                                    } elseif ($model->status == 1) {
                                                        return 'Approved';
                                                    } else {
                                                        return 'Not Approved';
                                                    }
                                                },
                                                'filter' => [0 => 'Not Approved', 1 => 'Approved', 2 => 'Rejected'],
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