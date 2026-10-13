<?php

use common\models\About;
use common\models\Words;
use common\models\Departments;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\web\View;

$currentUrl = Url::to(Yii::$app->request->url, true);
$homeUrl    = Yii::$app->homeUrl;
$isAr       = ($language === 'ar');

/*
 * ---------------------------------------------------------------------------
 * PAGE-SPECIFIC HEAD ASSETS (rendered by $this->head() in the layout)
 * - Owl CSS is tiny and controls layout of visible sections, so it goes in <head>
 *   (avoids CLS / flash of unstyled sliders). Fancybox CSS is only needed on click → non-blocking.
 * - reCAPTCHA is NOT registered here any more; it loads on demand (see bottom of file).
 * - The first hero image is preloaded with the correct media query so the LCP request starts
 *   before the CSS is parsed.
 * ---------------------------------------------------------------------------
 */
/* Above-the-fold CSS for this page is inlined by the layout; the full stylesheets then load without blocking. */
$this->params['criticalCss'] = 'critical-home.css';
/* Owl only styles the sliders further down the page → load it without blocking first paint. */
$this->registerCssFile($homeUrl . 'lib/owl.carousel-2.3.4.min.css', ['media' => 'print', 'onload' => "this.media='all';this.onload=null"]);
/* Every script in this view is `defer` or waits for DOMContentLoaded/load, so the layout may keep its libraries deferred. */
$this->params['scriptsDeferSafe'] = true;
/* Jarallax removed: it forced layout on every scroll tick (Lighthouse: 20 long tasks on desktop). The same effect is done in CSS below. */
/* Hero video overlays the <picture> (which defines the box). Without this the deferred src attach resized the video
   after first paint and shifted the whole page — desktop CLS 1.8. */
$this->registerCss('#MainBanner .imBox{position:relative}#MainBanner .imBox video.hero-video{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:50% 50%;margin:0;display:block}#MainBanner .imBox video.hero-video:not([src]){visibility:hidden}');
$this->registerCss('#appointment{position:relative;overflow:hidden;isolation:isolate}#appointment .parallax-img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:50% 50%;z-index:-1}@media (min-width:1024px) and (hover:hover){#appointment .parallax-img{height:130%;top:-15%;will-change:transform}}');

if (!empty($sliders)) {
    $first = reset($sliders);
    $this->registerLinkTag([
        'rel'           => 'preload',
        'as'            => 'image',
        'href'          => $homeUrl . 'uploads/home-banners/' . ($isAr ? $first->desktop_image_arabic : $first->desktop_image),
        'media'         => '(min-width: 768px)',
        'fetchpriority' => 'high',
    ], 'hero-desktop');
    $this->registerLinkTag([
        'rel'           => 'preload',
        'as'            => 'image',
        'href'          => $homeUrl . 'uploads/home-banners/' . $first->mobile_image,
        'media'         => '(max-width: 767px)',
        'fetchpriority' => 'high',
    ], 'hero-mobile');
}

/* Insurance section: previously ONE Departments query PER insurance row (N+1). Now one query, mapped by id. */
$insuranceDepts = [];
if (!empty($insurances)) {
    $deptIds = array_unique(array_map(function ($i) { return $i->department; }, $insurances));
    $insuranceDepts = Departments::find()->where(['id' => $deptIds])->indexBy('id')->all();
}

$ourStoryImage = About::getValue('our_story_image', $language);
$bookImage     = $isAr ? About::getValue('book_an_appointment_image_arabic', $language) : About::getValue('book_an_appointment_image', $language);
?>

<style>
    .newimageinhome{
        padding-bottom:50px !important;
        margin-top:-200px !important;
    }
    
    @media screen and (max-width:768px){
          .newimageinhome{
        padding-bottom:0px !important;
        margin-top:0px !important;
    }
    }
</style>

<div id="pageWrapper">
    <section id="MainBanner" class="carousel slide" data-bs-ride="carousel" data-bs-touch="false">
        <div class="carousel-inner">
            <?php if (!empty($sliders)): $i = 0; foreach ($sliders as $slider): $isFirst = ($i === 0);
                $desktopImg = $homeUrl . 'uploads/home-banners/' . ($isAr ? $slider->desktop_image_arabic : $slider->desktop_image);
                $mobileImg  = $homeUrl . 'uploads/home-banners/' . $slider->mobile_image; ?>
                <div class="carousel-item <?= $isFirst ? 'active' : '' ?>" data-bs-slide="<?= $i ?>" data-bs-interval="5000">
                    <div class="imBox">
                        <picture>
                            <source media="(min-width: 768px)" srcset="<?= $desktopImg ?>">
                            <!-- Slide 1 = LCP: eager + high priority. Every other slide is lazy (it is off-screen until the carousel moves). -->
                            <img src="<?= $mobileImg ?>" width="1920" height="700"
                                 <?= $isFirst ? 'fetchpriority="high" decoding="sync"' : 'loading="lazy" decoding="async"' ?>
                                 alt="<?= $isAr ? $slider->alt_tag_arabic : $slider->alt_tag ?>">
                        </picture>
                        <?php if ($slider->video != '' && $slider->type == 1): ?>
                            <!-- Positioned over the picture (see registerCss above). src is attached after window.load so the MP4 never competes with the LCP image. -->
                            <video id="heroVideo<?= $i ?>" class="dsk hero-video" loop muted playsinline preload="none" width="1920" height="700"
                                   data-src="<?= $homeUrl ?>uploads/home-banners/<?= $slider->video ?>"></video>
                        <?php endif; ?>
                    </div>
                    <div class="container">
                        <div class="bannerCaption">
                            <span class="mainTitle"><?= $isAr ? $slider->title_arabic : $slider->title ?></span>
                            <h4 class="SubInfo"><?= $isAr ? $slider->description_arabic : $slider->description ?></h4>
                            <?php if ($slider->link != ''): ?>
                                <div class="btnSec">
                                    <a href="<?= $slider->link ?>" class="cmnBtn white hoveranim">
                                        <span><?= Words::getValue($language, 'book_now') ?></span>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php $i++; endforeach; endif; ?>
        </div>
        <div class="container">
            <div class="navButtons">
                <button class="carousel-control-prev" type="button" data-bs-target="#MainBanner" data-bs-slide="prev" aria-label="Previous slide">
                    <span><div class="icon"><svg viewBox="0 0 18.156 9"><path d="M13,0V3H0V6H13V9l5.156-4.516L13,0Z" transform="translate(18.156 9) rotate(180)"/></svg></div></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#MainBanner" data-bs-slide="next" aria-label="Next slide">
                    <span><div class="icon"><svg viewBox="0 0 18.156 9"><path d="M-3697-66v-3h-13v-3h13v-3l5.156,4.516L-3697-66Z" transform="translate(3710 75)"/></svg></div></span>
                </button>
            </div>
            <div class="countBox">
                <div class="currentItems"><span></span></div>
                <div class="totalCount"><span></span></div>
            </div>
        </div>
    </section>

    <section style="padding-top:50px;">
        <div class="container">
            <h1 class="mainTitle" style="text-align:center;"><?= $isAr ? "أفضل مركز طبي في الشارقة" : "Best Medical Center Sharjah" ?></h1>
        </div>
    </section>

    <section id="about" style="padding-top:50px;padding-bottom:150px">
        <div class="floaticon">
            <img src="<?= $homeUrl ?>images/logoIcon.svg" alt="Our story icon" loading="lazy" width="120" height="120">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xl-7 col-lg-6">
                    <div class="imgBox wow animate__fadeInUp">
                        <img src="<?= $ourStoryImage ?>" data-src="<?= $ourStoryImage ?>" width="805" height="450"
                             class="lazy" loading="lazy" decoding="async" alt="Our Story">
                    </div>
                </div>
                <div class="col-xl-5 col-lg-6">
                    <div class="contentBx wow animate__fadeInUp">
                        <div class="title"><?= Words::getValue($language, 'our_story') ?></div>
                        <?= About::getValue('our_story', $language) ?>
                        <a href="<?= Url::to(['site/about', 'language' => $language]) ?>" class="cmnBtn hoveranim">
                            <span><?= Words::getValue($language, 'discover_more') ?></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="health">
        <div class="videoBx">
            <!-- src attached after window.load (see init script at the bottom) -->
            <video id="bgVideo" loop muted playsinline preload="none"
                   data-src="<?= About::getValue('about_video_link', $language) ?>"
                   poster="<?= About::getValue('about_video_poster', $language) ?>"></video>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="contentBox wow animate__fadeInUp" data-wow-duration="1.5s">
                        <div class="mainHead">
                            <div class="head white"><?= About::getValue('video_title', $language) ?></div>
                        </div>
                        <p><?= About::getValue('video_description', $language) ?></p>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="flxBox">
                        <?php foreach ([
                            ['c1.svg', 'year_of_experience', 'years_of_experience', '1.5s'],
                            ['c2.svg', 'treatments',         'treatments',          '1.5s'],
                            ['c3.svg', 'branches',           'branches',            '2s'],
                            ['c4.svg', 'happy_clients',      'happy_clients',       '2.5s'],
                        ] as [$icon, $aboutKey, $wordKey, $dur]): ?>
                        <div class="item wow animate__fadeInUp" data-wow-duration="<?= $dur ?>">
                            <div class="couterBx">
                                <div class="icon">
                                    <img src="<?= $homeUrl ?>images/<?= $icon ?>" alt="<?= Words::getValue($language, $wordKey) ?>" loading="lazy" width="60" height="60">
                                </div>
                                <div class="info">
                                    <div class="numTxt"><span data-count="<?= About::getValue($aboutKey, $language) ?>">0</span></div>
                                    <div class="txt"><?= Words::getValue($language, $wordKey) ?></div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Departments (owl) -->
    <section id="service">
        <div class="floaticon">
            <img src="<?= $homeUrl ?>images/logoIcon.svg" alt="Logo icon" loading="lazy" width="120" height="120">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 leftSec">
                    <div class="contentBx wow animate__fadeInUp" data-wow-duration="1.5s">
                        <div class="mainHead"><div class="head"><?= Words::getValue($language, 'our_departments') ?></div></div>
                        <p><?= Words::getValue($language, 'our_department_description') ?></p>
                    </div>
                    <div class="NavflxBx wow animate__fadeInUp" data-wow-duration="1.5s">
                        <div class="counterBx">
                            <div class="item"><div class="countList current">01</div></div>
                            <div class="item"><div class="countList total"><?= sprintf('%02d', count($departments)) ?></div></div>
                        </div>
                        <div class="navButtons">
                            <div class="item">
                                <button class="OwlPrev customSlideNav" type="button" aria-label="Previous">
                                    <div class="icon"><svg viewBox="0 0 18.156 9"><path d="M13,0V3H0V6H13V9l5.156-4.516L13,0Z" transform="translate(18.156 9) rotate(180)"/></svg></div>
                                </button>
                            </div>
                            <div class="item">
                                <button class="OwlNext customSlideNav" type="button" aria-label="Next">
                                    <div class="icon"><svg viewBox="0 0 18.156 9"><path d="M-3697-66v-3h-13v-3h13v-3l5.156,4.516L-3697-66Z" transform="translate(3710 75)"/></svg></div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="serviceSlider owl-carousel wow animate__fadeInUp" data-wow-duration="1.5s">
                        <?php foreach ($departments as $department):
                            $deptImg  = $homeUrl . 'uploads/departments/' . $department->department_image;
                            $deptName = $isAr ? $department->department_name_arabic : $department->department_name; ?>
                            <div class="item">
                                <a href="<?= Url::to(['site/department-details', 'language' => $language, 'slug' => $department->canonical_name]) ?>" class="serviceBox">
                                    <div class="imgBox">
                                        <img src="<?= $deptImg ?>" data-src="<?= $deptImg ?>" class="lazy" loading="lazy" decoding="async" width="300" height="458" alt="<?= $deptName ?>">
                                    </div>
                                    <div class="info"><div class="subT"><?= $deptName ?></div></div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Doctors (owl) -->
    <section id="doctors">
        <img src="<?= $homeUrl ?>images/doctorsBg.webp" class="bannerBg lazy" data-src="<?= $homeUrl ?>images/doctorsBg.webp"
             loading="lazy" decoding="async" width="1920" height="685" alt="">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 leftSec">
                    <div class="contentBx wow animate__fadeInUp" data-wow-duration="1.5s">
                        <div class="mainHead"><div class="head"><?= Words::getValue($language, 'our_doctors') ?></div></div>
                        <p><?= Words::getValue($language, 'our_doctor_description') ?></p>
                    </div>
                    <div class="NavflxBx wow animate__fadeInUp" data-wow-duration="1.5s">
                        <div class="counterBx">
                            <div class="item"><div class="countList current">01</div></div>
                            <div class="item"><div class="countList total"><?= sprintf('%02d', count($doctors)) ?></div></div>
                        </div>
                        <div class="navButtons">
                            <div class="item">
                                <button class="OwlPrev customSlideNav" type="button" aria-label="Previous">
                                    <div class="icon"><svg viewBox="0 0 18.156 9"><path d="M13,0V3H0V6H13V9l5.156-4.516L13,0Z" transform="translate(18.156 9) rotate(180)"/></svg></div>
                                </button>
                            </div>
                            <div class="item">
                                <button class="OwlNext customSlideNav" type="button" aria-label="Next">
                                    <div class="icon"><svg viewBox="0 0 18.156 9"><path d="M-3697-66v-3h-13v-3h13v-3l5.156,4.516L-3697-66Z" transform="translate(3710 75)"/></svg></div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="doctorSlider owl-carousel wow animate__fadeInUp" data-wow-duration="1.5s">
                        <?php foreach ($doctors as $our_doctor):
                            $docImg  = $homeUrl . 'uploads/doctors/' . $our_doctor->image;
                            $docName = $isAr ? $our_doctor->doctor_name_arabic : $our_doctor->doctor_name; ?>
                            <div class="item">
                                <a class="serviceBox" href="<?= Url::to(['site/doctor-details', 'language' => $language, 'slug' => $our_doctor->canonical_name]) ?>">
                                    <div class="imgBox">
                                        <img src="<?= $docImg ?>" data-src="<?= $docImg ?>" class="lazy" loading="lazy" decoding="async" width="300" height="385" alt="<?= $docName ?>">
                                    </div>
                                    <div class="info">
                                        <div class="name"><?= $docName ?></div>
                                        <div class="post"><?= $isAr ? $our_doctor->designation_arabic : $our_doctor->designation ?></div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php if (!empty($special_offers)): ?>
    <section id="special">
        <div class="container">
            <div class="flxBox wow animate__fadeInUp" data-wow-duration="1.5s">
                <div class="leftSec"><div class="mainHead"><div class="head"><?= Words::getValue($language, 'today_spacial_offer') ?></div></div></div>
                <div class="rtSec">
                    <a href="<?= Url::to(['site/offers', 'language' => $language]) ?>" class="cmnBtnLinks"><?= Words::getValue($language, 'view_all_offers') ?></a>
                </div>
            </div>
            <div class="rflx">
                <?php $k = 0; foreach ($special_offers as $special_offer): $k++;
                    $offerImg   = $homeUrl . 'uploads/special-offer/' . $special_offer->image;
                    $offerTitle = $isAr ? $special_offer->title_arabic : $special_offer->title; ?>
                    <div class="<?= $k == 2 ? 'rtSec' : 'leftBx' ?>">
                        <div class="specialBx wow animate__fadeInUp" data-wow-duration="1.4s">
                            <img src="<?= $offerImg ?>" data-src="<?= $offerImg ?>" class="lazy" loading="lazy" decoding="async" width="805" height="370" alt="<?= $offerTitle ?>">
                            <div class="contentBx">
                                <div class="title">
                                    <?= $offerTitle ?>
                                    <a href="<?= $isAr ? $special_offer->link_arabic : $special_offer->link ?>" class="bookNow"><?= Words::getValue($language, 'book_now') ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <section id="appointment" data-anchor="appointment">
        <!-- TODO: this WebP is 133 KB; re-export at quality ~70 (Lighthouse est. 97 KiB saving on mobile) -->
        <img src="<?= $bookImage ?>" data-src="<?= $bookImage ?>" class="lazy parallax-img" loading="lazy" decoding="async" width="1920" height="720" alt="">
        <div class="container">
            <div class="appointMentBox wow animate__fadeInLeft" data-wow-duration="1.5s">
                <div class="imgBox"><img src="<?= $homeUrl ?>images/logIcon.svg" alt="appointment" loading="lazy" width="60" height="60"></div>
                <div class="title"><?= Words::getValue($language, 'book_appointment') ?></div>
                <?= \common\widgets\Alert::widget() ?>
                <?php $form = ActiveForm::begin(['id' => 'appointment-form2']); ?>
                <div class="row">
                    <input type="hidden" name="AppointmentEnquiryListing[page_url]" value="<?= $currentUrl ?>" />
                    <div class="col-lg-12"><?= $form->field($model, 'name')->textInput(['placeholder' => Words::getValue($language, 'name') . ' *'])->label(false) ?></div>
                    <div class="col-lg-6"><?= $form->field($model, 'age')->textInput(['placeholder' => Words::getValue($language, 'age') . ' *'])->label(false) ?></div>
                    <div class="col-lg-6"><?= $form->field($model, 'gender')->dropDownList($genders, ['prompt' => Words::getValue($language, 'gender') . ' *', 'class' => 'select2 select'])->label(false) ?></div>
                    <div class="col-lg-12"><?= $form->field($model, 'phone_number')->textInput(['placeholder' => Words::getValue($language, 'phone_no') . ' *'])->label(false) ?></div>
                    <div class="col-lg-12"><?= $form->field($model, 'email')->textInput(['placeholder' => Words::getValue($language, 'email') . ' *'])->label(false) ?></div>
                    <div class="col-sm-12">
                        <div class="dateBx">
                            <?= $form->field($model, 'appointment_date')->textInput([
                                'id'          => 'eventDate',
                                'class'       => 'form-control datepicker',
                                'placeholder' => Words::getValue($language, 'your_preferred_date') . ' *',
                                'type'        => 'date',
                                'data-input'  => true,
                            ])->label(false) ?>
                        </div>
                    </div>
                    <div class="col-lg-12"><?= $form->field($model, 'service')->dropDownList($services, ['prompt' => Words::getValue($language, 'select_department'), 'class' => 'select2 select'])->label(false) ?></div>
                    <div class="col-lg-12"><?= $form->field($model, 'message')->textarea(['placeholder' => Words::getValue($language, 'message')])->label(false) ?></div>
                    <!-- reCAPTCHA: api.js is loaded when this section scrolls into view (or the booking modal opens), not on page load -->
                    <div class="col-lg-12 mb-3">
                        <div class="g-recaptcha" data-sitekey="6LeIN5stAAAAAH4T1_W3wKcBxlKmq8P-8bzJTga4"></div>
                        <?php if ($model->hasErrors('reCaptcha')): ?>
                            <div class="text-danger" style="margin-top:5px;"><?= $model->getFirstError('reCaptcha') ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-12">
                        <button class="hoveranim cmnBtn"><span><?= Words::getValue($language, 'book_now') ?></span></button>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </section>

    <?php if (!empty($insurances)): ?>
    <section id="insurance">
        <div class="container">
            <div class="flxBox wow animate__fadeInUp" data-wow-duration="1.5s">
                <div class="leftSec"><div class="mainHead"><div class="head"><?= Words::getValue($language, 'insurance') ?></div></div></div>
                <div class="rtSec">
                    <a href="<?= Url::to(['site/insurance', 'language' => $language]) ?>" class="cmnBtnLinks"><?= Words::getValue($language, 'view_all') ?></a>
                </div>
            </div>
            <div class="owl-carousel owl-theme insuranceSlider wow animate__fadeInUp" data-wow-duration="1s">
                <?php foreach ($insurances as $insurance):
                    $department = $insuranceDepts[$insurance->department] ?? null;
                    if (!$department) continue;
                    $insImg   = $homeUrl . 'uploads/insurance/' . $insurance->image;
                    $deptName = $isAr ? $department->department_name_arabic : $department->department_name; ?>
                    <div class="item">
                        <a href="<?= Url::to(['site/department-details', 'language' => $language, 'slug' => $department->canonical_name]) ?>" class="insurencBx">
                            <div class="imgBox">
                                <img src="<?= $insImg ?>" data-src="<?= $insImg ?>" class="lazy" loading="lazy" decoding="async" width="238" height="140" alt="<?= $deptName ?>">
                            </div>
                            <div class="contentBx"><div class="subT"><?= $deptName ?></div></div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php if (!empty($testimonials)): ?>
    <section id="testimonial">
        <div class="container">
            <div class="flxBox wow animate__fadeInUp" data-wow-duration="1.5s">
                <div class="leftSec"><div class="mainHead"><div class="head"><?= Words::getValue($language, 'client_testimonial') ?></div></div></div>
                <div class="rtSec">
                    <a href="<?= Url::to(['site/testimonials', 'language' => $language]) ?>" class="cmnBtnLinks"><?= Words::getValue($language, 'view_all') ?></a>
                </div>
            </div>
            <div class="testimonialSlider owl-carousel wow animate__fadeInUp" data-wow-duration="1.5s">
                <?php foreach ($testimonials as $testimonial):
                    $img_link = $homeUrl . 'uploads/testimonials/' . $testimonial->image;
                    $tName    = $isAr ? $testimonial->name_arabic : $testimonial->name; ?>
                    <div class="item">
                        <a href="<?= $testimonial->video != '' ? $testimonial->video : $img_link ?>" class="testimonialBox" data-fancybox="testmonial" target="_blank" rel="noopener">
                            <div class="imgBox">
                                <img src="<?= $img_link ?>" data-src="<?= $img_link ?>" class="lazy" loading="lazy" decoding="async" width="300" height="300" alt="testimonial-<?= $tName ?>">
                                <?php if ($testimonial->video != ''): ?>
                                    <div class="plyBtn"><svg viewBox="0 0 11.132 13.036"><path d="M6.518,0l6.518,11.132H0Z" transform="translate(11.132) rotate(90)" fill="#763813"/></svg></div>
                                <?php endif; ?>
                            </div>
                            <div class="info">
                                <div class="name"><?= $tName ?></div>
                                <div class="post"><?= $isAr ? $testimonial->designation_arabic : $testimonial->designation ?></div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php if (!empty($google_reviews)): ?>
    <section id="review">
        <div class="container">
            <div class="flxBox wow animate__fadeInUp" data-wow-duration="1.5s">
                <div class="leftSec"><div class="mainHead"><div class="head"><?= Words::getValue($language, 'google_reviews') ?></div></div></div>
            </div>
            <div class="reviewSlider owl-carousel wow animate__fadeInUp" data-wow-duration="1.5s">
                <?php foreach ($google_reviews as $google_review):
                    $revImg  = $homeUrl . 'uploads/google-reviews/' . $google_review->image;
                    $revName = $isAr ? $google_review->name_arabic : $google_review->name; ?>
                    <div class="item">
                        <a href="javascript:void(0)" class="reviewBx">
                            <div class="goImg"><img src="<?= $homeUrl ?>images/google.svg" alt="Google" loading="lazy" width="40" height="40"></div>
                            <div class="avtBx">
                                <div class="avImg">
                                    <div class="icon">
                                        <img src="<?= $revImg ?>" data-src="<?= $revImg ?>" class="lazy" loading="lazy" decoding="async" width="45" height="45" alt="review-<?= $revName ?>">
                                    </div>
                                </div>
                                <div class="info">
                                    <div class="name"><?= $revName ?></div>
                                    <div class="post"><?= date("d F Y", strtotime($google_review->date)) ?></div>
                                </div>
                            </div>
                            <div class="rateBx"><div class="stars" data-rating="5"></div></div>
                            <div class="content"><p><?= $isAr ? $google_review->message_arabic : $google_review->message ?></p></div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>
    
    
    <section  class="newimageinhome">
        <div class="container" style="display: flex; align-content: center; justify-content: center; align-items: center;z-index:1;">
            <img src="https://damasmc.com/uploads/about/Major-Credit-Card-Logo-PNG-Transparent-Image.png" alt="payment gateway" width="500px"/>
        </div>
    </section>

</div>


<!--
  PAGE SCRIPTS — Owl Carousel + WOW + touchSwipe, self-hosted as ONE deferred file (was 3 cdnjs requests).
  Fancybox (90 KB, only needed when a testimonial is clicked) is loaded after window.load, see bottom.
-->
<script defer src="<?= $homeUrl ?>lib/home.min.js?v=1"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var rtlVal = document.documentElement.getAttribute('dir') === 'rtl';

    /* ---- Reveal animations (animate.css v4 uses the animate__ prefix, so WOW must be told) ---- */
    if (window.WOW) { new WOW({ animateClass: 'animate__animated' }).init(); }

    /* ---- Hero swipe ---- */
    if ($.fn.swipe) {
        $("#MainBanner").swipe({
            swipe: function (event, direction) {
                if (direction == 'left')  $(this).carousel('next');
                if (direction == 'right') $(this).carousel('prev');
            },
            allowPageScroll: "vertical"
        });
    }

    /* ---- Hero slide counter ---- */
    function pad(str, max) { str = String(str); return str.length < max ? pad("0" + str, max) : str; }
    var totalItems = $('.carousel-item').length;
    function updateHeroCount() {
        var idx = parseInt($('.carousel-item.active').attr('data-bs-slide'), 10) + 1;
        $('.countBox .currentItems').html('<span>' + pad(idx, 2) + '</span>');
    }
    updateHeroCount();
    $('.countBox .totalCount').html('<span>' + pad(totalItems, 2) + '</span>');
    $('#MainBanner').on('slid.bs.carousel', updateHeroCount);

    /* ---- Counters: IntersectionObserver replaces ScrollMagic (one less 20KB library, no scroll listener) ---- */
    var counterBox = document.querySelector('#health .flxBox');
    if (counterBox && 'IntersectionObserver' in window) {
        var runCounters = function () {
            $('#health .couterBx').addClass('isVisible');
            $('.numTxt span').each(function () {
                var $el = $(this), target = parseFloat($el.attr('data-count')) || 0, start = null, dur = 2000;
                function step(ts) {
                    if (!start) start = ts;
                    var p = Math.min((ts - start) / dur, 1);
                    $el.text(Math.floor(p * target));
                    if (p < 1) requestAnimationFrame(step); else $el.text($el.attr('data-count'));
                }
                requestAnimationFrame(step);
            });
        };
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (e) {
                if (e.isIntersecting) { runCounters(); }
                else { $('#health .couterBx').removeClass('isVisible'); $('.numTxt span').text(0); }
            });
        }, { threshold: 0.1 });
        io.observe(counterBox);
    }

    /* ---- Owl sliders ---- */
    var owlBase = {
        rewind: true, autoplay: false, smartSpeed: 500, autoplayTimeout: 3500, autoplayHoverPause: true,
        nav: false, dots: false, items: 1, rtl: rtlVal, margin: 10, responsiveClass: true,
        responsive: { 520: { items: 2, margin: 15 }, 768: { items: 3, margin: 15 }, 992: { items: 3, margin: 15 }, 1441: { items: 3, margin: 22 } }
    };

    function wireNav(sectionId, $slider) {
        $slider.on('initialized.owl.carousel', function (e) {
            $(sectionId + ' .NavflxBx .total').text(e.item.count);
        });
        $(sectionId + ' .NavflxBx .current').text(1);
        $(sectionId + ' .customSlideNav.OwlNext').on('click', function () { $slider.trigger('next.owl.carousel'); });
        $(sectionId + ' .customSlideNav.OwlPrev').on('click', function () { $slider.trigger('prev.owl.carousel'); });
        $slider.on('translated.owl.carousel', function (e) {
            $(sectionId + ' .NavflxBx .current').text(Math.min(e.item.count, e.item.index + 1));
        });
    }

    /* Each slider is built when its section comes within ~600px of the screen, not all five at once after first paint
       (that burst was the biggest block of main-thread work on mobile). */
    if ($.fn.owlCarousel) {
        /* Observe the slider's <section>: Owl hides the slider itself (display:none) until it is initialised,
           and a hidden element never intersects the viewport. */
        var near = function (el, fn, margin) {
            if (!el) return;
            var target = $(el).closest('section')[0] || el.parentNode;
            (window.whenNear || function (e, f) { f(); })(target, fn, margin);
        };
        var $service = $('.serviceSlider');
        wireNav('#service', $service);
        near($service[0], function () {
            $service.owlCarousel($.extend({}, owlBase, { rewind: false, loop: false,
                responsive: { 520: { items: 2, margin: 15 }, 768: { items: 3, margin: 15 }, 992: { items: 3, margin: 15 }, 1441: { items: 4, margin: 22 } } }));
        }, '600px');

        var $doctor = $('.doctorSlider');
        wireNav('#doctors', $doctor);
        near($doctor[0], function () { $doctor.owlCarousel($.extend({}, owlBase, { autoplay: true, lazyLoad: true })); }, '600px');

        near($('.testimonialSlider')[0], function () { $('.testimonialSlider').owlCarousel(owlBase); }, '600px');
        near($('.reviewSlider')[0], function () { $('.reviewSlider').owlCarousel(owlBase); }, '600px');

        near($('.insuranceSlider')[0], function () {
            $('.insuranceSlider').owlCarousel({
                loop: true, autoplay: true, smartSpeed: 500, autoplayTimeout: 2000, autoplayHoverPause: true,
                responsiveClass: true, nav: true, dots: false, rtl: rtlVal, margin: 15,
                responsive: { 0: { items: 3 }, 578: { items: 4 }, 768: { items: 5 }, 1200: { items: 5, margin: 20 } }
            });
        }, '600px');
    }

    /* ---- Parallax on #appointment: passive scroll listener, one transform per frame, reads batched in rAF (replaces Jarallax) ---- */
    var pxImg = document.querySelector('#appointment .parallax-img');
    if (pxImg && window.matchMedia('(min-width:1024px) and (hover:hover)').matches && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        var pxSection = pxImg.parentNode, pxTicking = false;
        var pxUpdate = function () {
            pxTicking = false;
            var r = pxSection.getBoundingClientRect();
            if (r.bottom < 0 || r.top > window.innerHeight) return;
            var progress = (window.innerHeight - r.top) / (window.innerHeight + r.height); // 0..1 through the viewport
            pxImg.style.transform = 'translate3d(0,' + ((progress - 0.5) * r.height * 0.3) + 'px,0)';
        };
        var pxOnScroll = function () { if (!pxTicking) { pxTicking = true; requestAnimationFrame(pxUpdate); } };
        window.addEventListener('scroll', pxOnScroll, { passive: true });
        window.addEventListener('resize', pxOnScroll, { passive: true });
        pxUpdate();
    }

    /* select2 is initialised once for all <select>s in the layout — no second init here. */

    /* ---- reCAPTCHA on demand: load when the appointment section is within ~600px of the viewport ---- */
    var apptSection = document.getElementById('appointment');
    if (apptSection && window.loadRecaptcha) {
        if ('IntersectionObserver' in window) {
            var rcObs = new IntersectionObserver(function (entries, obs) {
                if (entries[0].isIntersecting) { window.loadRecaptcha(); obs.disconnect(); }
            }, { rootMargin: '600px 0px' });
            rcObs.observe(apptSection);
        } else {
            window.loadRecaptcha();
        }
        /* Server-side validation failed → the form re-rendered with an error → widget is needed immediately */
        if (document.querySelector('#appointment .text-danger')) { window.loadRecaptcha(); }
    }
});

/* ---- Videos ----
   Hero video: attached after window.load (it is above the fold and must not compete with the LCP image).
   Section videos (#health is a 4 MB Vimeo MP4): attached only when the section is within one viewport of being seen,
   never on a page the user does not scroll. */
function attachVideo(v) {
    if (!v || v.src) return;
    v.src = v.dataset.src;
    v.load();
    var p = v.play();
    if (p && p.catch) { p.catch(function () {}); }
}
window.addEventListener('load', function () {
    /* Fancybox: only used on click (testimonial videos), so fetch it once the page has finished loading. */
    var fbCss = document.createElement('link'); fbCss.rel = 'stylesheet'; fbCss.href = <?= json_encode($homeUrl . 'lib/jquery.fancybox-3.5.6.min.css') ?>;
    document.head.appendChild(fbCss);
    var fbJs = document.createElement('script'); fbJs.src = <?= json_encode($homeUrl . 'lib/jquery.fancybox-3.5.6.min.js') ?>; fbJs.async = true;
    document.body.appendChild(fbJs);

    document.querySelectorAll('video.hero-video[data-src]').forEach(attachVideo);

    var lazyVideos = document.querySelectorAll('video[data-src]:not(.hero-video)');
    if ('IntersectionObserver' in window) {
        var vo = new IntersectionObserver(function (entries, obs) {
            entries.forEach(function (e) { if (e.isIntersecting) { attachVideo(e.target); obs.unobserve(e.target); } });
        }, { rootMargin: '150px 0px' }); /* was one full viewport — Lighthouse's tall mobile viewport was still triggering the 4 MB download */
        lazyVideos.forEach(function (v) { vo.observe(v); });
    } else {
        lazyVideos.forEach(attachVideo);
    }
});
</script>