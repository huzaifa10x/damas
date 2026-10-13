<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DepartmentVideos */

$this->title = 'Department Videos';
$this->params['breadcrumbs'][] = ['label' => 'Department Videos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <?=  Html::a('Home', ['site/index']) ?>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            <?=  Html::a($this->title, ['index']) ?>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Update <?= Html::encode($this->title) ?></li>
    </ol>
</nav>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="head-box">
                    <?=  Html::a('Back', ['index'], ['class' => 'btn btn-primary btn-xs mb-1 mb-md-0','style' => 'float: right']) ?>
                    <h6 class="card-title"><?= Html::encode($this->title) ?></h6>
                </div>
                <?= $this->render('_form', [
                'model' => $model,
                ]) ?>

            </div>
        </div>
    </div>

</div>