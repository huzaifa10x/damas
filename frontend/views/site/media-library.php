<?php

/** @var yii\web\View $this */
use yii\helpers\Url;
use common\models\Words;

// $this->params['breadcrumbs'][] = $this->title;
// $this->title = 'Damas | ' . $banner->title;
?>

<div id="pageWrapper" class="mediaPage">
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
                    <h1 class="mainHead"><?= $language == 'ar' ? $banner->title_arabic : $banner->title ?></h1>
                    <div class="tagLine"><?= $language == 'ar' ? $banner->description_arabic : $banner->description ?></div>
                </div>

            </div>
        </div>
    </section>
    <section id="mediaSec">
        <div class="container">
            <div class="tleWrap">
                <div class="tle"><?= Words::getValue($language, 'media_centre') ?></div>
                <div class="inutBx">
                    <form method="post" id="media-search">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select name="department" class="select2 drop-change">
                                        <option value="" hidden><?= Words::getValue($language, 'department') ?></option>
                                        <?php
                                        if (!empty($departments)) {
                                            foreach ($departments as $department) {
                                                ?>
                                                <option <?= $dep == $department->id ? 'selected' : '' ?> value="<?= $department->id ?>"><?= $language == 'ar' ? $department->department_name_arabic : $department->department_name ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group selectd">
                                    <select name="service" class="select2 drop-change">
                                        <option value="" hidden><?= Words::getValue($language, 'services') ?></option>
                                        <?php
                                        if (!empty($services)) {
                                            foreach ($services as $service) {
                                                ?>
                                                <option <?= $serv == $service->id ? 'selected' : '' ?> value="<?= $service->id ?>"><?= $language == 'ar' ? $service->service_name_arabic : $service->service_name ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="Tle"><?= Words::getValue($language, 'media_library') ?></div>
            <div class="mediaWrap">
                <div class="dFlex">
                    <div class="hdWrap">
                        <div class="accordHead">
                            <div class="tle"><?= Words::getValue($language, 'media_library') ?></div>
                            <div class="accordion-header" id="heading0">
                                <button class="accordion-button " type="button" data-bs-toggle="collapse"
                                        data-bs-target="#detailAccord0" aria-expanded="true" aria-controls="detailAccord0">
                                            <?= Words::getValue($language, 'all_media') ?>
                                </button>
                            </div>
                            <?php
                            if (!empty($categories)) {
                                $i = 1;
                                foreach ($categories as $category) {
                                    $datas = \common\models\MediaLibrary::find()->where(['id' => $res, 'category' => $category->id])->all();
                                    $i++;
                                    if(!empty($datas)){
                                    ?>
                                    <div class="accordion-header" id="heading<?= $category->id ?>">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#detailAccord<?= $category->id ?>" aria-expanded="false" aria-controls="detailAccord<?= $category->id ?>">
                                                    <?= $language == 'ar' ? $category->category_name_arabic : $category->category_name ?>
                                        </button>
                                    </div>
                                    <?php
                                    }
                                }
                            }
                            ?>


                        </div>
                    </div>
                    <div class="accWrap">
                        <div class="accordion" id="mediaAccord">
                            <div class="accordion-item">
                                <div class="accordion-header" id="heading0">
                                    <button class="accordion-button detlccBtn" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#detailAccord0" aria-expanded="true"
                                            aria-controls="detailAccord0">
                                                <?= Words::getValue($language, 'all_media') ?>
                                    </button>
                                </div>
                                <div id="detailAccord0" class="accordion-collapse collapse show"
                                     aria-labelledby="heading1" data-bs-parent="#mediaAccord">
                                    <div class="accordion-body">
                                        <div class="contentWrap">
                                            <div class="Flex">
                                                <?php
                                                if (!empty($libraries)) {
                                                    foreach ($libraries as $library) {
                                                        ?>
                                                        <div class="item">
                                                            <div class="mediaBx">
                                                                <div class="imgBx">
                                                                    <img src="<?= Yii::$app->homeUrl ?>uploads/media-library/<?= $library->image ?>"
                                                                         data-src="<?= Yii::$app->homeUrl ?>uploads/media-library/<?= $library->image ?>" class="lazy"
                                                                         loading="lazy" width="448" height="292" alt="mediaImg">
                                                                </div>
                                                                <div class="contBx">
                                                                    <div class="info"><?= $language == 'ar' ? $library->title_arabic : $library->title ?></div>
                                                                    <div class="btmWrap">
                                                                        <?php
                                                                        if ($library->document != '') {
                                                                            ?>
                                                                            <a href="<?= Yii::$app->homeUrl ?>uploads/media-library/<?= $library->document ?>" class="dwnld" download="">
                                                                                <div class="txt"><?= Words::getValue($language, 'download') ?></div>
                                                                                <span>
                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                         width="14.912" height="14.912"
                                                                                         viewBox="0 0 14.912 14.912">
                                                                                    <g id="Group_22643" data-name="Group 22643"
                                                                                       transform="translate(-2 -2)">
                                                                                    <path id="Path_103721"
                                                                                          data-name="Path 103721"
                                                                                          d="M16.912,23.533v2.13a1.066,1.066,0,0,1-1.065,1.065H3.065A1.066,1.066,0,0,1,2,25.663v-2.13a.533.533,0,0,1,1.065,0v2.13H15.847v-2.13a.533.533,0,0,1,1.065,0Z"
                                                                                          transform="translate(0 -9.816)"
                                                                                          fill="#763813" />
                                                                                    <path id="Path_103722"
                                                                                          data-name="Path 103722"
                                                                                          d="M8.156,9.833a.532.532,0,0,1,.753-.753L11.728,11.9V2.533a.533.533,0,1,1,1.065,0V11.9L15.612,9.08a.532.532,0,1,1,.753.753l-3.728,3.728a.533.533,0,0,1-.754,0Z"
                                                                                          transform="translate(-2.804)"
                                                                                          fill="#763813" />
                                                                                    </g>
                                                                                    </svg>

                                                                                </span>
                                                                            </a>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                        <div class="dte"><?= Words::getValue($language, 'posted_on') ?> <?= date("d.m.Y", strtotime($library->posted_date)); ?></div>
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
                            if (!empty($categories)) {
                                $j = 1;
                                foreach ($categories as $category) {
                                    $datas = \common\models\MediaLibrary::find()->where(['id' => $res, 'category' => $category->id])->all();
                                    $j++;
                                    if(!empty($datas)){
                                    ?>
                                    <div class="accordion-item">
                                        <div class="accordion-header" id="heading<?= $category->id ?>">
                                            <button class="accordion-button detlccBtn collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#detailAccord<?= $category->id ?>" aria-expanded="false"
                                                    aria-controls="detailAccord<?= $category->id ?>">
                                                        <?= $language == 'ar' ? $category->category_name_arabic : $category->category_name ?>
                                            </button>
                                        </div>
                                        <div id="detailAccord<?= $category->id ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $category->id ?>"
                                             data-bs-parent="#mediaAccord">
                                            <div class="accordion-body">
                                                <div class="contentWrap">
                                                    <div class="Flex">
                                                        <?php
                                                        if (!empty($datas)) {
                                                            foreach ($datas as $library) {
                                                                ?>
                                                                <div class="item">
                                                                    <div class="mediaBx">
                                                                        <div class="imgBx">
                                                                            <img src="<?= Yii::$app->homeUrl ?>uploads/media-library/<?= $library->image ?>"
                                                                                 data-src="<?= Yii::$app->homeUrl ?>uploads/media-library/<?= $library->image ?>" class="lazy"
                                                                                 loading="lazy" width="448" height="292" alt="mediaImg">
                                                                        </div>
                                                                        <div class="contBx">
                                                                            <div class="info"><?= $language == 'ar' ? $library->title_arabic : $library->title ?></div>
                                                                            <div class="btmWrap">
                                                                                <?php
                                                                                if ($library->document != '') {
                                                                                    ?>
                                                                                    <a href="<?= Yii::$app->homeUrl ?>uploads/media-library/<?= $library->document ?>" class="dwnld" download="">
                                                                                        <div class="txt"><?= Words::getValue($language, 'download') ?></div>
                                                                                        <span>
                                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                 width="14.912" height="14.912"
                                                                                                 viewBox="0 0 14.912 14.912">
                                                                                            <g id="Group_22643" data-name="Group 22643"
                                                                                               transform="translate(-2 -2)">
                                                                                            <path id="Path_103721"
                                                                                                  data-name="Path 103721"
                                                                                                  d="M16.912,23.533v2.13a1.066,1.066,0,0,1-1.065,1.065H3.065A1.066,1.066,0,0,1,2,25.663v-2.13a.533.533,0,0,1,1.065,0v2.13H15.847v-2.13a.533.533,0,0,1,1.065,0Z"
                                                                                                  transform="translate(0 -9.816)"
                                                                                                  fill="#763813" />
                                                                                            <path id="Path_103722"
                                                                                                  data-name="Path 103722"
                                                                                                  d="M8.156,9.833a.532.532,0,0,1,.753-.753L11.728,11.9V2.533a.533.533,0,1,1,1.065,0V11.9L15.612,9.08a.532.532,0,1,1,.753.753l-3.728,3.728a.533.533,0,0,1-.754,0Z"
                                                                                                  transform="translate(-2.804)"
                                                                                                  fill="#763813" />
                                                                                            </g>
                                                                                            </svg>

                                                                                        </span>
                                                                                    </a>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                                <div class="dte"><?= Words::getValue($language, 'posted_on') ?> <?= date("d.m.Y", strtotime($library->posted_date)); ?></div>
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
                                }
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php if (!empty($galleries)) { ?>
        <section id="gallSec">
            <div class="container">
                <div class="tle"><?= Words::getValue($language, 'gallery') ?></div>
                <div class="gallWrap">
                    <?php
                    foreach ($galleries as $gallery) {
                        if ($gallery->video != '') {
                            ?>
                            <div class="item">
                                <a href="<?= $gallery->video ?>" class="imgBx vdoBx" data-fancybox="proGal">
                                    <img alt="image" src="<?= Yii::$app->homeUrl ?>uploads/media-gallery/<?= $gallery->image ?>" data-src="<?= Yii::$app->homeUrl ?>uploads/media-gallery/<?= $gallery->image ?>"
                                         class="lazy" loading="lazy" width="426" height="296" />
                                    <div class="cont">
                                        <div class="iconwrap">
                                            <div class="iconBx">
                                                <div class="icon">
                                                    <img alt="image" src="<?= Yii::$app->homeUrl ?>images/utube.svg" class="lazy" width="9"
                                                         height="10" />
                                                </div>
                                            </div>
                                            <div class="txt"><?= Words::getValue($language, 'watch_video') ?></div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php } else { ?>
                            <div class="item">
                                <a href="<?= Yii::$app->homeUrl ?>uploads/media-gallery/<?= $gallery->image ?>" class="imgBx" data-fancybox="proGal">
                                    <img alt="image" src="<?= Yii::$app->homeUrl ?>uploads/media-gallery/<?= $gallery->image ?>" data-src="<?= Yii::$app->homeUrl ?>uploads/media-gallery/<?= $gallery->image ?>" class="lazy"
                                         loading="lazy" width="426" height="296" />
                                </a>
                            </div>
                            <?php
                        }
                    }
                    ?>

                </div>
            </div>
        </section>
    <?php }
    ?>
    <section id="discntSec">
        <div class="container">
            <div class="discBx">
                <div class="innerBx">

                    <div class="hd">
                        <?= Words::getValue($language, 'media_book_now_description') ?>
                    </div>
                    <a href="javascript:void(0);" class="bookBtn" data-bs-toggle="modal"
                                       data-bs-target="#bookingModal">
                        <div class="txt"><?= Words::getValue($language, 'book_now') ?></div>
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="7.156" height="13" viewBox="0 0 7.156 13">
                            <path id="Exclusion_3" data-name="Exclusion 3" d="M-3697-75l7.156,6.523h0L-3697-62Z"
                                  transform="translate(3697 75)" fill="#fff" />
                            </svg>

                        </span>
                    </a>
                </div>
            </div>
        </div>
    </section>

</div>

<!-- SELECT2 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>




<script>
// SELECT2
    $(".select2").select2({
        minimumResultsForSearch: Infinity,
        theme: "bootstrap-5",
        closeOnSelect: true,
    });
</script>
<script>
    $(document).ready(function () {
        $(".drop-change").change(function () {
            $("#media-search").submit();
        });
    });
</script>
