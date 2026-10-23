<?php

/** @var yii\web\View $this */
use yii\helpers\Url;
use common\models\Words;
use yii\helpers\Html;
use yii\web\View;

$currentUrl = Url::to(Yii::$app->request->url, true);
$homeUrl    = Yii::$app->homeUrl;
$isAr       = ($language === 'ar');

?>
<script defer src="<?= $homeUrl ?>lib/home.min.js?v=1"></script>

<div id="pageWrapper" class="departmentPage">
    <section id="PageBanner">
        <img src="<?= $homeUrl ?>uploads/banners/<?= Html::encode($isAr ? $banner->image_arabic : $banner->image) ?>"
             data-src="<?= $homeUrl ?>uploads/banners/<?= Html::encode($isAr ? $banner->image_arabic : $banner->image) ?>"
             class="lazy bannerBg" loading="lazy" width="1920" height="535"
             alt="<?= Html::encode($isAr ? $banner->title_arabic : $banner->title) ?>">
        <div class="container">
            <div class="mainBanner">
                <div class="captionBx">
                    <h1 class="mainHead"><?= Html::encode($isAr ? $banner->title_arabic : $banner->title) ?></h1>
                    <div class="tagLine"><?= Html::encode($isAr ? $banner->description_arabic : $banner->description) ?></div>
                    <section id="Breadcrumb">
                        <div class="container">
                            <ul class="breadcrumb">
                                <li><a href="<?= Url::to(['site/index', 'language' => $language]) ?>"><?= Words::getValue($language, 'home') ?></a></li>
                                <li class="active"><?= Words::getValue($language, 'department') ?></li>
                            </ul>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>

    <section id="service" class="departmentSection">
        <div class="floaticon" aria-hidden="true">
            <img src="<?= $homeUrl ?>images/logoIcon.svg" alt="" loading="lazy" width="120" height="120">
        </div>
        <div class="container">
            <div class="departmentHeader">
                <div class="departmentHeader__copy">
                    <span class="departmentEyebrow"><?= Html::encode($isAr ? 'الأقسام' : 'DEPARTMENTS') ?></span>
                    <h2><?= Html::encode($isAr ? 'أقسامنا الطبية والتجميلية' : 'Our Medical and Aesthetic Departments') ?></h2>
                    <p><?= Html::encode($isAr ? 'سواءً كان سبب زيارتك هو إجراء فحص دوري، أو تحسين مظهر ابتسامتك، أو الحصول على بشرة أكثر نعومة، أو تعزيز ثقتك بنفسك، ستجد هنا المختص المناسب لتلبية احتياجاتك.':'Whatever brings you in, a check-up, a smile makeover, smoother skin or a confidence boost, you will find a specialist for it here.')?></p>
                </div>
              
            </div>

            <div class="serviceGrid">
                <?php foreach ($departments as $department):
                    $departmentName = $isAr ? $department->department_name_arabic : $department->department_name;
                    $departmentDescription = $isAr ? $department->department_description_arabic : $department->department_description;
                    $departmentDescription = mb_strimwidth(trim(strip_tags((string) $departmentDescription)), 0, 112, '…', 'UTF-8');
                    $departmentImage = $homeUrl . 'uploads/departments/' . $department->department_image;
                    ?>
                    <div class="serviceCardItem item">
                        <a href="<?= Url::to(['site/department-details', 'language' => $language, 'slug' => $department->canonical_name]) ?>" class="serviceCard">
                            <div class="serviceCard__image">
                                <img src="<?= Html::encode($departmentImage) ?>" data-src="<?= Html::encode($departmentImage) ?>" class="lazy" loading="lazy" decoding="async" width="420" height="270" alt="<?= Html::encode($departmentName) ?>">
                                <span class="serviceCard__title"><?= Html::encode($departmentName) ?></span>
                            </div>
                            <div class="serviceCard__body">
                                <p><?= Html::encode($departmentDescription) ?></p>
                                <span class="serviceCard__link"><?= Html::encode($isAr ? 'اعرف المزيد' : 'Learn More') ?><span aria-hidden="true">→</span></span>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
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
    $faqIntro = $isAr
           ? ['eyebrow' => 'الأسئلة الشائعة', 
           'title' => 'تحتاج إلى إجابات؟ نحن هنا للمساعدة', 
           'title2' => 'هل هناك أي أسئلة أخرى يمكنني الإجابة عليها من أجلك؟',
           'text' => 'إجابات واضحة على الأسئلة الشائعة حول المواعيد وساعات عمل العيادة والتأمين.'
           ]
        : ['eyebrow' => 'FAQ',
         'title' => 'Need Answers? We’re Here to Help', 
         'text' => 'Find clear answers to common questions about appointments, clinic hours and insurance.',
           'title2' => 'Are There Any Other Questions I Can Answer For You?'
         ];
    $homeFaqs = $isAr ? [
        ['question' => 'هل أحتاج إلى حجز موعد قبل الزيارة؟', 
        'answer' => 'يُنصح بحجز موعد لضمان توفر الأخصائي الذي تفضله. ونرحب بزيارات الحضور المباشر حسب التوفر.'],
        ['question' => 'ما ساعات عمل العيادة؟', 
        'answer' => 'من السبت إلى الخميس من الساعة 9:00 صباحاً حتى 10:00 مساءً، ويوم الجمعة من الساعة 12:00 ظهراً حتى 10:00 مساءً.'],
        ['question' => 'هل تقبلون التأمين؟', 
        'answer' => 'نتعامل مع مجموعة من شبكات التأمين. يرجى الاتصال بنا وتزويدنا بتفاصيل خطتك للتأكد من التغطية.'],
    ] : [
        ['question' => 'Do I need an appointment before visiting?',
         'answer' => 'Recommended, so your preferred specialist is available.'],
        ['question' => 'What are the operating hours?', 
        'answer' => 'Saturday to Thursday 9:00 AM to 10:00 PM, Friday 12:00 PM to 10:00 PM.'],
        ['question' => 'Which departments do you have?', 
        'answer' => 'Dental, cosmetic dentistry, orthodontics, derma, laser hair removal and skincare.',
        ],
         ['question' => 'Can I choose my doctor?', 
        'answer' => 'Yes. Name your preferred specialist when you book.',
        ],
         ['question' => 'Do you treat children?', 
        'answer' => 'Yes, our dental team includes paediatric dentistry.',
        ],
    ];?>
    <?php if (!empty($homeFaqs)): ?>
    <section id="homeFaq" class="homeFaq" dir="<?= $isAr ? 'rtl' : 'ltr' ?>">
        <div class="container">
            <div class="homeFaqIntro">
                <div class="homeFaqEyebrow"><?= Html::encode($faqIntro['eyebrow']) ?></div>
                <h2><?= Html::encode($faqIntro['title']) ?></h2>
                <p><?= Html::encode($faqIntro['text']) ?></p>
                <div class="FaqBox"> 
                      <h3><?= Html::encode($faqIntro['title2']) ?></h3 style="color: #fff;">
               <div class="homeFaqCta">
                    <a href="<?= Url::to(['site/contact_us', 'language' => $language]) ?>" class="cmnBtn hoveranim">
                        <span><?= $isAr ? 'اتصل بنا' : 'Contact Us' ?> →</span>
                    </a>
                </div>
                </div>
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
                <div class="homeFaqCta">
                    <a href="<?= Url::to(['site/faq', 'language' => $language]) ?>" class="cmnBtn hoveranim">
                        <span><?= $isAr ? 'عرض جميع الأسئلة الشائعة' : 'See All FAQs' ?> →</span>
                    </a>
                </div>
            </div>

        </div>
    </section>
    <?php endif; ?>
</div>
