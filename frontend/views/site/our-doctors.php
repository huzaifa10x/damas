<?php

/** @var yii\web\View $this */

use yii\helpers\Url;
use common\models\Words;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\web\View;


// $this->params['breadcrumbs'][] = $this->title;
// $this->title = 'Damas | ' . $banner->title;
$isAr       = ($language === 'ar');

?>

<div id="pageWrapper" class="doctorPage">
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
                                <li class="active"><?= Words::getValue($language, 'our_doctors') ?></li>
                            </ul>
                        </div>
                    </section>
                </div>

            </div>
        </div>
    </section>

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
                </div>
                <?php ActiveForm::end(); ?>

                <?php if (!empty($doctors)): ?>
                    <div class="doctor-team__grid">
                        <?php foreach ($doctors as $doctor):
                            $doctorName = $isAr ? $doctor->doctor_name_arabic : $doctor->doctor_name;
                            $doctorSpecialty = $isAr ? $doctor->designation_arabic : $doctor->designation;
                            $nameParts = preg_split('/\s+/u', trim((string) $doctorName));
                            $surname = !empty($nameParts) ? end($nameParts) : $doctorName;
                            $experienceYears = null;
                            foreach (['years_experience', 'experience'] as $experienceAttribute) {
                                if ($doctor->hasAttribute($experienceAttribute) && $doctor->$experienceAttribute !== '' && $doctor->$experienceAttribute !== null) {
                                    $experienceYears = $doctor->$experienceAttribute;
                                    break;
                                }
                            }
                            $doctorUrl = Url::to(['site/doctor-details', 'language' => $language, 'slug' => $doctor->canonical_name]);
                        ?>
                            <article class="doctor-team__card">
                                <a class="doctor-team__photo" href="<?= Html::encode($doctorUrl) ?>" aria-label="<?= Html::encode($doctorName) ?>">
                                    <img src="<?= Yii::$app->homeUrl ?>uploads/doctors/<?= Html::encode($doctor->image) ?>"
                                        data-src="<?= Yii::$app->homeUrl ?>uploads/doctors/<?= Html::encode($doctor->image) ?>"
                                        class="lazy" loading="lazy" decoding="async" width="420" height="375"
                                        alt="<?= Html::encode($doctorName) ?>">
                                </a>
                                <div class="doctor-team__body">
                                    <h3 class="doctor-team__name"><?= Html::encode($doctorName) ?></h3>
                                    <p class="doctor-team__specialty">
                                        <?= Html::encode($doctorSpecialty) ?>
                                        <?php if ($experienceYears !== null): ?>
                                            <span class="doctor-team__separator">·</span>
                                            <?= Html::encode((string) $experienceYears) ?>
                                            <?= Html::encode($isAr ? 'سنوات من الخبرة' : 'years of experience') ?>
                                        <?php endif; ?>
                                    </p>
                                    <a class="doctor-team__book" href="<?= Html::encode($doctorUrl) ?>">
                                        <?= Html::encode($isAr ? 'احجز مع د. ' . $surname : 'Book with Dr. ' . $surname) ?>
                                        <span aria-hidden="true"><?= $isAr ? '←' : '→' ?></span>
                                    </a>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="empty-search-result">
                        <h2><?= Html::encode($isAr ? 'لم يتم العثور على نتائج' : 'No Results Found') ?></h2>
                        <p><?= Html::encode($isAr ? 'لم نعثر على نتائج مطابقة لبحثك.' : 'We couldn’t find any results for your search.') ?></p>
                    </div>
                <?php endif; ?>
            </div>
    </section>

    <section id="ourValues" class="ourValues" dir="<?= $isAr ? 'rtl' : 'ltr' ?>">
        <div class="ourValuesIntro">
            <div class="ourValuesIntroInner">
                <div class="ourValuesEyebrow"><?= Html::encode($isAr ? 'قيمنا' : 'OUR VALUE') ?></div>
                <h2><?= Html::encode($isAr ? 'الجمال والصحة وجهان لعملة واحدة' : 'Beauty and Health, Two Faces for the Same Coin') ?></h2>
                <p style="color:#fff;"><?= Html::encode($isAr ? 'نتمتع بقيمة فريدة، وهذا ما يميزنا عن الآخرين' : 'We Have A Unique Value, This Sets Us Apart From Others') ?></p>
            </div>
        </div>
        <div class="ourValuesCardsArea">
            <div class="ourValuesCards">
                <article class="ourValueCard"><span class="ourValueIcon" aria-hidden="true">
                        <svg fill="#814826" width="30px" height="30px" viewBox="0 0 48 48" enable-background="new 0 0 48 48" id="Layer_3" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path d="M25.691,47.992C25.794,47.993,25.896,48,26,48s0.206-0.007,0.309-0.008H25.691z"></path>
                                <g>
                                    <rect height="6" width="6" x="7.5" y="24"></rect>
                                    <rect height="6" width="6" x="16.667" y="24"></rect>
                                    <rect height="6" width="6" x="7.5" y="33"></rect>
                                    <rect height="6" width="6" x="16.667" y="33"></rect>
                                    <polygon points="14,0 10,0 10,4 0,4 0,15.9 0,19.9 0,48 22.667,48 22.667,44 4,44 4,19.9 22.667,19.9 22.667,15.9 4,15.9 4,8 10,8 10,12 14,12 14,8 22.667,8 22.667,4 14,4 "></polygon>
                                    <path d="M25.98,4h0.039C26.013,4,26.007,4,26,4S25.987,4,25.98,4z"></path>
                                    <path d="M26.502,4.012v4.013C36.209,8.293,44,16.228,44,26c0,9.771-7.791,17.706-17.498,17.975v4.013C38.42,47.72,48,37.982,48,26 S38.42,4.28,26.502,4.012z"></path>
                                    <polygon points="40,28 40,24 30.501,24 30.501,12.083 26.502,12.083 26.502,24 26.502,28 30.501,28 "></polygon>
                                </g>
                            </g>
                        </svg>
                    </span>
                    <h3><?= Html::encode($isAr ? 'الجمال الإلهي:' : 'Divine Beauty:') ?></h3>
                    <p> <?= Html::encode($isAr ? 'تتسم رحلة كل فرد بكونها فريدة من نوعها. ونحن نكرس جهودنا لتقديم رعاية مخصصة تحترم هذا التنوع وتحتفي به، لنضمن أن تكون مسيرة كل شخص نحو الجمال والثقة فريدةً بقدر تفرده هو ذاته.' : 'Every individual journey is unique. We dedicate ourselves to providing personalized care that respects and celebrates this diversity, ensuring that each person path to beauty and confidence is as unique as they are.') ?> </p>
                </article>
                <article class="ourValueCard"><span class="ourValueIcon" aria-hidden="true">
                        <svg width="30px" height="30px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="#814826" stroke="#814826">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path d="M9 9H4v1h5V9z"></path>
                                <path d="M7 12V7H6v5h1z"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M5 3l1-1h7l1 1v7l-1 1h-2v2l-1 1H3l-1-1V6l1-1h2V3zm1 2h4l1 1v4h2V3H6v2zm4 1H3v7h7V6z"></path>
                            </g>
                        </svg>
                    </span>
                    <h3><?= Html::encode($isAr ? 'أصالة:' : 'Authenticity: ') ?></h3>
                    <p> <?= Html::encode($isAr ? 'سعينا نحو التميز لا يعرف الكلل؛ فنحن نطمح إلى وضع أعلى المعايير وتجاوزها في كل ما نقوم به، لنضمن لمرضانا الحصول على أفضل رعاية وتجربة ممكنة.' : 'Our pursuit of excellence is relentless. We aim to set and surpass the highest standards in all we do, ensuring that our patients receive the best possible care and experiences.') ?></p>

                </article>
                <article class="ourValueCard"><span class="ourValueIcon" aria-hidden="true">
                        <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path d="M13.5 6.50024C13.5 7.32867 12.8284 8.00024 12 8.00024C11.1716 8.00024 10.5 7.32867 10.5 6.50024C10.5 5.67182 11.1716 5.00024 12 5.00024C12.8284 5.00024 13.5 5.67182 13.5 6.50024Z" fill="#814826"></path>
                                <path d="M6.05132 8.68402C5.87667 9.20796 6.15983 9.77428 6.68377 9.94893C6.85906 10.0071 7.03576 10.0613 7.21265 10.1143C7.5363 10.2114 7.98911 10.3408 8.50746 10.4704C9.08908 10.6158 9.78094 10.7687 10.4783 10.8727C10.4323 11.7654 10.3205 12.4059 10.2166 12.8309L8.10557 17.053C7.85858 17.547 8.05881 18.1477 8.55279 18.3947C9.04677 18.6417 9.64744 18.4414 9.89443 17.9475L12 13.7363L14.1056 17.9475C14.3526 18.4414 14.9532 18.6417 15.4472 18.3947C15.9412 18.1477 16.1414 17.547 15.8944 17.053L13.7834 12.8309C13.6795 12.4059 13.5677 11.7654 13.5217 10.8727C14.2191 10.7687 14.9109 10.6158 15.4925 10.4704C16.0109 10.3408 16.4637 10.2114 16.7873 10.1143C16.963 10.0616 17.1384 10.0077 17.3125 9.95015C17.8261 9.77972 18.1201 9.19822 17.9487 8.68402C17.7741 8.16012 17.2078 7.87697 16.6839 8.05151C16.5277 8.10318 16.3703 8.15138 16.2127 8.19867C15.9113 8.28907 15.4891 8.40969 15.0075 8.5301C14.0216 8.77657 12.8709 9.00024 12 9.00024C11.1291 9.00024 9.97843 8.77657 8.99254 8.5301C8.51089 8.40969 8.0887 8.28907 7.78735 8.19867C7.63167 8.15196 7.47632 8.10404 7.32186 8.05342C6.80235 7.88161 6.22544 8.16164 6.05132 8.68402Z" fill="#814826"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M23 12.0002C23 18.0754 18.0751 23.0002 12 23.0002C5.92487 23.0002 1 18.0754 1 12.0002C1 5.92511 5.92487 1.00024 12 1.00024C18.0751 1.00024 23 5.92511 23 12.0002ZM3.00683 12.0002C3.00683 16.967 7.03321 20.9934 12 20.9934C16.9668 20.9934 20.9932 16.967 20.9932 12.0002C20.9932 7.03345 16.9668 3.00707 12 3.00707C7.03321 3.00707 3.00683 7.03345 3.00683 12.0002Z" fill="#814826"></path>
                            </g>
                        </svg>
                    </span>
                    <h3><?= Html::encode($isAr ? 'صنّاع المعجزات:' : 'Miracle Makers: ') ?></h3>
                    <p> <?= Html::encode($isAr ? 'نحن ملتزمون بالابتكار، ونسعى باستمرار إلى استكشاف وتبنّي أحدث التطورات في مجال الرعاية التجميلية، بهدف الارتقاء بخدماتنا وتحسين النتائج التي نحققها.' : 'We are committed to innovation, constantly seeking out and embracing the latest advancements in aesthetic healthcare to improve our services and outcomes.') ?></p>

                </article>
                <article class="ourValueCard"><span class="ourValueIcon" aria-hidden="true">
                        <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.55428 21.5288C5.35132 22.75 8.49749 21.4915 14.7898 18.9746C16.132 18.4377 16.8031 18.1693 17.3295 17.7076C17.4637 17.59 17.59 17.4637 17.7076 17.3295C18.1693 16.8031 18.4377 16.132 18.9746 14.7898C21.4915 8.49749 22.75 5.35132 21.5288 3.55428C21.2393 3.1282 20.8718 2.7607 20.4457 2.47117C18.6487 1.25001 15.5025 2.50848 9.21017 5.02542C7.86802 5.56228 7.19695 5.8307 6.67048 6.29238C6.53633 6.41002 6.41002 6.53633 6.29238 6.67048C5.8307 7.19695 5.56228 7.86802 5.02542 9.21017C2.50848 15.5025 1.25001 18.6487 2.47117 20.4457C2.76071 20.8718 3.1282 21.2393 3.55428 21.5288ZM8.25 12C8.25 9.92893 9.92893 8.25 12 8.25C14.0711 8.25 15.75 9.92893 15.75 12C15.75 14.0711 14.0711 15.75 12 15.75C9.92893 15.75 8.25 14.0711 8.25 12ZM9.75 12C9.75 10.7574 10.7574 9.75 12 9.75C13.2426 9.75 14.25 10.7574 14.25 12C14.25 13.2426 13.2426 14.25 12 14.25C10.7574 14.25 9.75 13.2426 9.75 12Z" fill="#814826"></path>
                            </g>
                        </svg>
                    </span>
                    <h3><?= Html::encode($isAr ? 'بوصلة الجمال:' : 'Aesthetic Compass:') ?></h3>
                    <p> <?= Html::encode($isAr ? 'يمثل التعاون ركيزة أساسية لتميّزنا؛ فمن خلال الجمع بين مواهب ووجهات نظر متنوعة، نرسّخ ثقافة قائمة على النجاح المشترك والتعلم المستمر.' : 'Collaboration is at the heart of our excellence. By bringing together with diverse talents and perspectives, we cultivate a culture of shared success and continuous learning.') ?></p>

                </article>
            </div>
        </div>
    </section>


    <section id="home-stats" class="homeStats" aria-label="<?= $isAr ? 'إحصائيات المركز' : 'Damas Medical Center statistics' ?>">
        <div class="container">
            <div class="homeStatsGrid">
                <div class="homeStat">
                    <span class="homeStatIcon" aria-hidden="true"><svg fill="#fff" height="30px" width="30px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <g>
                                    <g>
                                        <g>
                                            <path d="M357.949,96.453C327.531,76.978,292.279,66.684,256,66.684C151.61,66.684,66.683,151.61,66.683,256 S151.61,445.317,256,445.317s189.317-84.927,189.317-189.318c0-42.675-13.862-82.963-40.087-116.507 c-3.514-4.494-10.001-5.288-14.495-1.776c-4.494,3.512-5.288,10.003-1.776,14.495c23.358,29.878,35.704,65.768,35.704,103.788 c0,93.002-75.662,168.664-168.664,168.664S87.335,349.001,87.335,255.999S162.997,87.335,255.999,87.335 c32.324,0,63.727,9.167,90.814,26.51c4.801,3.074,11.188,1.677,14.264-3.128C364.153,105.914,362.751,99.527,357.949,96.453z"></path>
                                            <path d="M500.39,256c0-11.871,2.871-25.02,5.648-37.735c4.878-22.338,9.923-45.436,1.247-66.357 c-9.044-21.813-29.357-34.695-49.002-47.153c-11.117-7.051-21.618-13.709-29.474-21.566 c-7.855-7.855-14.515-18.356-21.564-29.473c-12.458-19.643-25.339-39.956-47.151-49.001c-20.923-8.678-44.021-3.632-66.359,1.246 C281.02,8.739,267.871,11.61,256,11.61c-11.871,0-25.02-2.871-37.735-5.648c-22.338-4.88-45.437-9.922-66.357-1.247 c-21.813,9.045-34.695,29.357-47.153,49.002c-7.051,11.117-13.709,21.618-21.566,29.474 c-7.855,7.855-18.356,14.515-29.473,21.564c-19.643,12.458-39.956,25.339-49.001,47.151c-8.677,20.921-3.632,44.019,1.246,66.359 c2.776,12.715,5.648,25.863,5.648,37.734s-2.871,25.02-5.648,37.735c-4.878,22.338-9.922,45.437-1.246,66.359 c9.044,21.812,29.357,34.694,49.002,47.151l3.972,2.524c4.807,3.066,11.192,1.656,14.26-3.152 c3.068-4.808,1.656-11.192-3.152-14.26l-4.02-2.554c-17.712-11.232-34.442-21.842-40.985-37.621 c-6.194-14.936-2.046-33.931,2.346-54.041c3.01-13.786,6.123-28.041,6.123-42.141s-3.113-28.355-6.124-42.141 c-4.392-20.11-8.541-39.105-2.346-54.041c6.543-15.779,23.273-26.389,40.985-37.621c11.577-7.34,23.544-14.929,33.015-24.399 s17.062-21.44,24.403-33.017c11.232-17.712,21.842-34.442,37.621-40.985c14.937-6.194,33.931-2.045,54.041,2.346 c13.786,3.01,28.041,6.123,42.141,6.123c14.1,0,28.355-3.113,42.141-6.124c20.11-4.392,39.107-8.542,54.041-2.346 c15.779,6.543,26.389,23.273,37.621,40.985c7.34,11.575,14.932,23.544,24.402,33.015c9.47,9.471,21.44,17.062,33.017,24.403 c17.712,11.232,34.442,21.842,40.985,37.621c6.194,14.936,2.046,33.931-2.346,54.041c-3.01,13.786-6.123,28.041-6.123,42.141 s3.113,28.355,6.124,42.141c4.392,20.11,8.541,39.105,2.346,54.041c-6.543,15.779-23.273,26.389-40.985,37.621 c-11.575,7.34-23.544,14.932-33.015,24.402c-9.471,9.47-17.062,21.44-24.403,33.017c-11.232,17.712-21.842,34.442-37.621,40.985 c-14.937,6.194-33.931,2.045-54.041-2.346c-13.786-3.01-28.041-6.123-42.141-6.123s-28.355,3.113-42.141,6.124 c-20.112,4.392-39.105,8.541-54.041,2.346c-15.78-6.543-26.389-23.273-37.621-40.985c-2.941-4.637-5.982-9.433-9.123-14.029 c-3.219-4.709-9.645-5.918-14.352-2.7c-4.709,3.219-5.918,9.645-2.7,14.352c2.941,4.304,5.754,8.74,8.733,13.437 c12.458,19.645,25.339,39.957,47.151,49.002c8.269,3.428,16.876,4.714,25.644,4.714c13.416,0,27.206-3.011,40.715-5.962 c12.715-2.777,25.864-5.648,37.735-5.648s25.02,2.871,37.735,5.648c22.337,4.878,45.437,9.92,66.357,1.247 c21.813-9.044,34.695-29.357,47.153-49.002c7.051-11.117,13.709-21.618,21.566-29.474c7.855-7.855,18.356-14.515,29.473-21.564 c19.643-12.458,39.956-25.339,49.001-47.151c8.677-20.921,3.632-44.019-1.246-66.359C503.261,281.02,500.39,267.871,500.39,256z"></path>
                                            <path d="M368.093,222.475c-1.196-3.679-4.349-6.383-8.169-7.001l-64.752-10.492l-29.988-58.341 c-1.768-3.441-5.315-5.605-9.184-5.605c-3.869,0-7.414,2.163-9.184,5.605l-29.988,58.341l-64.752,10.492 c-3.819,0.618-6.972,3.321-8.169,7.001c-1.195,3.68-0.233,7.721,2.493,10.467l46.218,46.548l-10.032,64.825 c-0.593,3.823,1.004,7.658,4.135,9.933c3.13,2.273,7.268,2.606,10.726,0.863l58.552-29.573l58.552,29.573 c1.471,0.742,3.065,1.108,4.654,1.108c2.142,0,4.272-0.666,6.072-1.972c3.131-2.273,4.727-6.108,4.135-9.933l-10.032-64.825 l46.218-46.548C368.327,230.197,369.29,226.156,368.093,222.475z M301.049,268.638c-2.31,2.327-3.377,5.613-2.876,8.854 l7.757,50.126l-45.275-22.867c-1.464-0.738-3.059-1.108-4.655-1.108s-3.192,0.369-4.658,1.108l-45.275,22.867l7.757-50.126 c0.503-3.241-0.566-6.528-2.876-8.854l-35.739-35.994l50.069-8.112c3.237-0.525,6.033-2.555,7.533-5.473l23.188-45.111 l23.188,45.111c1.499,2.918,4.296,4.948,7.533,5.473l50.069,8.112L301.049,268.638z"></path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg></span>
                    <div>
                        <strong class="homeStatValue" data-count="2007">0</strong>
                        <span><?= $isAr ? 'نخدم الشارقة منذ' : 'Serving Sharjah Since' ?></span>
                    </div>
                </div>
                <div class="homeStat"><span class="homeStatIcon" aria-hidden="true">
                        <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path d="M15 12L12 12M12 12L9 12M12 12L12 9M12 12L12 15" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"></path>
                                <path d="M3 10.4167C3 7.21907 3 5.62028 3.37752 5.08241C3.75503 4.54454 5.25832 4.02996 8.26491 3.00079L8.83772 2.80472C10.405 2.26824 11.1886 2 12 2C12.8114 2 13.595 2.26824 15.1623 2.80472L15.7351 3.00079C18.7417 4.02996 20.245 4.54454 20.6225 5.08241C21 5.62028 21 7.21907 21 10.4167C21 10.8996 21 11.4234 21 11.9914C21 14.4963 20.1632 16.4284 19 17.9041M3.19284 14C4.05026 18.2984 7.57641 20.5129 9.89856 21.5273C10.62 21.8424 10.9807 22 12 22C13.0193 22 13.38 21.8424 14.1014 21.5273C14.6796 21.2747 15.3324 20.9478 16 20.5328" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"></path>
                            </g>
                        </svg>
                    </span>
                    <div><strong class="homeStatValue" data-count="19" data-suffix="+">0</strong><span><?= $isAr ? 'سنوات من الخبرة' : 'Years of Experience' ?></span></div>
                </div>
                <div class="homeStat"><span class="homeStatIcon" aria-hidden="true">
                        <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path d="M12 1.25C12.4142 1.25 12.75 1.58579 12.75 2V2.25143C12.8612 2.25311 12.9561 2.25675 13.0446 2.26458C14.8548 2.42465 16.2896 3.85953 16.4497 5.66968C16.4643 5.83512 16.4643 6.02256 16.4643 6.29785L16.4643 7.521C16.4643 11.3903 13.5202 14.5719 9.75001 14.9481V17.0001C9.75001 19.3473 11.6528 21.2501 14 21.2501H14.8824C16.2803 21.2501 17.4809 20.3981 17.9902 19.1822C18.03 19.0872 18.0578 18.9789 18.075 18.8547C16.8708 18.4647 16 17.3341 16 16C16 14.3431 17.3432 13 19 13C20.6569 13 22 14.3431 22 16C22 17.4603 20.9567 18.6768 19.5748 18.945C19.5472 19.2085 19.4887 19.4872 19.3738 19.7617C18.6391 21.5156 16.9058 22.7501 14.8824 22.7501H14C10.8244 22.7501 8.25001 20.1757 8.25001 17.0001V14.9495C4.3217 14.5722 1.25001 11.2625 1.25001 7.23529L1.25 6.29791C1.24997 6.02259 1.24995 5.83514 1.26458 5.66968C1.42465 3.85953 2.85954 2.42465 4.66969 2.26458C4.82536 2.25081 5.00051 2.25002 5.25001 2.24999V2C5.25001 1.58579 5.58579 1.25 6.00001 1.25C6.41422 1.25 6.75001 1.58579 6.75001 2V4C6.75001 4.41421 6.41422 4.75 6.00001 4.75C5.58579 4.75 5.25001 4.41421 5.25001 4V3.75002C4.9866 3.7502 4.88393 3.75148 4.80181 3.75875C3.71573 3.85479 2.85479 4.71572 2.75875 5.80181C2.75074 5.8924 2.75001 6.00802 2.75001 6.3369V7.23529C2.75001 10.6871 5.54823 13.4853 9.00001 13.4853C12.294 13.4853 14.9643 10.815 14.9643 7.521V6.3369C14.9643 6.00802 14.9636 5.8924 14.9555 5.80181C14.8595 4.71572 13.9986 3.85479 12.9125 3.75875C12.8702 3.755 12.8224 3.75285 12.75 3.75162V4C12.75 4.41421 12.4142 4.75 12 4.75C11.5858 4.75 11.25 4.41421 11.25 4V2C11.25 1.58579 11.5858 1.25 12 1.25Z" fill="#ffffff"></path>
                            </g>
                        </svg>
                    </span>
                    <div><strong class="homeStatValue" data-count="<?= count($doctors) ?>">0</strong><span><?= $isAr ? 'أطباء متخصصون' : 'Specialist Doctors' ?></span></div>
                </div>
                <div class="homeStat"><span class="homeStatIcon" aria-hidden="true">
                        <svg fill="#ffffff" width="30px" height="30px" viewBox="-32 0 512 512" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path d="M277.37 11.98C261.08 4.47 243.11 0 224 0c-53.69 0-99.5 33.13-118.51 80h81.19l90.69-68.02zM342.51 80c-7.9-19.47-20.67-36.2-36.49-49.52L239.99 80h102.52zM224 256c70.69 0 128-57.31 128-128 0-5.48-.95-10.7-1.61-16H97.61c-.67 5.3-1.61 10.52-1.61 16 0 70.69 57.31 128 128 128zM80 299.7V512h128.26l-98.45-221.52A132.835 132.835 0 0 0 80 299.7zM0 464c0 26.51 21.49 48 48 48V320.24C18.88 344.89 0 381.26 0 422.4V464zm256-48h-55.38l42.67 96H256c26.47 0 48-21.53 48-48s-21.53-48-48-48zm57.6-128h-16.71c-22.24 10.18-46.88 16-72.89 16s-50.65-5.82-72.89-16h-7.37l42.67 96H256c44.11 0 80 35.89 80 80 0 18.08-6.26 34.59-16.41 48H400c26.51 0 48-21.49 48-48v-41.6c0-74.23-60.17-134.4-134.4-134.4z"></path>
                            </g>
                        </svg>
                    </span>
                    <div><strong class="homeStatValue homeStatValuePending">—</strong><span><?= $isAr ? 'مريضاً في جميع الأقسام' : 'Patients Treated, All Departments Combined' ?></span></div>
                </div>
            </div>
        </div>
    </section>
    <?php
    $this->registerJs('(()=>{const section=document.getElementById("home-stats");if(!section)return;const values=section.querySelectorAll(".homeStatValue[data-count]");let started=false;const animate=()=>{if(started)return;started=true;values.forEach(el=>{const target=Number(el.dataset.count)||0,start=performance.now(),duration=1800;const tick=now=>{const p=Math.min((now-start)/duration,1);el.textContent=Math.floor(target*p).toLocaleString()+(el.dataset.suffix||"");if(p<1)requestAnimationFrame(tick)};requestAnimationFrame(tick)});};if("IntersectionObserver" in window){const observer=new IntersectionObserver(entries=>{if(entries.some(entry=>entry.isIntersecting)){animate();observer.disconnect()}},{threshold:.25});observer.observe(section)}else{animate()}})();', View::POS_READY);
    ?>
</div>
<script>
    // $(document).ready(function () {

    //     $(".form-change").blur(function () {
    //         $("#doctor-search").submit();
    //     });
    // });
</script>