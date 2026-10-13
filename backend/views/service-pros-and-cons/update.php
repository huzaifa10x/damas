<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model
common\models\ServiceProsAndCons */
$this->title =
'Update Service Pros And Cons: '. $model->
title;
$this->params['breadcrumbs'][] = ['label' =>
'Service Pros And Cons',
'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->
title, 'url' => ['view',
'id' => $model->id]];
$this->params['breadcrumbs'][] =
'Update';
?>
<div class="page-content">
    <nav class="page-breadcrumb align-items-center d-flex">
        <ol class="breadcrumb w-50 mb-0">
            <li class="breadcrumb-item"><a href="#">
                    service-pros-and-cons                </a></li>
            <li class="breadcrumb-item active" aria-current="page">
                <?= Html::encode($this->title) ?>
            </li>
        </ol>
        <div class="float-left d-flex  w-50">
            <?=  Html::a('Manage
            Service Pros And Cons',
            ['index'], ['class' => 'btn btn-outline-primary ml-auto','style' => 'margin-left: auto;',]) ?>
        </div>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <?= $this->render('_form', [
                    'model' => $model,
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>