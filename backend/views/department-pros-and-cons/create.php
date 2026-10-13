<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\DepartmentProsAndCons */

$this->title = 'Department Pros And Cons';
$this->params['breadcrumbs'][] = ['label' => 'Department Pros And Cons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <?= Html::a('Home', ['site/index']) ?>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            <?= Html::a($this->title, ['index']) ?>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Create <?= Html::encode($this->title) ?></li>
    </ol>
</nav>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div id="wizard" role="application" class="wizard clearfix">
                <div class="steps clearfix"><ul role="tablist">
                        <li role="tab" class="disabled" aria-disabled="false" aria-selected="true">
                            <a id="wizard-t-0" href="<?= Url::to(['departments/update', 'id' => $dep_id]); ?>">
                                <span class="current-info audible">current step: </span>
                                Department Details
                            </a></li>
                        <li role="tab" class="disabled" aria-disabled="true">
                            <a id="wizard-t-1" href="<?= Url::to(['department-videos/index', 'dep_id' => $dep_id]); ?>">
                                Department Videos
                            </a>
                        </li>
                        <li role="tab" class="disabled" aria-disabled="true">
                            <a id="wizard-t-2" href="<?= Url::to(['department-treatment-results/index', 'dep_id' => $dep_id]); ?>">
                                Department Treatment Results
                            </a>
                        </li>
                        <li role="tab" class="current" aria-disabled="true">
                            <a id="wizard-t-3" href="<?= Url::to(['department-pros-and-cons/index', 'dep_id' => $dep_id]); ?>">
                                Department Pros & Cons
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="head-box">
                    <?= Html::a('Back', ['index', 'dep_id' => $dep_id], ['class' => 'btn btn-primary btn-xs mb-1 mb-md-0', 'style' => 'float: right']) ?>
                    <h6 class="card-title"><?= Html::encode($this->title) ?></h6>
                </div>
                <?=
                $this->render('_form', [
                    'model' => $model,
                ])
                ?>

            </div>
        </div>
    </div>

</div>