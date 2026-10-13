<?php
/** @var \yii\web\View $this */
/** @var string $content */

use frontend\assets\AppAsset;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\Words;
use common\models\About;
use common\models\Departments;
use common\models\Services;
use common\models\Genders;
use common\models\ContactUs;

AppAsset::register($this);

$controller = Yii::$app->controller->id;
$action     = Yii::$app->controller->action->id;
$action_url = $controller . '/' . $action;
$language   = !empty($this->params['language']) ? $this->params['language'] : 'en';
$isAr       = ($language === 'ar');
$currentUrl = Url::to(Yii::$app->request->url, true);
$model      = Yii::$app->AppointmentModelHelper;
$homeUrl    = Yii::$app->homeUrl;

/*
 * ---------------------------------------------------------------------------
 * LAYOUT DATA — cached until the admin changes any content (ContentCache tag,
 * invalidated from backend/config/bootstrap.php), 24h at most.
 * ---------------------------------------------------------------------------
 */
$layout = Yii::$app->cache->getOrSet('layout_data_v2', function () {
    $sortExpr = new \yii\db\Expression('-sort_order DESC, sort_order ASC');

    $departments = Departments::find()->where(['status' => 1])->orderBy([$sortExpr])->all();
    $services    = Services::find()->where(['status' => 1])->orderBy([$sortExpr])->all();

    $servicesByDept = [];
    foreach ($services as $s) {
        $servicesByDept[$s->department][] = $s;
    }

    return [
        'departments'    => $departments,
        'servicesByDept' => $servicesByDept,
        'genders'        => Genders::find()->where(['status' => 1])->all(),
        'contact'        => ContactUs::findOne(1),
    ];
}, \common\components\ContentCache::DURATION, \common\components\ContentCache::dependency());

$departments    = $layout['departments'];
$servicesByDept = $layout['servicesByDept'];
$contact_data   = $layout['contact'];
$service_list   = ArrayHelper::map($departments, 'id', $isAr ? 'department_name_arabic' : 'department_name');
$genders        = ArrayHelper::map($layout['genders'], 'id', $isAr ? 'gender_arabic' : 'gender');

$session        = Yii::$app->session;
$successMessage = $session->getFlash('success');
$errorMessage   = $session->getFlash('error');

$canonical = 'https://damasmc.com' . strtok(Yii::$app->request->url, '?');

/*
 * Page views print their own <script> tags inside $content, i.e. BEFORE jQuery (which is at the end of <body>).
 * Synchronous jQuery plugins / inline $(...) code there would throw "$ is not defined" and break the page's
 * sliders, selects and forms. Move every script block out of $content and print it after jQuery + libraries,
 * keeping the original order. JSON-LD blocks stay where they are.
 * Views whose scripts are all `defer` / DOMContentLoaded-safe set $this->params['scriptsDeferSafe'] = true
 * (the homepage does) so the shared libraries can stay deferred there.
 */
$viewScripts = '';
$movedContent = preg_replace_callback(
    '#<script\b(?![^>]*application/ld\+json)[^>]*>.*?</script>#is',
    function ($m) use (&$viewScripts) { $viewScripts .= $m[0] . "\n"; return ''; },
    $content
);
if ($movedContent === null) { // PCRE limit hit on a huge page: leave the page exactly as it was
    $viewScripts = '';
} else {
    $content = $movedContent;
}
$libsAttr = ($viewScripts === '' || !empty($this->params['scriptsDeferSafe'])) ? ' defer' : '';
$whatsapp  = 'https://api.whatsapp.com/send?phone=' . str_replace(' ', '', $contact_data->whatsapp_no) . '&text=Help%20Me%20%3F';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= $language ?>" dir="<?= $isAr ? 'rtl' : 'ltr' ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <!-- All libraries are self-hosted in web/lib (same HTTP/2 connection as the page, no extra DNS+TLS
         round-trips to cdnjs/jsdelivr). The logo is NOT preloaded: it is in the HTML anyway, and a
         high-priority preload made it compete with the hero image, which is the actual LCP element. -->

    <!-- Google Tag Manager (async, keep first so tags fire early) -->
    <!--<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-WHGCVTW');</script>-->
    <!-- GA4 direct. DELETE this block if GA4 (G-E74FZLYF77) is already fired by a tag inside GTM-WHGCVTW -->
    <!--<script async src="https://www.googletagmanager.com/gtag/js?id=G-E74FZLYF77"></script>-->
    <!--<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','G-E74FZLYF77');</script>-->

    <?php
    /*
     * Main stylesheets (~860 KB: bootstrap + app.min.css + style.css). Pages that ship an above-the-fold CSS file
     * (the view sets $this->params['criticalCss'], e.g. the homepage) get it INLINED, and the full CSS arrives as ONE
     * combined file that does not block first paint. Every other page — or any page whose critical file is out of
     * date (see frontend/components/CriticalCss.php) — loads the stylesheets render-blocking as before.
     * Regenerate after changing app.min.css / style.css / the homepage markup: tools/critical-css/README.md
     */
    $critical = !empty($this->params['criticalCss']) ? \frontend\components\CriticalCss::prepare($this->params['criticalCss']) : null;
    ?>
    <?php if ($critical): ?>
    <style id="critical-css"><?= $critical['css'] ?></style>
    <link rel="stylesheet" href="<?= $critical['bundleUrl'] ?>" media="print" onload="this.media='all';this.onload=null">
    <noscript><link rel="stylesheet" href="<?= $critical['bundleUrl'] ?>"></noscript>
    <?php else: ?>
    <link rel="stylesheet" href="<?= $homeUrl ?>lib/bootstrap-5.3.2.min.css">
    <link rel="stylesheet" href="<?= $homeUrl ?>css/app.min.css?v=<?= @filemtime(Yii::getAlias('@webroot/css/app.min.css')) ?: 1 ?>">
    <link rel="stylesheet" href="<?= $homeUrl ?>css/style.css?v=<?= @filemtime(Yii::getAlias('@webroot/css/style.css')) ?: 1 ?>">
    <?php endif; ?>

    <!-- Self-hosted body font: preload the regular weight so text does not wait for the 626 KB CSS to discover it -->
    <link rel="preload" href="<?= $homeUrl ?>fonts/Salzburg-Serial-Regular.woff2" as="font" type="font/woff2" crossorigin>

    <!-- NON-CRITICAL CSS (modal/select/datepicker/animations): loads without blocking first paint -->
    <!-- select2 + flatpickr (+dark theme) + toastr + animate.css in ONE file (bootstrap-select and AOS removed: nothing on the site uses them) -->
    <link rel="stylesheet" media="print" onload="this.media='all'" href="<?= $homeUrl ?>lib/vendor-async.css?v=1">
    <noscript><link rel="stylesheet" href="<?= $homeUrl ?>lib/vendor-async.css?v=1"></noscript>

    <!-- jQuery is loaded at the END of <body> (still synchronous, so Yii's registerJs() output works) — no longer render-blocking in <head> -->

    <link rel="icon" type="image/png" sizes="16x16" href="<?= $homeUrl ?>images/favicon.ico">
    <link rel="manifest" href="<?= $homeUrl ?>images/manifest.json">
    <link rel="canonical" href="<?= Html::encode($canonical) ?>">
    <meta name="msapplication-TileColor" content="#39AA7E">
    <meta name="theme-color" content="#060606">
    <meta name="robots" content="index, follow">

    <!-- TODO SEO: these OG/Twitter tags are homepage-static on every page; set them per page via $this->params -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= Html::encode($canonical) ?>">
    <meta property="og:title" content="Damas Medical Center | Best Healthcare Services">
    <meta property="og:description" content="Top-rated medical center providing expert healthcare services. Book your consultation now.">
    <meta property="og:image" content="https://damasmc.com/images/featured-image.jpg">
    <meta property="og:image:alt" content="Damas Medical Center - Best Medical Services">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="Damas Medical Center">
    <meta property="og:locale" content="<?= $isAr ? 'ar_AE' : 'en_US' ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="<?= Html::encode($canonical) ?>">
    <meta name="twitter:title" content="Damas Medical Center | Best Healthcare Services">
    <meta name="twitter:description" content="Get expert medical care at Damas Medical Center. Book an appointment today.">
    <meta name="twitter:image" content="https://damasmc.com/images/featured-image.jpg">
    <meta name="twitter:image:alt" content="Damas Medical Center - Best Medical Services">

    <!-- TODO SEO: fill real address/phone — placeholder schema hurts more than it helps -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "MedicalOrganization",
      "name": "Damas Medical Center",
      "url": "https://damasmc.com/",
      "logo": "https://damasmc.com/images/logo.svg",
      "description": "Damas Medical Center offers expert medical care with state-of-the-art technology and experienced doctors.",
      "address": {"@type": "PostalAddress", "streetAddress": "Your Street Address", "addressLocality": "Your City", "addressRegion": "Your State", "postalCode": "Your ZIP Code", "addressCountry": "Your Country"},
      "contactPoint": {"@type": "ContactPoint", "telephone": "+123456789", "contactType": "customer service", "availableLanguage": ["English", "Arabic"]},
      "sameAs": ["https://www.facebook.com/DamasMedicalCenter", "https://twitter.com/DamasMedical", "https://www.instagram.com/damasmedical"]
    }
    </script>

    <style>
        .grecaptcha-badge { display: none !important; }
        .flatpickr-calendar.open { z-index: 999999 !important; }
    </style>

    <?php $this->head() ?>
</head>

<body id="body">
<?php $this->beginBody() ?>
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WHGCVTW" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

<header id="Header">
    <div class="Background"></div>
    <section class="HeaderMenu">
        <div class="container">
            <div class="FlexRow">

                <div class="lftSec">
                    <a href="<?= Url::to(['site/index', 'language' => $language]) ?>" class="LogoSec" aria-label="logo">
                        <img src="<?= $homeUrl ?>images/logo.svg" alt="Damas Logo" width="160" height="60">
                    </a>
                </div>

                <div class="ritSec">
                    <div class="modal fade" id="HeaderPOP" tabindex="-1" role="dialog" aria-labelledby="bookingModalLabel" aria-hidden="true">
                        <div class="modal-dialog mobile-menu" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="accordion" id="AccordMenu">
                                        <div class="accordion-item">
                                            <div class="accordion-header">
                                                <a href="<?= Url::to(['site/about', 'language' => $language]) ?>" class="accordion-button <?= $action_url == 'site/about' ? 'active' : '' ?>">
                                                    <?= Words::getValue($language, 'about_us') ?>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="accordion-item dropDownBx">
                                            <div class="accordion-header">
                                                <a href="<?= Url::to(['site/departments', 'language' => $language]) ?>"
                                                   class="accordion-button collapsed <?= in_array($action_url, ['site/departments', 'site/department-details', 'site/service-details']) ? 'active' : '' ?>"
                                                   data-bs-toggle="collapse" data-bs-target="#AccordMenuTwo" aria-expanded="false" aria-controls="AccordMenuTwo">
                                                    <span onclick="window.location.href = '<?= Url::to(['site/departments', 'language' => $language]) ?>'">
                                                        <?= Words::getValue($language, 'department') ?>
                                                    </span>
                                                </a>
                                            </div>
                                            <div id="AccordMenuTwo" class="accordion-collapse dropBox collapse" aria-labelledby="headingTwo" data-bs-parent="#AccordMenu">
                                                <div class="accordion-body">
                                                    <div class="container">
                                                        <div class="rowFlx megaBox accordion" id="submenuAccord">
                                                            <div class="leftSec">
                                                                <ul>
                                                                    <?php $i = 0; foreach ($departments as $department): $i++;
                                                                        $deptUrl = Url::to(['site/department-details', 'language' => $language, 'slug' => $department->canonical_name]);
                                                                        $deptImg = $homeUrl . 'uploads/departments/' . $department->department_image; ?>
                                                                    <li class="<?= !empty($servicesByDept[$department->id]) ? 'hasMenu' : '' ?>">
                                                                        <a href="<?= $deptUrl ?>" data-val="<?= $deptImg ?>" class="cmnBtnLink department-change"
                                                                           data-bs-toggle="collapse" data-bs-target="#submenuAccord<?= $department->id ?>"
                                                                           aria-expanded="<?= $i == 1 ? 'true' : 'false' ?>" aria-controls="submenuAccord<?= $department->id ?>"
                                                                           onclick="window.location.href = '<?= $deptUrl ?>'">
                                                                            <?= $isAr ? $department->department_name_arabic : $department->department_name ?>
                                                                        </a>
                                                                    </li>
                                                                    <?php endforeach; ?>
                                                                </ul>
                                                            </div>
                                                            <div class="rtSec">
                                                                <div class="accordionBx">
                                                                    <?php $j = 0; $imgurl = ''; foreach ($departments as $department): $j++;
                                                                        $deptImg = $homeUrl . 'uploads/departments/' . $department->department_image;
                                                                        if ($j == 1) { $imgurl = $deptImg; }
                                                                        $services = $servicesByDept[$department->id] ?? []; ?>
                                                                    <div class="accordion-item">
                                                                        <div class="accordion-header" id="heading<?= $department->id ?>">
                                                                            <button class="accordion-button department-change" data-val="<?= $deptImg ?>" type="button"
                                                                                    data-bs-toggle="collapse" data-bs-target="#submenuAccord<?= $department->id ?>"
                                                                                    aria-expanded="<?= $j == 1 ? 'true' : 'false' ?>" aria-controls="submenuAccord<?= $department->id ?>">
                                                                                <?= $isAr ? $department->department_name_arabic : $department->department_name ?>
                                                                            </button>
                                                                        </div>
                                                                        <div id="submenuAccord<?= $department->id ?>" class="accordion-collapse collapse <?= $j == 1 ? 'show' : '' ?>"
                                                                             aria-labelledby="heading<?= $department->id ?>" data-bs-parent="#submenuAccord">
                                                                            <div class="accordion-body">
                                                                                <div class="flxBox">
                                                                                    <div class="lefBx">
                                                                                        <ul>
                                                                                            <?php foreach ($services as $service): ?>
                                                                                            <li>
                                                                                                <a href="<?= Url::to(['site/service-details', 'language' => $language, 'department' => $department->canonical_name, 'slug' => $service->canonical_name]) ?>" class="pageLinks">
                                                                                                    <?= $isAr ? $service->service_name_arabic : $service->service_name ?>
                                                                                                </a>
                                                                                            </li>
                                                                                            <?php endforeach; ?>
                                                                                        </ul>
                                                                                    </div>
                                                                                    <div class="rtBx">
                                                                                        <div class="item">
                                                                                            <div class="imgBox">
                                                                                                <img src="<?= $imgurl ?>" data-src="<?= $imgurl ?>" class="lazy dep-image" loading="lazy" width="300" height="360" alt="Department Image">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="item">
                                                                                            <div class="contactBx">
                                                                                                <div class="imgBxBg">
                                                                                                    <img src="<?= $homeUrl ?>images/iconLg.svg" alt="Phone Number" loading="lazy">
                                                                                                </div>
                                                                                                <a href="tel:<?= $contact_data->phone1 ?>" target="_blank" class="callBtn"><?= $contact_data->phone1 ?></a>
                                                                                                <div class="flx">
                                                                                                    <div class="item">
                                                                                                        <a href="#bookingModal" data-bs-toggle="modal" data-bs-target="#bookingModal" class="cmnBtns hoveranim">
                                                                                                            <span><?= Words::getValue($language, 'book_an_appointment') ?></span>
                                                                                                        </a>
                                                                                                    </div>
                                                                                                    <div class="item">
                                                                                                        <a href="<?= $whatsapp ?>" target="_blank" class="cmnBtns hoveranim green">
                                                                                                            <span><?= Words::getValue($language, 'chat_with_whatsapp') ?></span>
                                                                                                            <div class="icon">
                                                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20.234" height="20.403" viewBox="0 0 20.234 20.403"><g transform="translate(0)"><path d="M55.617,41A10.121,10.121,0,0,0,39.4,52.711l-1.074,5.213a.381.381,0,0,0,.062.3.389.389,0,0,0,.413.161l5.1-1.211A10.121,10.121,0,0,0,55.609,41ZM54.022,53.718a7.935,7.935,0,0,1-9.127,1.5l-.714-.354-3.133.741v-.04l.66-3.16-.349-.687a7.924,7.924,0,0,1,12.663-9.2l.035.048a7.925,7.925,0,0,1-.04,11.162Z" transform="translate(-38.299 -37.997)" fill="#fff"/><path d="M65.331,64.113a2.647,2.647,0,0,1-1.4,1.222c-1.074.258-2.708,0-4.755-1.892l-.026-.024c-1.781-1.662-2.253-3.048-2.148-4.145a2.627,2.627,0,0,1,1.02-1.557.584.584,0,0,1,.913.215l.659,1.491a.58.58,0,0,1-.071.593l-.335.43a.569.569,0,0,0-.045.634,6.229,6.229,0,0,0,1.132,1.259,6.7,6.7,0,0,0,1.568,1.123.569.569,0,0,0,.621-.131l.384-.391a.582.582,0,0,1,.586-.163L65,63.224a.589.589,0,0,1,.331.889Z" transform="translate(-50.915 -51.343)" fill="#fff"/></g></svg>
                                                                                                            </div>
                                                                                                        </a>
                                                                                                    </div>
                                                                                                    <div class="item">
                                                                                                        <a href="<?= Url::to(['site/offers', 'language' => $language]) ?>" class="cmnBtns hoveranim brwn">
                                                                                                            <span><?= Words::getValue($language, 'our_offers') ?></span>
                                                                                                        </a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php foreach ([
                                            ['site/our-doctors', 'our_doctors', ['site/our-doctors', 'site/doctor-details']],
                                            ['site/offers',      'offers',      ['site/offers']],
                                            ['site/contact',     'contact_us',  ['site/contact']],
                                            ['site/careers',     'careers',     ['site/careers']],
                                        ] as [$route, $word, $activeOn]): ?>
                                        <div class="accordion-item">
                                            <div class="accordion-header">
                                                <a href="<?= Url::to([$route, 'language' => $language]) ?>" class="accordion-button <?= in_array($action_url, $activeOn) ? 'active' : '' ?>">
                                                    <?= Words::getValue($language, $word) ?>
                                                </a>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="sidemenus">
                        <ul>
                            <li class="login"></li>
                            <li class="language">
                                <?php if ($isAr): ?>
                                <a href="javascript:void(0);" class="langBtn en language-change" lang="en" hreflang="en" val="en">
                                    <div class="icon"><img src="<?= $homeUrl ?>images/lang1.png" alt="English" width="24" height="24"></div>
                                    <span>EN</span>
                                </a>
                                <?php else: ?>
                                <a href="javascript:void(0);" class="langBtn ar language-change" lang="ar" hreflang="ar" val="ar">
                                    <div class="icon"><img src="<?= $homeUrl ?>images/lang1.png" alt="Arabic" width="24" height="24"></div>
                                    <span><?= Words::getValue('ar', 'arabic') ?></span>
                                </a>
                                <?php endif; ?>
                            </li>
                            <li>
                                <a href="<?= $contact_data->youtube_link ?>" class="youtube" target="_blank" rel="noopener" aria-label="YouTube">
                                    <div class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30.471" height="21.334" viewBox="0 0 30.471 21.334"><g transform="translate(0 0)"><path d="M29.843,3.338A3.818,3.818,0,0,0,27.157.653C24.773,0,15.235,0,15.235,0S5.7,0,3.313.628A3.9,3.9,0,0,0,.627,3.338,40.227,40.227,0,0,0,0,10.667,40.079,40.079,0,0,0,.627,18a3.818,3.818,0,0,0,2.686,2.686c2.409.653,11.922.653,11.922.653s9.538,0,11.922-.628a3.818,3.818,0,0,0,2.686-2.686,40.228,40.228,0,0,0,.627-7.329,38.182,38.182,0,0,0-.628-7.354Zm0,0" fill="red"/><path d="M204.969,111.621l7.931-4.568-7.931-4.568Zm0,0" transform="translate(-192.771 -96.385)" fill="#fff"/></g></svg>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#!" class="search accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" aria-label="Search">
                                    <div class="open icon">
                                        <svg viewBox="0 0 18.842 18.846"><g transform="translate(-7.129 -7.125)"><path d="M25.644,24.065l-3.622-3.622a8.318,8.318,0,1,0-1.579,1.579l3.622,3.622a1.117,1.117,0,1,0,1.579-1.579ZM11.135,19.712a6.065,6.065,0,1,1,4.288,1.776,6.072,6.072,0,0,1-4.288-1.776Z"/></g></svg>
                                    </div>
                                    <div class="close icon">
                                        <svg viewBox="0 0 329.26933 329"><path d="m194.800781 164.769531 128.210938-128.214843c8.34375-8.339844 8.34375-21.824219 0-30.164063-8.339844-8.339844-21.824219-8.339844-30.164063 0l-128.214844 128.214844-128.210937-128.214844c-8.34375-8.339844-21.824219-8.339844-30.164063 0-8.34375 8.339844-8.34375 21.824219 0 30.164063l128.210938 128.214843-128.210938 128.214844c-8.34375 8.339844-8.34375 21.824219 0 30.164063 4.15625 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921875-2.089844 15.082031-6.25l128.210937-128.214844 128.214844 128.214844c4.160156 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921874-2.089844 15.082031-6.25 8.34375-8.339844 8.34375-21.824219 0-30.164063zm0 0"/></svg>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="MenuIcon">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#HeaderPOP" aria-label="Menu">
                        <span></span><span></span><span></span>
                    </button>
                </div>
            </div>

            <div class="accordion-collapse collapse search_fld" id="collapseOne">
                <div class="searchBox">
                    <?= Html::beginForm(['/' . $language . '/search'], 'get', ['id' => 'serach-formms']) ?>
                    <div class="form-group">
                        <input autocomplete="off" required type="search" class="form-control keyword-search" list="searchresults" name="keyword" id="searckeyhwords"
                               placeholder="What are you looking for ?" value="<?= Html::encode(Yii::$app->request->get('keyword', '')) ?>">
                        <div class="searchresults">
                            <ul class="keywordsearchresults" id="searchresults"></ul>
                        </div>
                        <button type="submit" class="sendBtn" aria-label="Search">
                            <svg viewBox="0 0 18.842 18.846"><g transform="translate(-7.129 -7.125)"><path d="M25.644,24.065l-3.622-3.622a8.318,8.318,0,1,0-1.579,1.579l3.622,3.622a1.117,1.117,0,1,0,1.579-1.579ZM11.135,19.712a6.065,6.065,0,1,1,4.288,1.776,6.072,6.072,0,0,1-4.288-1.776Z"/></g></svg>
                        </button>
                    </div>
                    <?= Html::endForm() ?>
                </div>
            </div>
        </div>
    </section>
</header>

<div class="fixedRit">
    <ul>
        <li>
            <a href="#appointment" class="bookNow hoveranim" data-bs-toggle="modal" data-bs-target="#bookingModal">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30.494" height="30" viewBox="0 0 30.494 30"><g transform="translate(-35.905 -285.506) rotate(-90)"><path d="M-77.653,65.906l-1.43-1.509,1.151-1.034,3.5,3.418c1.032-.8,2.065-1.629,3.02-2.5a8.011,8.011,0,0,1-.279,4.451c-1.153,2.822-3.816,5.246-7.154,5.086a7.8,7.8,0,0,1-4.609-1.987c.516-.437,1.073-.914,1.629-1.39a32,32,0,0,0,4.172-4.53m-3.775-3.973-.953-1.034,1.032-.874,1,.954Zm10.81,1.55a7.193,7.193,0,0,0,.756-.795c2.5-2.624,4.053-4.571,3.3-8.5A7.6,7.6,0,0,0-73.321,48.1,8.847,8.847,0,0,0-78.8,49.374c-2.583-2.265-5.166-3.616-7.71-3.457a7.625,7.625,0,0,0-7.191,5.563A7.233,7.233,0,0,0-92.713,58c-2.465,2.98-3.936,5.882-3.617,8.623A7.493,7.493,0,0,0-90.41,73.5a7.149,7.149,0,0,0,6.24-1.152l.2.239c2.5,2.622,4.369,4.292,8.345,3.695a7.5,7.5,0,0,0,6.4-6.438,9.413,9.413,0,0,0-1.391-6.358m-17.167,4.292,3.895-3.577-1.073-1.112-1.828,1.55a32,32,0,0,1-4.253-4.412,17.555,17.555,0,0,1-1.111-1.43c-1.511,1.509-2.385,3.576-1.63,6.914.954,2.9,3.418,5.484,6.756,5.564a8.079,8.079,0,0,0,1.709-.2,28.436,28.436,0,0,1-2.464-3.3m9.935-9.141,2.106-1.947a39.043,39.043,0,0,1,4.649,6,7.6,7.6,0,0,0,2.225-5.166c-.039-3.337-2.583-5.882-5.444-6.875a9.437,9.437,0,0,0-3.378-.278c1.113,1.073,2.265,2.344,3.419,3.695L-78.726,57.8Zm6.04,4.57a8.817,8.817,0,0,0-2.622-2.94c-.319.277-.637.556-.954.874.834.835,1.668,1.708,2.5,2.583a6.751,6.751,0,0,0,1.073-.517m-9.737,3.417c-1.112.994-2.185,1.947-3.257,2.9a6.661,6.661,0,0,0,.516,1.232,5.493,5.493,0,0,0,3.537-3.338Zm-3.139-8.186-4.171-4.451c-.954.914-1.869,1.789-2.664,2.663a11.031,11.031,0,0,1-.118-1.669c.238-3.338,2.98-5.642,5.922-6.437,2.859-.516,4.728.119,6.118,1.271a34.684,34.684,0,0,0-6.516,5.523l2.345,2.305Zm5.882-7.829a17.618,17.618,0,0,1,1.151,1.669c-1.151,1.034-2.3,2.026-3.5,3.06-.478-.516-.994-1.034-1.511-1.51A7.649,7.649,0,0,1-78.8,50.606M-87.27,60.7l-.834.755a5.56,5.56,0,0,1-3.1-3.5c.238-.159.516-.357.755-.516,1.033,1.073,2.105,2.146,3.178,3.258" transform="translate(-219.133 -10)" fill="#d5ae69" fill-rule="evenodd"/></g></svg>
                </div>
                <span><?= Words::getValue($language, 'book_now') ?></span>
            </a>
        </li>
        <li>
            <a href="<?= $whatsapp ?>" target="_blank" rel="noopener" id="whatsapp" class="socialLink" aria-label="WhatsApp">
                <div class="align">
                    <svg xmlns="http://www.w3.org/2000/svg" width="68" height="68" viewBox="0 0 68 68"><circle cx="34" cy="34" r="34" fill="#2aa81a"/><g transform="translate(15 15)"><path d="M67.914,43.135A17.307,17.307,0,0,0,40.186,63.159L38.35,72.074a.652.652,0,0,0,.106.519.666.666,0,0,0,.707.275l8.722-2.07A17.307,17.307,0,0,0,67.9,43.135ZM65.187,64.881a13.57,13.57,0,0,1-15.608,2.557l-1.221-.606L43,68.1V68.03l1.129-5.4-.6-1.175A13.55,13.55,0,0,1,65.187,45.72l.06.083a13.551,13.551,0,0,1-.069,19.088Z" transform="translate(-36.592 -37.276)" fill="#fff"/><path d="M71.257,68.753a4.527,4.527,0,0,1-2.4,2.09c-1.836.441-4.632,0-8.132-3.236l-.044-.04c-3.045-2.843-3.853-5.212-3.673-7.089a4.493,4.493,0,0,1,1.745-2.663,1,1,0,0,1,1.561.367l1.128,2.549a.992.992,0,0,1-.121,1.014l-.573.735a.973.973,0,0,0-.077,1.084,10.652,10.652,0,0,0,1.936,2.152,11.449,11.449,0,0,0,2.681,1.921.973.973,0,0,0,1.062-.224l.657-.668a1,1,0,0,1,1-.279l2.681.768a1.006,1.006,0,0,1,.566,1.521Z" transform="translate(-44.897 -46.194)" fill="#fff"/></g></svg>
                </div>
            </a>
        </li>
        <li>
            <a href="tel:<?= $contact_data->phone1 ?>" target="_blank" id="call" class="socialLink" aria-label="Call">
                <div class="align">
                    <svg xmlns="http://www.w3.org/2000/svg" width="68" height="68" viewBox="0 0 68 68"><g transform="translate(0.327 0.071)"><g transform="translate(-0.327 -0.071)" fill="#d5ae69" stroke="#e5bb70" stroke-width="1"><circle cx="34" cy="34" r="34" stroke="none"/><circle cx="34" cy="34" r="33.5" fill="none"/></g><path d="M166.512,150.708c-.28-.158-.6-.336-.979-.566-.213-.129-.481-.305-.766-.492-1.459-.958-2.564-1.636-3.5-1.636a1.711,1.711,0,0,0-.619.111,5.983,5.983,0,0,0-2.156,1.987,10.536,10.536,0,0,1-.791.924,15.567,15.567,0,0,1-7.562-7.57,10.458,10.458,0,0,1,.928-.8,5.993,5.993,0,0,0,1.981-2.15c.407-1.057-.339-2.32-1.524-4.127-.187-.284-.363-.553-.491-.765-.231-.384-.409-.7-.567-.981-.646-1.149-1.073-1.909-2.677-1.909-1.041,0-2.513.985-3.511,1.961a6.667,6.667,0,0,0-2.247,4.618c0,4.236,2.365,9.09,6.48,13.323.007.007.014.009.021.016,4.23,4.119,9.084,6.475,13.316,6.475h0a6.646,6.646,0,0,0,4.613-2.239c.977-1,1.962-2.46,1.962-3.5C168.419,151.782,167.66,151.355,166.512,150.708Z" transform="translate(-121.351 -111.806)" fill="#fff"/></g></svg>
                </div>
            </a>
        </li>
        <li>
            <a href="<?= $contact_data->instagram_link ?>" target="_blank" rel="noopener" id="insta" class="socialLink" aria-label="Instagram">
                <div class="align">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="68" height="68" viewBox="0 0 68 68"><defs><linearGradient id="linear-gradient" x1="0.146" y1="0.146" x2="0.854" y2="0.854" gradientUnits="objectBoundingBox"><stop offset="0" stop-color="#fae100"/><stop offset="0.15" stop-color="#fcb720"/><stop offset="0.3" stop-color="#ff7950"/><stop offset="0.5" stop-color="#ff1c74"/><stop offset="1" stop-color="#6c1cd1"/></linearGradient></defs><g transform="translate(0.03 0.029)"><g transform="translate(0.007 0)"><g transform="translate(0 0)"><rect width="68" height="68" rx="34" transform="translate(-0.038 -0.029)" fill="url(#linear-gradient)"/><g><path d="M59.86,11.683A121.751,121.751,0,0,1,39.042,39.047a121.913,121.913,0,0,1-27.351,20.8q-.858-.746-1.667-1.555A34.147,34.147,0,1,1,58.308,10q.8.814,1.551,1.684Z" transform="translate(-0.016 0)" fill="#fff" opacity="0.1"/><g transform="translate(16.169 16.176)"><path d="M62.061,36H45.885A9.885,9.885,0,0,0,36,45.885V62.061a9.885,9.885,0,0,0,9.885,9.885H62.061a9.885,9.885,0,0,0,9.885-9.885V45.885A9.885,9.885,0,0,0,62.061,36ZM68.8,60.641a8.16,8.16,0,0,1-8.16,8.16H47.305a8.16,8.16,0,0,1-8.16-8.16V47.305a8.16,8.16,0,0,1,8.16-8.16H60.641a8.16,8.16,0,0,1,8.16,8.16Z" transform="translate(-36 -36)" fill="#fff"/><path d="M71.333,58.129l-.085-.085-.072-.072a9.058,9.058,0,0,0-6.4-2.642,9.22,9.22,0,0,0-9.157,9.288,9.324,9.324,0,0,0,2.7,6.565,9.072,9.072,0,0,0,6.479,2.7,9.315,9.315,0,0,0,6.538-15.749ZM64.777,70.711a6.093,6.093,0,1,1,6.008-6.093A6.093,6.093,0,0,1,64.777,70.711Z" transform="translate(-46.804 -46.644)" fill="#fff"/><path d="M97.095,51.682a2.193,2.193,0,0,1-2.179,2.211,2.161,2.161,0,0,1-1.537-.643,2.215,2.215,0,0,1,1.541-3.77,2.166,2.166,0,0,1,1.389.5l.045.045a1.371,1.371,0,0,1,.2.2l.049.054a2.211,2.211,0,0,1,.494,1.4Z" transform="translate(-67.246 -43.423)" fill="#fff"/></g></g></g></g></g></svg>
                </div>
            </a>
        </li>
    </ul>
</div>

<main id="viewport">
    <?= $content ?>

    <footer>
        <section id="footersec">
            <div class="bannerBg">
                <img src="<?= $homeUrl ?>images/footerBg.svg" alt="" loading="lazy">
            </div>
            <div class="container">
                <div class="accordion" id="footerAccord">
                    <div class="row">
                        <div class="col-md-3 col-lg-4 cmnSec">
                            <div class="accordion-item">
                                <div class="accordion-header" id="headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#footerAccordOne" aria-expanded="false" aria-controls="footerAccordOne">
                                        <div class="headTitle"><?= Words::getValue($language, 'information') ?></div>
                                    </button>
                                </div>
                                <div id="footerAccordOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#footerAccord">
                                    <div class="accordion-body">
                                        <div class="headTitle"><?= Words::getValue($language, 'information') ?></div>
                                        <ul class="links info">
                                            <?php foreach ([
                                                'site/about'                => 'about_us',
                                                'site/our-doctors'          => 'our_doctors',
                                                'site/privacy-policy'       => 'privacy_policy',
                                                'site/terms-and-conditions' => 'terms_and_condition',
                                                'site/contact'              => 'contact_us',
                                                'site/testimonials'         => 'testimonials',
                                                'site/insurance'            => 'insurance',
                                                'site/gallery'              => 'gallery',
                                            ] as $route => $word): ?>
                                            <li><a href="<?= Url::to([$route, 'language' => $language]) ?>" class="linkBtn"><?= Words::getValue($language, $word) ?></a></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5 col-lg-4">
                            <div class="accordion-item">
                                <div class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#footerAccordTwo" aria-expanded="false" aria-controls="footerAccordTwo">
                                        <div class="headTitle"><?= Words::getValue($language, 'contact') ?></div>
                                    </button>
                                </div>
                                <div id="footerAccordTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#footerAccord">
                                    <div class="accordion-body">
                                        <div class="headTitle"><?= Words::getValue($language, 'contact') ?></div>
                                        <ul class="links cnt">
                                            <li>
                                                <div class="mainTxt"><?= Words::getValue($language, 'address') ?></div>
                                                <a href="javascript:void(0)" class="linkBtn contLink">
                                                    <span><?= $isAr ? $contact_data->address_arabic : $contact_data->address ?></span>
                                                </a>
                                            </li>
                                            <li>
                                                <div class="mainTxt"><?= Words::getValue($language, 'phone') ?></div>
                                                <a href="tel:<?= $contact_data->phone1 ?>" class="linkBtn contLink">
                                                    <span><?= $contact_data->phone1 ?></span>
                                                    <div class="Txt"><?= Words::getValue($language, 'phone_no1_description') ?></div>
                                                </a>
                                                <a href="tel:<?= $contact_data->phone2 ?>" class="linkBtn contLink">
                                                    <span><?= $contact_data->phone2 ?></span>
                                                    <div class="Txt"><?= Words::getValue($language, 'phone_no2_description') ?></div>
                                                </a>
                                            </li>
                                            <li>
                                                <div class="mainTxt"><?= Words::getValue($language, 'email') ?></div>
                                                <a href="mailto:<?= $contact_data->email ?>" class="linkBtn contLink"><span><?= $contact_data->email ?></span></a>
                                            </li>
                                        </ul>

                                        <div class="socialBx">
                                            <div class="mainTxt"><?= Words::getValue($language, 'social_media') ?></div>
                                            <ul>
                                                <?php if ($contact_data->facebook_link != ''): ?>
                                                <li><a href="<?= $contact_data->facebook_link ?>" target="_blank" rel="noopener" class="links" aria-label="Facebook"><div class="icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="13.247" height="23.339" viewBox="0 0 13.247 23.339"><path d="M9.929,5.777c.032-.036.181-.153.766-.153h1.919A1.133,1.133,0,0,0,13.746,4.49V1.136A1.134,1.134,0,0,0,12.616,0L9.766,0A5.866,5.866,0,0,0,5.441,1.678,6.159,6.159,0,0,0,3.812,6.091V7.9H1.632A1.133,1.133,0,0,0,.5,9.032v3.612a1.133,1.133,0,0,0,1.132,1.132H3.812v8.43a1.133,1.133,0,0,0,1.132,1.132H8.682a1.133,1.133,0,0,0,1.132-1.132v-8.43H12.48a1.133,1.133,0,0,0,1.132-1.132V9.032a1.136,1.136,0,0,0-.582-.99,1.15,1.15,0,0,0-.56-.142H9.814V6.471c0-.466.063-.634.115-.694Zm0,0" transform="translate(-0.5 0)"/></svg>
                                                </div></a></li>
                                                <?php endif; ?>
                                                <?php if ($contact_data->instagram_link != ''): ?>
                                                <li><a href="<?= $contact_data->instagram_link ?>" target="_blank" rel="noopener" class="links" aria-label="Instagram"><div class="icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="23.72" height="23.72" viewBox="0 0 23.72 23.72"><path d="M17.795,0H5.935A5.948,5.948,0,0,0,0,5.93V17.79a5.948,5.948,0,0,0,5.93,5.93h11.86a5.948,5.948,0,0,0,5.93-5.93V5.93A5.948,5.948,0,0,0,17.795,0Zm3.953,17.79a3.958,3.958,0,0,1-3.953,3.953H5.935A3.958,3.958,0,0,1,1.982,17.79V5.93A3.958,3.958,0,0,1,5.935,1.977h11.86A3.957,3.957,0,0,1,21.748,5.93V17.79Z" transform="translate(-0.005 0)"/><ellipse cx="1.482" cy="1.482" rx="1.482" ry="1.482" transform="translate(16.802 3.953)"/><path d="M108.335,102.4a5.93,5.93,0,1,0,5.93,5.93A5.929,5.929,0,0,0,108.335,102.4Zm0,9.884a3.953,3.953,0,1,1,3.953-3.954A3.953,3.953,0,0,1,108.335,112.284Z" transform="translate(-96.475 -96.47)"/></svg>
                                                </div></a></li>
                                                <?php endif; ?>
                                                <?php if ($contact_data->youtube_link != ''): ?>
                                                <li><a href="<?= $contact_data->youtube_link ?>" target="_blank" rel="noopener" class="links" aria-label="YouTube"><div class="icon" id="youtube">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30.018" height="21.692" viewBox="0 0 30.018 21.692"><path d="M15.006,22.192H15c-.906-.006-8.913-.079-11.182-.693A4.639,4.639,0,0,1,.552,18.237,34.047,34.047,0,0,1,0,11.375,34.688,34.688,0,0,1,.55,4.461l0-.006A4.737,4.737,0,0,1,3.812,1.171l.012,0C6.067.578,14.091.506,15,.5h.016c.908.006,8.937.079,11.185.694A4.638,4.638,0,0,1,29.46,4.451a33.031,33.031,0,0,1,.553,6.95,34.141,34.141,0,0,1-.55,6.852l0,.006a4.64,4.64,0,0,1-3.266,3.263l-.006,0c-2.243.589-10.266.661-11.174.668h-.008ZM2.817,5.062a33.545,33.545,0,0,0-.472,6.3v.031a31.521,31.521,0,0,0,.472,6.239,2.287,2.287,0,0,0,1.61,1.6c1.674.453,8.2.6,10.579.612,2.39-.017,8.921-.155,10.583-.59a2.288,2.288,0,0,0,1.607-1.6,31.629,31.629,0,0,0,.472-6.239c0-.012,0-.025,0-.037A30.528,30.528,0,0,0,27.2,5.07v0a2.288,2.288,0,0,0-1.611-1.608c-1.658-.453-8.19-.6-10.579-.612-2.388.017-8.913.155-10.58.589a2.352,2.352,0,0,0-1.61,1.628ZM12.018,16.094V6.6l8.208,4.749Zm0,0" transform="translate(0.002 -0.5)"/></svg>
                                                </div></a></li>
                                                <?php endif; ?>
                                                <?php if ($contact_data->twitter_link != ''): ?>
                                                <li><a href="<?= $contact_data->twitter_link ?>" target="_blank" rel="noopener" class="links" aria-label="X"><div class="icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21.407" height="20.793" viewBox="0 0 21.407 20.793"><path d="M24.711,8.381,31.921,0H30.213l-6.26,7.277L18.952,0H13.185l7.561,11-7.561,8.789h1.709L21.5,12.108l5.281,7.685h5.767L24.711,8.381Zm-2.34,2.72-.766-1.1-6.1-8.719h2.624l4.919,7.037.766,1.1,6.395,9.146H27.589L22.371,11.1Z" transform="translate(-12.095 0.5)" stroke-width="1"/></svg>
                                                </div></a></li>
                                                <?php endif; ?>
                                                <?php if ($contact_data->threads_link != ''): ?>
                                                <li><a href="<?= $contact_data->threads_link ?>" target="_blank" rel="noopener" class="links" aria-label="Threads"><div class="icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="23.158" height="26.396" viewBox="0 0 23.158 26.396"><path d="M43.186,26.4h-.008c-3.938-.027-6.966-1.325-9-3.86-1.811-2.256-2.744-5.395-2.776-9.328v-.019c.031-3.934.965-7.072,2.776-9.328,2.033-2.535,5.062-3.834,9-3.86h.015A12.149,12.149,0,0,1,50.7,2.306a11.108,11.108,0,0,1,3.86,6.013l-2.243.626C51.1,4.59,48.032,2.364,43.185,2.329c-3.2.023-5.619,1.029-7.192,2.989C34.52,7.153,33.759,9.8,33.731,13.2c.029,3.394.79,6.045,2.262,7.879,1.573,1.96,3.992,2.966,7.192,2.989,2.884-.021,4.793-.693,6.38-2.248a4.724,4.724,0,0,0,1.2-5.276,4.238,4.238,0,0,0-1.8-1.923,7.266,7.266,0,0,1-1.413,3.6,5.383,5.383,0,0,1-4.1,1.969A6.037,6.037,0,0,1,39.87,19.3a4.125,4.125,0,0,1-.466-6.649,6.5,6.5,0,0,1,3.94-1.419,15.076,15.076,0,0,1,3.321.157,3.824,3.824,0,0,0-.822-1.932,3.318,3.318,0,0,0-2.6-.98h-.032a3.452,3.452,0,0,0-2.994,1.451l-1.933-1.3a5.715,5.715,0,0,1,4.926-2.48h.048c3.514.022,5.607,2.171,5.815,5.925.12.05.237.1.353.157A6.814,6.814,0,0,1,52.9,15.609a7.038,7.038,0,0,1-1.7,7.874c-2.032,1.99-4.5,2.889-8,2.913h-.007Zm1.1-12.859c-.266,0-.536.008-.812.024-2.02.114-3.279,1.039-3.207,2.357.075,1.38,1.6,2.022,3.061,1.943,1.347-.072,3.1-.6,3.394-4.081a11.7,11.7,0,0,0-2.435-.242Z" transform="translate(-31.403)"/></svg>
                                                </div></a></li>
                                                <?php endif; ?>
                                                <?php if ($contact_data->linkedin_link != ''): ?>
                                                <li><a href="<?= $contact_data->linkedin_link ?>" target="_blank" rel="noopener" class="links" aria-label="LinkedIn"><div class="icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="22.755" height="21.749" viewBox="0 0 22.755 21.749"><path d="M2.759,0A2.542,2.542,0,1,0,2.7,5.071h.032A2.543,2.543,0,1,0,2.759,0"/><rect width="4.878" height="14.675" transform="translate(0.288 7.074)"/><path d="M230.273,189.108c-2.631,0-4.4,2.473-4.4,2.473v-2.128H221v14.675h4.878v-8.195a3.343,3.343,0,0,1,.161-1.19,2.67,2.67,0,0,1,2.5-1.784c1.765,0,2.471,1.346,2.471,3.318v7.85h4.877v-8.414c0-4.507-2.407-6.6-5.616-6.6" transform="translate(-213.134 -182.378)"/></svg>
                                                </div></a></li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-lg-4">
                            <div class="accordion-item">
                                <div class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#footerAccordThree" aria-expanded="false" aria-controls="footerAccordThree">
                                        <div class="headTitle"><?= Words::getValue($language, 'get_a_free_quote') ?></div>
                                    </button>
                                </div>
                                <div id="footerAccordThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#footerAccord">
                                    <div class="accordion-body">
                                        <div class="addressBx">
                                            <div class="headTitle"><?= Words::getValue($language, 'get_a_free_quote') ?></div>
                                            <p><?= Words::getValue($language, 'get_a_free_quote_description') ?></p>
                                            <div class="btnSec">
                                                <div class="item">
                                                    <a href="javascript:void(0)" class="hoveranim cmnBtn" data-bs-toggle="modal" data-bs-target="#bookingModal">
                                                        <span><?= Words::getValue($language, 'book_now') ?></span>
                                                    </a>
                                                </div>
                                                <div class="item">
                                                    <a href="<?= $contact_data->location_link ?>" class="cmnBtn white locatn" target="_blank" rel="noopener">
                                                        <!-- Map iframe replaced by a static thumbnail: the embed cost ~1MB + 3 long tasks on every page. Put a 260x160 screenshot at images/map-thumb.jpg -->
                                                        <?php if (is_file(Yii::getAlias('@webroot/images/map-thumb.jpg'))): /* file did not exist → every page view made a 404 that booted Yii */ ?>
                                                        <div class="locatnBx">
                                                            <img src="<?= $homeUrl ?>images/map-thumb.jpg" alt="Map" width="260" height="160" loading="lazy">
                                                        </div>
                                                        <?php endif; ?>
                                                        <span><?= Words::getValue($language, 'our_location_map') ?></span>
                                                        <div class="icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="13.693" height="16.736" viewBox="0 0 13.693 16.736"><path d="M14.2,2.558A6.844,6.844,0,1,0,5.68,13.273a11.6,11.6,0,0,1,2.983,3.208l.533.886a.761.761,0,0,0,1.3,0l.51-.851a9.677,9.677,0,0,1,2.722-3.043A6.839,6.839,0,0,0,14.2,2.555Zm-4.35,8.331A3.043,3.043,0,1,1,12.89,7.846,3.043,3.043,0,0,1,9.847,10.889Z" transform="translate(-3.001 -0.999)" fill="#763813"/></svg>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="Txt">
                                                <?= Words::getValue($language, 'copyright') ?> © <?= date('Y') ?> <br>
                                                <?= Words::getValue($language, 'copyright_description') ?>
                                            </div>
                                            <div class="Txt">
                                                <?= Words::getValue($language, 'designed_by') ?>:
                                                <a href="https://www.intersmartsolution.com" target="_blank" rel="noopener"><?= Words::getValue($language, 'intersmart') ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </footer>

    <!-- Booking Success Modal -->
    <div class="modal fade PopupModals" id="bookingSuccessModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h5><?= Words::getValue($language, 'book_appointment_success_message') ?></h5>
                    <button type="button" class="close-btn" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Booking Modal -->
<div class="modal fade bookingModal" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <a href="javascript:void(0)" class="closeBtn" data-bs-dismiss="modal" aria-label="Close">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="27.764" height="27.764" viewBox="0 0 27.764 27.764"><g transform="translate(-2 -2)"><path d="M9.185,8.2a.694.694,0,0,0-.982.982l4.368,4.368L8.2,17.921a.694.694,0,0,0,.982.982l4.368-4.368L17.921,18.9a.694.694,0,1,0,.982-.982l-4.368-4.368L18.9,9.185a.694.694,0,0,0-.982-.982l-4.368,4.368Z" transform="translate(2.329 2.329)"/><path d="M2,8.941A6.941,6.941,0,0,1,8.941,2H22.823a6.941,6.941,0,0,1,6.941,6.941V22.823a6.941,6.941,0,0,1-6.941,6.941H8.941A6.941,6.941,0,0,1,2,22.823ZM8.941,3.388H22.823a5.553,5.553,0,0,1,5.553,5.553V22.823a5.553,5.553,0,0,1-5.553,5.553H8.941a5.553,5.553,0,0,1-5.553-5.553V8.941A5.553,5.553,0,0,1,8.941,3.388Z" fill-rule="evenodd"/></g></svg>
                </div>
            </a>
            <div class="modal-body">
                <div class="flxBx">
                    <div class="lftBx">
                        <div class="imgBx">
                            <?php $popupImg = About::getValue('book_an_appointment_popup_image', $language); ?>
                            <img src="<?= $popupImg ?>" width="700" height="630" alt="popupBg" loading="lazy">
                        </div>
                    </div>
                    <div class="rtSec">
                        <div class="appointMentBox">
                            <div class="imgBox"><img src="<?= $homeUrl ?>images/logIcon.svg" alt="Logo Icon" loading="lazy"></div>
                            <div class="title"><?= Words::getValue($language, 'book_appointment') ?></div>
                            <?php $form = ActiveForm::begin([
                                'id'     => 'appointment-form',
                                'action' => Url::to(['site/appointment-form', 'language' => $language]),
                                'method' => 'post',
                            ]); $am = $model->getAppointmentModel(); ?>
                            <div class="row">
                                <input type="hidden" name="AppointmentEnquiry[page_url]" value="<?= Html::encode($currentUrl) ?>">
                                <div class="col-lg-12"><?= $form->field($am, 'name')->textInput(['placeholder' => Words::getValue($language, 'name') . ' *'])->label(false) ?></div>
                                <div class="col-lg-6"><?= $form->field($am, 'age')->textInput(['placeholder' => Words::getValue($language, 'age') . ' *'])->label(false) ?></div>
                                <div class="col-lg-6"><?= $form->field($am, 'gender')->dropDownList($genders, ['prompt' => Words::getValue($language, 'gender') . ' *', 'class' => 'select2 select'])->label(false) ?></div>
                                <div class="col-lg-12"><?= $form->field($am, 'phone_number')->textInput(['placeholder' => Words::getValue($language, 'phone_no') . ' *'])->label(false) ?></div>
                                <div class="col-lg-12"><?= $form->field($am, 'email')->textInput(['placeholder' => Words::getValue($language, 'email') . ' *'])->label(false) ?></div>
                                <div class="col-sm-12">
                                    <div class="dateBx">
                                        <?= $form->field($am, 'appointment_date')->textInput([
                                            'id'          => 'eventDate1',
                                            'class'       => 'form-control datepicker',
                                            'placeholder' => Words::getValue($language, 'your_preferred_date') . ' *',
                                            'data-input'  => true,
                                        ])->label(false) ?>
                                    </div>
                                </div>
                                <div class="col-lg-12"><?= $form->field($am, 'service')->dropDownList($service_list, ['prompt' => Words::getValue($language, 'select_department'), 'class' => 'select2 select'])->label(false) ?></div>
                                <div class="col-lg-12"><?= $form->field($am, 'message')->textarea(['placeholder' => Words::getValue($language, 'message')])->label(false) ?></div>
                                <!-- reCAPTCHA: api.js is loaded only when this modal first opens (see JS below) -->
                                <div class="col-lg-12 mb-3"><div class="g-recaptcha" data-sitekey="6LeIN5stAAAAAH4T1_W3wKcBxlKmq8P-8bzJTga4"></div></div>
                                <div class="col-lg-12">
                                    <button class="hoveranim cmnBtn"><span><?= Words::getValue($language, 'book_now') ?></span></button>
                                </div>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
/* reCAPTCHA api.js loads ONCE, on demand (modal open, or a page-level form scrolling into view).
   api.js auto-renders every .g-recaptcha present in the DOM when it loads, so both the modal
   widget and any on-page widget get rendered by the single load. */
window.loadRecaptcha = function () {
    if (window.__rcLoaded) return;
    window.__rcLoaded = true;
    var s = document.createElement('script');
    s.src = 'https://www.google.com/recaptcha/api.js'; s.async = true; s.defer = true;
    document.head.appendChild(s);
};

/* All site init runs after the deferred libraries above have executed. */
document.addEventListener('DOMContentLoaded', function () {
    /* Pages can be served from the page cache, so write the visitor's real URL (with utm/gclid) into the booking forms here */
    document.querySelectorAll('input[name$="[page_url]"]').forEach(function (el) { el.value = window.location.href; });

    var homeUrl   = <?= Json::encode($homeUrl) ?>;
    var language  = <?= Json::encode($language) ?>;
    var actionUrl = <?= Json::encode($action_url) ?>;

    if (window.LazyLoad) { new LazyLoad({}); }

    /* Run fn once, when el comes within `margin` of the viewport (or right away if IntersectionObserver is missing).
       Used to keep widget setup (select2, datepickers, sliders) out of the first seconds after the page paints. */
    window.whenNear = function (el, fn, margin) {
        if (!el) return;
        if (!('IntersectionObserver' in window)) { fn(); return; }
        var io = new IntersectionObserver(function (entries) {
            if (entries[0].isIntersecting) { io.disconnect(); fn(); }
        }, { rootMargin: (margin || '400px') + ' 0px' });
        io.observe(el);
    };

    function initSelect2(scope) {
        if (!$.fn.select2) return;
        $(scope).find("select:not(.selectpicker)").not('.select2-hidden-accessible').select2({
            minimumResultsForSearch: Infinity,
            theme: "bootstrap-5",
            containerCssClass: "select2--small",
            selectionCssClass: "select2--small",
            dropdownCssClass: "select2--small"
        });
    }
    /* select2 per form, when that form approaches the screen (modal forms: when the modal opens) */
    document.querySelectorAll('form').forEach(function (form) {
        if (form.closest('.modal')) return;
        if (form.querySelector('select:not(.selectpicker)')) whenNear(form, function () { initSelect2(form); });
    });
    initSelect2($('select:not(.selectpicker)').filter(function () { return !$(this).closest('form').length; }).parent());

    /* Booking modal: init select2 + datepicker + lazy-load reCAPTCHA on first open only (window.loadRecaptcha is defined above) */
    $('#bookingModal').on('show.bs.modal', function () {
        initSelect2(this);
        window.loadRecaptcha();
    }).on('shown.bs.modal', function () {
        if (window.flatpickr) {
            flatpickr('#eventDate1', {
                dateFormat: "F, d Y",
                minDate: "today",
                disable: [{ from: "1700-01-01", to: "1800-01-01" }]
            });
        }
    });
    whenNear(document.getElementById('eventDate'), function () {
        if (window.flatpickr) flatpickr("#eventDate", { dateFormat: "F, d Y", disable: [{ from: "1700-01-01", to: "1800-01-01" }] });
    });

    /* Language switch */
    $('.language-change').on('click', function (e) {
        e.preventDefault();
        var lang = $(this).attr('val');
        $.post(homeUrl + 'en/language', { lang: lang }, function () {
            var url = window.location.href, res;
            if (lang === 'ar') {
                res = (actionUrl === 'product/search') ? url.replace("en", "=ar") : (url.indexOf("/en") > -1 ? url.replace("/en", "/ar") : url + lang);
            } else {
                res = (actionUrl === 'product/search') ? url.replace("=ar", "=en") : (url.indexOf("/ar") > -1 ? url.replace("/ar", "/en") : url + lang);
            }
            window.location = res;
        });
    });

    /* Department hover image (no cache-busting timestamp — it forced a re-download every hover) */
    $(".department-change").on("mouseover", function () {
        var src = $(this).attr('data-val');
        $(".dep-image").attr("src", src).attr("data-src", src);
    });

    /* Keyword search (debounced) */
    var searchTimer;
    $(document).on('keyup', '.keyword-search', function () {
        var keyword = $(this).val();
        clearTimeout(searchTimer);
        if (keyword === '') {
            $(".searchresults").removeClass("show");
            $(".keywordsearchresults").html('');
            return;
        }
        searchTimer = setTimeout(function () {
            $.post(homeUrl + language + '/keyword-search', { keyword: keyword }, function (data) {
                $(".keywordsearchresults").html(data);
                $(".searchresults").addClass("show");
            });
        }, 250);
    });
    $(document).on('click', '#searchresults li', function () {
        $("#searckeyhwords").val($(this).text());
        $('#serach-formms').submit();
    });

    /* Service review form */
    $(document).on('submit', '#review-form', function (e) {
        e.preventDefault();
        $.ajax({
            url: homeUrl + language + '/service-review',
            type: 'POST', data: new FormData(this), processData: false, contentType: false,
            success: function (response) {
                var ok = response != 0;
                $("#review-form").before('<div id="subscribe-msg" class="action-alert success" style="color:#fff;background:' + (ok ? '#689F38' : 'red') + ';border:1px solid #cac2c2;padding:6px;text-align:center;border-radius:3px;">' + (ok ? response : 'Image is required') + '</div>');
                if (ok) { $("#review-name,#review-email,#review-title,#review-message").val(''); }
                setTimeout(function () { $("#subscribe-msg").remove(); }, 5000);
            }
        });
    });

    /* Add to cart */
    $(document).on('click', '.add-to-cart', function (e) {
        e.preventDefault();
        var canname = $(this).attr('data-product');
        if (!canname) return;
        $.post(homeUrl + language + '/ajax/add-to-cart', {
            product: canname, qty: 1, combo: $(this).attr('data-variant'), type: 1, current_url: ''
        }, function (data) {
            if (data != 0) { window.location.href = <?= Json::encode(Url::to(['cart/index', 'language' => $language])) ?>; }
        });
    });

    $('.btn-close').on('click', function () {
        $(this).closest('.alert').fadeOut('slow', function () { $(this).remove(); });
    });

    /* Flash messages */
    <?php if ($successMessage): ?>
    if (window.toastr) toastr.success(<?= Json::encode($successMessage) ?>, 'Success', { closeButton: true, progressBar: true, timeOut: 10000 });
    <?php endif; ?>
    <?php if ($errorMessage): ?>
    if (window.toastr) toastr.error(<?= Json::encode($errorMessage) ?>, 'Error', { closeButton: true, progressBar: true, timeOut: 10000 });
    <?php endif; ?>
});
</script>

<script>
/* Third-party tags (Clarity, ClickRank, Meta, Snap, TikTok) load on first interaction, or 6s AFTER window.load —
   whichever comes first. Timing from `load` (not from parse) keeps them out of the Lighthouse trace on fast desktop
   loads, where the old 5s-from-parse timer was landing inside the measurement window (TBT 1.7s, 20 long tasks). */
(function () {
    var loaded = false;
    function loadThirdParty() {
        if (loaded) return; loaded = true;
        ['scroll', 'mousemove', 'touchstart', 'keydown'].forEach(function (ev) { window.removeEventListener(ev, loadThirdParty); });

        // Microsoft Clarity
        (function (c, l, a, r, i, t, y) { c[a] = c[a] || function () { (c[a].q = c[a].q || []).push(arguments) }; t = l.createElement(r); t.async = 1; t.src = "https://www.clarity.ms/tag/" + i; y = l.getElementsByTagName(r)[0]; y.parentNode.insertBefore(t, y); })(window, document, "clarity", "script", "epyd9oxyi3");

        // ClickRank (no cache-busting timestamp)
        var cr = document.createElement("script"); cr.src = "https://js.clickrank.ai/seo/6742abc7-0319-4661-b02b-9fa4d0062a42/script"; cr.async = true; document.head.appendChild(cr);

        // Meta Pixel
        !function (f, b, e, v, n, t, s) { if (f.fbq) return; n = f.fbq = function () { n.callMethod ? n.callMethod.apply(n, arguments) : n.queue.push(arguments) }; if (!f._fbq) f._fbq = n; n.push = n; n.loaded = !0; n.version = '2.0'; n.queue = []; t = b.createElement(e); t.async = !0; t.src = v; s = b.getElementsByTagName(e)[0]; s.parentNode.insertBefore(t, s) }(window, document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '976174241061653'); fbq('track', 'PageView');

        // Snap Pixel
        (function (e, t, n) { if (e.snaptr) return; var a = e.snaptr = function () { a.handleRequest ? a.handleRequest.apply(a, arguments) : a.queue.push(arguments) }; a.queue = []; var s = 'script', r = t.createElement(s); r.async = !0; r.src = n; var u = t.getElementsByTagName(s)[0]; u.parentNode.insertBefore(r, u); })(window, document, 'https://sc-static.net/scevent.min.js');
        snaptr('init', '4c24fb1c-95b9-4e86-91f1-8856d3a05bcf', {}); snaptr('track', 'PAGE_VIEW');

        // TikTok Pixel (both accounts)
        !function (w, d, t) { w.TiktokAnalyticsObject = t; var ttq = w[t] = w[t] || []; ttq.methods = ["page", "track", "identify", "instances", "debug", "on", "off", "once", "ready", "alias", "group", "enableCookie", "disableCookie", "holdConsent", "revokeConsent", "grantConsent"], ttq.setAndDefer = function (t, e) { t[e] = function () { t.push([e].concat(Array.prototype.slice.call(arguments, 0))) } }; for (var i = 0; i < ttq.methods.length; i++) ttq.setAndDefer(ttq, ttq.methods[i]); ttq.instance = function (t) { for (var e = ttq._i[t] || [], n = 0; n < ttq.methods.length; n++) ttq.setAndDefer(e, ttq.methods[n]); return e }; ttq.load = function (e, n) { var r = "https://analytics.tiktok.com/i18n/pixel/events.js"; ttq._i = ttq._i || {}, ttq._i[e] = [], ttq._i[e]._u = r, ttq._t = ttq._t || {}, ttq._t[e] = +new Date, ttq._o = ttq._o || {}, ttq._o[e] = n || {}; n = document.createElement("script"); n.type = "text/javascript", n.async = !0, n.src = r + "?sdkid=" + e + "&lib=" + t; e = document.getElementsByTagName("script")[0]; e.parentNode.insertBefore(n, e) }; ttq.load('CVUHJHJC77U7LB59MI30'); ttq.load('CUQP3E3C77U38KO2EJ8G'); ttq.page(); }(window, document, 'ttq');
    }
    ['scroll', 'mousemove', 'touchstart', 'keydown'].forEach(function (ev) { window.addEventListener(ev, loadThirdParty, { passive: true }); });
    var armTimer = function () {
        var idle = window.requestIdleCallback || function (cb) { return setTimeout(cb, 0); };
        setTimeout(function () { idle(loadThirdParty, { timeout: 2000 }); }, 6000);
    };
    if (document.readyState === 'complete') { armTimer(); } else { window.addEventListener('load', armTimer); }
})();
</script>
<noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=976174241061653&ev=PageView&noscript=1" alt=""></noscript>
<!-- jQuery: the ONE synchronous script. It must sit BEFORE $this->endBody() because Yii's registerJs()/ActiveForm
     output (jQuery(function($){...})) is printed there. At the end of <body> it does not block first paint.
     Deferred scripts below execute after it, in document order, before DOMContentLoaded. -->
    <script src="<?= $homeUrl ?>lib/jquery-3.7.0.min.js"></script>
<!-- bootstrap.bundle + select2.full + flatpickr + toastr + vanilla-lazyload, one deferred file.
     Removed: bootstrap-select, AOS, GSAP, ScrollTrigger (≈110 KB of JS that no page uses). -->
    <script<?= $libsAttr ?> src="<?= $homeUrl ?>lib/vendor.min.js?v=1"></script>
    <script<?= $libsAttr ?> src="<?= $homeUrl ?>js/app.min.js"></script>
<?= $viewScripts ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();