<?php

use yii\helpers\Url;
use common\models\Words;

$this->title = 'Damas | Cart';
?>
<div id="pageWrapper" class="checkoutPage">
    <section id="checkoutSec">
        <div class="container">
            <div id="emptyCrt">
                <div class="container">
                    <div class="emptybx">
                        <div class="imgBx">
                            <img src="<?= Yii::$app->homeUrl ?>images/empty-cart.png" alt="checkoutSec">
                        </div>
                        <h1 class="emptyTitle">
                            <?= Words::getValue($language, 'your_cart_is_empty') ?>
                        </h1>
                        <div class="subtitle">
                            <?= Words::getValue($language, 'add_item_to_it_now') ?>
                            
                        </div>
                        <a href="<?= Url::to(['site/offers', 'language' => $language]); ?>" class="prod_link hoveranim">
                            <span><?= Words::getValue($language, 'get_the_offers') ?></span>
                        </a>
                    </div>
                </div>
            </div>


        </div>
    </section>

</div>
