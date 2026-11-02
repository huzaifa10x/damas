<?php

/** @var yii\web\View $this */

use yii\helpers\Url;
use common\models\Words;
use yii\helpers\Html;

// $this->params['breadcrumbs'][] = $this->title;
// $this->title = 'Damas | ' . $banner->title;

$homeUrl    = Yii::$app->homeUrl;
$isAr       = ($language === 'ar');
?>
<div id="pageWrapper" class="faqPage">

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
                                <li class="active"><?= Words::getValue($language, 'faq') ?></li>
                            </ul>
                        </div>
                    </section>
                </div>

            </div>
        </div>
    </section>

    <section id="homeFaq" class="homeFaq" dir="<?= $isAr ? 'rtl' : 'ltr' ?>">
        <div class="container">
            <div class="homeFaqIntro">
                <div class="homeFaqEyebrow"><?= Html::encode($language == 'ar' ? 'التعليمات' : 'FAQ') ?></div>
                <h2><?= Html::encode($language == 'ar' ? 'الأسئلة الشائعة' : 'Frequently Asked Questions') ?></h2>
                <p><?= Html::encode($language == 'ar' ?
                        'إذا لم تجد إجابة لسؤالك هنا، يرجى الاتصال على الرقم 7444 506 6 971+ أو إرسال رسالة عبر تطبيق "واتساب"، وسيقوم أحد موظفينا بالرد عليك خلال ساعات عمل العيادة.' :
                        'If your question is not answered here, call +971 6 506 7444 or send us a WhatsApp message and a real person will reply during clinic hours.') ?></p>
            </div>
        </div>
    </section>

    <?php
    $faqGroups = $isAr ? [
        ['heading' => 'المواعيد والزيارة', 'questions' => [
            ['هل أحتاج إلى موعد قبل الحضور؟', 'يُنصح بحجز موعد لضمان توفر الأخصائي الذي تفضله. ونرحب بالحضور المباشر حسب التوفر.'],
            ['ما أيام وساعات العمل؟', 'من السبت إلى الخميس من الساعة 9:00 صباحاً حتى 10:00 مساءً، ويوم الجمعة من الساعة 12:00 ظهراً حتى 10:00 مساءً.'],
            ['أين يقع المركز وهل تتوفر مواقف؟', 'نقع في المجاز 1، كورنيش بلازا 1، الشارقة، بالقرب من كورنيش البحيرة. يرجى الاتصال بنا للتأكد من تفاصيل مواقف السيارات قبل الزيارة.'],
            ['هل يمكنني إحضار مرافق؟', 'نعم. يمكن للوالدين البقاء مع أطفالهم طوال فترة العلاج.'],
        ]],
        ['heading' => 'العلاجات والأقسام', 'questions' => [
            ['ما العلاجات المتوفرة في داماس؟', 'طب الأسنان، وطب الأسنان التجميلي، وتقويم الأسنان، والجلدية، وإزالة الشعر بالليزر، والعناية بالبشرة.'],
            ['هل يمكنني اختيار طبيبي؟', 'نعم. اذكر اسم الأخصائي الذي تفضله عند الحجز.'],
            ['هل تستقبلون الأطفال؟', 'نعم. يضم فريق طب الأسنان لدينا أطباء متخصصين في طب أسنان الأطفال.'],
            ['كم تستغرق فترة العلاج؟', 'تعتمد المدة على تقييم حالتك. وسيقدم لك الأخصائي جدولاً زمنياً واقعياً خلال الاستشارة.'],
        ]],
        ['heading' => 'استشارتك', 'questions' => [
            ['كيف يمكنني حجز موعد؟', 'اتصل على +971 6 506 7444، أو أرسل رسالة عبر واتساب، أو استخدم نموذج الحجز.'],
            ['ماذا أحضر في زيارتي الأولى؟', 'أحضر هويتك الإماراتية، وبطاقة التأمين إذا كنت ترغب باستخدامها، وقائمة بالأدوية التي تتناولها، وأي تقارير أو صور أشعة سابقة.'],
            ['ماذا يحدث أثناء الاستشارة؟', 'سيجري الأخصائي فحصاً، ويشرح الخيارات المتاحة، ثم يضع خطة علاجية.'],
            ['هل الاستشارة مجانية؟', 'يرجى التواصل مع فريقنا للتأكد من رسوم الاستشارة الحالية قبل الحجز.'],
        ]],
        ['heading' => 'الدفع والتأمين', 'questions' => [
            ['ما طرق الدفع المقبولة؟', 'نقبل Visa وMastercard والدفع النقدي، كما تتوفر خيارات الدفع بالتقسيط عبر Tabby وTamara وToothPay وYusr.'],
            ['هل تقبلون التأمين الصحي؟', 'نتعامل مع مجموعة من شبكات التأمين. اتصل بنا بتفاصيل خطتك قبل زيارتك للتأكد من التغطية.'],
            ['هل يمكنني الدفع على أقساط؟', 'نعم. تتم الموافقة على خطة التقسيط من قبل مزود الخدمة.'],
            ['كيف أحصل على فاتورة مفصلة؟', 'اطلبها من مكتب الاستقبال في نهاية زيارتك.'],
        ]],
    ] : [
        ['heading' => 'Appointments and Visiting', 'questions' => [
            ['Do I need an appointment before coming in?', 'An appointment is recommended so your preferred specialist is available. Walk-ins are welcome subject to availability.'],
            ['What days and hours are you open?', 'Saturday to Thursday, 9:00 AM to 10:00 PM; Friday, 12:00 PM to 10:00 PM.'],
            ['Where are you located and is there parking?', 'Al Majaz 1, Corniche Plaza 1, Sharjah, close to Buhaira Corniche. Please contact us to confirm parking details before your visit.'],
            ['Can I bring someone with me?', 'Yes. Parents may stay with their children throughout treatment.'],
        ]],
        ['heading' => 'Treatments and Departments', 'questions' => [
            ['What treatments are available at Damas?', 'Dental, cosmetic dentistry, orthodontics, derma, laser hair removal and skincare.'],
            ['Can I choose my doctor?', 'Yes. Name your preferred specialist when you book.'],
            ['Do you treat children?', 'Yes. Our dental team includes paediatric dentistry.'],
            ['How long will my treatment take?', 'That depends on your assessment. Your specialist will give you a realistic timeline at the consultation.'],
        ]],
        ['heading' => 'Your Consultation', 'questions' => [
            ['How do I book?', 'Call +971 6 506 7444, send a WhatsApp, or use the booking form.'],
            ['What should I bring to my first visit?', 'Bring your Emirates ID, your insurance card if you plan to use it, a list of any medication, and any previous reports or X-rays.'],
            ['What happens during the consultation?', 'Your specialist will examine you, explain your options, and prepare a treatment plan.'],
            ['Is the consultation free?', 'Please contact our team to confirm current consultation fees before booking.'],
        ]],
        ['heading' => 'Payment and Insurance', 'questions' => [
            ['What payment methods do you accept?', 'Visa, Mastercard and cash, plus split payment through Tabby, Tamara, ToothPay and Yusr.'],
            ['Do you accept health insurance?', 'We work with a range of networks. Call us with your plan details before your visit so we can confirm coverage.'],
            ['Can I pay in instalments?', 'Yes. Approval is handled by the payment provider.'],
            ['How do I get an itemised bill?', 'Ask reception at the end of your visit.'],
        ]],
    ];
    ?>
    <section id="faq" class="faqGroups" <?= $isAr ? 'dir="rtl" lang="ar"' : 'lang="en"' ?>>
        <div class="container">
            <div class="faqGroupsGrid">
                <?php foreach ($faqGroups as $groupIndex => $group):
                    $groupId = 'faqGroup' . $groupIndex; ?>
                    <section class="faqGroup" aria-labelledby="<?= $groupId ?>Title">
                        <h2 class="faqGroupTitle" id="<?= $groupId ?>Title"><?= Html::encode($group['heading']) ?></h2>
                        <div class="accordion faqGroupAccordion" id="<?= $groupId ?>Accordion">
                            <?php foreach ($group['questions'] as $questionIndex => $qa):
                                $collapseId = $groupId . 'Question' . $questionIndex;
                                $isFirstQuestion = $questionIndex === 0; ?>
                                <article class="accordion-item">
                                    <h3 class="accordion-header" id="<?= $collapseId ?>Heading">
                                        <button class="accordion-button <?= $isFirstQuestion ? '' : 'collapsed' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?= $collapseId ?>" aria-expanded="<?= $isFirstQuestion ? 'true' : 'false' ?>" aria-controls="<?= $collapseId ?>">
                                            <span class="faqQuestionNumber"><?= $questionIndex + 1 ?>.</span>
                                            <span><?= Html::encode($qa[0]) ?></span>
                                        </button>
                                    </h3>
                                    <div id="<?= $collapseId ?>" class="accordion-collapse collapse <?= $isFirstQuestion ? 'show' : '' ?>" aria-labelledby="<?= $collapseId ?>Heading" data-bs-parent="#<?= $groupId ?>Accordion">
                                        <div class="accordion-body"><?= Html::encode($qa[1]) ?></div>
                                    </div>
                                </article>
                            <?php endforeach; ?>
                        </div>
                    </section>
                <?php endforeach; ?>
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
                <div class="homeFaqCta" style="display: flex; justify-content: center; margin-top: 20px;">
                    <a href="<?= Url::to(['site/blogs', 'language' => $language]) ?>" class="cmnBtn hoveranim "><span><?= $isAr ? 'عرض جميع المدونات' : 'See All Blogs' ?> →</span></a>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <!-- owl carousel  -->

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script>
        // serviceSlider

        // serviceSlider
        var mydir = $("html").attr("dir");

        if (mydir == 'rtl') {
            var rtlVal = true
        } else {
            var rtlVal = false
        }



        $('.serviceSlider').owlCarousel({

            rewind: true,
            autoplay: false,
            smartSpeed: 500,
            autoplayTimeout: 3500,
            autoplayHoverPause: true,
            nav: false,
            dots: false,
            items: 1,
            rtl: rtlVal,
            margin: 10,
            responsiveClass: true,
            responsive: {
                520: {
                    items: 2,
                    margin: 15,
                },
                768: {
                    items: 3,
                    margin: 15,
                },
                992: {
                    items: 3,
                    margin: 15,
                },
                1441: {
                    items: 3,
                    margin: 22,
                }
            }

        });



        // service section nav


        var serviceSlider = $('.serviceSlider');

        $('#service .customSlideNav.OwlNext').click(function() {
            serviceSlider.trigger('next.owl.carousel');
        });

        $('#service .customSlideNav.OwlPrev').click(function() {
            serviceSlider.trigger('prev.owl.carousel');
        });
    </script>
</div>