<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
/* @var $this yii\web\View */
/* @var $model
common\models\LandingPages */
$this->title = 'View
Landing Pages Details';
$this->params['breadcrumbs'][] = ['label' =>
'Landing Pages',
'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-content">
    <nav class="page-breadcrumb align-items-center d-flex">
        <ol class="breadcrumb w-50 mb-0">
            <li class="breadcrumb-item"><a href="#">
                    landing-pages                </a></li>
            <li class="breadcrumb-item active" aria-current="page">
                <?= Html::encode($this->title) ?>
            </li>
        </ol>
        <div class="float-left d-flex  w-50">
            <?=  Html::a('Manage
            Landing Pages', ['index'], ['class' => 'btn
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
            'title',
            'title_arabic',
            'canonical_name',
            'phone_no',
            'whatsapp_no',
            'is_enable_banner',
            'is_enable_about',
            'is_enable_video_banner',
            'is_enable_gallery',
            'is_enable_our_video',
            'is_enable_services',
            'is_enable_appointment',
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