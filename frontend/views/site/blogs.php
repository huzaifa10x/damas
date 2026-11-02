<?php

/** @var yii\web\View $this */
use yii\helpers\Url;
use common\models\Words;
use yii\helpers\Html;

// $this->params['breadcrumbs'][] = $this->title;
// $this->title = 'Damas | Blogs';
$homeUrl    = Yii::$app->homeUrl;
$isAr       = ($language === 'ar');
$blogDepartmentOptions = \common\models\Departments::find()
    ->where(['status' => 1])
    ->orderBy(['sort_order' => SORT_ASC, 'id' => SORT_ASC])
    ->all();
?>

<div id="pageWrapper" class="blogPage">
  
       <section id="PageBanner">

        <img src="<?= Yii::$app->homeUrl ?>uploads/banners/<?= $language == 'ar' ? $banner->image_arabic : $banner->image ?>" data-src="<?= Yii::$app->homeUrl ?>uploads/banners/<?= $language == 'ar' ? $banner->image_arabic : $banner->image ?>" class="lazy bannerBg"
            loading="lazy" width="1920" height="535" alt="<?= $language == 'ar' ? $banner->title_arabic : $banner->title ?>">
        <div class="container">
            <div class="mainBanner">
                <div class="captionBx">
                    <h1 class="mainHead"><?= $language == 'ar' ? $banner->title_arabic : $banner->title ?></h1>
                    <div class="tagLine"><?= $language == 'ar' ? $banner->description_arabic : $banner->description ?></div>

                    <section id="Breadcrumb">
                        <div class="container">
                            <ul class="breadcrumb">
                                <li><a href="<?= Url::to(['site/index', 'language' => $language]); ?>"><?= Words::getValue($language, 'home') ?></a></li>
                                <li class="active"><?= Words::getValue($language, 'blogs') ?></li>
                            </ul>
                        </div>
                    </section>
                </div>

            </div>
        </div>
    </section>

    <section id="blog" class="blogListing" <?= $isAr ? 'dir="rtl" lang="ar"' : 'lang="en"' ?>>
        <div class="container">
            <header class="blogListingHeader">
                <div>
                    <span class="blogListingEyebrow"><?= Html::encode($isAr ? 'المدونة والأخبار' : 'BLOG & NEWS') ?></span>
                    <h2><?= Html::encode($isAr ? 'رؤى صحية وأخبار العيادة' : 'Health Insights and Clinic News') ?></h2>
                </div>
                <div class="blogListingFilters">
                       <form method="post" id="depform" class="blogDepartmentFilter">
                        <select name="department" class="select dep-change" aria-label="<?= Html::encode(Words::getValue($language, 'select_department')) ?>">
                            <option value=""><?= Html::encode(Words::getValue($language, 'select_department')) ?></option>
                            <?php foreach ($blogDepartmentOptions as $department): ?>
                                <option value="<?= (int) $department->id ?>" <?= (int) $dep === (int) $department->id ? 'selected' : '' ?>><?= Html::encode($isAr ? $department->department_name_arabic : $department->department_name) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </form>
                  
                </div>
            </header>

            <div class="blogCardGrid">
                <?php if (!empty($blogs)): foreach ($blogs as $blog):
                    $blogTitle = $isAr ? $blog->title_arabic : $blog->title;
                    $blogDescription = $isAr ? $blog->description_arabic : $blog->description;
                    $blogImage = $homeUrl . 'uploads/blogs/' . $blog->main_image;
                    $blogDate = $isAr ? date('Y/m/d', strtotime($blog->date)) : date('j F Y', strtotime($blog->date));
                    $blogUrl = Url::to(['site/blog-details', 'language' => $language, 'slug' => $blog->canonical_name]); ?>
                    <article class="blogCard">
                        <a class="blogCardImage" href="<?= $blogUrl ?>" aria-label="<?= Html::encode($blogTitle) ?>">
                            <img src="<?= Html::encode($blogImage) ?>" data-src="<?= Html::encode($blogImage) ?>" class="lazy" loading="lazy" decoding="async" width="450" height="300" alt="<?= Html::encode($blogTitle) ?>">
                        </a>
                        <div class="blogCardDate">
                            <svg viewBox="0 0 16 16" aria-hidden="true"><path d="M3 2.5h10v11H3zM5 1v3M11 1v3M3 5.5h10"></path></svg>
                            <time datetime="<?= Html::encode(date('Y-m-d', strtotime($blog->date))) ?>"><?= Html::encode($blogDate) ?></time>
                        </div>
                        <div class="blogCardBody">
                            <h3><a href="<?= $blogUrl ?>"><?= Html::encode($blogTitle) ?></a></h3>
                            <p><?= Html::encode(mb_strimwidth(trim(strip_tags((string) $blogDescription)), 0, 104, '…', 'UTF-8')) ?></p>
                            <a class="blogCardLearnMore" href="<?= $blogUrl ?>"><?= Html::encode($isAr ? 'اقرأ المزيد' : 'Learn More') ?><span aria-hidden="true">→</span></a>
                        </div>
                    </article>
                <?php endforeach; else: ?>
                    <p class="blogNoResults"><?= Html::encode($isAr ? 'لا توجد مقالات متاحة حالياً.' : 'No articles are available right now.') ?></p>
                <?php endif; ?>
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

