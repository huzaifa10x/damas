<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model
  common\models\Services */
$this->title = 'Update Services';
$this->params['breadcrumbs'][] = ['label' =>
    'Services',
    'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->
    id, 'url' => ['view',
        'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="page-content">
    <nav class="page-breadcrumb align-items-center d-flex">
        <ol class="breadcrumb w-50 mb-0">
            <li class="breadcrumb-item"><a href="<?= Yii::$app->homeUrl ?>">
                    Dashboard                </a></li>
            <li class="breadcrumb-item">
                <?=  Html::a('
                Services', ['index']) ?>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <?= Html::encode($this->title) ?>
            </li>
        </ol>
        <div class="float-left d-flex  w-50">
            <?= Html::a('Manage
            Services', ['index'], ['class' => 'btn btn-outline-primary ml-auto', 'style' => 'margin-left: auto;',])
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
                                    <a id="wizard-t-0" href="<?= Url::to(['services/update', 'id' => $model->id]); ?>">
                                        <span class="current-info audible">current step: </span>
                                        Service Details
                                    </a></li>
                                <li role="tab" class="disabled" aria-disabled="true">
                                    <a id="wizard-t-1" href="<?= Url::to(['service-videos/index', 's_id' => $model->id]); ?>">
                                        Service Videos
                                    </a>
                                </li>
                                <li role="tab" class="disabled" aria-disabled="true">
                                    <a id="wizard-t-2" href="<?= Url::to(['service-treatment-results/index', 's_id' => $model->id]); ?>">
                                        Service Treatment Results
                                    </a>
                                </li>
                                <li role="tab" class="disabled" aria-disabled="true">
                                    <a id="wizard-t-3" href="<?= Url::to(['service-pros-and-cons/index', 's_id' => $model->id]); ?>">
                                        Service Pros & Cons
                                    </a>
                                </li>
                                <li role="tab" class="disabled" aria-disabled="true">
                                    <a id="wizard-t-3" href="<?= Url::to(['sub-services/index', 's_id' => $model->id]); ?>">
                                        Sub Services
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