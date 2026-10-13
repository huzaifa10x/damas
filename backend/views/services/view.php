<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
/* @var $this yii\web\View */
/* @var $model
common\models\Services */
$this->title = 'View
Services Details';
$this->params['breadcrumbs'][] = ['label' =>
'Services',
'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-content">
    <nav class="page-breadcrumb align-items-center d-flex">
        <ol class="breadcrumb w-50 mb-0">
            <li class="breadcrumb-item"><a href="#">
                    services                </a></li>
            <li class="breadcrumb-item active" aria-current="page">
                <?= Html::encode($this->title) ?>
            </li>
        </ol>
        <div class="float-left d-flex  w-50">
            <?=  Html::a('Manage
            Services', ['index'], ['class' => 'btn
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
            'department',
            'service_name',
            'service_name_arabic',
            'canonical_name',
            'banner_image',
            'banner_description:ntext',
            'banner_description_arabic:ntext',
            'service_image',
            'service_description:ntext',
            'service_description_arabic:ntext',
            'section3_title',
            'section3_title_arabic',
            'section3_description:ntext',
            'section3_description_arabic:ntext',
            'section3_image',
            'section4_title',
            'section4_title_arabic',
            'section4_description:ntext',
            'section4_description_arabic:ntext',
            'section7_title',
            'section7_title_arabic',
            'section7_description:ntext',
            'section7_description_arabic:ntext',
            'meta_title',
            'meta_keyword',
            'meta_description:ntext',
            'other_meta_tags:ntext',
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