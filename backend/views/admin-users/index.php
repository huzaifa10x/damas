<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AdminUsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Admin Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-content">
    <nav class="page-breadcrumb align-items-center d-flex">
        <ol class="breadcrumb w-50 mb-0">
            <li class="breadcrumb-item"><a href="<?= Yii::$app->homeUrl ?>">
                    Dashboard              </a></li>
            <li class="breadcrumb-item active" aria-current="page">Admin Users</li>
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
                                            'email:email',
                                            'username',
                                            [
    'class' => 'yii\grid\ActionColumn',
    'contentOptions' => ['class' => 'action-head one'],
    'headerOptions' => ['class' => 'action-column'],
    'header' => 'Actions',
    'template' => '{edit}',
    'buttons' => [
        'edit' => function ($url, $model) {
            return Html::a(
                '<i data-feather="edit-2"></i>',
                Url::to(['update', 'id' => $model->id]),
                [
                    'title' => Yii::t('app', 'Edit'),
                    'class' => 'btn btn-outline-primary btn-xs',
                ]
            );
        },
    ],
    'urlCreator' => function ($action, $model) {
        if ($action === 'edit') {
            return Url::to(['update', 'id' => $model->id]);
        }
    },
],

                                    ];
                                    
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
