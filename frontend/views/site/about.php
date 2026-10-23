<?php

/** @var yii\web\View $this */
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\About;
use common\models\Words;
use yii\widgets\ActiveForm;
use common\models\Departments;

// $this->params['breadcrumbs'][] = $this->title;
// $this->title = 'Damas | About Us';
$currentUrl = Url::to(Yii::$app->request->url, true);
$homeUrl    = Yii::$app->homeUrl;
$isAr       = ($language === 'ar');

$insuranceDepts = [];
if (!empty($insurances)) {
    $deptIds = array_unique(array_map(function ($i) { return $i->department; }, $insurances));
    $insuranceDepts = Departments::find()->where(['id' => $deptIds])->indexBy('id')->all();
}

?>


<?php
// Register the Google reCAPTCHA script in the view
$this->registerJsFile(
    'https://www.google.com/recaptcha/api.js',
    ['position' => \yii\web\View::POS_HEAD, 'async' => true, 'defer' => true]
);
?>


<div id="pageWrapper" class="aboutPage">
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
                                <li class="active"><?= Words::getValue($language, 'about_us') ?></li>
                            </ul>
                        </div>
                    </section>
                </div>

            </div>
        </div>
    </section>

     <section id="about" class="about-section">
        <div class="floaticon" aria-hidden="true">
            <img src="<?= Yii::$app->homeUrl ?>images/logoIcon.svg" alt="" loading="lazy" width="120" height="120">
        </div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6">
                   <div class="imgBox aboutImageBox wow animate__fadeInUp">
                        <img src="<?= About::getValue('our_story_image', $language) ?>" data-src="<?= About::getValue('our_story_image', $language) ?>" 
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

    <section id="insurance" style="margin-top: -90px;">
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

    <section id="health">
        <div class="videoBx">
            <video id="myVideo" autoplay loop muted playsinline src="<?= About::getValue('about_video_link', $language) ?>"></video>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="contentBox wow animate__fadeInUp" data-wow-duration="1.5s">
                        <div class="mainHead">
                            <div class="head white"><?= About::getValue('video_title', $language) ?>
                            </div>
                        </div>
                        <p><?= About::getValue('video_description', $language) ?>
                        </p>
                        <a href="javascript:void(0)" class="cmnBtn hoveranim white wow animate__fadeInUp"
                           data-wow-duration="1.5s" data-bs-toggle="modal" data-bs-target="#bookingModal">
                            <span><?= Words::getValue($language, 'book_now') ?></span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="flxBox">
                        <div class="item wow animate__fadeInUp" data-wow-duration="1.5s">
                            <div class="couterBx">
                                <div class="icon">
                                    <img src="<?= Yii::$app->homeUrl ?>images/c1.svg" alt="Year of experience">
                                </div>
                                <div class="info">
                                    <div class="numTxt"><span data-count="<?= About::getValue('year_of_experience', $language) ?>">0</span></div>
                                    <div class="txt"><?= Words::getValue($language, 'years_of_experience') ?></div>
                                </div>
                            </div>
                        </div>

                        <div class="item wow animate__fadeInUp" data-wow-duration="1.5s">
                            <div class="couterBx">
                                <div class="icon">
                                    <img src="<?= Yii::$app->homeUrl ?>images/c2.svg" alt="treatments">
                                </div>
                                <div class="info">
                                    <div class="numTxt"><span data-count="<?= About::getValue('treatments', $language) ?>">0</span></div>
                                    <div class="txt"><?= Words::getValue($language, 'treatments') ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="item wow animate__fadeInUp" data-wow-duration="2s">
                            <div class="couterBx">
                                <div class="icon">
                                    <img src="<?= Yii::$app->homeUrl ?>images/c3.svg" alt="branches">
                                </div>
                                <div class="info">
                                    <div class="numTxt"><span data-count="<?= About::getValue('branches', $language) ?>">0</span></div>
                                    <div class="txt"><?= Words::getValue($language, 'branches') ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="item wow animate__fadeInUp" data-wow-duration="2.5s">
                            <div class="couterBx">
                                <div class="icon">
                                    <img src="<?= Yii::$app->homeUrl ?>images/c4.svg" alt="happy_clients">
                                </div>
                                <div class="info">
                                    <div class="numTxt"><span data-count="<?= About::getValue('happy_clients', $language) ?>">0</span></div>
                                    <div class="txt"><?= Words::getValue($language, 'happy_clients') ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

      <?php $homeContactCta = $isAr ? [
       'visionTitle'  => 'الرؤية',
    'visionDesc'   => 'في مركز "داماس" الطبي، تتجاوز رؤيتنا الحدود المألوفة؛ فنحن نصيغ عالماً يُتاح فيه لكل فرد فرصة خوض تحول شخصي عميق، والسعي بشغف نحو تحقيق أحلامه. ومن خلال باقة من التجارب التجميلية الفريدة، نلتزم بإطلاق العنان للإمكانات اللامحدودة الكامنة في أعماق كل إنسان، لنرشده نحو احتضان جوهره الحقيقي والاحتفاء به. هنا، لا يُعد التمكين مجرد وعد، بل هو رحلة لاكتشاف الذات الحقيقية وتقديرها.',
    'missionTitle' => 'الرسالة',
    'missionDesc'  => 'بهدف تمكين التحول وإبراز الجمال لدى الجميع، يجمع مركز "داماس" الطبي (Damas Medical Center) بين الرعاية التجميلية المبتكرة والاهتمام الشخصي المخصص لكل فرد. ومن خلال احتضان المواهب المتنوعة وتوظيف أحدث التقنيات، نسعى لتقديم خدمات متميزة تتيح لكل شخص إطلاق كامل إمكاناته ضمن بيئة داعمة.',
    'rightEyebrow' => 'الرؤية والرسالة', 
    'rightTitle'   => 'جعل الجمال والصحة متاحين وبأسعار معقولة للجميع',

    ] : [
         'visionTitle'  => 'Our Vision',
    'visionDesc'   => 'At Damas Medical Center, our vision transcends ordinary boundaries, crafting a world where every individual is empowered to undergo profound personal transformation and ardently chase their dreams. Through a symphony of unparalleled aesthetic experiences, we pledge to unlock the infinite potential within each soul, guiding them to embrace and celebrate their true essence. Here, empowerment is not just a promise—it\'s a journey to discovering and honoring the authentic self.',
    'missionTitle' => 'Our Mission',
    'missionDesc'  => 'To empower transformation and beauty in everyone, Damas Medical Center combines innovative aesthetic healthcare with personalized care. By embracing diverse talents and cutting-edge technology, we aim to provide excellence in service, unlocking each individual\'s potential in a supportive environment.',
     'rightEyebrow' => 'Vision & Mission', 
    'rightTitle'   => 'Making Beauty and Health Affordable and Available for Everyone',

    ]; ?>
    <section id="aboutContactCta" class="aboutContactCta" dir="<?= $isAr ? 'rtl' : 'ltr' ?>">
        <div class="container">
            <div class="aboutContactCard">
                <div class="aboutContactMethod">
                    <span class="homeContactIcon" aria-hidden="true">
                        <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M17.4056 1.25004C17.4519 1.25007 17.4989 1.25009 17.5465 1.25009L18.167 1.25009C19.0386 1.25006 19.7673 1.25004 20.3462 1.32763C20.9578 1.40962 21.5134 1.59037 21.9605 2.03612C22.4079 2.48218 22.5896 3.03701 22.672 3.64789C22.7499 4.22551 22.7498 4.95241 22.7498 5.82101V6.44002C22.7498 6.4877 22.7498 6.53475 22.7499 6.58119C22.7504 7.63124 22.7508 8.36819 22.4707 9.04242C22.1906 9.71642 21.668 10.2369 20.9229 10.9791C20.89 11.0119 20.8566 11.0451 20.8228 11.0788L18.153 13.7406L18.2461 13.8843C18.6397 14.4923 18.9586 14.9848 19.1889 15.4095C19.4273 15.8494 19.5968 16.262 19.6646 16.7185C19.7737 17.4523 19.6751 18.2066 19.3858 18.8996C19.2785 19.1566 19.0929 19.4259 18.9026 19.6714C18.7031 19.9286 18.4593 20.2088 18.1974 20.4941C17.6762 21.0621 17.0504 21.686 16.495 22.2397L16.404 22.3305C15.684 23.0483 14.4361 22.8156 14.0522 21.8525C13.8245 21.2814 13.7324 21.0538 13.6171 20.8435C13.5102 20.6486 13.3875 20.4627 13.2503 20.2876C13.1042 20.1012 12.9335 19.9287 12.5102 19.5066L12.0054 19.064C11.9983 19.0578 11.9914 19.0515 11.9846 19.0451C11.8911 19.0572 11.7962 19.0634 11.6997 19.0634C11.0682 19.0634 10.5472 18.7998 10.0561 18.4262C9.59158 18.0729 9.0762 17.559 8.46002 16.9446L7.0134 15.5024C6.39726 14.8881 5.88183 14.3743 5.52735 13.911C5.15269 13.4215 4.88741 12.901 4.88741 12.2693C4.88741 12.1547 4.8962 12.0425 4.91329 11.9325L4.08287 11.1046C4.03445 11.0563 4.01506 11.037 3.99593 11.0185C3.62227 10.6559 3.18262 10.3675 2.70047 10.1689C2.67577 10.1587 2.6503 10.1486 2.58667 10.1234L2.20802 9.97334C1.19447 9.57173 0.92164 8.26365 1.69543 7.4922L1.70249 7.48516C2.25792 6.93141 2.88366 6.30756 3.4533 5.78791C3.73952 5.5268 4.02052 5.28373 4.27845 5.08494C4.52476 4.89509 4.79455 4.71029 5.05179 4.60356C5.74601 4.31552 6.50143 4.21738 7.2361 4.32595C7.693 4.39347 8.10622 4.56205 8.54733 4.79974C8.9732 5.02923 9.46709 5.34711 10.077 5.73965L10.2247 5.8347L12.8969 3.17043C12.9306 3.13686 12.9638 3.10371 12.9966 3.071C13.7414 2.32769 14.2632 1.80689 14.9386 1.52798C15.6138 1.24915 16.3517 1.24952 17.4056 1.25004ZM9.13735 6.91875C8.57734 6.55864 8.17425 6.30262 7.83578 6.12024C7.4767 5.92675 7.23621 5.84226 7.01681 5.80984C6.55867 5.74213 6.07732 5.80205 5.62665 5.98904C5.55933 6.01697 5.41759 6.10078 5.19416 6.27299C4.98234 6.43625 4.73539 6.6487 4.46422 6.89608C3.92148 7.39119 3.31755 7.9931 2.75448 8.55446C2.7513 8.55763 2.75029 8.55938 2.7502 8.55953C2.7501 8.5597 2.7502 8.55952 2.7502 8.55953C2.7501 8.55988 2.74939 8.56283 2.75033 8.56737C2.75127 8.57191 2.75297 8.5744 2.75343 8.57497C2.75371 8.57517 2.75614 8.57707 2.76059 8.57883L3.14432 8.73088C3.20135 8.75348 3.23668 8.76748 3.27188 8.78198C3.92982 9.05306 4.53008 9.44669 5.04048 9.94193C5.06779 9.96843 5.09469 9.99525 5.1381 10.0385L5.61586 10.5149C5.68125 10.4336 5.74953 10.353 5.82004 10.2725C6.14181 9.90528 6.55522 9.49312 7.03378 9.016L9.13735 6.91875ZM13.4544 18.3396L13.5352 18.4104L13.5868 18.4619C13.9774 18.8513 14.2195 19.0926 14.4309 19.3624C14.6184 19.6016 14.7861 19.8557 14.9322 20.1222C15.0919 20.4133 15.2156 20.7203 15.4087 21.2047L15.4289 21.1845C15.992 20.6231 16.5957 20.021 17.0923 19.4799C17.3404 19.2096 17.5535 18.9634 17.7172 18.7522C17.8899 18.5294 17.9738 18.3884 18.0016 18.3218C18.1888 17.8733 18.2487 17.3946 18.1809 16.9391C18.1486 16.7214 18.0641 16.4822 17.8702 16.1244C17.6869 15.7863 17.4295 15.3835 17.067 14.8233L14.9584 16.9256C14.4685 17.414 14.0465 17.8348 13.6707 18.1594C13.5989 18.2214 13.5269 18.2816 13.4544 18.3396ZM17.5465 2.75009C16.2947 2.75009 15.8771 2.7633 15.5112 2.9144C15.1455 3.06541 14.8413 3.35009 13.956 4.23268L8.10915 10.062C7.61071 10.5589 7.23286 10.9362 6.9482 11.2611C6.6622 11.5874 6.5162 11.8109 6.44522 11.9874C6.40383 12.0903 6.38741 12.1792 6.38741 12.2693C6.38741 12.4398 6.44582 12.643 6.71857 12.9994C7.00448 13.3731 7.44672 13.8162 8.10915 14.4767L8.26629 14.6333L9.79679 13.1074C10.0901 12.815 10.565 12.8157 10.8574 13.109C11.1499 13.4024 11.1492 13.8772 10.8559 14.1697L9.32855 15.6924L9.4825 15.8459C10.1449 16.5063 10.5894 16.9473 10.9643 17.2324C11.3217 17.5043 11.5267 17.5634 11.6997 17.5634C11.7845 17.5634 11.867 17.5491 11.9594 17.5151C12.1348 17.4505 12.3584 17.3107 12.6902 17.0241C13.0208 16.7387 13.4055 16.3557 13.9168 15.8459L19.7637 10.0166C20.6492 9.13374 20.9343 8.83068 21.0854 8.46692C21.2365 8.10341 21.2498 7.68861 21.2498 6.44002V5.87287C21.2498 4.93878 21.2482 4.31389 21.1854 3.84835C21.1256 3.40463 21.0229 3.21946 20.9014 3.09837C20.7797 2.97697 20.593 2.87414 20.1469 2.81434C19.6794 2.75167 19.0521 2.75009 18.1154 2.75009H17.5465ZM16.6635 7.32353C16.1978 6.85916 15.4417 6.85916 14.9759 7.32353C14.5114 7.78666 14.5114 8.53661 14.9759 8.99974C15.4417 9.46412 16.1978 9.46412 16.6635 8.99974C17.1281 8.53661 17.1281 7.78666 16.6635 7.32353ZM13.9168 6.26128C14.968 5.21324 16.6714 5.21324 17.7226 6.26128C18.7751 7.31056 18.7751 9.01271 17.7226 10.062C16.6714 11.11 14.968 11.11 13.9168 10.062C12.8644 9.01271 12.8644 7.31056 13.9168 6.26128Z" fill="#ffffff"></path> </g></svg>
                    </span>
                    <div>
                        <h3><?= Html::encode($homeContactCta['visionTitle']) ?></h3>
                        <p><?= Html::encode($homeContactCta['visionDesc']) ?></p>
                    </div>
                </div>
                <div class="aboutContactMethod">
                    <span class="homeContactIcon" aria-hidden="true">
                        <svg width="30px" height="30px" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M8.16923 2.00234C8.11301 2.00078 8.0566 2 8 2C4.68629 2 2 4.68629 2 8C2 11.3137 4.68629 14 8 14C11.3137 14 14 11.3137 14 8C14 7.9434 13.9992 7.88699 13.9977 7.83077L15.7642 6.06422C15.9182 6.68407 16 7.33249 16 8C16 12.4183 12.4183 16 8 16C3.58172 16 0 12.4183 0 8C0 3.58172 3.58172 0 8 0C8.66751 0 9.31593 0.0817526 9.93578 0.235791L8.16923 2.00234Z" fill="#ffffff"></path> <path d="M4 7.99996C4 6.13612 5.27477 4.57002 7 4.12598V6.26752C6.4022 6.61333 6 7.25968 6 7.99996C6 9.10453 6.89543 9.99996 8 9.99996C8.74028 9.99996 9.38663 9.59776 9.73244 8.99996H11.874C11.4299 10.7252 9.86384 12 8 12C5.79086 12 4 10.2091 4 7.99996Z" fill="#ffffff"></path> <path d="M14 2L13 0L10 3V4.58579L7.79289 6.79289L9.20711 8.20711L11.4142 6H13L16 3L14 2Z" fill="#ffffff"></path> </g></svg>
                    </span>
                    <div>
                        <h3><?= Html::encode($homeContactCta['missionTitle']) ?></h3>
                        <p><?= Html::encode($homeContactCta['missionDesc']) ?></p>
                    </div>
                    </div>
            </div>
            <div class="homeGetStarted">
                <div class="homeGetStartedEyebrow"><?= Html::encode($homeContactCta['rightEyebrow']) ?></div>
                <h2><?= Html::encode($homeContactCta['rightTitle']) ?></h2>
            </div>
        </div>
    </section>

    <?php
    if (!empty($our_history)) {
        ?>
        <section id="histroy">
            <div class="container">
                <div class="mainHead">
                    <div class="head"><?= Words::getValue($language, 'our_history') ?></div>
                    <div class="tagLine"><?= About::getValue('our_history_title', $language) ?></div>
                </div>
                <div class="SliderFlex">

                    <div id="MainSlide" class="splide MainSlide">
                        <div class="splide__track">
                            <ul class="splide__list">
                                <?php foreach ($our_history as $our_hstory) { ?>
                                    <li class="splide__slide">
                                        <div class="row">
                                            <div class="col-lg-5">
                                                <div class="yearBox">
                                                    <div class="logIcon">
                                                        <img src="<?= Yii::$app->homeUrl ?>images/log.svg" alt="<?= $language == 'ar' ? $our_hstory->title_arabic : $our_hstory->title ?>">
                                                    </div>
                                                    <div class="year"><?= $our_hstory->year ?></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-7 rtBx">
                                                <div class="contentWrap">
                                                    <div class="subTxt"><?= $language == 'ar' ? $our_hstory->title_arabic : $our_hstory->title ?></div>
                                                     <div class="contentwrpaBx">
                                                        <?= $language == 'ar' ? $our_hstory->description_arabic : $our_hstory->description ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                <?php }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div id="ThumbSlide" class="splide ThumbSlide">
                        <div class="splide__track">
                            <ul class="splide__list">
                                <?php foreach ($our_history as $our_hstory) { ?>
                                    <li class="splide__slide">
                                        <div class="Dot">
                                            <span></span>
                                        </div>
                                        <div class="yearTxt"><?= $our_hstory->year ?></div>
                                    </li>
                                    <?php
                                }
                                ?>

                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <?php
    }
    ?>

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

    
    <?php
    $valueCards = $isAr
        ? ['التوفر', 'القدرة على تحمل التكلفة', 'سهولة الوصول']
        : ['Availability', 'Affordability', 'Accessibility'];
    $damasValues = $isAr ? [
        ['الجمال الإلهي', 'رحلة كل شخص فريدة. نلتزم بتقديم رعاية شخصية تحترم هذا التنوع وتحتفي به، ليكون طريق كل شخص نحو الجمال والثقة مميزاً مثله.'],
        ['الأصالة', 'نسعى باستمرار إلى التميز، ونعمل على بلوغ أعلى المعايير وتجاوزها، لنمنح مرضانا أفضل رعاية وتجربة ممكنة.'],
        ['صنّاع المعجزات', 'نلتزم بالابتكار ونسعى باستمرار إلى تبني أحدث التطورات في الرعاية الصحية التجميلية لتحسين خدماتنا ونتائجها.'],
        ['بوصلة الجمال', 'التعاون أساس تميزنا. ومن خلال جمع خبرات ووجهات نظر متنوعة، نبني ثقافة نجاح مشترك وتعلم مستمر.'],
        ['الرضا والثقة', 'نؤمن بتمكين مرضانا وموظفينا من تحقيق كامل إمكاناتهم وأحلامهم، عبر التطور الشخصي والمهني.'],
    ] : [
        ['Divine Beauty', 'Every individual’s journey is unique. We dedicate ourselves to personalized care that respects and celebrates this diversity, making each person’s path to beauty and confidence their own.'],
        ['Authenticity', 'Our pursuit of excellence is relentless. We aim to set and surpass the highest standards so our patients receive the best possible care and experience.'],
        ['Miracle Makers', 'We are committed to innovation, continually seeking and embracing advancements in aesthetic healthcare to improve our services and outcomes.'],
        ['Aesthetic Compass', 'Collaboration is at the heart of our excellence. By bringing together diverse talents and perspectives, we cultivate shared success and continuous learning.'],
        ['Satisfaction & Trust', 'We believe in empowering our patients and staff to reach their full potential and live their dreams through personal and professional transformation.'],
    ];
    ?>
  
    <section id="ourValues" class="ourValues" dir="<?= $isAr ? 'rtl' : 'ltr' ?>">
        <div class="ourValuesIntro">
            <div class="ourValuesIntroInner">
                <div class="ourValuesEyebrow"><?= Html::encode($isAr ? 'قيمنا' : 'OUR VALUE') ?></div>
                <h2><?= Html::encode($isAr ? 'الجمال والصحة وجهان لعملة واحدة' : 'Beauty and Health, Two Faces for the Same Coin') ?></h2>
                <p style="color:#fff;"><?= Html::encode($isAr ? 'نتمتع بقيمة فريدة، وهذا ما يميزنا عن الآخرين': 'We Have A Unique Value, This Sets Us Apart From Others') ?></p>
            </div>
        </div>
        <div class="ourValuesCardsArea">
            <div class="ourValuesCards">
                <article class="ourValueCard"><span class="ourValueIcon" aria-hidden="true">
                   <svg fill="#814826" width="30px" height="30px" viewBox="0 0 48 48" enable-background="new 0 0 48 48" id="Layer_3" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M25.691,47.992C25.794,47.993,25.896,48,26,48s0.206-0.007,0.309-0.008H25.691z"></path> <g> <rect height="6" width="6" x="7.5" y="24"></rect> <rect height="6" width="6" x="16.667" y="24"></rect> <rect height="6" width="6" x="7.5" y="33"></rect> <rect height="6" width="6" x="16.667" y="33"></rect> <polygon points="14,0 10,0 10,4 0,4 0,15.9 0,19.9 0,48 22.667,48 22.667,44 4,44 4,19.9 22.667,19.9 22.667,15.9 4,15.9 4,8 10,8 10,12 14,12 14,8 22.667,8 22.667,4 14,4 "></polygon> <path d="M25.98,4h0.039C26.013,4,26.007,4,26,4S25.987,4,25.98,4z"></path> <path d="M26.502,4.012v4.013C36.209,8.293,44,16.228,44,26c0,9.771-7.791,17.706-17.498,17.975v4.013C38.42,47.72,48,37.982,48,26 S38.42,4.28,26.502,4.012z"></path> <polygon points="40,28 40,24 30.501,24 30.501,12.083 26.502,12.083 26.502,24 26.502,28 30.501,28 "></polygon> </g> </g></svg>
                </span>
                <h3><?= Html::encode($isAr ? 'الجمال الإلهي:' : 'Divine Beauty:') ?></h3>
                   <p> <?= Html::encode($isAr ? 'تتسم رحلة كل فرد بكونها فريدة من نوعها. ونحن نكرس جهودنا لتقديم رعاية مخصصة تحترم هذا التنوع وتحتفي به، لنضمن أن تكون مسيرة كل شخص نحو الجمال والثقة فريدةً بقدر تفرده هو ذاته.' : 'Every individual journey is unique. We dedicate ourselves to providing personalized care that respects and celebrates this diversity, ensuring that each person path to beauty and confidence is as unique as they are.') ?> </p>
            </article>
                <article class="ourValueCard"><span class="ourValueIcon" aria-hidden="true">
                    <svg width="30px" height="30px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="#814826" stroke="#814826"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M9 9H4v1h5V9z"></path><path d="M7 12V7H6v5h1z"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M5 3l1-1h7l1 1v7l-1 1h-2v2l-1 1H3l-1-1V6l1-1h2V3zm1 2h4l1 1v4h2V3H6v2zm4 1H3v7h7V6z"></path></g></svg>
                </span><h3><?= Html::encode($isAr ? 'أصالة:' : 'Authenticity: ') ?></h3>
                   <p> <?= Html::encode($isAr ? 'سعينا نحو التميز لا يعرف الكلل؛ فنحن نطمح إلى وضع أعلى المعايير وتجاوزها في كل ما نقوم به، لنضمن لمرضانا الحصول على أفضل رعاية وتجربة ممكنة.' : 'Our pursuit of excellence is relentless. We aim to set and surpass the highest standards in all we do, ensuring that our patients receive the best possible care and experiences.')?></p>
                   
            </article>
                <article class="ourValueCard"><span class="ourValueIcon" aria-hidden="true">
                    <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M13.5 6.50024C13.5 7.32867 12.8284 8.00024 12 8.00024C11.1716 8.00024 10.5 7.32867 10.5 6.50024C10.5 5.67182 11.1716 5.00024 12 5.00024C12.8284 5.00024 13.5 5.67182 13.5 6.50024Z" fill="#814826"></path> <path d="M6.05132 8.68402C5.87667 9.20796 6.15983 9.77428 6.68377 9.94893C6.85906 10.0071 7.03576 10.0613 7.21265 10.1143C7.5363 10.2114 7.98911 10.3408 8.50746 10.4704C9.08908 10.6158 9.78094 10.7687 10.4783 10.8727C10.4323 11.7654 10.3205 12.4059 10.2166 12.8309L8.10557 17.053C7.85858 17.547 8.05881 18.1477 8.55279 18.3947C9.04677 18.6417 9.64744 18.4414 9.89443 17.9475L12 13.7363L14.1056 17.9475C14.3526 18.4414 14.9532 18.6417 15.4472 18.3947C15.9412 18.1477 16.1414 17.547 15.8944 17.053L13.7834 12.8309C13.6795 12.4059 13.5677 11.7654 13.5217 10.8727C14.2191 10.7687 14.9109 10.6158 15.4925 10.4704C16.0109 10.3408 16.4637 10.2114 16.7873 10.1143C16.963 10.0616 17.1384 10.0077 17.3125 9.95015C17.8261 9.77972 18.1201 9.19822 17.9487 8.68402C17.7741 8.16012 17.2078 7.87697 16.6839 8.05151C16.5277 8.10318 16.3703 8.15138 16.2127 8.19867C15.9113 8.28907 15.4891 8.40969 15.0075 8.5301C14.0216 8.77657 12.8709 9.00024 12 9.00024C11.1291 9.00024 9.97843 8.77657 8.99254 8.5301C8.51089 8.40969 8.0887 8.28907 7.78735 8.19867C7.63167 8.15196 7.47632 8.10404 7.32186 8.05342C6.80235 7.88161 6.22544 8.16164 6.05132 8.68402Z" fill="#814826"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M23 12.0002C23 18.0754 18.0751 23.0002 12 23.0002C5.92487 23.0002 1 18.0754 1 12.0002C1 5.92511 5.92487 1.00024 12 1.00024C18.0751 1.00024 23 5.92511 23 12.0002ZM3.00683 12.0002C3.00683 16.967 7.03321 20.9934 12 20.9934C16.9668 20.9934 20.9932 16.967 20.9932 12.0002C20.9932 7.03345 16.9668 3.00707 12 3.00707C7.03321 3.00707 3.00683 7.03345 3.00683 12.0002Z" fill="#814826"></path> </g></svg>
                </span><h3><?= Html::encode($isAr ? 'صنّاع المعجزات:' : 'Miracle Makers: ') ?></h3>
                   <p> <?= Html::encode($isAr ? 'نحن ملتزمون بالابتكار، ونسعى باستمرار إلى استكشاف وتبنّي أحدث التطورات في مجال الرعاية التجميلية، بهدف الارتقاء بخدماتنا وتحسين النتائج التي نحققها.' : 'We are committed to innovation, constantly seeking out and embracing the latest advancements in aesthetic healthcare to improve our services and outcomes.')?></p>
                   
            </article>
              <article class="ourValueCard"><span class="ourValueIcon" aria-hidden="true">
<svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M3.55428 21.5288C5.35132 22.75 8.49749 21.4915 14.7898 18.9746C16.132 18.4377 16.8031 18.1693 17.3295 17.7076C17.4637 17.59 17.59 17.4637 17.7076 17.3295C18.1693 16.8031 18.4377 16.132 18.9746 14.7898C21.4915 8.49749 22.75 5.35132 21.5288 3.55428C21.2393 3.1282 20.8718 2.7607 20.4457 2.47117C18.6487 1.25001 15.5025 2.50848 9.21017 5.02542C7.86802 5.56228 7.19695 5.8307 6.67048 6.29238C6.53633 6.41002 6.41002 6.53633 6.29238 6.67048C5.8307 7.19695 5.56228 7.86802 5.02542 9.21017C2.50848 15.5025 1.25001 18.6487 2.47117 20.4457C2.76071 20.8718 3.1282 21.2393 3.55428 21.5288ZM8.25 12C8.25 9.92893 9.92893 8.25 12 8.25C14.0711 8.25 15.75 9.92893 15.75 12C15.75 14.0711 14.0711 15.75 12 15.75C9.92893 15.75 8.25 14.0711 8.25 12ZM9.75 12C9.75 10.7574 10.7574 9.75 12 9.75C13.2426 9.75 14.25 10.7574 14.25 12C14.25 13.2426 13.2426 14.25 12 14.25C10.7574 14.25 9.75 13.2426 9.75 12Z" fill="#814826"></path> </g></svg>
                </span><h3><?= Html::encode($isAr ? 'بوصلة الجمال:' : 'Aesthetic Compass:') ?></h3>
                   <p> <?= Html::encode($isAr ? 'يمثل التعاون ركيزة أساسية لتميّزنا؛ فمن خلال الجمع بين مواهب ووجهات نظر متنوعة، نرسّخ ثقافة قائمة على النجاح المشترك والتعلم المستمر.' : 'Collaboration is at the heart of our excellence. By bringing together with diverse talents and perspectives, we cultivate a culture of shared success and continuous learning.')?></p>
                   
            </article>
            </div>
        </div>
    </section>


    <section id="appointment" data-anchor="appointment" data-jarallax data-type="scroll" class="jarallax">
        <img src="<?= $language == 'ar' ? About::getValue('book_an_appointment_image_arabic', $language) : About::getValue('book_an_appointment_image', $language) ?>" data-src="<?= $language == 'ar' ? About::getValue('book_an_appointment_image_arabic', $language) : About::getValue('book_an_appointment_image', $language) ?>" class="lazy jarallax-img"
             loading="lazy" width="1920" height="720" alt="Appointment Form Background">
        <div class="container">
            <div class="appointMentBox wow animate__fadeInLeft" data-wow-duration="1.5s">
                <div class="imgBox">
                    <img src="<?= Yii::$app->homeUrl ?>images/logIcon.svg" alt="Logo">
                </div>
                <div class="title"><?= Words::getValue($language, 'book_appointment') ?></div>
                <?= \common\widgets\Alert::widget() ?>
                <?php $form = ActiveForm::begin(['id' => 'appointment-form2']); ?>
                <div class="row">
                    <input type="hidden" name="AppointmentEnquiryListing[page_url]" value="<?= $currentUrl ?>"/>
                    <div class="col-lg-12">
                        <?= $form->field($model, 'name')->textInput(['placeholder' => Words::getValue($language, 'name') . ' *'])->label(FALSE) ?>
                    </div>
                    <div class="col-lg-6">
                        <?= $form->field($model, 'age')->textInput(['placeholder' => Words::getValue($language, 'age') . ' *'])->label(FALSE) ?>
                    </div>
                    <div class="col-lg-6">
                        <?php
                        echo $form->field($model, 'gender')
                                ->dropDownList(
                                        $genders, // Flat array ('id'=>'label')
                                        ['prompt' => Words::getValue($language, 'gender') . ' *', 'class' => 'select2 select']    // options
                                )->label(FALSE);
                        ?>
                    </div>
                    <div class="col-lg-12">
                        <?= $form->field($model, 'phone_number')->textInput(['placeholder' => Words::getValue($language, 'phone_no') . ' *'])->label(FALSE) ?>
                    </div>
                    <div class="col-lg-12">
                        <?= $form->field($model, 'email')->textInput(['placeholder' => Words::getValue($language, 'email') . ' *'])->label(FALSE) ?>
                    </div>
                    <!--<div class="col-sm-12">-->
                    <!--    <?php // $form->field($model, 'appointment_date')->textInput(['placeholder' => Words::getValue($language, 'your_preferred_date') . ' *', 'id' => 'dateInput'])->label(FALSE)      ?>-->
                    <!--</div>-->
                    <div class="col-sm-12">
                        <div class="dateBx">


    <?= $form->field($model, 'appointment_date')->textInput([
        'id' => 'eventDate', 
        'class' => 'form-control datepicker', 
        'placeholder' => Words::getValue($language, 'your_preferred_date') . ' *',
        'type' => 'date', // Start as text, change to date on focus
        'data-input' => true
    ])->label(false) ?>
</div>
                    </div>
                    <div class="col-lg-12">
                        <?php
                        echo $form->field($model, 'service')
                                ->dropDownList(
                                        $services, // Flat array ('id'=>'label')
                                        ['prompt' => Words::getValue($language, 'select_department'), 'class' => 'select2 select']    // options
                                )->label(FALSE);
                        ?>
                    </div>
                    <div class="col-lg-12">
                        <?= $form->field($model, 'message')->textarea(['placeholder' => Words::getValue($language, 'message')])->label(FALSE) ?>
                    </div>
                    <div class="col-lg-12">
    <div class="g-recaptcha" data-sitekey="6LeIN5stAAAAAH4T1_W3wKcBxlKmq8P-8bzJTga4"></div>
    
    <?php if ($model->hasErrors('reCaptcha')): ?>
        <div class="text-danger" style="margin-top: 5px;">
            <?= $model->getFirstError('reCaptcha') ?>
        </div>
    <?php endif; ?>
</div>

                    <div class="col-lg-12">
                        <button class="hoveranim cmnBtn">
                            <span><?= Words::getValue($language, 'book_now') ?></span>
                        </button>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </section>

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

    <section id="ceo">
        <div class="container">
            <div class="mainHead center">
                <div class="head"><?= Words::getValue($language, 'ceo_message') ?></div>
                <div class="tagLine"><?= About::getValue('ceo_message_heading', $language) ?></div>
            </div>
            <div class="d_flx">
                <div class="imgWrap">
                    <div class="imgBox">
                        <img src="<?= About::getValue('ceo_image', $language) ?>" data-src="<?= About::getValue('ceo_image', $language) ?>" class="lazy" loading="lazy"
                             width="520" height="585" alt="<?= About::getValue('ceo_name', $language) ?>">
                    </div>
                </div>
                <div class="content">
                    <div class="ceoBx">
                        <div class="contentWarp">
                            <?= About::getValue('ceo_message', $language) ?>
                        </div>
                        <div class="signature">
                            <img src="<?= About::getValue('ceo_signature', $language) ?>" data-src="<?= About::getValue('ceo_signature', $language) ?>" class="lazy"
                                 loading="lazy" alt="<?= About::getValue('ceo_name', $language) ?>">
                        </div>
                        <div class="name"><?= About::getValue('ceo_name', $language) ?></div>
                        <div class="post"><?= About::getValue('ceo_designation', $language) ?></div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- WOW -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"
            integrity="sha512-Eak/29OTpb36LLo2r47IpVzPBLXnAMPAVypbSZiZ4Qkf8p/7S/XRG5xp7OKWPPYfJT6metI+IORkR5G8F900+g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- SCROLL MAGIC -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.8/ScrollMagic.min.js"
            integrity="sha512-8E3KZoPoZCD+1dgfqhPbejQBnQfBXe8FuwL4z/c8sTrgeDMFEnoyTlH3obB4/fV+6Sg0a0XF+L/6xS4Xx1fUEg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <!-- JARALLAX --->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jarallax/2.0.3/jarallax.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jarallax/2.0.3/jarallax.min.js"></script>

   


    <!-- SPLIDE --->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/splidejs/4.1.4/css/splide.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/splidejs/4.1.4/js/splide.min.js"></script>
    <script
        src="https://cdn.jsdelivr.net/npm/@splidejs/splide-extension-auto-scroll@0.5.3/dist/js/splide-extension-auto-scroll.min.js">
    </script>


<script defer src="<?= $homeUrl ?>lib/home.min.js?v=1"></script>

    <script>
        // WOW REVEAL

        new WOW().init();
        // counter


        $(document).ready(function () {
            var controller = new ScrollMagic.Controller();
            

            var scene = new ScrollMagic.Scene({
                triggerElement: '#health .flxBox  ',
                triggerHook: 0.9
            })
                    .setClassToggle('#health .flxBox .couterBx ', 'isVisible')
                    .on("enter", function () {
                        $('.numTxt span').each(function () {
                            var $this = $(this),
                                    countTo = $this.attr('data-count');

                            $({
                                countNum: $this.text()
                            }).animate({
                                countNum: countTo
                            }, {

                                duration: 2000,
                                easing: 'linear',
                                step: function () {
                                    $this.text(Math.floor(this.countNum));
                                },
                                complete: function () {
                                    $this.text((this.countNum));
                                }

                            });

                        });
                    })
                    .on("leave", function () {
                        $('.numTxt span ').each(function () {
                            $(this).text(0);
                        });
                    })
                    .reverse(true)
                    .addTo(controller);


        });


        document.addEventListener('DOMContentLoaded', function () {
            var rtlVal = document.documentElement.getAttribute('dir') === 'rtl';    
            var main = new Splide('#histroy #MainSlide', {
                type: 'fade',
                rewind: true,
                pagination: false,
                arrows: false,
                autoplay: true,
                pauseOnHover: false,
                interval: 2500,
            });

            var thumbnails = new Splide('#histroy #ThumbSlide', {
                // gap         : 10,

                width: "100%",
                height: "100%",
                rewind: true,
                pagination: false,
                cover: true,
                arrows: false,
                isNavigation: true,
                perPage: 7,
                perMove: 1,

            });
            main.sync(thumbnails);
            main.mount();
            thumbnails.mount();

            
                    if ($.fn.owlCarousel) {
                         var near = function (el, fn, margin) {
            if (!el) return;
            var target = $(el).closest('section')[0] || el.parentNode;
            (window.whenNear || function (e, f) { f(); })(target, fn, margin);
        };

                    near($('.insuranceSlider')[0], function () {
                        $('.insuranceSlider').owlCarousel({
                            loop: true, autoplay: true, smartSpeed: 500, autoplayTimeout: 2000, autoplayHoverPause: true,
                            responsiveClass: true, nav: true, dots: false, rtl: rtlVal, margin: 15,
                            responsive: { 0: { items: 3 }, 578: { items: 4 }, 768: { items: 5 }, 1200: { items: 5, margin: 20 } }
                        });
                    }, '600px');
            
                }
        });
    </script>


</div>
