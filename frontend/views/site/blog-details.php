<?php
use yii\helpers\Url;
use common\models\Words;
?>
<div id="pageWrapper" class="blogPage">
    <section id="blogdetailSec">
        <div class="container">
            <div class="tleWrap">
                <div class="topT">
                    <div class="lft"><?= date("l, d F, Y", strtotime($blog_details->date)); ?></div>
                    <span></span>
                    <div class="ryt"># <?= Words::getValue($language, 'blog') ?></div>
                </div>
                <h1 class="tle"><?= $language == 'ar' ? $blog_details->title_arabic : $blog_details->title ?>
                </h1>
            </div>
            <div class="vdoWrap">
                <?php if ($blog_details->video != '') { ?>
                    <a href="<?= Yii::$app->homeUrl ?>uploads/blogs/<?= $blog_details->video ?>" class=" vdoBx" data-fancybox="proGal">
                        <img alt="image" src="<?= Yii::$app->homeUrl ?>uploads/blogs/<?= $blog_details->main_image ?>" data-src="<?= Yii::$app->homeUrl ?>uploads/blogs/<?= $blog_details->main_image ?>" class="lazy"
                             loading="lazy" width="1350" height="562" />
                        <div class="iconwrap">
                            <div class="icon">
                                <img alt="image" src="<?= Yii::$app->homeUrl ?>images/utube.svg" class="lazy" width="9" height="10" />
                            </div>
                        </div>
                    </a>
                <?php } else { ?>
                    <a href="javascript:void(0);" class=" vdoBx">
                        <img alt="image" src="<?= Yii::$app->homeUrl ?>uploads/blogs/<?= $blog_details->main_image ?>" data-src="<?= Yii::$app->homeUrl ?>uploads/blogs/<?= $blog_details->main_image ?>" class="lazy"
                             loading="lazy" width="1350" height="562" />
                    </a>
                <?php }
                ?>

            </div>
            <div class="info">
                <?= $language == 'ar' ? $blog_details->description_arabic : $blog_details->description ?>
            </div>
            <?php
            if ($blog_details->image1 != '' || $blog_details->image2 != '') {
                ?>
                <div class="gallWrap">
                    <div class="dFlex">
                        <?php
                        if ($blog_details->image1 != '') {
                            ?>
                            <div class="item">
                                <div class="imgBx">
                                    <img alt="image" src="<?= Yii::$app->homeUrl ?>uploads/blogs/<?= $blog_details->image1 ?>" class="lazy" width="659" height="359" />
                                </div>
                            </div>
                            <?php
                        }
                        if ($blog_details->image2 != '') {
                            ?>
                            <div class="item">
                                <div class="imgBx">
                                    <img alt="image" src="<?= Yii::$app->homeUrl ?>uploads/blogs/<?= $blog_details->image2 ?>" class="lazy" width="659" height="359" />
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
            }
            if ($blog_details->more_details_arabic != '' && $blog_details->more_details != '') {
                ?>
                <div class="contBx">
                    <div class="element">
                        <img alt="image" src="<?= Yii::$app->homeUrl ?>images/elementCnt.svg" class="lazy" width="292" height="296">
                    </div>
                    <?= $language == 'ar' ? $blog_details->more_details_arabic : $blog_details->more_details ?>
                </div>
                <?php
            }
            ?>
        </div>
    </section>
    <?php
    if (!empty($blogs)) {
        ?>
        <section id="relatedblogSec">
            <div class="container">
                <div class="flxBox wow animate__fadeInUp" data-wow-duration="1.5s">
                    <div class="leftSec">
                        <div class="mainHead">
                            <div class="head"><?= Words::getValue($language, 'related_blog') ?></div>
                        </div>
                    </div>
                    <div class="rtSec">
                        <a href="<?= Url::to(['site/blogs', 'language' => $language]); ?>" class="cmnBtnLinks">
                            <?= Words::getValue($language, 'view_all_blogs') ?>
                        </a>
                    </div>
                </div>
                <div class="blogSlider owl-carousel wow animate__fadeInUp" data-wow-duration="1.5s">
                    <?php foreach ($blogs as $blog) { 
                        $department_info = \common\models\Departments::findOne($blog->department_id);
                        ?>
                        <div class="item">
                            <a href="<?= Url::to(['site/blog-details', 'language' => $language, 'slug' => $blog->canonical_name]); ?>" class="blogBox">
                                <div class="imgBox">
                                    <img src="<?= Yii::$app->homeUrl ?>uploads/blogs/<?= $blog->main_image ?>" data-src="<?= Yii::$app->homeUrl ?>uploads/blogs/<?= $blog->main_image ?>" class="lazy"
                                         loading="lazy" width="450" height="300" alt="blogImg">
                                    <!--                                    <div class="plyBtn">
                                                                            <svg viewBox="0 0 11.132 13.036">
                                                                            <path id="Polygon_3" data-name="Polygon 3" d="M6.518,0l6.518,11.132H0Z"
                                                                                  transform="translate(11.132) rotate(90)" fill="#763813" />
                                                                            </svg>
                                                                        </div>-->
                                </div>
                                <div class="contentBx">
                                    <div class="topBx">
                                        <div class="catName"><span><?= Words::getValue($language, 'department') ?> :</span> <?= $language == 'ar' && !empty($department_info) ? $department_info->department_name_arabic : $department_info->department_name ?></div>
                                        <div class="mainTxt"><?= $language == 'ar' ? $blog->title_arabic : $blog->title ?></div>
                                        <?= $language == 'ar' ? mb_strimwidth($blog->description_arabic, 0, 97, '...') : mb_strimwidth($blog->description, 0, 97, '...') ?>
                                    </div>
                                    <div class="btmSec">
                                        <div class="date"><?= date("d F, Y", strtotime($blog->date)); ?></div>

                                        <div class="tag"># <?= Words::getValue($language, 'blog') ?></div>

                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php }
                    ?>
                </div>
            </div>
        </section>
        <?php
    }
    ?>
</div>

<!-- WOW -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"
        integrity="sha512-Eak/29OTpb36LLo2r47IpVzPBLXnAMPAVypbSZiZ4Qkf8p/7S/XRG5xp7OKWPPYfJT6metI+IORkR5G8F900+g=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<!-- owl carousel  -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
      integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<!-- FANCY_BOX-->
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.6/jquery.fancybox.min.css">
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.6/jquery.fancybox.min.js">
</script>

<script>
    $('.blogSlider').owlCarousel({

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
                items: 2,
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
</script>
