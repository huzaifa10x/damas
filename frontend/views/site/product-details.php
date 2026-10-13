<?php

/** @var yii\web\View $this */
use yii\helpers\Url;
use common\models\Words;

// $this->params['breadcrumbs'][] = $this->title;
// $this->title = 'Damas | ' . $product_details->product_name;
?>
<div id="pageWrapper" class="servicePage">
    <section id="servicedetails">
        <div class="container">
            <div class="row">
                <div class="col-xl-7  col-lg-6">
                    <a href="<?= Yii::$app->homeUrl ?>uploads/products/<?= $product_details->image ?>" class="imgBox" data-fancybox="serviceImg">
                        <img src="<?= Yii::$app->homeUrl ?>uploads/products/<?= $product_details->image ?>" data-src="<?= Yii::$app->homeUrl ?>uploads/products/<?= $product_details->image ?>" class="lazy" loading="lazy"
                             width="720" height="480" alt="serviceImg">
                    </a>
                </div>
                <div class="col-xl-5 col-lg-6">
                    <div class="serviceBox">
                        <h1 class="title"><?= $language == 'ar' ? $product_details->product_name_arabic : $product_details->product_name ?></h1>
                        <!--<div class="rateBx">-->
                        <!--    <div class="ratingstar" data-rating="<?php // round($averageRating ?? 0) ?>">-->
                        <!--    </div>-->
                        <!--    <div class="rateTxt"> <?php // round($averageRating ?? 0) ?> Out of 5 stars</div>-->
                        <!--</div>-->
                        <div class="priceBx">
                            <?php if ($actual_price > 0) { ?>
                                <div class="price"> <?= $now_price ?>AED </div>
                                <div class="offPrice"> <?= $actual_price ?>AED </div>
                            <?php } else { ?>
                                <div class="price"> <?= $now_price ?>AED </div>
                            <?php }
                            ?>
                            <?php
                            if ($percentage > 0) {
                                ?>
                                <div class="tag"> <?= $percentage ?>%off</div>
                                <?php
                            }
                            ?>
                        </div>
                        <?= $language == 'ar' ? $product_details->description_arabic : $product_details->description ?>
                        <div class="btnBx">
                            <div class="item">
                                <a href="#appointment" class="cmnBtn hoveranim" data-bs-toggle="modal"
                                   data-bs-target="#bookingModal">
                                    <span><?= Words::getValue($language, 'book_an_appointment') ?></span>
                                </a>
                            </div>
                            <div class="item">
                                <a href="javscript:void(0)" class="cmnBtn white hoveranim add-to-cart" data-product="<?= $product_details->id ?>">
                                    <span><?= Words::getValue($language, 'pay_now') ?></span>
                                </a>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="details">
        <div class="container">
            <div class="accordHead">
                <div class="accordion-header" id="headingOne">
                    <button class="accordion-button " type="button" data-bs-toggle="collapse"
                            data-bs-target="#detailAccord1" aria-expanded="true" aria-controls="detailAccord1">
                        Benefits of the treatment
                    </button>
                </div>
                <div class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#detailAccord2" aria-expanded="false" aria-controls="detailAccord2">
                        Before & After images
                    </button>
                </div>
                <div class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#detailAccord3" aria-expanded="false" aria-controls="detailAccord3">
                        Write a Review
                    </button>
                </div>
                <div class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#detailAccord4" aria-expanded="false" aria-controls="detailAccord4">
                        FAQ
                    </button>
                </div>
                <div class="accordion-header" id="headingFive">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#detailAccord5" aria-expanded="false" aria-controls="detailAccord5">
                        Terms & conditions
                    </button>
                </div>

            </div>
            <div class="accordion" id="detailAccord">
                <div class="accordion-item">
                    <div class="accordion-header" id="headingOne">
                        <button class="accordion-button detlccBtn" type="button" data-bs-toggle="collapse"
                                data-bs-target="#detailAccord1" aria-expanded="true" aria-controls="detailAccord1">
                            Benefits of the treatment
                        </button>
                    </div>
                    <div id="detailAccord1" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                         data-bs-parent="#detailAccord">
                        <div class="accordion-body">
                            <div class="element">
                                <img src="<?= Yii::$app->homeUrl ?>images/elementF.svg" alt="image">
                            </div>
                            <?php
                            if (!empty($benefits_of_treatments)) {
                                foreach ($benefits_of_treatments as $benefits) {
                                    ?>
                                    <div class="mainTxt"><?= $language == 'ar' ? $benefits->title_arabic : $benefits->title ?></div>
                                    <?= $language == 'ar' ? $benefits->description_arabic : $benefits->description ?>
                                    <?php
                                    if ($benefits->image != '') {
                                        ?>
                                        <div class="imGBox">
                                            <img src="<?= Yii::$app->homeUrl ?>uploads/product-benefits/<?= $benefits->image ?>" data-src="<?= Yii::$app->homeUrl ?>uploads/product-benefits/<?= $benefits->image ?>" class="lazy"
                                                 loading="lazy" width="1350" height="440" alt="<?= $language == 'ar' ? $benefits->title_arabic : $benefits->title ?>">
                                        </div>
                                        <?php
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header" id="headingTwo">
                        <button class="accordion-button detlccBtn collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#detailAccord2" aria-expanded="false" aria-controls="detailAccord2">
                            Before & After images
                        </button>
                    </div>
                    <div id="detailAccord2" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                         data-bs-parent="#detailAccord">
                        <?php
                        if (!empty($before_after_images)) {
                        ?>
                        <div class="accordion-body">
                            <div class="element">
                                <img src="<?= Yii::$app->homeUrl ?>images/elementF.svg" alt="image">
                            </div>
                            <div class="copmarsnWrap">
                                <div class="dFlex">
                                    <?php
                                    if (!empty($before_after_images)) {
                                        $k = 0;
                                        foreach ($before_after_images as $before_after_image) {
                                            $k++;
                                            ?>
                                            <div class="item">
                                                <div class="coparisonBx">
                                                    <div id="comparison" class="comparison">
                                                        <figure>
                                                            <div class="imgBx">
                                                                <img src="<?= Yii::$app->homeUrl ?>uploads/product-gallery/<?= $before_after_image->after_image ?>"
                                                                     data-src="<?= Yii::$app->homeUrl ?>uploads/product-gallery/<?= $before_after_image->after_image ?>" class="lazy"
                                                                     loading="lazy" width="312" height="395" alt="coparisonBx">
                                                            </div>
                                                            <div class="handle" data-slider-id="slider<?= $k ?>"  >
                                                            </div>
                                                            <div class="divisor" data-slider-id="slider<?= $k ?>"
                                                                 style="background-image: url(&quot;<?= Yii::$app->homeUrl ?>uploads/product-gallery/<?= $before_after_image->before_image ?>&quot); width: 57%;">
                                                            </div>
                                                        </figure>
                                                        <input type="range" min="0" max="100" value="50" id="slider<?= $k ?>"
                                                               oninput="moveDivisor('slider<?= $k ?>')">
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header" id="headingThree">
                        <button class="accordion-button detlccBtn collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#detailAccord3" aria-expanded="false" aria-controls="detailAccord3">
                            Write a Review
                        </button>
                    </div>
                    <div id="detailAccord3" class="accordion-collapse collapse" aria-labelledby="headingThree"
                         data-bs-parent="#detailAccord">
                        <div class="accordion-body">
                            <div class="element">
                                <img src="<?= Yii::$app->homeUrl ?>images/elementF.svg" alt="image">
                            </div>
                            <div class="reviewBx">
                                <div class="contactSec">
                                    <form id="review-form" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="service" value="<?= $product_details->id ?>" />
                                        <div class="topBx">
                                            <div class="rvwWrp">
                                                <div class="tle">Add Reviews</div>
                                                <div class="rateBx">
                                                    <div class="txt">Rating</div>
                                                    <div class="stars" data-stars="1">

                                                        <svg viewBox="0 0 24.532 23.332" class="star rating"
                                                             data-rating="1">
                                                        <path id="Path_103754" data-name="Path 103754"
                                                              d="M26.239,32.276,32.371,26.3,23.9,25.068l-3.79-7.681-3.79,7.681L7.839,26.3l6.135,5.978-1.449,8.441,7.581-3.986,7.581,3.987Zm-6.133,2.613-5.414,2.846,1.035-6.027-4.38-4.269,6.052-.88L20.1,21.075l2.706,5.484,6.053.88-4.379,4.269,1.033,6.027Z"
                                                              transform="translate(-7.839 -17.387)" />
                                                        </svg>

                                                        <svg viewBox="0 0 24.532 23.332" class="star rating"
                                                             data-rating="2">
                                                        <path id="Path_103754" data-name="Path 103754"
                                                              d="M26.239,32.276,32.371,26.3,23.9,25.068l-3.79-7.681-3.79,7.681L7.839,26.3l6.135,5.978-1.449,8.441,7.581-3.986,7.581,3.987Zm-6.133,2.613-5.414,2.846,1.035-6.027-4.38-4.269,6.052-.88L20.1,21.075l2.706,5.484,6.053.88-4.379,4.269,1.033,6.027Z"
                                                              transform="translate(-7.839 -17.387)" />
                                                        </svg>
                                                        <svg viewBox="0 0 24.532 23.332" class="star rating"
                                                             data-rating="3">
                                                        <path id="Path_103754" data-name="Path 103754"
                                                              d="M26.239,32.276,32.371,26.3,23.9,25.068l-3.79-7.681-3.79,7.681L7.839,26.3l6.135,5.978-1.449,8.441,7.581-3.986,7.581,3.987Zm-6.133,2.613-5.414,2.846,1.035-6.027-4.38-4.269,6.052-.88L20.1,21.075l2.706,5.484,6.053.88-4.379,4.269,1.033,6.027Z"
                                                              transform="translate(-7.839 -17.387)" />
                                                        </svg>
                                                        <svg viewBox="0 0 24.532 23.332" class="star rating"
                                                             data-rating="4">
                                                        <path id="Path_103754" data-name="Path 103754"
                                                              d="M26.239,32.276,32.371,26.3,23.9,25.068l-3.79-7.681-3.79,7.681L7.839,26.3l6.135,5.978-1.449,8.441,7.581-3.986,7.581,3.987Zm-6.133,2.613-5.414,2.846,1.035-6.027-4.38-4.269,6.052-.88L20.1,21.075l2.706,5.484,6.053.88-4.379,4.269,1.033,6.027Z"
                                                              transform="translate(-7.839 -17.387)" />
                                                        </svg>
                                                        <svg viewBox="0 0 24.532 23.332" class="star rating"
                                                             data-rating="5">
                                                        <path id="Path_103754" data-name="Path 103754"
                                                              d="M26.239,32.276,32.371,26.3,23.9,25.068l-3.79-7.681-3.79,7.681L7.839,26.3l6.135,5.978-1.449,8.441,7.581-3.986,7.581,3.987Zm-6.133,2.613-5.414,2.846,1.035-6.027-4.38-4.269,6.052-.88L20.1,21.075l2.706,5.484,6.053.88-4.379,4.269,1.033,6.027Z"
                                                              transform="translate(-7.839 -17.387)" />
                                                        </svg>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="phtoBx">
                                                <input type="file" id="imageUpload" name="file" accept=".png, .jpg, .jpeg">
                                                <label for="imageUpload" id="imageUploadLabel">
                                                    <div class="tx">Add Photo <span>+</span></div>
                                                </label>

                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="formGroup">
    <input type="text" class="form-control" name="name" id="review-name"
           placeholder="Enter your Name" required
           pattern="[A-Za-z\s]+" title="Name should only contain letters and spaces.">
</div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="formGroup">
                                                    <input type="email" class="form-control" required  name="email" id="review-email" pattern="^[^@]+@[^@]+\.[^@]+$" 
           title="Please enter a valid email address with a proper domain (e.g., user@example.com)."
                                                           placeholder="Enter your Email">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="formGroup">
                                                    <input type="text" class="form-control" required  name="review_title" id="review-title" pattern="[A-Za-z\s]+" title="Title should only contain letters and spaces."
                                                           placeholder="Title of Review">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="formGroup">
                                                    <textarea class="form-control" name="message" id="review-message" placeholder="How was your overall Experience?" required></textarea>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <button class="hoveranim cmnBtn" type="submit">
                                                    <span>Submit Review</span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    <div id="message" style="color:#689F38"></div>
                                </div>
                            </div>
                            <?php
                            if (!empty($reviews)) {
                            ?>
                            <div id="review">
                                <div class="container">
                                    <div class="flxBox wow animate__fadeInUp" data-wow-duration="1.5s">
                                        <div class="leftSec">
                                            <div class="mainHead">
                                                <div class="head">Customer Reviews</div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="reviewSlider owl-carousel wow animate__fadeInUp"
                                         data-wow-duration="1.5s">
                                             <?php
                                             if (!empty($reviews)) {
                                                 foreach ($reviews as $review) {
                                                     ?>
                                                <div class="item">
                                                    <a href="javascript:void(0)" class="reviewBx">
                                                        <!--                                                        <div class="goImg">
                                                                                                                    <img src="<?php // Yii::$app->homeUrl    ?>images/google.svg" alt="damasmc">
                                                                                                                </div>-->
                                                        <div class="avtBx">
                                                            <div class="avImg">
                                                                <div class="icon">
                                                                    <img src="<?= Yii::$app->homeUrl ?>uploads/product-reviews/<?= $review->image ?>"
                                                                         data-src="<?= Yii::$app->homeUrl ?>uploads/product-reviews/<?= $review->image ?>" class="lazy"
                                                                         loading="lazy" width="45" height="45" alt="product-reviews">
                                                                </div>
                                                            </div>
                                                            <div class="info">
                                                                <div class="name"><?= $review->name ?></div>
                                                                <div class="post"><?= date("d F Y", strtotime($review->date)); ?></div>
                                                            </div>
                                                        </div>
                                                        <div class="rateBx">
                                                            <div class="starrs" data-rating="<?= $review->rating ?>">
                                                            </div>
                                                        </div>
                                                        <div class="content">
                                                            <p><?= $review->message ?></p>
                                                        </div>
                                                    </a>
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header" id="headingFour">
                        <button class="accordion-button detlccBtn collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#detailAccord4" aria-expanded="false" aria-controls="detailAccord4">
                            FAQ
                        </button>
                    </div>
                    <div id="detailAccord4" class="accordion-collapse collapse" aria-labelledby="headingFour"
                         data-bs-parent="#detailAccord">
                        <?php
                        if (!empty($faqs)) {
                        ?>
                        <div class="accordion-body">
                            <div class="element">
                                <img src="<?= Yii::$app->homeUrl ?>images/elementF.svg" alt="image">
                            </div>
                            <div class="faqWrap">
                                <div class="accordion CommonAccord" id="OffshoreAccordfaq">
                                    <div class="item">
                                        <?php
                                        if (!empty($faqs)) {
                                            $totcount = count($faqs);
                                            $count = ceil(count($faqs) / 2);
                                            $m = 0;
                                            foreach ($faqs as $faq) {
                                                $m++;
                                                ?>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingOne">
                                                        <button class="accordion-button faqAcordBtn collapsed" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#OffshoreAccordfaq<?= $faq->id ?>"
                                                                aria-expanded="false" aria-controls="OffshoreAccordfaq<?= $faq->id ?>">
                                                            <div class="numTxt">
                                                                <?= sprintf('%02d', $m); ?>.
                                                            </div>

                                                            <?= $language == 'ar' ? $faq->question_arabic : $faq->question ?>
                                                        </button>
                                                    </h2>
                                                    <div id="OffshoreAccordfaq<?= $faq->id ?>" class="accordion-collapse collapse"
                                                         aria-labelledby="heading<?= $faq->id ?>" data-bs-parent="#OffshoreAccordfaq">
                                                        <div class="accordion-body">
                                                            <?= $language == 'ar' ? $faq->answer_arabic : $faq->answer ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php if ($m == $count) { ?>
                                                </div>
                                                <div class="item">
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header" id="headingFive">
                        <button class="accordion-button detlccBtn collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#detailAccord5" aria-expanded="false" aria-controls="detailAccord5">
                            Terms & conditions
                        </button>
                    </div>
                    <div id="detailAccord5" class="accordion-collapse collapse" aria-labelledby="headingFive"
                         data-bs-parent="#detailAccord">
                         <?php
                            if (!empty($terms_conditions)) {
                            ?>
                        <div class="accordion-body">
                            <div class="element">
                                <img src="<?= Yii::$app->homeUrl ?>images/elementF.svg" alt="image">
                            </div>
                           
                            <div class="termsBody">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="sideNav">
                                            <ul>
                                                <?php
                                                if (!empty($terms_conditions)) {
                                                    $r = 0;
                                                    foreach ($terms_conditions as $terms_condition) {
                                                        $r++;
                                                        ?>
                                                        <li>
                                                            <a href="javascript:void(0)" class="pageLink"
                                                               data-bs-toggle="collapse" data-bs-target="#faqAccord<?= $terms_condition->id ?>"
                                                               aria-expanded="<?= $r == 1 ? 'true' : 'false' ?>" aria-controls="faqAccord<?= $terms_condition->id ?>">
                                                                <?= $language == 'ar' ? $terms_condition->title_arabic : $terms_condition->title ?></a>
                                                        </li>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="accordion  faqAccord" id="faqAccord">
                                            <?php
                                            if (!empty($terms_conditions)) {
                                                $s = 0;
                                                foreach ($terms_conditions as $terms_condition) {
                                                    $s++;
                                                    ?>
                                                    <div class="accordion-item">
                                                        <div id="faqAccord<?= $terms_condition->id ?>" class="accordion-collapse collapse <?= $s == 1 ? 'show' : '' ?>"
                                                             aria-labelledby="heading<?= $terms_condition->id ?>" data-bs-parent="#faqAccord">
                                                            <div class="accordion-body">

                                                                <div class="contenetBx">

                                                                    <h3>Terms & Conditions</h3>

                                                                    <?= $language == 'ar' ? $terms_condition->terms_and_condition_arabic : $terms_condition->terms_and_condition ?>
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <?php
                            }
                            ?>
                    </div>
                </div>
            </div>

        </div>
</div>
</section>
<?php
if (!empty($related_products)) {
    ?>
    <section id="relatedService">
        <div class="container">
            <div class="flxBox wow animate__fadeInUp" data-wow-duration="1.5s">
                <div class="leftSec">
                    <div class="mainHead">
                        <div class="head"><?= Words::getValue($language, 'related_services') ?></div>
                    </div>
                </div>
                <div class="rtSec">
                    <!--                    <a href="javascript:void(0)" class="cmnBtnLinks">
                                            View all Services
                                        </a>-->
                </div>
            </div>
            <div class="relatedSlider owl-carousel">
                <?php
                foreach ($related_products as $related_product) {
                    ?>
                    <div class="item">
                        <?= common\components\ProductListIingWidget::widget(['product_id' => $related_product->id, 'language' => $language]) ?>
                    </div>
                <?php }
                ?>
            </div>
        </div>
    </section>

    <?php
}
?>

<!-- FANCY_BOX-->

<link rel="stylesheet" type="text/css"
      href="//cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.6/jquery.fancybox.min.css">
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.6/jquery.fancybox.min.js">
</script>

<!-- STAR RATING -->
<link rel="stylesheet" type="text/css" href="<?= Yii::$app->homeUrl ?>rating/star-rating-svg.css">
<script type="text/javascript" src="<?= Yii::$app->homeUrl ?>rating/star-rating-svg.js"></script>

<!-- select2 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<!-- BOOTSTRAP_SELECTPICKER -->

<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<!-- owl carousel  -->

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
      integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script>
    const starEls = document.querySelectorAll('.star.rating');
    starEls.forEach(star => {
        star.addEventListener('click', function (e) {
            let starEl = e.currentTarget;
            console.log(starEl.parentNode.dataset.rvwStar + ", " + starEl.dataset.rating);
            starEl.parentNode.setAttribute('data-stars', starEl.dataset.rating);
        });
    })

    $(".select").select2({
        minimumResultsForSearch: Infinity,
        theme: "bootstrap-5",
        containerCssClass: "select2--small", // For Select2 v4.0
        selectionCssClass: "select2--small", // For Select2 v4.1
        dropdownCssClass: "select2--small",
    });

// relatedSlider

    $('.relatedSlider').owlCarousel({

        rewind: true,
        autoplay: false,
        smartSpeed: 500,
        autoplayTimeout: 3500,
        autoplayHoverPause: true,
        nav: false,
        dots: false,
        items: 1,
        margin: 10,
        responsiveClass: true,
        responsive: {
            530: {
                items: 1.5,
                margin: 10,
            },
            678: {
                items: 2,
                margin: 10,
            },
            768: {
                items: 2.2,
                margin: 10,
            },
            992: {
                items: 2.5,
                margin: 10,
            },
            1200: {
                items: 3,
                margin: 10,
            },
            1441: {
                items: 3,
                margin: 22,
            }
        }

    });


// image comparison

    function moveDivisor(sliderId) {
        var slider = document.getElementById(`${sliderId}`);
        var divisor = document.querySelector(`.divisor[data-slider-id="${sliderId}"]`);
        var handle = document.querySelector(`.handle[data-slider-id="${sliderId}"]`);

        var sliderValue = slider.value;
        var width = 100 - sliderValue;

        handle.style.left = slider.value + "%";
        divisor.style.width = slider.value + "%";

    }



    $('.reviewSlider').owlCarousel({

        rewind: true,
        autoplay: false,
        smartSpeed: 500,
        autoplayTimeout: 3500,
        autoplayHoverPause: true,
        nav: false,
        dots: false,
        items: 1,
        margin: 10,
        responsiveClass: true,
        responsive: {
            520: {
                items: 2,
                margin: 15,
            },
            768: {
                items: 3,
                margin: 15,
            },
            992: {
                items: 3,
                margin: 15,
            },
            1441: {
                items: 3,
                margin: 22,
            }
        }

    });

// datepicker

    

    $(".ratingstar").starRating({
        totalStars: 5,
        emptyColor: '#CBCBCB',
        hoverColor: '#D5AE69',
        activeColor: '#D5AE69',
        initialRating: 4,
        strokeWidth: 40,
        strokeColor: '#d5ae6900',
        useGradient: false,
        starSize: 18,
        readOnly: true,

    });
    $(".starrs").starRating({
        totalStars: 5,
        emptyColor: '#CBCBCB',
        hoverColor: '#FFC107',
        activeColor: '#FFC107',
        initialRating: 4,
        strokeWidth: 40,
        strokeColor: '#d5ae6900',
        useGradient: false,
        starSize: 22,
        readOnly: true,

    });
</script>
<script>
    $(document).ready(function() {
        $('#imageUpload').on('change', function() {
            var fileInput = this;
            var file = fileInput.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                // Remove any existing image preview
                $('.image-preview').remove();

                // Create a new image element and set the source to the file
                $('<img>', {
                    src: e.target.result,
                    class: 'image-preview',
                    width: '100px' // Adjust width as needed
                }).insertAfter('#imageUploadLabel');
            };

            // Check if a file was selected
            if (file) {
                reader.readAsDataURL(file); // Convert the file to a data URL
            }
        });
    });
</script>
</div>