<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Change Password';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
?>
<div class="page-content">
    <nav class="page-breadcrumb align-items-center d-flex">
        <ol class="breadcrumb w-50 mb-0">
             <li class="breadcrumb-item"><?= Html::a('Dashboard', ['site/index']) ?></li>
            <li class="breadcrumb-item active" aria-current="page">
                <?= Html::encode($this->title) ?>
            </li>
        </ol>
        <div class="float-left d-flex  w-50">
            <?= Html::a('Manage
            Admin Users', ['index'], ['class' => 'btn btn-outline-primary ml-auto', 'style' => 'margin-left: auto;',])
            ?>
        </div>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <?= \common\widgets\Alert::widget() ?>
                   <div class="row">
                            <div class="col-lg-12">
                                <?php $form = ActiveForm::begin(['class' => 'form-horizontal']); ?>
                                <div class="row">
                                    <div class='col-md-4 col-sm-4 col-xs-12 left_padd'>
                                        <label for="inputEmail3" class="control-label">New Password</label>
                                        <?= $form->field($model, 'new_password')->passwordInput()->label(FALSE) ?>
                                    </div>
                                    <div class='col-md-4 col-sm-4 col-xs-12 left_padd'>
                                        <label for="inputEmail3" class="control-label">Confirm Password</label>
                                        <?= $form->field($model, 'confirm_password')->passwordInput()->label(FALSE) ?>
                                    </div>
                                    <div class='col-md-4 col-sm-4 col-xs-12 left_padd'>
                                            <?= Html::submitButton('Submit', ['class' => 'btn btn-success', 'style' => 'float:left;margin-top:20px;']) ?>
                                       
                                    </div>
                                </div>
                                <?php ActiveForm::end(); ?>

                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
