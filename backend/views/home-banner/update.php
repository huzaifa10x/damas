<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model
  common\models\HomeBanner */
$this->title = 'Update Home Banner';
$this->params['breadcrumbs'][] = ['label' =>
    'Home Banners',
    'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->
    title, 'url' => ['view',
        'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="page-content">
    <nav class="page-breadcrumb align-items-center d-flex">
        <ol class="breadcrumb w-50 mb-0">
            <li class="breadcrumb-item"><a href="<?= Url::to(['site/index']) ?>">
                    Dashboard                </a></li>
                    <li class="breadcrumb-item"><a href="<?= Url::to(['home-banner/index']) ?>">
                    Home Banner</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                <?= Html::encode($this->title) ?>
            </li>
        </ol>
        <div class="float-left d-flex  w-50">
            <?= Html::a('Manage
            Home Banner', ['index'], ['class' => 'btn btn-outline-primary ml-auto', 'style' => 'margin-left: auto;',])
            ?>
        </div>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <?= \common\widgets\Alert::widget() ?>
                    <?=
                    $this->render('_form', [
                        'model' => $model,
                    ])
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>