<?php

/** @var yii\web\View $this */
use yii\helpers\Url;
use common\models\Words;
use yii\widgets\ActiveForm;

// $this->params['breadcrumbs'][] = $this->title;
// $this->title = 'Damas | ' . $banner->title;
?>

<div id="pageWrapper" class="doctorPage">
    <section id="PageBanner">
        <?php if ($banner->video != '') { ?>
            <video id="myVideo" class="bannerBg" autoplay loop muted playsinline src="<?= Yii::$app->homeUrl ?>uploads/banners/<?= $banner->video ?>"
                   type="video/mp4"></video>
               <?php } else { ?>
            <img src="<?= Yii::$app->homeUrl ?>uploads/banners/<?= $language == 'ar' ? $banner->image_arabic : $banner->image ?>" data-src="<?= Yii::$app->homeUrl ?>uploads/banners/<?= $language == 'ar' ? $banner->image_arabic : $banner->image ?>" class="lazy bannerBg"
                 loading="lazy" width="1920" height="535" alt="<?= $language == 'ar' ? $banner->title_arabic : $banner->title ?>"> 
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
    
    <!-- Breadcrumb -->

    <section id="Breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="<?= Url::to(['site/index', 'language' => $language]); ?>"><?= Words::getValue($language, 'home') ?></a></li>
                <li class="active"><?= Words::getValue($language, 'our_doctors') ?></li>
            </ul>
        </div>
    </section>

    <!-- Breadcrumb end -->

    <section id="doctorsSec">
        <div class="container">
            <div class="searchWrap">
                <?php
                $form = ActiveForm::begin([
                            'id' => 'doctor-search',
                            'method' => 'post',
                ]);
                ?>
                <!--<div class="action-alert success d-none">Succes Message</div>-->
                <div class="row">
                    <div class="col-lg-5 col-sm-5">
                        <div class="form-group">
                            <input type="text" class="form-control form-change" name="department" value="<?= $dep_id ?>" placeholder="<?= Words::getValue($language, 'search_by_department') ?>" name="name" autocomplete="off">
                            <div class="search">
                                    <svg viewBox="0 0 18.842 18.846">
                                        <g id="_x32_-Magnifying_Glass" transform="translate(-7.129 -7.125)">
                                            <path id="Path_103759" data-name="Path 103759"
                                                d="M25.644,24.065l-3.622-3.622a8.318,8.318,0,1,0-1.579,1.579l3.622,3.622a1.117,1.117,0,1,0,1.579-1.579ZM11.135,19.712a6.065,6.065,0,1,1,4.288,1.776,6.072,6.072,0,0,1-4.288-1.776Z"
                                                transform="translate(0 0)" />
                                        </g>
                                    </svg>
                                </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-sm-5">
                        <div class="form-group">
                            <input type="text" class="form-control form-change" doctor="doctor" value="<?= $dr_id ?>" placeholder="<?= Words::getValue($language, 'search_by_name') ?>" name="name" autocomplete="off">
                            <div class="search">
                                    <svg viewBox="0 0 18.842 18.846">
                                        <g id="_x32_-Magnifying_Glass" transform="translate(-7.129 -7.125)">
                                            <path id="Path_103759" data-name="Path 103759"
                                                d="M25.644,24.065l-3.622-3.622a8.318,8.318,0,1,0-1.579,1.579l3.622,3.622a1.117,1.117,0,1,0,1.579-1.579ZM11.135,19.712a6.065,6.065,0,1,1,4.288,1.776,6.072,6.072,0,0,1-4.288-1.776Z"
                                                transform="translate(0 0)" />
                                        </g>
                                    </svg>
                                </div>
                        </div>
                    </div>
                     <div class="col-lg-2 col-sm-2">
                        <div class="form-group">
                            <button type="submit" class="submitbtn hoveranim">
                                <span><?= Words::getValue($language, 'search') ?></span>
                            </button>
                        </div>
                    </div>
                </div
                <?php ActiveForm::end(); ?>
                <div class="dFlex">
                    <?php
                    if (!empty($doctors)) {
                        foreach ($doctors as $doctor) {
                            ?>
                            <div class="item">
                                <a href="<?= Url::to(['site/doctor-details', 'language' => $language, 'slug' => $doctor->canonical_name]); ?>" class="serviceBox">
                                    <div class="imgBox">
                                        <img src="<?= Yii::$app->homeUrl ?>uploads/doctors/<?= $doctor->image ?>" data-src="<?= Yii::$app->homeUrl ?>uploads/doctors/<?= $doctor->image ?>" class="lazy" loading="lazy" width="300" height="385" alt="<?= $language == 'ar' ? $doctor->doctor_name_arabic : $doctor->doctor_name ?>">
                                    </div>
                                    <div class="info">
                                        <div class="name"> <?= $language == 'ar' ? $doctor->doctor_name_arabic : $doctor->doctor_name ?></div>
                                        <div class="post"> <?= $language == 'ar' ? $doctor->designation_arabic : $doctor->designation ?></div>
                                        <div class="depat"> <?= Yii::$app->SetValues->GetDepartments($doctor->id,$language); ?></div>
                                    </div>
                                </a>
                            </div>
                            <?php
                        }
                    }else{ ?>
                        <div class="empty-search-result">
                            <h2>No Results Found</h2>
                            <p>We couldn't find any results for your search.</p>
                        </div>
                <?php    }
                    ?>
                </div>
            </div>
    </section>

</div>
<script>
    // $(document).ready(function () {

    //     $(".form-change").blur(function () {
    //         $("#doctor-search").submit();
    //     });
    // });
</script>