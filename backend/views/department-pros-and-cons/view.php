<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\DepartmentProsAndCons */

$this->title = 'Department Pros And Cons';
$this->params['breadcrumbs'][] = ['label' => 'Department Pros And Cons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
                    <li class="breadcrumb-item active"><?= Html::encode($this->title) ?> Details</li>
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
                        <h3 class="card-title"><?= Html::encode($this->title) ?> Details</h3>
                        <?=  Html::a('<i class="fa fa-arrow-left"></i><span> Back </span>', ['index'], ['class' => 'btn btn-block btn-outline-info btn-sm']) ?>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                                    'id',
            'department_id',
            'title',
            'title_arabic',
            'description:ntext',
            'description_arabic:ntext',
            'status',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
                        ],
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


