<?php

/** @var yii\web\View $this */
use yii\helpers\Url;
use common\models\Words;

// $this->params['breadcrumbs'][] = $this->title;
// $this->title = 'Damas | Blogs';
?>
<div id="pageWrapper" class="blogPage">
    <section id="PageBanner">
        <?php if ($banner->video != '') { ?>
            <video id="myVideo" class="bannerBg" autoplay loop muted playsinline src="<?= Yii::$app->homeUrl ?>uploads/banners/<?= $banner->video ?>"
                   type="video/mp4"></video>
               <?php } else { ?>
            <img src="<?= Yii::$app->homeUrl ?>uploads/banners/<?= $language == 'ar' ? $banner->image_arabic : $banner->image ?>" data-src="<?= Yii::$app->homeUrl ?>uploads/banners/<?= $language == 'ar' ? $banner->image_arabic : $banner->image ?>" class="lazy bannerBg"
                 loading="lazy" width="1920" height="535" alt="aboutBanner"> 
             <?php }
             ?>
        <div class="container">
            <div class="mainBanner">
                <div class="captionBx">
                    <h2 class="mainHead"><?= $language == 'ar' ? $banner->title_arabic : $banner->title ?></h2>
                    <div class="tagLine"><?= $language == 'ar' ? $banner->description_arabic : $banner->description ?></div>
                </div>

            </div>
        </div>
    </section>

    <section id="blog">
        <div class="container">
            <div class="rowFlx">
                <div class="lftBx">
                    <div class="flxBox wow animate__fadeInUp" data-wow-duration="1.5s">
                        <div class="leftSec">
                            <div class="mainHead">
                                <div class="head"><?= Words::getValue($language, 'our_blogs') ?></div>
                            </div>
                        </div>
                        <div class="rtSec">
                            <div class="selectBx">
                                <div class="Txt"><?= Words::getValue($language, 'sort_by') ?> :</div>
                                <div class="formGroup">
                                    <form method="post" id="depform">
                                        <select name="department" class="select dep-change">
                                            <option value=""><?= Words::getValue($language, 'select_department') ?></option>
                                            <?php
                                            if (!empty($departments)) {
                                                foreach ($departments as $department) {
                                                    ?>
                                                    <option <?= $dep == $department->id ? 'selected':''?> value="<?= $department->id ?>"><?= $language == 'ar' ? $department->department_name_arabic : $department->department_name ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="searchBox mob">
                        <div class="title"><?= Words::getValue($language, 'search') ?></div>
                        <form method="post">
                            <div class="formGroup">
                                <input type="text" class="form-control" name="keyword" value="<?= $keyword ?>" placeholder="<?= Words::getValue($language, 'type_here') ?>" required>
                                <button class="submitBtn hoveranim">
                                    <div class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15.747" height="15.752"
                                             viewBox="0 0 15.747 15.752">
                                        <g id="layer1" transform="translate(-0.514 -291.161)">
                                        <path id="circle2017"
                                              d="M7.576,291.161a7.065,7.065,0,1,0,4.4,12.581l2.942,2.94a.787.787,0,0,0,1.113-1.112l-2.942-2.941a7.054,7.054,0,0,0-5.512-11.468Zm0,1.57a5.5,5.5,0,1,1-5.493,5.492,5.48,5.48,0,0,1,5.493-5.492Z"
                                              transform="translate(0 0)" fill="#fff" />
                                        </g>
                                        </svg>
                                    </div>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="rflx">
                        <?php
                        if (!empty($blogs)) {
                            foreach ($blogs as $blog) {
                                $department_info = \common\models\Departments::findOne($blog->department_id);
                                ?>
                                <div class="item">
                                    <a href="<?= Url::to(['site/blog-details', 'language' => $language, 'slug' => $blog->canonical_name]); ?>" class="blogBox">
                                        <div class="imgBox">
                                            <img src="<?= Yii::$app->homeUrl ?>uploads/blogs/<?=$blog->main_image ?>" data-src="<?= Yii::$app->homeUrl ?>uploads/blogs/<?=$blog->main_image ?>" class="lazy"
                                                 loading="lazy" width="450" height="300" alt="blogImg">
                                        </div>
                                        <div class="contentBx">
                                            <div class="topBx">
                                                <div class="catName"><span><?= Words::getValue($language, 'department') ?> :</span> <?= $language == 'ar' && !empty($department_info) ? $department_info->department_name_arabic : $department_info->department_name ?></div>
                                                <div class="mainTxt"><?= $language == 'ar' ? $blog->title_arabic : $blog->title ?></div>
                                                <?= $language == 'ar' ? mb_strimwidth($blog->description_arabic, 0, 97, '...') : mb_strimwidth($blog->description, 0, 97, '...') ?>
                                            </div>
                                            <div class="btmSec">
                                                <div class="date"><?= date("d F, Y", strtotime($blog->date)); ?></div>

                                                <div class="tag"># <?= $language == 'ar' && !empty($department_info) ? $department_info->department_name_arabic : $department_info->department_name ?></div>

                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <?php
                            }
                        }
                        ?>

                    </div>
                </div>
                <div class="rtBx">
                    <div class="sideBar">
                        <div class="itemList">
                            <div class="item">
                                <div class="searchBox desk">
                                    <div class="title"><?= Words::getValue($language, 'search') ?></div>
                                    <form method="post">
                                        <div class="formGroup">
                                            <input type="text" name="keyword" class="form-control" value="<?= $keyword ?>" placeholder="Type here..." required>
                                            <button class="submitBtn hoveranim">
                                                <div class="icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="15.747"
                                                         height="15.752" viewBox="0 0 15.747 15.752">
                                                    <g id="layer1" transform="translate(-0.514 -291.161)">
                                                    <path id="circle2017"
                                                          d="M7.576,291.161a7.065,7.065,0,1,0,4.4,12.581l2.942,2.94a.787.787,0,0,0,1.113-1.112l-2.942-2.941a7.054,7.054,0,0,0-5.512-11.468Zm0,1.57a5.5,5.5,0,1,1-5.493,5.492,5.48,5.48,0,0,1,5.493-5.492Z"
                                                          transform="translate(0 0)" fill="#fff" />
                                                    </g>
                                                    </svg>
                                                </div>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                       


                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- select2 -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


</div>
<script>
    $(document).ready(function () {
        $(".dep-change").change(function () {
            $("#depform").submit();
        });
        $(".dep-link").click(function () {
            $('.dep-change').val($(this).attr('data-val'));
            $("#depform").submit();
        });
    });
</script>