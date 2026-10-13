<?php
/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var \common\models\LoginForm $model */
use yii\helpers\Url;
use yii\widgets\ActiveForm;

// $this->params['breadcrumbs'][] = $this->title;
    $this->title = 'Damas | Login';
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
                            <h1 class="mTle">Login to <br> Your Account</h1>
                            <h6 class="sTle">Sign in if you have an account in here.</h6>
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
                                    <div class="form-group">
                                        <div>
                                            <?=
                                            $form->field($model, 'username')->textInput([
                                                'class' => 'form-control',
                                                'placeholder' => '',
                                                'autofocus' => true,
                                                'id' => 'name'
                                            ])->label('Email/Mobile Number')
                                            ?>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-12">
                                    <div class="form-group PassWrp">
                                        <div class="inputWrap hasIcon">
                                            <?=
                                            $form->field($model, 'password')->passwordInput([
                                                'class' => 'form-control',
                                                'placeholder' => '***********',
                                                'id' => 'password1'
                                            ])->label('Password')
                                            ?>
                                            <div class="icon showPass">
                                                <span class="hide">
                                                    <svg class="show" viewBox="0 0 128 128">
                                                    <path id="Show"
                                                          d="m64 104c-41.873 0-62.633-36.504-63.496-38.057-.672-1.209-.672-2.678 0-3.887.863-1.552 21.623-38.056 63.496-38.056s62.633 36.504 63.496 38.057c.672 1.209.672 2.678 0 3.887-.863 1.552-21.623 38.056-63.496 38.056zm-55.293-40.006c4.758 7.211 23.439 32.006 55.293 32.006 31.955 0 50.553-24.775 55.293-31.994-4.758-7.211-23.439-32.006-55.293-32.006-31.955 0-50.553 24.775-55.293 31.994zm55.293 24.006c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm0-40c-8.822 0-16 7.178-16 16s7.178 16 16 16 16-7.178 16-16-7.178-16-16-16z"/>
                                                    </svg>
                                                    <svg class="hide" viewBox="0 0 21.075 15.806">
                                                    <path id="Hide" class="cls-1"
                                                          d="M13.154,24.08l1.2-1.2a3.937,3.937,0,0,1-4.833,4.833l1.2-1.2a2.623,2.623,0,0,0,2.439-2.439Zm7.838-.5a13.794,13.794,0,0,0-3.476-3.865l-.958.958A13.181,13.181,0,0,1,19.641,23.9c-.781,1.189-3.843,5.268-9.1,5.268a9.677,9.677,0,0,1-2.213-.262L7.242,29.992a11.156,11.156,0,0,0,3.3.5c6.894,0,10.312-6.01,10.454-6.266a.658.658,0,0,0,0-.64Zm-2.744-6.459L3.759,31.613a.658.658,0,1,1-.931-.931l1.843-1.843A13.819,13.819,0,0,1,.083,24.223a.658.658,0,0,1,0-.64c.142-.256,3.56-6.266,10.454-6.266a11.09,11.09,0,0,1,4.647,1.008l2.132-2.132a.658.658,0,1,1,.931.931ZM5.653,27.856,7.32,26.189a3.945,3.945,0,0,1,5.5-5.5l1.348-1.348a9.7,9.7,0,0,0-3.634-.7c-5.261,0-8.323,4.079-9.1,5.268a12.931,12.931,0,0,0,4.219,3.954Zm2.623-2.624,3.591-3.591a2.6,2.6,0,0,0-1.33-.373A2.637,2.637,0,0,0,7.9,23.9,2.6,2.6,0,0,0,8.276,25.232Z"
                                                          transform="translate(0 -16)"/>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="helpWrap">
                                        <div class="cCheckBtn chkBox">
                                            <?=
                                            $form->field($model, 'rememberMe')->checkbox([
                                                'id' => 'check1',
                                                'label' => 'Remember me',
                                                'required' => true
                                            ])->label(false)
                                            ?>
                                        </div>

                                        <a href="<?= Url::to(['site/forgot-password', 'language' => $language]); ?>" class="fPasswordBtn txt"
                                           >Forgot Password?</a>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="btnWrap">
                                        <button type="submit" class="baseBtn hoveranim">
                                            <span>Login</span>
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

