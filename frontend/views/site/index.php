<?php

use common\models\About;
use common\models\Words;
use common\models\Departments;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;

$currentUrl = Url::to(Yii::$app->request->url, true);
$homeUrl    = Yii::$app->homeUrl;
$isAr       = ($language === 'ar');

$this->params['criticalCss'] = 'critical-home.css';
$this->registerCssFile($homeUrl . 'lib/owl.carousel-2.3.4.min.css', ['media' => 'print', 'onload' => "this.media='all';this.onload=null"]);
$this->params['scriptsDeferSafe'] = true;
$this->registerCss('#MainBanner .carousel-inner .carousel-item{display:none}#MainBanner .carousel-inner .carousel-item.active,#MainBanner .carousel-inner .carousel-item-next,#MainBanner .carousel-inner .carousel-item-prev{display:flex}');
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
    <!-- No data-bs-ride: auto-rotation starts after the first interaction or 8 s after load (see script below).
         Rotating during load made a later slide the LCP element (lazy, low priority) instead of the preloaded first slide. -->
    <section id="MainBanner" class="carousel slide" data-bs-touch="false">
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
                            <span class="bannerEyebrow"><?= Html::encode($isAr ? 'الصحة والجمال تحت سقف واحد' : 'Where Health Meets Beauty Under One Roof') ?></span>
                            <h2 class="mainTitle"><?= Html::encode($isAr ? 'موثوقون منذ 19 عاماً على التوالي' : 'Trusted for 19 Years Straight') ?></h2>
                            <p class="SubInfo"><?= Html::encode($isAr ? 'من الابتسامات الواثقة إلى البشرة المتألقة، يصمم أطباؤنا الرعاية بما يناسبك.' : 'From confident smiles to radiant skin, our doctors design care around you.') ?></p>

                            <div class="heroContactRow">
                                <a href="#bookingModal" class="cmnBtn heroBookBtn hoveranim" data-bs-toggle="modal" data-bs-target="#bookingModal">
                                    <span><?= Html::encode($isAr ? 'احجز موعدك' : 'Book Your Appointment') ?></span>
                                </a>
                                <div class="heroPhone">
                                    <span class="heroPhone__icon" aria-hidden="true">
                                        <svg viewBox="0 0 24 24" focusable="false"><path d="M6.6 10.8a15.5 15.5 0 0 0 6.6 6.6l2.2-2.2a1 1 0 0 1 1-.24 11.4 11.4 0 0 0 3.56.57 1 1 0 0 1 1 1V20a1 1 0 0 1-1 1A17 17 0 0 1 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1 11.4 11.4 0 0 0 .57 3.56 1 1 0 0 1-.25 1z"/></svg>
                                    </span>
                                    <a href="tel:+97165067444" class="heroPhone__copy">
                                        <span><?= Html::encode($isAr ? 'لحجز موعد' : 'To Book An Appointment') ?></span>
                                        <strong dir="ltr">+971 6 506 7444</strong>
                                    </a>
                                </div>
                            </div>

                            <aside class="heroHours" aria-label="<?= Html::encode($isAr ? 'ساعات العمل' : 'Opening Hours') ?>">
                                <h3><?= Html::encode($isAr ? 'ساعات العمل' : 'Opening Hours') ?></h3>
                                <div class="heroHours__row">
                                    <span><?= Html::encode($isAr ? 'السبت – الخميس' : 'Saturday – Thursday') ?></span>
                                    <time dir="ltr">9:00 AM – 10:00 PM</time>
                                </div>
                                <div class="heroHours__row">
                                    <span><?= Html::encode($isAr ? 'الجمعة' : 'Friday') ?></span>
                                    <time dir="ltr">12:00 PM – 10:00 PM</time>
                                </div>
                            </aside>
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

    <section id="about" class="about-section" style="padding-top:50px;padding-bottom:150px">
        <div class="floaticon" aria-hidden="true">
            <img src="<?= $homeUrl ?>images/logoIcon.svg" alt="" loading="lazy" width="120" height="120">
        </div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6">
                   <div class="imgBox aboutImageBox wow animate__fadeInUp">
                        <img src="<?= $ourStoryImage ?>" data-src="<?= $ourStoryImage ?>" 
                             class="lazy" loading="lazy" decoding="async" alt="<?= Html::encode($isAr ? 'مركز داماس الطبي' : 'Damas Medical Center') ?>">
                        <div class="aboutFloatingCard">
                            <h3><?= Html::encode($isAr ? 'يمكنك التمتع بالجمال بأمان' : 'You Can Be Beautiful Safely') ?></h3>
                            
                        </div>
                </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="contentBx aboutContent wow animate__fadeInUp">
                        <span class="aboutEyebrow"><?= Html::encode($isAr ? 'من نحن' : 'ABOUT US') ?></span>
                        <h2 class="aboutHeadline"><?= Html::encode($isAr ? 'مركز داماس الطبي للجميع، أينما كنتم' : 'Damas Medical Center Is for Everyone, Anywhere') ?></h2>
                         <?= About::getValue('our_story', $language) ?>

                          <div class="aboutStats" aria-label="<?= Html::encode($isAr ? 'حقائق عن مركز داماس الطبي' : 'Damas Medical Center facts') ?>">
                            <div class="aboutStat" style="background-color: #814826;">
                                <svg fill="#ffffff" width="30px" height="30px" viewBox="-32 0 512 512" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M277.37 11.98C261.08 4.47 243.11 0 224 0c-53.69 0-99.5 33.13-118.51 80h81.19l90.69-68.02zM342.51 80c-7.9-19.47-20.67-36.2-36.49-49.52L239.99 80h102.52zM224 256c70.69 0 128-57.31 128-128 0-5.48-.95-10.7-1.61-16H97.61c-.67 5.3-1.61 10.52-1.61 16 0 70.69 57.31 128 128 128zM80 299.7V512h128.26l-98.45-221.52A132.835 132.835 0 0 0 80 299.7zM0 464c0 26.51 21.49 48 48 48V320.24C18.88 344.89 0 381.26 0 422.4V464zm256-48h-55.38l42.67 96H256c26.47 0 48-21.53 48-48s-21.53-48-48-48zm57.6-128h-16.71c-22.24 10.18-46.88 16-72.89 16s-50.65-5.82-72.89-16h-7.37l42.67 96H256c44.11 0 80 35.89 80 80 0 18.08-6.26 34.59-16.41 48H400c26.51 0 48-21.49 48-48v-41.6c0-74.23-60.17-134.4-134.4-134.4z"></path></g></svg>
                                <strong>2007</strong>
                                <span><?= Html::encode($isAr ? 'نخدم الشارقة منذ' : 'Serving Sharjah Since') ?></span>
                            </div>
                            <div class="aboutStat" style="background-color:#D5AE69;">
                                <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M12 7V12L14.5 10.5M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                <strong>19+</strong>
                                <span><?= Html::encode($isAr ? 'عاماً من الخبرة' : 'Years of Experience') ?></span>
                            </div>
                            <div class="aboutStat" style="background-color: #D5AE69;">
                                <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M4.5 9.45728C4.5 7.13366 6.38366 5.25 8.70728 5.25C9.77775 5.25 10.7533 5.64881 11.4962 6.30708L11.5918 6.39185L11.9753 6.77533L12 6.75349L12.0246 6.77534L12.4081 6.3919L12.5038 6.30708C13.2467 5.64881 14.2222 5.25 15.2927 5.25C17.6163 5.25 19.4999 7.13366 19.4999 9.45728C19.4999 10.524 19.104 11.4963 18.4499 12.2382L18.2646 12.4354L12 18.7L8.03033 14.7303L6.96967 15.791L12 20.8213L19.3416 13.4796L19.5582 13.2492L19.5655 13.241C20.4575 12.2343 20.9999 10.9082 20.9999 9.45728C20.9999 6.30523 18.4447 3.75 15.2927 3.75C14.0969 3.75 12.9859 4.11843 12.0686 4.74733L11.9999 4.67867L11.9313 4.74731C11.014 4.11842 9.90307 3.75 8.70728 3.75C5.55523 3.75 3 6.30523 3 9.45728C3 10.9045 3.53349 12.2379 4.42798 13.2474L5.55066 12.2526C4.89489 11.5125 4.5 10.5314 4.5 9.45728ZM12.75 12.4393L9.75 9.43934L4.93934 14.25H3V15.75H5.56066L9.75 11.5607L12.75 14.5607L15.3107 12H17.25V10.5H14.6893L12.75 12.4393Z" fill="#ffffff"></path> </g></svg>
                                <strong>4.4/5</strong>
                                <span><?= Html::encode($isAr ? 'تقييم Google' : 'Google Rating') ?></span>
                            </div>
                        </div>

                        <a href="<?= Url::to(['site/about', 'language' => $language]) ?>" class="cmnBtn hoveranim aboutLearnMore">
                            <span><?= Html::encode($isAr ? 'اعرف المزيد' : 'Learn More') ?></span>
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

    <!-- Departments: desktop grid, mobile carousel -->
    <section id="service" class="departmentSection">
        <div class="floaticon" aria-hidden="true">
            <img src="<?= $homeUrl ?>images/logoIcon.svg" alt="" loading="lazy" width="120" height="120">
        </div>
        <div class="container">
            <div class="departmentHeader">
                <div class="departmentHeader__copy">
                    <span class="departmentEyebrow"><?= Html::encode($isAr ? 'الأقسام' : 'DEPARTMENTS') ?></span>
                    <h2><?= Html::encode($isAr ? 'كل ما تحتاجه ابتسامتك وبشرتك' : 'Everything Your Smile and Skin Need') ?></h2>
                </div>
                <div class="NavflxBx departmentNav wow animate__fadeInUp" data-wow-duration="1.5s">
                    <div class="counterBx">
                        <div class="item"><div class="countList current">01</div></div>
                        <div class="item"><div class="countList total"><?= sprintf('%02d', count($departments)) ?></div></div>
                    </div>
                    <div class="navButtons">
                        <div class="item">
                            <button class="OwlPrev customSlideNav" type="button" aria-label="<?= Html::encode($isAr ? 'السابق' : 'Previous') ?>">
                                <div class="icon"><svg viewBox="0 0 18.156 9"><path d="M13,0V3H0V6H13V9l5.156-4.516L13,0Z" transform="translate(18.156 9) rotate(180)"/></svg></div>
                            </button>
                        </div>
                        <div class="item">
                            <button class="OwlNext customSlideNav" type="button" aria-label="<?= Html::encode($isAr ? 'التالي' : 'Next') ?>">
                                <div class="icon"><svg viewBox="0 0 18.156 9"><path d="M-3697-66v-3h-13v-3h13v-3l5.156,4.516L-3697-66Z" transform="translate(3710 75)"/></svg></div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="serviceGrid wow animate__fadeInUp" data-wow-duration="1.5s">
                <?php foreach ($departments as $department):
                    $deptImg = $homeUrl . 'uploads/departments/' . $department->department_image;
                    $deptName = $isAr ? $department->department_name_arabic : $department->department_name;
                    $deptDescription = $isAr ? $department->department_description_arabic : $department->department_description;
                    $deptDescription = trim(preg_replace('/\\s+/u', ' ', strip_tags((string) $deptDescription)));
                    $deptDescription = mb_strimwidth($deptDescription, 0, 135, '…', 'UTF-8');
                    $deptUrl = Url::to(['site/department-details', 'language' => $language, 'slug' => $department->canonical_name]); ?>
                    <div class="serviceCardItem item">
                        <a href="<?= $deptUrl ?>" class="serviceCard">
                            <div class="serviceCard__image">
                                <img src="<?= $deptImg ?>" data-src="<?= $deptImg ?>" class="lazy" loading="lazy" decoding="async" width="420" height="250" alt="<?= Html::encode($deptName) ?>">
                                <span class="serviceCard__title"><?= Html::encode($deptName) ?></span>
                            </div>
                            <div class="serviceCard__body">
                                <p><?= Html::encode($deptDescription) ?></p>
                                <span class="serviceCard__link ">
                                    <?= Html::encode($isAr ? 'اعرف المزيد' : 'Learn More') ?>
                                    <span aria-hidden="true">→</span>
                                </span>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Doctors (owl) -->
    <section id="careProcess" class="careProcess">
        <div class="container">
            <div class="careProcess__layout">
                <div class="careProcess__intro">
                    <span class="careProcess__eyebrow"><?= Html::encode($isAr ? 'الخطوات' : 'PROCESS') ?></span>
                    <h2><?= Html::encode($isAr ? 'العناية بصحتك يجب أن تكون سهلة، ونحن نجعلها كذلك' : 'Taking Care of Your Health Should Be Easy, We Have That') ?></h2>
                    <p><?= Html::encode($isAr ? 'أربع مراحل، من الاتصال الأول حتى المتابعة.' : 'Four stages, from the first call to the follow-up.') ?></p>
                    <div class="careProcess__visual" aria-hidden="true">
                        <img src="<?= $homeUrl ?>images/processimage.webp" alt="" loading="lazy" decoding="async" width="960" height="400">
                    </div>
                </div>

                <div class="careProcess__steps">
                    <?php foreach ([
                        [
                            'title' => $isAr ? 'احجز موعدك' : 'Book Your Appointment',
                            'text' => $isAr ? 'اتصل بنا أو راسلنا عبر واتساب أو استخدم النموذج الإلكتروني. نؤكد موعدك عبر الهاتف.' : 'Call, WhatsApp or use the online form. We confirm your time by phone.',
                        ],
                        [
                            'title' => $isAr ? 'الاستشارة والتقييم' : 'Consultation and Assessment',
                            'text' => $isAr ? 'يفحصك الطبيب المختص ويشرح لك الخيارات الواقعية.' : 'Your specialist examines you and explains the realistic options.',
                        ],
                        [
                            'title' => $isAr ? 'خطتك العلاجية' : 'Your Plan',
                            'text' => $isAr ? 'تحصل على خطة علاج مصممة حول ما ترغب في تغييره.' : 'You receive a treatment plan built around what you want to change.',
                        ],
                        [
                            'title' => $isAr ? 'العلاج والمتابعة' : 'Treatment and Follow-Up',
                            'text' => $isAr ? 'نبدأ العلاج ونتواصل معك بعد ذلك للاطمئنان.' : 'We begin, and we check in afterwards.',
                        ],
                    ] as $stepIndex => $step): ?>
                        <article class="careProcess__card">
                            <div class="careProcess__number"><span><?= sprintf('%02d', $stepIndex + 1) ?></span><i aria-hidden="true"></i></div>
                            <h3><?= Html::encode($step['title']) ?></h3>
                            <p><?= Html::encode($step['text']) ?></p>
                        </article>
                    <?php endforeach; ?>
                </div>
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

    <section id="whyChooseUs" class="whyChooseUs">
        <div class="container">
            <header class="whyChooseUs__header">
                <span class="whyChooseUs__eyebrow"><?= Html::encode($isAr ? 'لماذا تختارنا' : 'WHY CHOOSE US') ?></span>
                <h2><?= Html::encode($isAr ? 'شريكك الصحي الذي كنت تبحث عنه' : 'The Health Partner You\'ve Been Looking For') ?></h2>
            </header>

            <?php
            $whyLeft = [
                [
                    'title' => $isAr ? '19 عاماً من الخبرة' : '19 years of experience',
                    'desc' => $isAr ? '19 عاماً من الخبرة' : '19 years of experience',
                    'svg' => '<svg height="30px" width="30px" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css"> .st0{fill:#ffffff;} </style> <g> <path class="st0" d="M78.641,118.933c22.88,0,41.416-18.551,41.416-41.414c0-22.887-18.536-41.423-41.416-41.423 c-22.887,0-41.422,18.536-41.422,41.423C37.218,100.382,55.754,118.933,78.641,118.933z"></path> <path class="st0" d="M255.706,228.73v0.062c0.101,0,0.194-0.031,0.294-0.031c0.101,0,0.194,0.031,0.294,0.031v-0.062 c15.562-0.317,28.082-12.976,28.082-28.601c0-15.648-12.52-28.299-28.082-28.616v-0.063c-0.101,0-0.194,0.031-0.294,0.031 c-0.1,0-0.193-0.031-0.294-0.031v0.063c-15.563,0.317-28.082,12.968-28.082,28.616C227.623,215.754,240.143,228.413,255.706,228.73 z"></path> <path class="st0" d="M433.359,118.933c22.887,0,41.423-18.551,41.423-41.414c0-22.887-18.536-41.423-41.423-41.423 c-22.88,0-41.416,18.536-41.416,41.423C391.944,100.382,410.48,118.933,433.359,118.933z"></path> <path class="st0" d="M470.097,138.553h-36.312h-18.404c-21.106,0-40.432,11.831-50.033,30.622l-33.494,97.967 c-1.154,2.246-3.298,3.84-5.792,4.282c-2.493,0.442-5.048-0.309-6.914-2.036l-20.836-18.04c-6.233-5.769-14.408-8.973-22.902-8.973 H256h-19.41c-8.494,0-16.669,3.204-22.902,8.973l-20.835,18.04c-1.866,1.727-4.421,2.478-6.914,2.036 c-2.492-0.442-4.637-2.036-5.791-4.282l-33.495-97.967c-9.6-18.791-28.926-30.622-50.032-30.622H78.215H41.902 C21.834,138.553,0,160.387,0,180.464v139.211c0,10.034,8.13,18.171,18.164,18.171c4.939,0,0,0,12.682,0l6.906,118.725 c0,10.676,8.664,19.332,19.34,19.332c4.506,0,12.814,0,21.122,0c8.308,0,16.616,0,21.122,0c10.676,0,19.34-8.656,19.34-19.332 l6.906-118.725l-0.085-84.766c0-1.339,0.914-2.493,2.222-2.818c1.309-0.31,2.648,0.309,3.26,1.502l26.572,65.401 c3.206,6.256,9.152,10.654,16.074,11.885c6.922,1.231,14.022-0.844,19.186-5.613l25.426-18.729 c0.852-0.782,2.083-0.984,3.136-0.542c1.061,0.473,1.743,1.518,1.743,2.663l0.093,73.508l4.777,82.187 c0,7.387,6.001,13.379,13.395,13.379c3.113,0,8.865,0,14.618,0c5.753,0,11.506,0,14.618,0c7.394,0,13.394-5.992,13.394-13.379 l4.778-82.187l0.093-73.508c0-1.146,0.681-2.19,1.742-2.663c1.053-0.442,2.284-0.24,3.136,0.542l25.427,18.729 c5.164,4.769,12.264,6.844,19.186,5.613c6.922-1.231,12.868-5.629,16.073-11.885l26.573-65.401 c0.611-1.192,1.951-1.812,3.259-1.502c1.309,0.325,2.222,1.478,2.222,2.818l-0.085,84.766l6.906,118.725 c0,10.676,8.664,19.332,19.341,19.332c4.507,0,12.814,0,21.122,0c8.308,0,16.616,0,21.121,0c10.677,0,19.342-8.656,19.342-19.332 l6.906-118.725c12.682,0,7.742,0,12.682,0c10.034,0,18.164-8.137,18.164-18.171V180.464 C512,160.387,490.166,138.553,470.097,138.553z"></path> </g> </g></svg>',
                ],
                [
                    'title' => $isAr ? 'أطباء بخبرة تزيد على 10 سنوات' : 'Doctors with over 10 years of experience',
                    'desc' => $isAr ? 'أطباء بخبرة تزيد على 10 سنوات' : 'Doctors with over 10 years of experience',
                    'svg' => '<svg fill="#ffffff" width="30px" height="30px" viewBox="0 0 14 14" role="img" focusable="false" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="m 7.75,4.05953 0,-0.43453 0.375,0 C 8.3321875,3.625 8.5,3.45719 8.5,3.25 l 0,-0.375 C 8.5,2.66781 8.3321875,2.5 8.125,2.5 l -2.25,0 C 5.6678125,2.5 5.5,2.66781 5.5,2.875 l 0,0.375 c 0,0.20719 0.1678125,0.375 0.375,0.375 l 0.375,0 0,0.43453 C 3.7067969,4.42445 1.75,6.60578 1.75,9.25 l 10.5,0 c 0,-2.64422 -1.956797,-4.82555 -4.5,-5.19047 z M 12.625,10 1.375,10 C 1.1678125,10 1,10.16781 1,10.375 l 0,0.75 C 1,11.33219 1.1678125,11.5 1.375,11.5 l 11.25,0 C 12.832188,11.5 13,11.33219 13,11.125 l 0,-0.75 C 13,10.16781 12.832188,10 12.625,10 Z"></path></g></svg>',
                ],
                [
                    'title' => $isAr ? 'قصص نجاح حقيقية' : 'Real successful cases',
                    'desc' => $isAr ? 'أطباء بخبرة تزيد على 10 سنوات' : 'Doctors with over 10 years of experience',
                    'svg' => '<svg fill="#ffffff" width="30px" height="30px" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M505.04 442.66l-99.71-99.69c-4.5-4.5-10.6-7-17-7h-16.3c27.6-35.3 44-79.69 44-127.99C416.03 93.09 322.92 0 208.02 0S0 93.09 0 207.98s93.11 207.98 208.02 207.98c48.3 0 92.71-16.4 128.01-44v16.3c0 6.4 2.5 12.5 7 17l99.71 99.69c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.59.1-33.99zm-297.02-90.7c-79.54 0-144-64.34-144-143.98 0-79.53 64.35-143.98 144-143.98 79.54 0 144 64.34 144 143.98 0 79.53-64.35 143.98-144 143.98zm27.11-152.54l-45.01-13.5c-5.16-1.55-8.77-6.78-8.77-12.73 0-7.27 5.3-13.19 11.8-13.19h28.11c4.56 0 8.96 1.29 12.82 3.72 3.24 2.03 7.36 1.91 10.13-.73l11.75-11.21c3.53-3.37 3.33-9.21-.57-12.14-9.1-6.83-20.08-10.77-31.37-11.35V112c0-4.42-3.58-8-8-8h-16c-4.42 0-8 3.58-8 8v16.12c-23.63.63-42.68 20.55-42.68 45.07 0 19.97 12.99 37.81 31.58 43.39l45.01 13.5c5.16 1.55 8.77 6.78 8.77 12.73 0 7.27-5.3 13.19-11.8 13.19h-28.1c-4.56 0-8.96-1.29-12.82-3.72-3.24-2.03-7.36-1.91-10.13.73l-11.75 11.21c-3.53 3.37-3.33 9.21.57 12.14 9.1 6.83 20.08 10.77 31.37 11.35V304c0 4.42 3.58 8 8 8h16c4.42 0 8-3.58 8-8v-16.12c23.63-.63 42.68-20.54 42.68-45.07 0-19.97-12.99-37.81-31.59-43.39z"></path></g></svg>',

                    
                ],
            ];
            $whyRight = [
                [
                    'title' => $isAr ? 'تقييم 4.4 على Google' : '4.4 rating on Google',
                    'desc' => $isAr ? 'أطباء بخبرة تزيد على 10 سنوات' : 'Doctors with over 10 years of experience',
                    'svg' => '<svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M7 6H5.2C4.0799 6 3.51984 6 3.09202 6.21799C2.71569 6.40973 2.40973 6.71569 2.21799 7.09202C2 7.51984 2 8.0799 2 9.2V17.8C2 18.9201 2 19.4802 2.21799 19.908C2.40973 20.2843 2.71569 20.5903 3.09202 20.782C3.51984 21 4.0799 21 5.2 21H18.8C19.9201 21 20.4802 21 20.908 20.782C21.2843 20.5903 21.5903 20.2843 21.782 19.908C22 19.4802 22 18.9201 22 17.8V9.2C22 8.07989 22 7.51984 21.782 7.09202C21.5903 6.71569 21.2843 6.40973 20.908 6.21799C20.4802 6 19.9201 6 18.8 6H17M2 10H4M20 10H22M2 14H4M20 14H22M12 6V10M10 8H14M17 21V6.2C17 5.0799 17 4.51984 16.782 4.09202C16.5903 3.71569 16.2843 3.40973 15.908 3.21799C15.4802 3 14.9201 3 13.8 3H10.2C9.07989 3 8.51984 3 8.09202 3.21799C7.71569 3.40973 7.40973 3.71569 7.21799 4.09202C7 4.51984 7 5.0799 7 6.2V21H17ZM14 21V17C14 15.8954 13.1046 15 12 15C10.8954 15 10 15.8954 10 17V21H14Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>',

                ],
                [
                    'title' => $isAr ? 'خيارات دفع مرنة' : 'Flexible ways to pay',
                    'desc' => $isAr ? 'أطباء بخبرة تزيد على 10 سنوات' : 'Doctors with over 10 years of experience',
                    'svg' => '<svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M8 5.00005C7.01165 5.00082 6.49359 5.01338 6.09202 5.21799C5.71569 5.40973 5.40973 5.71569 5.21799 6.09202C5 6.51984 5 7.07989 5 8.2V17.8C5 18.9201 5 19.4802 5.21799 19.908C5.40973 20.2843 5.71569 20.5903 6.09202 20.782C6.51984 21 7.07989 21 8.2 21H15.8C16.9201 21 17.4802 21 17.908 20.782C18.2843 20.5903 18.5903 20.2843 18.782 19.908C19 19.4802 19 18.9201 19 17.8V8.2C19 7.07989 19 6.51984 18.782 6.09202C18.5903 5.71569 18.2843 5.40973 17.908 5.21799C17.5064 5.01338 16.9884 5.00082 16 5.00005M8 5.00005V7H16V5.00005M8 5.00005V4.70711C8 4.25435 8.17986 3.82014 8.5 3.5C8.82014 3.17986 9.25435 3 9.70711 3H14.2929C14.7456 3 15.1799 3.17986 15.5 3.5C15.8201 3.82014 16 4.25435 16 4.70711V5.00005M12 11H9M15 15H9" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>',

                ],
                [
                    'title' => $isAr ? 'جميع الأقسام تحت سقف واحد' : 'All departments under one roof',
                    'desc' => $isAr ? 'أطباء بخبرة تزيد على 10 سنوات' : 'Doctors with over 10 years of experience',
                    'svg' => '<svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M4.5 9.45728C4.5 7.13366 6.38366 5.25 8.70728 5.25C9.77775 5.25 10.7533 5.64881 11.4962 6.30708L11.5918 6.39185L11.9753 6.77533L12 6.75349L12.0246 6.77534L12.4081 6.3919L12.5038 6.30708C13.2467 5.64881 14.2222 5.25 15.2927 5.25C17.6163 5.25 19.4999 7.13366 19.4999 9.45728C19.4999 10.524 19.104 11.4963 18.4499 12.2382L18.2646 12.4354L12 18.7L8.03033 14.7303L6.96967 15.791L12 20.8213L19.3416 13.4796L19.5582 13.2492L19.5655 13.241C20.4575 12.2343 20.9999 10.9082 20.9999 9.45728C20.9999 6.30523 18.4447 3.75 15.2927 3.75C14.0969 3.75 12.9859 4.11843 12.0686 4.74733L11.9999 4.67867L11.9313 4.74731C11.014 4.11842 9.90307 3.75 8.70728 3.75C5.55523 3.75 3 6.30523 3 9.45728C3 10.9045 3.53349 12.2379 4.42798 13.2474L5.55066 12.2526C4.89489 11.5125 4.5 10.5314 4.5 9.45728ZM12.75 12.4393L9.75 9.43934L4.93934 14.25H3V15.75H5.56066L9.75 11.5607L12.75 14.5607L15.3107 12H17.25V10.5H14.6893L12.75 12.4393Z" fill="#ffffff"></path> </g></svg>',

                ],
            ];
            ?>

            <div class="whyChooseUs__grid">
                <div class="whyChooseUs__side whyChooseUs__side--left">
                    <?php foreach ($whyLeft as $index => $item): ?>
                        <article class="whyChooseUs__item">
                            <div class="whyChooseUs__copy">
                                <h3><?= Html::encode($item['title']) ?></h3>
                                <p><?=Html::encode($item['desc'])?></p>
                            </div>
                            <span class="whyChooseUs__icon" aria-hidden="true"> <?= ($item['svg']) ?></span>
                        </article>
                    <?php endforeach; ?>
                </div>

                <div class="whyChooseUs__doctor" aria-hidden="true">
                    <img src="<?= $homeUrl ?>uploads/doctors/doctor_transparent.png" alt="" loading="lazy" decoding="async" width="306" height="600">
                </div>

                <div class="whyChooseUs__side whyChooseUs__side--right">
                    <?php foreach ($whyRight as $index => $item): ?>
                        <article class="whyChooseUs__item">
                            <span class="whyChooseUs__icon" aria-hidden="true"> <?= ($item['svg']) ?></span>
                            <div class="whyChooseUs__copy">
                                <h3><?= Html::encode($item['title']) ?></h3>
                                <p><?=Html::encode($item['desc'])?></p>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

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
                        <button class="cmnBtn hoveranim cmnBtn"><span><?= Words::getValue($language, 'book_now') ?></span></button>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </section>

     <section id="home-stats" class="homeStats" aria-label="<?= $isAr ? 'إحصائيات المركز' : 'Damas Medical Center statistics' ?>">
        <div class="container">
            <div class="homeStatsGrid">
                <div class="homeStat">
                    <span class="homeStatIcon" aria-hidden="true"><svg fill="#fff" height="30px" width="30px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <g> <path d="M357.949,96.453C327.531,76.978,292.279,66.684,256,66.684C151.61,66.684,66.683,151.61,66.683,256 S151.61,445.317,256,445.317s189.317-84.927,189.317-189.318c0-42.675-13.862-82.963-40.087-116.507 c-3.514-4.494-10.001-5.288-14.495-1.776c-4.494,3.512-5.288,10.003-1.776,14.495c23.358,29.878,35.704,65.768,35.704,103.788 c0,93.002-75.662,168.664-168.664,168.664S87.335,349.001,87.335,255.999S162.997,87.335,255.999,87.335 c32.324,0,63.727,9.167,90.814,26.51c4.801,3.074,11.188,1.677,14.264-3.128C364.153,105.914,362.751,99.527,357.949,96.453z"></path> <path d="M500.39,256c0-11.871,2.871-25.02,5.648-37.735c4.878-22.338,9.923-45.436,1.247-66.357 c-9.044-21.813-29.357-34.695-49.002-47.153c-11.117-7.051-21.618-13.709-29.474-21.566 c-7.855-7.855-14.515-18.356-21.564-29.473c-12.458-19.643-25.339-39.956-47.151-49.001c-20.923-8.678-44.021-3.632-66.359,1.246 C281.02,8.739,267.871,11.61,256,11.61c-11.871,0-25.02-2.871-37.735-5.648c-22.338-4.88-45.437-9.922-66.357-1.247 c-21.813,9.045-34.695,29.357-47.153,49.002c-7.051,11.117-13.709,21.618-21.566,29.474 c-7.855,7.855-18.356,14.515-29.473,21.564c-19.643,12.458-39.956,25.339-49.001,47.151c-8.677,20.921-3.632,44.019,1.246,66.359 c2.776,12.715,5.648,25.863,5.648,37.734s-2.871,25.02-5.648,37.735c-4.878,22.338-9.922,45.437-1.246,66.359 c9.044,21.812,29.357,34.694,49.002,47.151l3.972,2.524c4.807,3.066,11.192,1.656,14.26-3.152 c3.068-4.808,1.656-11.192-3.152-14.26l-4.02-2.554c-17.712-11.232-34.442-21.842-40.985-37.621 c-6.194-14.936-2.046-33.931,2.346-54.041c3.01-13.786,6.123-28.041,6.123-42.141s-3.113-28.355-6.124-42.141 c-4.392-20.11-8.541-39.105-2.346-54.041c6.543-15.779,23.273-26.389,40.985-37.621c11.577-7.34,23.544-14.929,33.015-24.399 s17.062-21.44,24.403-33.017c11.232-17.712,21.842-34.442,37.621-40.985c14.937-6.194,33.931-2.045,54.041,2.346 c13.786,3.01,28.041,6.123,42.141,6.123c14.1,0,28.355-3.113,42.141-6.124c20.11-4.392,39.107-8.542,54.041-2.346 c15.779,6.543,26.389,23.273,37.621,40.985c7.34,11.575,14.932,23.544,24.402,33.015c9.47,9.471,21.44,17.062,33.017,24.403 c17.712,11.232,34.442,21.842,40.985,37.621c6.194,14.936,2.046,33.931-2.346,54.041c-3.01,13.786-6.123,28.041-6.123,42.141 s3.113,28.355,6.124,42.141c4.392,20.11,8.541,39.105,2.346,54.041c-6.543,15.779-23.273,26.389-40.985,37.621 c-11.575,7.34-23.544,14.932-33.015,24.402c-9.471,9.47-17.062,21.44-24.403,33.017c-11.232,17.712-21.842,34.442-37.621,40.985 c-14.937,6.194-33.931,2.045-54.041-2.346c-13.786-3.01-28.041-6.123-42.141-6.123s-28.355,3.113-42.141,6.124 c-20.112,4.392-39.105,8.541-54.041,2.346c-15.78-6.543-26.389-23.273-37.621-40.985c-2.941-4.637-5.982-9.433-9.123-14.029 c-3.219-4.709-9.645-5.918-14.352-2.7c-4.709,3.219-5.918,9.645-2.7,14.352c2.941,4.304,5.754,8.74,8.733,13.437 c12.458,19.645,25.339,39.957,47.151,49.002c8.269,3.428,16.876,4.714,25.644,4.714c13.416,0,27.206-3.011,40.715-5.962 c12.715-2.777,25.864-5.648,37.735-5.648s25.02,2.871,37.735,5.648c22.337,4.878,45.437,9.92,66.357,1.247 c21.813-9.044,34.695-29.357,47.153-49.002c7.051-11.117,13.709-21.618,21.566-29.474c7.855-7.855,18.356-14.515,29.473-21.564 c19.643-12.458,39.956-25.339,49.001-47.151c8.677-20.921,3.632-44.019-1.246-66.359C503.261,281.02,500.39,267.871,500.39,256z"></path> <path d="M368.093,222.475c-1.196-3.679-4.349-6.383-8.169-7.001l-64.752-10.492l-29.988-58.341 c-1.768-3.441-5.315-5.605-9.184-5.605c-3.869,0-7.414,2.163-9.184,5.605l-29.988,58.341l-64.752,10.492 c-3.819,0.618-6.972,3.321-8.169,7.001c-1.195,3.68-0.233,7.721,2.493,10.467l46.218,46.548l-10.032,64.825 c-0.593,3.823,1.004,7.658,4.135,9.933c3.13,2.273,7.268,2.606,10.726,0.863l58.552-29.573l58.552,29.573 c1.471,0.742,3.065,1.108,4.654,1.108c2.142,0,4.272-0.666,6.072-1.972c3.131-2.273,4.727-6.108,4.135-9.933l-10.032-64.825 l46.218-46.548C368.327,230.197,369.29,226.156,368.093,222.475z M301.049,268.638c-2.31,2.327-3.377,5.613-2.876,8.854 l7.757,50.126l-45.275-22.867c-1.464-0.738-3.059-1.108-4.655-1.108s-3.192,0.369-4.658,1.108l-45.275,22.867l7.757-50.126 c0.503-3.241-0.566-6.528-2.876-8.854l-35.739-35.994l50.069-8.112c3.237-0.525,6.033-2.555,7.533-5.473l23.188-45.111 l23.188,45.111c1.499,2.918,4.296,4.948,7.533,5.473l50.069,8.112L301.049,268.638z"></path> </g> </g> </g> </g></svg></span>
                    <div>
                        <strong class="homeStatValue" data-count="2007">0</strong>
                        <span><?= $isAr ? 'نخدم الشارقة منذ' : 'Serving Sharjah Since' ?></span>
                    </div>
                </div>
                <div class="homeStat"><span class="homeStatIcon" aria-hidden="true">
                    <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M15 12L12 12M12 12L9 12M12 12L12 9M12 12L12 15" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"></path> <path d="M3 10.4167C3 7.21907 3 5.62028 3.37752 5.08241C3.75503 4.54454 5.25832 4.02996 8.26491 3.00079L8.83772 2.80472C10.405 2.26824 11.1886 2 12 2C12.8114 2 13.595 2.26824 15.1623 2.80472L15.7351 3.00079C18.7417 4.02996 20.245 4.54454 20.6225 5.08241C21 5.62028 21 7.21907 21 10.4167C21 10.8996 21 11.4234 21 11.9914C21 14.4963 20.1632 16.4284 19 17.9041M3.19284 14C4.05026 18.2984 7.57641 20.5129 9.89856 21.5273C10.62 21.8424 10.9807 22 12 22C13.0193 22 13.38 21.8424 14.1014 21.5273C14.6796 21.2747 15.3324 20.9478 16 20.5328" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>
                </span><div><strong class="homeStatValue" data-count="19" data-suffix="+">0</strong><span><?= $isAr ? 'سنوات من الخبرة' : 'Years of Experience' ?></span></div></div>
                <div class="homeStat"><span class="homeStatIcon" aria-hidden="true">
                    <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M12 1.25C12.4142 1.25 12.75 1.58579 12.75 2V2.25143C12.8612 2.25311 12.9561 2.25675 13.0446 2.26458C14.8548 2.42465 16.2896 3.85953 16.4497 5.66968C16.4643 5.83512 16.4643 6.02256 16.4643 6.29785L16.4643 7.521C16.4643 11.3903 13.5202 14.5719 9.75001 14.9481V17.0001C9.75001 19.3473 11.6528 21.2501 14 21.2501H14.8824C16.2803 21.2501 17.4809 20.3981 17.9902 19.1822C18.03 19.0872 18.0578 18.9789 18.075 18.8547C16.8708 18.4647 16 17.3341 16 16C16 14.3431 17.3432 13 19 13C20.6569 13 22 14.3431 22 16C22 17.4603 20.9567 18.6768 19.5748 18.945C19.5472 19.2085 19.4887 19.4872 19.3738 19.7617C18.6391 21.5156 16.9058 22.7501 14.8824 22.7501H14C10.8244 22.7501 8.25001 20.1757 8.25001 17.0001V14.9495C4.3217 14.5722 1.25001 11.2625 1.25001 7.23529L1.25 6.29791C1.24997 6.02259 1.24995 5.83514 1.26458 5.66968C1.42465 3.85953 2.85954 2.42465 4.66969 2.26458C4.82536 2.25081 5.00051 2.25002 5.25001 2.24999V2C5.25001 1.58579 5.58579 1.25 6.00001 1.25C6.41422 1.25 6.75001 1.58579 6.75001 2V4C6.75001 4.41421 6.41422 4.75 6.00001 4.75C5.58579 4.75 5.25001 4.41421 5.25001 4V3.75002C4.9866 3.7502 4.88393 3.75148 4.80181 3.75875C3.71573 3.85479 2.85479 4.71572 2.75875 5.80181C2.75074 5.8924 2.75001 6.00802 2.75001 6.3369V7.23529C2.75001 10.6871 5.54823 13.4853 9.00001 13.4853C12.294 13.4853 14.9643 10.815 14.9643 7.521V6.3369C14.9643 6.00802 14.9636 5.8924 14.9555 5.80181C14.8595 4.71572 13.9986 3.85479 12.9125 3.75875C12.8702 3.755 12.8224 3.75285 12.75 3.75162V4C12.75 4.41421 12.4142 4.75 12 4.75C11.5858 4.75 11.25 4.41421 11.25 4V2C11.25 1.58579 11.5858 1.25 12 1.25Z" fill="#ffffff"></path> </g></svg>
                </span><div><strong class="homeStatValue" data-count="<?= count($doctors) ?>">0</strong><span><?= $isAr ? 'أطباء متخصصون' : 'Specialist Doctors' ?></span></div></div>
                <div class="homeStat"><span class="homeStatIcon" aria-hidden="true">
                                                    <svg fill="#ffffff" width="30px" height="30px" viewBox="-32 0 512 512" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M277.37 11.98C261.08 4.47 243.11 0 224 0c-53.69 0-99.5 33.13-118.51 80h81.19l90.69-68.02zM342.51 80c-7.9-19.47-20.67-36.2-36.49-49.52L239.99 80h102.52zM224 256c70.69 0 128-57.31 128-128 0-5.48-.95-10.7-1.61-16H97.61c-.67 5.3-1.61 10.52-1.61 16 0 70.69 57.31 128 128 128zM80 299.7V512h128.26l-98.45-221.52A132.835 132.835 0 0 0 80 299.7zM0 464c0 26.51 21.49 48 48 48V320.24C18.88 344.89 0 381.26 0 422.4V464zm256-48h-55.38l42.67 96H256c26.47 0 48-21.53 48-48s-21.53-48-48-48zm57.6-128h-16.71c-22.24 10.18-46.88 16-72.89 16s-50.65-5.82-72.89-16h-7.37l42.67 96H256c44.11 0 80 35.89 80 80 0 18.08-6.26 34.59-16.41 48H400c26.51 0 48-21.49 48-48v-41.6c0-74.23-60.17-134.4-134.4-134.4z"></path></g></svg>
                </span><div><strong class="homeStatValue homeStatValuePending">—</strong><span><?= $isAr ? 'مريضاً في جميع الأقسام' : 'Patients Treated, All Departments Combined' ?></span></div></div>
            </div>
        </div>
    </section>
    <?php
    $this->registerJs('(()=>{const section=document.getElementById("home-stats");if(!section)return;const values=section.querySelectorAll(".homeStatValue[data-count]");let started=false;const animate=()=>{if(started)return;started=true;values.forEach(el=>{const target=Number(el.dataset.count)||0,start=performance.now(),duration=1800;const tick=now=>{const p=Math.min((now-start)/duration,1);el.textContent=Math.floor(target*p).toLocaleString()+(el.dataset.suffix||"");if(p<1)requestAnimationFrame(tick)};requestAnimationFrame(tick)});};if("IntersectionObserver" in window){const observer=new IntersectionObserver(entries=>{if(entries.some(entry=>entry.isIntersecting)){animate();observer.disconnect()}},{threshold:.25});observer.observe(section)}else{animate()}})();', View::POS_READY);
    ?>
    
    <section id="doctors" class="doctorsSection">
        <img src="<?= $homeUrl ?>images/doctorsBg.webp" class="bannerBg lazy" data-src="<?= $homeUrl ?>images/doctorsBg.webp"
             loading="lazy" decoding="async" width="1920" height="685" alt="">
        <div class="container">
            <header class="doctorsSectionHeading">
                <div class="doctorsEyebrow"><?= $isAr ? 'الأطباء والطاقم' : 'DOCTORS &amp; STAFF' ?></div>
                <h2><?= $isAr ? 'فريق من الأطباء والموظفين الخبراء' : 'Expert Doctor and Staff Team' ?></h2>
            </header>
            <div class="doctorSlider doctorGrid">
                <?php foreach (array_slice($doctors, 0, 3) as $our_doctor):
                    $docImg  = $homeUrl . 'uploads/doctors/' . $our_doctor->image;
                    $docName = $isAr ? $our_doctor->doctor_name_arabic : $our_doctor->doctor_name; ?>
                    <div class="doctorSlide">
                        <a class="doctorCard" href="<?= Url::to(['site/doctor-details', 'language' => $language, 'slug' => $our_doctor->canonical_name]) ?>">
                            <div class="imgBox"><img src="<?= $docImg ?>" data-src="<?= $docImg ?>" class="lazy" loading="lazy" decoding="async" alt="<?= Html::encode($docName) ?>"></div>
                            <div class="info">
                                <div class="name"><?= Html::encode($docName) ?></div>
                                <div class="post"><?= Html::encode($isAr ? $our_doctor->designation_arabic : $our_doctor->designation) ?></div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="doctorsSeeAll"><a href="<?= Url::to(['site/our-doctors', 'language' => $language]) ?>" class="cmnBtn hoveranim"><span><?= $isAr ? 'عرض جميع الأطباء' : 'See All Doctors' ?> →</span></a></div>
        </div>
    </section>

    <?php
    $faqIntro = $isAr
           ? ['eyebrow' => 'الأسئلة الشائعة', 'title' => 'تحتاج إلى إجابات؟ نحن هنا للمساعدة', 'text' => 'إجابات واضحة على الأسئلة الشائعة حول المواعيد وساعات عمل العيادة والتأمين.']
        : ['eyebrow' => 'FAQ', 'title' => 'Need Answers? We’re Here to Help', 'text' => 'Find clear answers to common questions about appointments, clinic hours and insurance.'];
    $homeFaqs = $isAr ? [
        ['question' => 'هل أحتاج إلى حجز موعد قبل الزيارة؟', 'answer' => 'يُنصح بحجز موعد لضمان توفر الأخصائي الذي تفضله. ونرحب بزيارات الحضور المباشر حسب التوفر.'],
        ['question' => 'ما ساعات عمل العيادة؟', 'answer' => 'من السبت إلى الخميس من الساعة 9:00 صباحاً حتى 10:00 مساءً، ويوم الجمعة من الساعة 12:00 ظهراً حتى 10:00 مساءً.'],
        ['question' => 'هل تقبلون التأمين؟', 'answer' => 'نتعامل مع مجموعة من شبكات التأمين. يرجى الاتصال بنا وتزويدنا بتفاصيل خطتك للتأكد من التغطية.'],
    ] : [
        ['question' => 'Do I need an appointment before visiting?', 'answer' => 'An appointment is recommended so your preferred specialist is available. Walk-ins are welcome subject to availability.'],
        ['question' => 'What are the operating hours of the clinic?', 'answer' => 'Saturday to Thursday, 9:00 AM to 10:00 PM; Friday, 12:00 PM to 10:00 PM.'],
        ['question' => 'Do you accept insurance?', 'answer' => 'We work with a range of networks. Call us with your plan details and we will confirm what is covered.'],
    ];?>
    <?php if (!empty($homeFaqs)): ?>
    <section id="homeFaq" class="homeFaq" dir="<?= $isAr ? 'rtl' : 'ltr' ?>">
        <div class="container">
            <div class="homeFaqIntro">
                <div class="homeFaqEyebrow"><?= Html::encode($faqIntro['eyebrow']) ?></div>
                <h2><?= Html::encode($faqIntro['title']) ?></h2>
                <p><?= Html::encode($faqIntro['text']) ?></p>
            </div>
            <div class="homeFaqList accordion" id="homeFaqAccordion">
                <?php foreach ($homeFaqs as $faqIndex => $faq):
                        $faqQuestion = $faq['question'];
                    $faqAnswer = $faq['answer'];
                    $faqHeadingId = 'homeFaqHeading' . $faqIndex;
                    $faqCollapseId = 'homeFaqCollapse' . $faqIndex; ?>
                    <div class="accordion-item">
                        <h3 class="accordion-header" id="<?= $faqHeadingId ?>">
                            <button class="accordion-button <?= $faqIndex === 0 ? '' : 'collapsed' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?= $faqCollapseId ?>" aria-expanded="<?= $faqIndex === 0 ? 'true' : 'false' ?>" aria-controls="<?= $faqCollapseId ?>">
                                <span class="homeFaqQuestionNumber"><?= $faqIndex + 1 ?>.</span>
                                <?= Html::encode($faqQuestion) ?>
                            </button>
                        </h3>
                        <div id="<?= $faqCollapseId ?>" class="accordion-collapse collapse <?= $faqIndex === 0 ? 'show' : '' ?>" aria-labelledby="<?= $faqHeadingId ?>" data-bs-parent="#homeFaqAccordion">
                            <div class="accordion-body"><?= Html::encode($faqAnswer) ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="homeFaqCta"><a href="<?= Url::to(['site/faq', 'language' => $language]) ?>" class="cmnBtn hoveranim"><span><?= $isAr ? 'عرض جميع الأسئلة الشائعة' : 'See All FAQs' ?> →</span></a></div>
            </div>

        </div>
    </section>
    <?php endif; ?>

     <?php $homeContactCta = $isAr ? [
        'leftTitle' => 'هل يمكنني مساعدتك في شيء؟',
        'leftText' => 'أخبرنا بهدفك وسيرشدك فريقنا إلى الأخصائي المناسب. دون ضغط، فقط نصيحة صادقة.',
        'phoneLabel' => 'لحجز موعد', 'emailLabel' => 'راسلنا عبر البريد الإلكتروني',
        'rightEyebrow' => 'ابدأ الآن', 'rightTitle' => 'التردد يقف عائقاً أمام تحقيق كامل إمكاناتك الجمالية',
        'button' => 'احجز موعدك الآن',
    ] : [
        'leftTitle' => 'Is There Anything I Can Do For You?',
        'leftText' => 'Tell us your goal and our team will point you to the right specialist. No pressure, just honest guidance.',
        'phoneLabel' => 'To Book An Appointment', 'emailLabel' => 'Send Us Email',
        'rightEyebrow' => 'GET STARTED', 'rightTitle' => 'Hesitation Is the Enemy of Your Full Beauty Potential',
        'button' => 'Book Your Appointment',
    ]; ?>
    <section id="homeContactCta" class="homeContactCta" dir="<?= $isAr ? 'rtl' : 'ltr' ?>">
        <div class="container">
            <div class="homeContactCard">
                <h2><?= Html::encode($homeContactCta['leftTitle']) ?></h2>
                <p><?= Html::encode($homeContactCta['leftText']) ?></p>
                <div class="homeContactMethod">
                    <span class="homeContactIcon" aria-hidden="true">☎</span>
                    <div><span><?= Html::encode($homeContactCta['phoneLabel']) ?></span><a href="tel:+97165067444">+971 6 506 7444</a></div>
                </div>
                <div class="homeContactMethod">
                    <span class="homeContactIcon" aria-hidden="true">✉</span>
                    <div><span><?= Html::encode($homeContactCta['emailLabel']) ?></span><a href="mailto:info@damasmc.com">info@damasmc.com</a></div>
                </div>
            </div>
            <div class="homeGetStarted">
                <div class="homeGetStartedEyebrow"><?= Html::encode($homeContactCta['rightEyebrow']) ?></div>
                <h2><?= Html::encode($homeContactCta['rightTitle']) ?></h2>
                <a href="#appointment" class="cmnBtn"><span><?= Html::encode($homeContactCta['button']) ?> →</span></a>
            </div>
        </div>
    </section>
    
    <?php
    $homeBlogs = \common\models\Blogs::find()->where(['status' => 1])->orderBy(['date' => SORT_DESC, 'id' => SORT_DESC])->limit(4)->all();
    $blogSectionCopy = $isAr
        ? ['eyebrow' => 'المدونة والأخبار', 'title' => 'نصائح عن الابتسامة والبشرة من فريقنا', 'link' => 'اقرأ المزيد']
        : ['eyebrow' => 'BLOG & NEWS', 'title' => 'Smile and Skin Insights From Our Team', 'link' => 'Learn More'];
    ?>
    <?php if (!empty($homeBlogs)): ?>
    <section id="homeBlog" class="homeBlog" dir="<?= $isAr ? 'rtl' : 'ltr' ?>">
        <div class="container">
            <header class="homeBlogHeading">
                <div class="homeBlogEyebrow"><?= Html::encode($blogSectionCopy['eyebrow']) ?></div>
                <h2><?= Html::encode($blogSectionCopy['title']) ?></h2>
            </header>
            <div class="homeBlogGrid">
                <?php foreach ($homeBlogs as $blog):
                    $blogTitle = $isAr ? $blog->title_arabic : $blog->title;
                    $blogDescription = $isAr ? $blog->description_arabic : $blog->description;
                    $blogImage = $homeUrl . 'uploads/blogs/' . $blog->main_image; ?>
                    <article class="homeBlogCard">
                        <a class="homeBlogImage" href="<?= Url::to(['site/blog-details', 'language' => $language, 'slug' => $blog->canonical_name]) ?>" aria-label="<?= Html::encode($blogTitle) ?>">
                            <img src="<?= Html::encode($blogImage) ?>" data-src="<?= Html::encode($blogImage) ?>" class="lazy" loading="lazy" decoding="async" width="150" height="145" alt="<?= Html::encode($blogTitle) ?>">
                        </a>
                        <div class="homeBlogContent">
                            <h3><a href="<?= Url::to(['site/blog-details', 'language' => $language, 'slug' => $blog->canonical_name]) ?>"><?= Html::encode($blogTitle) ?></a></h3>
                            <p><?= Html::encode(mb_strimwidth(strip_tags($blogDescription), 0, 96, '…')) ?></p>
                            <a class="homeBlogLearnMore" href="<?= Url::to(['site/blog-details', 'language' => $language, 'slug' => $blog->canonical_name]) ?>"><?= Html::encode($blogSectionCopy['link']) ?> <span aria-hidden="true">→</span></a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

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

<script defer src="<?= $homeUrl ?>lib/home.min.js?v=1"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var rtlVal = document.documentElement.getAttribute('dir') === 'rtl';

    /* ---- Reveal animations (animate.css v4 uses the animate__ prefix, so WOW must be told) ---- */
    if (window.WOW) { new WOW({ animateClass: 'animate__animated' }).init(); }

    /* ---- Hero auto-rotation: only after the page has loaded and settled ----
       Starts on the first scroll/touch/key/mouse move, or 8 s after window load, whichever comes first.
       Until then slide 1 (preloaded, high priority) is the only hero image on screen, so it stays the LCP element. */
    (function () {
        var hero = document.getElementById('MainBanner');
        if (!hero || !window.bootstrap || !bootstrap.Carousel) return;
        var started = false, events = ['scroll', 'touchstart', 'keydown', 'mousemove', 'click'];
        function start() {
            if (started) return; started = true;
            /* Fetch the other slides now (they are lazy and hidden), so each is ready before it slides in */
            hero.querySelectorAll('img[loading="lazy"]').forEach(function (img) { img.loading = 'eager'; });
            events.forEach(function (ev) { window.removeEventListener(ev, start); });
            bootstrap.Carousel.getOrCreateInstance(hero, { interval: 5000, ride: 'carousel' }).cycle();
        }
        events.forEach(function (ev) { window.addEventListener(ev, start, { passive: true, once: true }); });
        if (document.readyState === 'complete') { setTimeout(start, 8000); }
        else { window.addEventListener('load', function () { setTimeout(start, 8000); }); }
    })();

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
        var $service = $('.serviceGrid');
        var serviceMobileQuery = window.matchMedia('(max-width: 767px)');
        wireNav('#service', $service);

        function syncServiceCarousel() {
            if (serviceMobileQuery.matches) {
                if (!$service.hasClass('owl-loaded')) {
                    $service.addClass('owl-carousel');
                    $service.owlCarousel($.extend({}, owlBase, {
                        rewind: false,
                        loop: false,
                        responsive: { 0: { items: 1, margin: 15 }, 520: { items: 2, margin: 15 } }
                    }));
                }
            } else if ($service.hasClass('owl-loaded')) {
                $service.trigger('destroy.owl.carousel');
                $service.removeClass('owl-carousel');
            }
        }

        near($service[0], function () {
            syncServiceCarousel();
            var resizeTimer;
            var onServiceResize = function () {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(syncServiceCarousel, 150);
            };
            if (serviceMobileQuery.addEventListener) {
                serviceMobileQuery.addEventListener('change', onServiceResize);
            } else {
                serviceMobileQuery.addListener(onServiceResize);
            }
        }, '600px');

        var $doctor = $('.doctorSlider');
        // wireNav('#doctors', $doctor);
        // near($doctor[0], function () { $doctor.owlCarousel($.extend({}, owlBase, { autoplay: true, lazyLoad: true })); }, '600px');

          if ($doctor.length) {
            var doctorCarousel = window.matchMedia('(max-width: 767.98px)');
            var setDoctorLayout = function () {
                if (doctorCarousel.matches && !$doctor.hasClass('owl-loaded')) {
                    $doctor.addClass('owl-carousel').removeClass('doctorGrid');
                    $doctor.owlCarousel({ rewind: true, autoplay: false, smartSpeed: 500, nav: false, dots: true, items: 1, margin: 14, rtl: rtlVal, lazyLoad: true });
                } else if (!doctorCarousel.matches && $doctor.hasClass('owl-loaded')) {
                    $doctor.trigger('destroy.owl.carousel').removeClass('owl-carousel owl-loaded');
                    $doctor.find('.owl-stage-outer').children().unwrap();
                    $doctor.find('.owl-stage').children().unwrap();
                    $doctor.find('.owl-item').children().unwrap();
                    $doctor.addClass('doctorGrid');
                }
            };
            near($doctor[0], function () { setDoctorLayout(); doctorCarousel.addEventListener('change', setDoctorLayout); }, '600px');
        }

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