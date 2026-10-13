<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DepartmentTreatmentResults */

$this->title = 'Department Treatment Results';
$this->params['breadcrumbs'][] = ['label' => 'Department Treatment Results', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><?= Html::encode($this->title) ?></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#!">Home</a></li>
                    <li class="breadcrumb-item"><?=  Html::a($this->title, ['index']) ?></li>
                    <li class="breadcrumb-item active">Update <?= Html::encode($this->title) ?></li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Update <?= Html::encode($this->title) ?></h3>
                        <?=  Html::a('<i class="fa fa-arrow-left"></i><span> Back </span>', ['index'], ['class' => 'btn btn-block btn-outline-info btn-sm']) ?>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <?= $this->render('_form', [
                        'model' => $model,
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

