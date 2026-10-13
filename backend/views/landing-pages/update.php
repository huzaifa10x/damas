<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model
  common\models\LandingPages */
$this->title = 'Update Landing Pages';
$this->params['breadcrumbs'][] = ['label' =>
    'Landing Pages',
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
            <li class="breadcrumb-item"><a href="<?= Url::to(['landing-pages/index']) ?>">
                    Landing Pages                </a></li>
            <li class="breadcrumb-item active" aria-current="page">
                <?= Html::encode($this->title) ?>
            </li>
        </ol>
        <div class="float-left d-flex  w-50">
            <?= Html::a('Manage
            Landing Pages', ['index'], ['class' => 'btn btn-outline-primary ml-auto', 'style' => 'margin-left: auto;',])
            ?>
        </div>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div id="wizard" role="application" class="wizard clearfix">
                        <div class="steps clearfix"><ul role="tablist">
                                <li role="tab" class="current" aria-disabled="false" aria-selected="true">
                                    <a id="wizard-t-0" href="<?= Url::to(['landing-pages/update', 'id' => $model->id]); ?>">
                                        <span class="current-info audible">current step: </span>
                                        Update Page Details
                                    </a></li>
                                <li role="tab" class="disabled" aria-disabled="true">
                                    <a id="wizard-t-1" href="<?= Url::to(['landing-pages/banner', 'page_id' => $model->id]); ?>">
                                        Banner
                                    </a>
                                </li>
                                <li role="tab" class="disabled" aria-disabled="true">
                                    <a id="wizard-t-2" href="<?= Url::to(['landing-pages/about', 'page_id' => $model->id]); ?>">
                                        About Us
                                    </a>
                                </li>
                                <li role="tab" class="disabled" aria-disabled="true">
                                    <a id="wizard-t-3" href="<?= Url::to(['landing-pages/video-section', 'page_id' => $model->id]); ?>">
                                        Video / Image Section
                                    </a>
                                </li>
                                <li role="tab" class="disabled" aria-disabled="true">
                                    <a id="wizard-t-3" href="<?= Url::to(['landing-pages/our-gallery', 'page_id' => $model->id]); ?>">
                                        Our Gallery
                                    </a>
                                </li>
                                <li role="tab" class="disabled" aria-disabled="true">
                                    <a id="wizard-t-3" href="<?= Url::to(['landing-pages/our-videos', 'page_id' => $model->id]); ?>">
                                        Our Videos
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
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