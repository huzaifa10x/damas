<?php

use yii\helpers\Url;
use yii\helpers\Html;
use common\models\Words;

$currentUrl = Url::to(Yii::$app->request->url, true);
$controller = Yii::$app->controller->id;
$action     = Yii::$app->controller->action->id;
$homeUrl    = Yii::$app->homeUrl;
$language   = !empty($this->params['language']) ? $this->params['language'] : 'en';
$isAr       = ($language === 'ar');
$action_url = $controller . '/' . $action;


$this->registerCssFile(Yii::$app->homeUrl . 'css/related-product-cards.css');
$formatPrice = static function ($amount) {
    return rtrim(rtrim(number_format((float) $amount, 2, '.', ','), '0'), '.');
};

foreach ($related_products as $related_product):
    $productName = $language === 'ar' ? $related_product->product_name_arabic : $related_product->product_name;
    $description = $language === 'ar' ? $related_product->short_description_arabic : $related_product->short_description;
    $productUrl = Url::to(['site/product-details', 'language' => $language, 'slug' => $related_product->canonical_name]);
    $imageUrl = Yii::$app->homeUrl . 'uploads/products/' . $related_product->image;

    $price = (float) $related_product->price;
    $offerPrice = (float) $related_product->offer_price;
    $hasOffer = $offerPrice > 0 && $price > 0 && $offerPrice < $price;
    $currentPrice = $hasOffer ? $offerPrice : $price;
    $discountPercent = $hasOffer ? (int) round(100 - (($offerPrice / $price) * 100)) : 0;
    ?>
    <article class="relatedBox relatedProductCard" dir="<?= $language === 'ar' ? 'rtl' : 'ltr' ?>">
        <a class="relatedProductCard__imageLink" href="<?= $productUrl ?>" aria-label="<?= Html::encode($productName) ?>">
            <div class="relatedProductCard__image">
                <img src="<?= Html::encode($imageUrl) ?>" data-src="<?= Html::encode($imageUrl) ?>" class="lazy"
                     loading="lazy" decoding="async" width="400" height="245" alt="<?= Html::encode($productName) ?>">
                <?php if ($discountPercent > 0): ?>
                    <span class="relatedProductCard__discount"><?= $discountPercent ?>% <?= Html::encode(Words::getValue($language, 'off')) ?></span>
                <?php endif; ?>
                <span class="relatedProductCard__title"><?= Html::encode($productName) ?></span>
            </div>
        </a>
        <div class="relatedProductCard__body">
            <p class="relatedProductCard__description"><?= Html::encode(trim(strip_tags((string) $description))) ?></p>
            <div class="relatedProductCard__prices">
                <span class="relatedProductCard__price"><?= Html::encode($formatPrice($currentPrice)) ?> AED</span>
                <?php if ($hasOffer): ?>
                    <del class="relatedProductCard__oldPrice"><?= Html::encode($formatPrice($price)) ?> AED</del>
                <?php endif; ?>
            </div>
            <div class="relatedProductCard__actions">
                <button type="button" class="relatedProductCard__book" data-bs-toggle="modal" data-bs-target="#bookingModal">
                    <span><?= Html::encode(Words::getValue($language, 'book_an_appointment')) ?></span><span aria-hidden="true">›</span>
                </button>
                <a href="javascript:void(0)" class="relatedProductCard__pay add-to-cart" data-product="<?= (int) $related_product->id ?>" data-variant="">
                    <?= Html::encode(Words::getValue($language, 'pay_now')) ?>
                </a>
            </div>
            <a class="relatedProductCard__more" href="<?= Html::encode($related_product->link ?: $productUrl) ?>">
                <?= Html::encode(Words::getValue($language, 'more_details')) ?><span aria-hidden="true">→</span>
            </a>
        </div>
    </article>
<?php endforeach; ?>
