<?php
use common\models\Words;
use yii\helpers\Url;
?>
<div id="pageWrapper" class="legalPage">

    <section id="legalBanner">
        <div class="container">
            <div class="bnrWrap">
                <div class="tleWrap">
                    <h1 class="tle"><?= Words::getValue($language, 'terms_and_condition') ?></h1>
                    <div class="info">
                        <?= $language == 'ar' ? $data->description_arabic : $data->description ?>
                    </div>
                </div>
                <div class="iconBx">
                    <img src="<?= Yii::$app->homeUrl ?>images/termsIcon.svg" data-src="<?= Yii::$app->homeUrl ?>images/termsIcon.svg" alt="missionTransform" width="1920" height="520" class="lazy" loading="lazy">
                </div>
            </div>
        </div>
    </section>
    
    <!-- Breadcrumb -->

    <section id="Breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="<?= Url::to(['site/index', 'language' => $language]); ?>"><?= Words::getValue($language, 'home') ?></a></li>
                <li class="active"><?= Words::getValue($language, 'terms_and_condition') ?></li>
            </ul>
        </div>
    </section>

    <!-- Breadcrumb end -->


    <section id="content">
        <div class="container">

            <div class="contenetBx">
<?= $language == 'ar' ? $data->more_details_arabic : $data->more_details ?>

                <h3>VII. DAMAS MEDICAL CENTRE L.L.C.SP</h3>
                <ul>
	<li>DAMAS MEDICAL CENTRE L.L.C.SP” maintains the https://damasmc.com/.</li>
	<li>"United Arab of Emirates is our country of domicile" and stipulate that the governing law is the local law.</li>
	<li>Visa or MasterCard debit and credit cards in AED will be accepted for payment</li>
	<li>The displayed price and currency at the checkout page, will be the same price and currency printed on the Transaction Receipt and the amount charged to the card will be shown in your card currency.</li>
	<li>We will not trade with or provide any services to OFAC and sanctioned countries</li>
	<li>Customer using the website who are Minor /under the age of 18 shall not register as a User of the website and shall not transact on or use the website</li>
	<li>Cardholder must retain a copy of transaction records and https://damasmc.com/ policies and rules</li>
	<li>User is responsible for maintaining the confidentiality of his account</li>
</ul>
 
            </div>
            

        </div>
    </section>

</div>
