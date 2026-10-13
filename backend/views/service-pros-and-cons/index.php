<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\DepartmentProsAndConsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Department Pros And Cons';
$this->params['breadcrumbs'][] = $this->title;
?>
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <?= Html::a('Home', ['site/index']) ?>
        </li>
        <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
    </ol>
</nav>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="head-box">
                    <?= Html::a('Add More Details', ['more-details', 's_id' => $s_id], ['class' => 'btn btn-primary btn-xs mb-1 mb-md-0', 'style' => 'float:right']) ?>
                    <h6 class="card-title"><?= Html::encode($this->title) ?></h6>
                </div>
                <div id="wizard" role="application" class="wizard clearfix">
                    <div class="steps clearfix"><ul role="tablist">
                            <li role="tab" class="disabled" aria-disabled="false" aria-selected="true">
                                <a id="wizard-t-0" href="<?= Url::to(['services/update', 'id' => $s_id]); ?>">
                                    <span class="current-info audible">current step: </span>
                                    Service Details
                                </a></li>
                            <li role="tab" class="disabled" aria-disabled="true">
                                <a id="wizard-t-1" href="<?= Url::to(['service-videos/index', 's_id' => $s_id]); ?>">
                                    Service Videos
                                </a>
                            </li>
                            <li role="tab" class="disabled" aria-disabled="true">
                                <a id="wizard-t-2" href="<?= Url::to(['service-treatment-results/index', 's_id' => $s_id]); ?>">
                                    Service Treatment Results
                                </a>
                            </li>
                            <li role="tab" class="current" aria-disabled="true">
                                <a id="wizard-t-3" href="<?= Url::to(['service-pros-and-cons/index', 's_id' => $s_id]); ?>">
                                    Service Pros & Cons
                                </a>
                            </li>
                            <li role="tab" class="disabled" aria-disabled="true">
                                    <a id="wizard-t-3" href="<?= Url::to(['sub-services/index', 's_id' => $s_id]); ?>">
                                        Sub Services
                                    </a>
                                </li>
                        </ul>
                    </div>
                </div>
                <?= \common\widgets\Alert::widget() ?>
                <div class="text-left colors-create frm-box">
                    <?=
                    $this->render('_form_description', [
                        'model' => $model,
                        's_id' => $s_id,
                    ])
                    ?>
                </div>
            </div>
        </div>
    </div>

</div>
