<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\DepartmentVideosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Landing Page Image Gallery';
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
                            <li role="tab" class="disabled" aria-disabled="true">
                                <a id="wizard-t-3" href="<?= Url::to(['landing-pages/video-section', 'page_id' => $page_id]); ?>">
                                    Video / Image Section
                                </a>
                            </li>
                            <li role="tab" class="current" aria-disabled="true">
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
                    $this->render('_form_our_gallery', [
                        'model' => $model,
                        'page_id' => $page_id,
                    ])
                    ?>
                    <div class="table-responsive pt-3 gridview">
                        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                        <?=
                        GridView::widget([
                            'tableOptions' => [
                                'class' => 'table table-bordered',
                            ],
                            'options' => [
                                'class' => 'table-responsive',
                            ],
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    [
                                    'attribute' => 'before_image',
                                    'format' => 'raw',
                                    'value' => function ($data) {
                                        $img = '';
                                        if (!empty($data->before_image))
                                            $img = '<img width="45" style = "border: 2px solid #d2d2d2;margin-right:.5em;" src="' . Yii::$app->homeUrl . '../uploads/landing-page-our-gallery/' . $data->before_image . '?' . rand() . '"/>';
                                        return $img;
                                    },
                                ],
                                    [
                                    'attribute' => 'after_image',
                                    'format' => 'raw',
                                    'value' => function ($data) {
                                        $img = '';
                                        if (!empty($data->after_image))
                                            $img = '<img width="45" style = "border: 2px solid #d2d2d2;margin-right:.5em;" src="' . Yii::$app->homeUrl . '../uploads/landing-page-our-gallery/' . $data->after_image . '?' . rand() . '"/>';
                                        return $img;
                                    },
                                ],
                                    [
                                    'attribute' => 'status',
                                    'format' => 'raw',
                                    'value' => function($model, $key, $index, $column) {
                                        if ($model->status == 1) {
                                            return 'Active';
                                        } else {
                                            return 'Inactive';
                                        }
                                    },
                                    'filter' => [1 => 'Active', 0 => 'Inactive'],
                                ],
                                    [
                                    'class' => 'yii\grid\ActionColumn',
                                    'contentOptions' => ['class' => 'action-head two'],
                                    'headerOptions' => ['class' => 'action-column'],
                                    'header' => 'Actions',
                                    'template' => '{update}{delete}',
                                    'buttons' => [
                                        'update' => function ($url, $model) {
                                            return Html::a('<i data-feather="edit"></i>', $url, [
                                                        'title' => Yii::t('app', 'update'),
                                                        'class' => 'btn btn-outline-primary btn-xs',
                                            ]);
                                        },
                                        'delete' => function ($url, $model) {
                                            return Html::a('<i data-feather="trash"></i>', $url, [
                                                        'title' => Yii::t('app', 'delete'),
                                                        'class' => 'btn btn-outline-danger btn-xs',
                                                        'data-confirm' => Yii::t('yii', 'Are you sure you want to delete?'),
                                                        'data-method' => 'post',
                                            ]);
                                        },
                                    ],
                                    'urlCreator' => function ($action, $model)use($page_id) {
                                        if ($action === 'update') {
                                            $url = Url::to(['our-gallery', 'page_id' => $page_id, 'id' => $model->id]);
                                            return $url;
                                        }
                                        if ($action === 'delete') {
                                            $url = Url::to(['our-gallery-delete', 'page_id' => $page_id, 'id' => $model->id]);
                                            return $url;
                                        }
                                    }
                                ],
                            ],
                        ]);
                        ?>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
