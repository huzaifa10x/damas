<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\DepartmentVideosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Landing Page Video Section';
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
                <div id="wizard" role="application" class="wizard clearfix">
                    <div class="steps clearfix"><ul role="tablist">
                            <li role="tab" class="disabled" aria-disabled="false" aria-selected="true">
                                <a id="wizard-t-0" href="<?= Url::to(['landing-pages/update', 'id' => $page_id]); ?>">
                                    <span class="current-info audible">current step: </span>
                                    Update Page Details
                                </a></li>
                            <li role="tab" class="disabled" aria-disabled="true">
                                <a id="wizard-t-1" href="<?= Url::to(['landing-pages/banner', 'page_id' => $page_id]); ?>">
                                    Banner
                                </a>
                            </li>
                            <li role="tab" class="disabled" aria-disabled="true">
                                <a id="wizard-t-2" href="<?= Url::to(['landing-pages/about', 'page_id' => $page_id]); ?>">
                                    About Us
                                </a>
                            </li>
                            <li role="tab" class="current" aria-disabled="true">
                                <a id="wizard-t-3" href="<?= Url::to(['landing-pages/video-section', 'page_id' => $page_id]); ?>">
                                    Video / Image Section
                                </a>
                            </li>
                            <li role="tab" class="disabled" aria-disabled="true">
                                <a id="wizard-t-3" href="<?= Url::to(['landing-pages/our-gallery', 'page_id' => $page_id]); ?>">
                                    Our Gallery
                                </a>
                            </li>
                            <li role="tab" class="disabled" aria-disabled="true">
                                <a id="wizard-t-3" href="<?= Url::to(['landing-pages/our-videos', 'page_id' => $page_id]); ?>">
                                    Our Videos
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <?= \common\widgets\Alert::widget() ?>
                <div class="text-left colors-create frm-box">
                    <?=
                    $this->render('_form_video_section', [
                        'model' => $model,
                        'page_id' => $page_id,
                    ])
                    ?>
                </div>
                
            </div>
        </div>
    </div>

</div>
