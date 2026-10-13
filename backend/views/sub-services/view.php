<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
/* @var $this yii\web\View */
/* @var $model
common\models\SubServices */
$this->title = 'View
Sub Services Details';
$this->params['breadcrumbs'][] = ['label' =>
'Sub Services',
'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-content">
    <nav class="page-breadcrumb align-items-center d-flex">
        <ol class="breadcrumb w-50 mb-0">
            <li class="breadcrumb-item"><a href="#">
                    sub-services                </a></li>
            <li class="breadcrumb-item active" aria-current="page">
                <?= Html::encode($this->title) ?>
            </li>
        </ol>
        <div class="float-left d-flex  w-50">
            <?=  Html::a('Manage
            Sub Services', ['index'], ['class' => 'btn
            btn-primary m-1']) ?>
            <?= Html::a(
            'Update', ['update',
            'id' => $model->id], ['class' => 'btn btn-secondary m-1']) ?>
            <?= Html::a(
            'Delete', ['delete',
            'id' => $model->id], [
            'class' => 'btn btn-danger m-1',
            'data' => [
            'confirm' =>
            'Are you sure you want to delete this item?',
            'method' => 'post',
            ],
            ]) ?>
        </div>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                                'id',
            'service',
            'title',
            'title_arabic',
            'small_description',
            'small_description_arabic',
            'section1_title',
            'section1_title_arabic',
            'section1_description:ntext',
            'section1_description_arabic:ntext',
            'section2_title',
            'section2_title_arabic',
            'section2_description:ntext',
            'section2_description_arabic:ntext',
            'section3_title',
            'section3_title_arabic',
            'section3_description:ntext',
            'section3_description_arabic:ntext',
            'section4_description:ntext',
            'section4_description_arabic:ntext',
            'image',
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