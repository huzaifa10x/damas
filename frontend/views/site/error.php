<?php
/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */

/** @var Exception $exception */
use yii\helpers\Url;
use common\models\Words;

// $this->title = $name;
$this->title = 'Damas | Not Found Page';
$language = 'en';
if(isset(Yii::$app->session['language']) && Yii::$app->session['language'] != ''){
    $language = Yii::$app->session['language'];
}
?>
<div id="pageWrapper" class="errorPage">
    <section id="error">
        <div class="container">
            <div class="bgImage">

                <img alt="image" src="<?= Yii::$app->homeUrl ?>images/errorBg.png" data-src="<?= Yii::$app->homeUrl ?>images/errorBg.png" class="lazy"
                     loading="lazy" width="1362" height="539" />
            </div>
            <div class="row">
                <div class="page_cntnt">
                    <h1 class="head_two"><?= Words::getValue($language, 'oops') ?></h1>
                    <h5 class="head_three"><?= Words::getValue($language, 'error_description') ?></h5>
                    <div class="btnWrap">
                        <a href="<?= Url::to(['site/index', 'language' => $language]); ?>" class="baseBtn hoveranim">
                            <div class="lnk"><?= Words::getValue($language, 'get_home_page') ?></div>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="5.156" height="9" viewBox="0 0 5.156 9">
                                    <path id="Exclusion_3" data-name="Exclusion 3" d="M-3697-75l5.156,4.516h0L-3697-66Z"
                                          transform="translate(3697 75)" fill="#763813" />
                                </svg>


                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
