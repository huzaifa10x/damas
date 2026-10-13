<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model
common\models\BenefitsOfTreatments */
$this->title =
'Update Benefits Of Treatments';
$this->params['breadcrumbs'][] = ['label' =>
'Benefits Of Treatments',
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
            <li class="breadcrumb-item"><?= Html::a('Dashboard', ['site/index']) ?></li>
            <li class="breadcrumb-item active" aria-current="page">
                <?= Html::encode($this->title) ?>
            </li>
        </ol>
        <div class="float-left d-flex  w-50">
            <?=  Html::a('Manage
            Benefits Of Treatments',
            ['index'], ['class' => 'btn btn-outline-primary ml-auto','style' => 'margin-left: auto;',]) ?>
        </div>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <?= \common\widgets\Alert::widget() ?>
                    <?= $this->render('_form', [
                    'model' => $model,
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>