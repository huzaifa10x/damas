<?php
/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var \common\models\LoginForm $model */
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Damas | password reset';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div id="pageWrapper" class="authPage">
    <section id="loginSec">
        <div class="Custom_container">
            <div class="dFlex">
                <div class="lft">
                    <div class="imgBx">
                        <img alt="image" src="<?= Yii::$app->homeUrl ?>images/logImg.jpg" data-src="assets/images/logImg.jpg" class="lazy"
                             loading="lazy" width="982" height="871" />
                    </div>
                </div>
                <div class="ryt">
                    <div class="formWrap">
                        <div class="formTle">
                            <h1 class="mTle">Forgot <br> Password?</h1>
                            <h6 class="sTle">Enter your registered email, we will send intrsuctions to reset your password</h6>
                        </div>
                        <div class="formBox">
                            <?php
                            $form = ActiveForm::begin([
                                        'options' => ['class' => 'loginForm']
                            ]);
                            ?>
                            <?= \common\widgets\Alert::widget() ?>
                            <div class="row">
                                <div class="col-12 ">
                                    <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                                </div>
                                <div class="col-12">
                                    <div class="btnWrap">
                                        <button type="submit" class="baseBtn hoveranim">
                                            <span>Submit</span>
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="5.156" height="9"
                                                     viewBox="0 0 5.156 9">
                                                <path id="Exclusion_3" data-name="Exclusion 3"
                                                      d="M0,0,5.156,4.516h0L0,9Z" fill="#fff" />
                                                </svg>

                                            </span>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <p class="createTxt txt">Don't have an account? <a href="<?= Url::to(['site/signup', 'language' => $language]); ?>"> Sign
                                            up</a></p>
                                </div>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>

</div>


<!-- SCROLL MAGIC -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.8/ScrollMagic.min.js"
        integrity="sha512-8E3KZoPoZCD+1dgfqhPbejQBnQfBXe8FuwL4z/c8sTrgeDMFEnoyTlH3obB4/fV+6Sg0a0XF+L/6xS4Xx1fUEg=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
// SHOW PASSWORD
    $('.showPass span').click(function () {
        if ($(this).hasClass('show')) {
            $(this).closest('.PassWrp').find("input").attr('type', 'password');
            $(this).removeClass('show');
            $(this).addClass('hide');
        } else {
            $(this).closest('.PassWrp').find("input").attr('type', 'text');
            $(this).addClass('show');
            $(this).removeClass('hide');
        }
    });

</script>

