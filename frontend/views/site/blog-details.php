<?php

/** @var yii\web\View $this */
use yii\helpers\Url;
use yii\helpers\Html;
use common\models\Words;

$homeUrl = Yii::$app->homeUrl;
$isAr = ($language === 'ar');
$title = $isAr ? $blog_details->title_arabic : $blog_details->title;
$description = $isAr ? $blog_details->description_arabic : $blog_details->description;
$moreDetails = $isAr ? $blog_details->more_details_arabic : $blog_details->more_details;
$blogImage = $homeUrl . 'uploads/blogs/' . $blog_details->main_image;
$department = \common\models\Departments::findOne($blog_details->department_id);
$departmentName = $department ? ($isAr ? $department->department_name_arabic : $department->department_name) : Words::getValue($language, 'blog');
$postUrl = Url::to(Yii::$app->request->url, true);
$blogDateIso = date('Y-m-d', strtotime($blog_details->date));
$blogDateLabel = $isAr ? date('Y/m/d', strtotime($blog_details->date)) : date('j F Y', strtotime($blog_details->date));
?>

<div id="pageWrapper" class="blogPage blogDetailPage" dir="<?= $isAr ? 'rtl' : 'ltr' ?>">
    <section class="blogArticleHero" aria-labelledby="blog-article-title">
        <img class="blogArticleHero__background" src="<?= $homeUrl ?>images/doctorsBg.webp" alt="" loading="eager" fetchpriority="high">
        <div class="blogArticleHero__overlay" aria-hidden="true"></div>
        <div class="blogArticleHero__content">
            <h1 id="blog-article-title"><?= Html::encode($title) ?></h1>
            <div class="blogArticleMeta">
                <span><span aria-hidden="true">
                    <svg fill="#814826" height="20px" width="20px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 432.836 432.836" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M393.277,52.929L218.486,0.301c-0.016-0.005-0.031-0.009-0.047-0.014l-0.036-0.011c-0.014-0.004-0.03-0.006-0.044-0.01 c-0.252-0.074-0.512-0.13-0.776-0.173c-0.067-0.011-0.133-0.022-0.199-0.031c-0.277-0.036-0.557-0.062-0.843-0.062 c-0.002,0-0.005,0-0.007,0c-0.001,0-0.003,0-0.004,0c-0.287,0-0.567,0.025-0.844,0.061c-0.067,0.009-0.133,0.02-0.199,0.03 c-0.263,0.043-0.522,0.098-0.774,0.171c-0.015,0.004-0.03,0.006-0.045,0.01l-0.038,0.011c-0.017,0.005-0.034,0.01-0.051,0.015 L39.693,52.586c-2.75,0.822-4.635,3.351-4.638,6.221l-0.122,129.724c-0.083,87.902,47.372,169.431,123.846,212.772l54.148,30.688 c0.011,0.006,0.022,0.01,0.033,0.016c0.228,0.128,0.464,0.242,0.707,0.342c0.035,0.014,0.07,0.025,0.105,0.039 c0.203,0.079,0.411,0.148,0.623,0.207c0.066,0.018,0.132,0.035,0.199,0.051c0.189,0.046,0.381,0.083,0.576,0.112 c0.065,0.01,0.13,0.022,0.195,0.03c0.25,0.03,0.503,0.049,0.761,0.049c0.002,0,0.004,0,0.006,0c0.258,0,0.512-0.019,0.762-0.048 c0.067-0.008,0.132-0.021,0.199-0.03c0.193-0.029,0.384-0.065,0.571-0.111c0.067-0.016,0.133-0.033,0.199-0.051 c0.211-0.058,0.417-0.126,0.618-0.204c0.036-0.014,0.072-0.025,0.108-0.04c0.243-0.099,0.478-0.212,0.704-0.339 c0.011-0.006,0.022-0.01,0.033-0.016l54.207-30.586c76.556-43.197,124.164-124.637,124.247-212.538l0.122-129.713 C397.906,56.289,396.025,53.757,393.277,52.929z M47.933,188.543L48.05,63.656l161.97-48.426l-0.017,18.53L70.419,75.493 c-2.75,0.822-4.635,3.351-4.638,6.221L65.681,188.56c-0.072,76.838,41.41,148.106,108.26,185.992l35.721,20.245l-0.019,20.39 l-44.454-25.194C92.784,348.958,47.854,271.768,47.933,188.543z M384.781,188.86c-0.079,83.224-45.154,160.331-117.636,201.229 l-44.502,25.11l0.019-20.39l35.761-20.178c66.92-37.761,108.537-108.95,108.609-185.787l0.031-33.03 c0.003-3.59-2.904-6.503-6.494-6.506c-0.002,0-0.004,0-0.006,0c-3.587,0-6.497,2.906-6.5,6.494l-0.031,33.03 c-0.068,72.16-39.151,139.016-101.998,174.478l-35.862,20.235l-35.821-20.302c-62.78-35.58-101.738-102.509-101.67-174.669 l0.096-102.01l137.714-41.174L354.128,86.83l-0.024,25.647c-0.004,3.59,2.904,6.503,6.494,6.506c0.002,0,0.004,0,0.006,0 c3.587,0,6.496-2.906,6.5-6.494l0.029-30.483c0.003-2.871-1.878-5.403-4.626-6.23L223.003,33.773l0.017-18.53l161.877,48.74 L384.781,188.86z M263.14,83.972c-0.063,0-0.127,0-0.19,0l-0.662,0.002c-11.939,0.041-22.942,6.292-29.432,16.72 c-3.557,5.715-9.688,9.125-16.406,9.125c-0.006,0-0.013,0-0.019,0c-6.726-0.006-12.859-3.429-16.407-9.156 c-6.47-10.441-17.461-16.712-29.394-16.776l-0.662-0.004c-0.098,0-0.191,0-0.289,0c-28.598,0-52.445,23.163-53.22,51.766 c-0.158,5.893,0.64,11.707,2.387,17.328l17.87,56.036c0.049,22.333,4.775,56.07,15.189,78.605l23.083,49.947 c2.359,6.717,8.548,11.247,15.529,11.317c0.059,0.001,0.116,0.001,0.174,0.001c4.388,0,8.516-1.695,11.639-4.784 c3.165-3.13,4.91-7.305,4.914-11.756c0.001-0.602-0.083-1.202-0.247-1.781c-4.477-15.784-13.513-60.16-1.729-75.736 c2.624-3.468,6.122-5.083,11.009-5.083c0.007,0,0.015,0,0.021,0c4.759,0.004,8.175,1.589,10.75,4.988 c11.729,15.48,2.828,59.822-1.592,75.601c-0.159,0.569-0.24,1.158-0.241,1.749c-0.008,8.563,6.797,16.097,15.17,16.794 c0.471,0.039,0.938,0.059,1.404,0.059c6.991,0,13.224-4.362,15.582-11.016l23.287-50.214c10.433-22.495,15.211-56.2,15.299-78.539 l17.991-56.048c1.742-5.572,2.551-11.385,2.403-17.278C315.633,107.199,291.778,83.972,263.14,83.972z M301.556,149.188 l-18.286,56.969c-0.207,0.647-0.313,1.37-0.311,2.05c0.053,20.902-4.335,52.983-14.093,74.025l-23.431,50.524 c-0.109,0.235-0.204,0.476-0.284,0.721c-0.514,1.576-2.028,2.574-3.688,2.441c-1.446-0.121-2.868-1.608-3.184-3.188 c2.765-10.202,16.072-63.479-0.865-85.845c-5.019-6.627-12.316-10.135-21.104-10.143c-0.011,0-0.021,0-0.031,0 c-8.92,0-16.313,3.543-21.383,10.246c-17.009,22.494-3.517,75.804-0.716,86.012c-0.133,0.7-0.474,1.343-0.992,1.855 c-0.68,0.672-1.6,1.017-2.539,1.027c-1.505-0.016-2.916-1.14-3.433-2.734c-0.079-0.247-0.174-0.489-0.283-0.725l-23.228-50.26 c-8.419-18.218-12.799-44.67-13.776-65.024c12.652,3.886,37.273,10.044,66.39,10.072c0.063,0,0.125,0,0.189,0 c15.837,0,32.321-1.859,48.993-5.527c3.506-0.771,5.723-4.239,4.952-7.745c-0.771-3.505-4.231-5.725-7.745-4.952 c-0.489,0.107-0.976,0.198-1.464,0.303l7.173-18.151c1.319-3.338-0.317-7.114-3.656-8.434c-3.338-1.32-7.113,0.317-8.434,3.656 L246.2,211.996c-10.088,1.465-20.025,2.217-29.69,2.217c-0.059,0-0.119,0-0.178,0c-10.921-0.01-21.236-0.964-30.442-2.334 l-10.057-25.592c-1.314-3.341-5.084-4.985-8.428-3.672c-3.341,1.313-4.984,5.086-3.672,8.427l7.104,18.077 c-10.552-2.299-18.447-4.791-22.403-6.146l-17.189-53.899c-1.309-4.21-1.91-8.609-1.79-13.073 c0.584-21.615,18.606-39.117,40.213-39.117c0.073,0,0.146,0,0.219,0.001l0.667,0.004c7.436,0.04,14.321,4.011,18.419,10.623 c5.933,9.575,16.192,15.298,27.446,15.309c0.011,0,0.02,0,0.03,0c11.24,0,21.498-5.702,27.443-15.257 c4.11-6.604,11.003-10.563,18.498-10.589l0.598-0.002c0.049,0,0.095,0,0.144,0c21.649,0,39.681,17.553,40.225,39.192 C303.469,140.628,302.858,145.026,301.556,149.188z"></path> </g></svg>
                </span> <?= Html::encode($departmentName) ?></span>
                <span><span aria-hidden="true">
                    <img src="https://damasmc.com/images/favicon.ico" width="20px" height="20px">
                </span> Damas Medical Center</span>
                <time datetime="<?= Html::encode($blogDateIso) ?>"><span aria-hidden="true">
                    <svg fill="#814826" width="20px" height="20px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" stroke="#814826"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M960 95.888l-256.224.001V32.113c0-17.68-14.32-32-32-32s-32 14.32-32 32v63.76h-256v-63.76c0-17.68-14.32-32-32-32s-32 14.32-32 32v63.76H64c-35.344 0-64 28.656-64 64v800c0 35.343 28.656 64 64 64h896c35.344 0 64-28.657 64-64v-800c0-35.329-28.656-63.985-64-63.985zm0 863.985H64v-800h255.776v32.24c0 17.679 14.32 32 32 32s32-14.321 32-32v-32.224h256v32.24c0 17.68 14.32 32 32 32s32-14.32 32-32v-32.24H960v799.984zM736 511.888h64c17.664 0 32-14.336 32-32v-64c0-17.664-14.336-32-32-32h-64c-17.664 0-32 14.336-32 32v64c0 17.664 14.336 32 32 32zm0 255.984h64c17.664 0 32-14.32 32-32v-64c0-17.664-14.336-32-32-32h-64c-17.664 0-32 14.336-32 32v64c0 17.696 14.336 32 32 32zm-192-128h-64c-17.664 0-32 14.336-32 32v64c0 17.68 14.336 32 32 32h64c17.664 0 32-14.32 32-32v-64c0-17.648-14.336-32-32-32zm0-255.984h-64c-17.664 0-32 14.336-32 32v64c0 17.664 14.336 32 32 32h64c17.664 0 32-14.336 32-32v-64c0-17.68-14.336-32-32-32zm-256 0h-64c-17.664 0-32 14.336-32 32v64c0 17.664 14.336 32 32 32h64c17.664 0 32-14.336 32-32v-64c0-17.68-14.336-32-32-32zm0 255.984h-64c-17.664 0-32 14.336-32 32v64c0 17.68 14.336 32 32 32h64c17.664 0 32-14.32 32-32v-64c0-17.648-14.336-32-32-32z"></path></g></svg>
                </span> <?= Html::encode($blogDateLabel) ?></time>
            </div>
        </div>
    </section>

    <article class="blogArticle">
        <div class="blogArticleFeatured">
            <?php if (!empty($blog_details->video)): ?>
                <a href="<?= Html::encode($homeUrl . 'uploads/blogs/' . $blog_details->video) ?>" data-fancybox="blogVideo" aria-label="<?= Html::encode($isAr ? 'تشغيل فيديو المقال' : 'Play article video') ?>">
                    <img src="<?= Html::encode($blogImage) ?>" data-src="<?= Html::encode($blogImage) ?>" class="lazy" loading="lazy" decoding="async" width="1350" height="562" alt="<?= Html::encode($title) ?>">
                    <span class="blogArticlePlay" aria-hidden="true">▶</span>
                </a>
            <?php else: ?>
                <img src="<?= Html::encode($blogImage) ?>" data-src="<?= Html::encode($blogImage) ?>" class="lazy" loading="lazy" decoding="async" width="1350" height="562" alt="<?= Html::encode($title) ?>">
            <?php endif; ?>
        </div>

        <div class="blogArticleContent">
            <div class="blogArticleRichText"><?= $description ?></div>

            <?php foreach (['image1'] as $imageField):
                $galleryImage = $blog_details->$imageField;
                if (empty($galleryImage)) continue;
                $galleryUrl = $homeUrl . 'uploads/blogs/' . $galleryImage;
                ?>
                <figure class="blogArticleFigure">
                    <img src="<?= Html::encode($galleryUrl) ?>" class="lazy" loading="lazy" decoding="async" width="900" height="520" alt="<?= Html::encode($title) ?>">
                </figure>
            <?php endforeach; ?>

            <?php if (!empty(trim(strip_tags((string) $moreDetails)))): ?>
                <div class="blogArticleRichText blogArticleMoreDetails"><?= $moreDetails ?></div>
            <?php endif; ?>

            <div class="blogArticleShare">
                <strong><?= Html::encode($isAr ? 'شارك هذا المقال:' : 'Share This Post:') ?></strong>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?= rawurlencode($postUrl) ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                    <svg width="20px" height="20px" viewBox="-5 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>facebook [#176]</title> <desc>Created with Sketch.</desc> <defs> </defs> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="Dribbble-Light-Preview" transform="translate(-385.000000, -7399.000000)" fill="#ffffff"> <g id="icons" transform="translate(56.000000, 160.000000)"> <path d="M335.821282,7259 L335.821282,7250 L338.553693,7250 L339,7246 L335.821282,7246 L335.821282,7244.052 C335.821282,7243.022 335.847593,7242 337.286884,7242 L338.744689,7242 L338.744689,7239.14 C338.744689,7239.097 337.492497,7239 336.225687,7239 C333.580004,7239 331.923407,7240.657 331.923407,7243.7 L331.923407,7246 L329,7246 L329,7250 L331.923407,7250 L331.923407,7259 L335.821282,7259 Z" id="facebook-[#176]"> </path> </g> </g> </g> </g></svg>
                </a>
                <a href="https://twitter.com/intent/tweet?url=<?= rawurlencode($postUrl) ?>&text=<?= rawurlencode($title) ?>" target="_blank" rel="noopener noreferrer" aria-label="X">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16">
  <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/>
</svg>
                </a>
                <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= rawurlencode($postUrl) ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
  <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z"/>
</svg>
                </a>
                 <a href="https://wa.me/?text=<?= rawurlencode($title . ' ' . $postUrl) ?>" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
  <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
</svg> </a>
                <a type="button" class="blogArticleShare__instagram" role="button" data-share-instagram data-share-title="<?= Html::encode($title) ?>" data-share-url="<?= Html::encode($postUrl) ?>" aria-label="Share on Instagram" title="Share on Instagram">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
  <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
</svg>
            </a>
            </div>
        </div>
    </article>
</div>


<script>
document.querySelectorAll('[data-share-instagram]').forEach(function (button) {
    button.addEventListener('click', async function () {
        var shareData = { title: button.dataset.shareTitle, url: button.dataset.shareUrl };
        if (navigator.share) {
            try {
                await navigator.share(shareData);
                return;
            } catch (error) {
                if (error.name === 'AbortError') return;
            }
        }
        try {
            await navigator.clipboard.writeText(shareData.url);
            window.open('https://www.instagram.com/', '_blank', 'noopener,noreferrer');
            button.title = 'Link copied — paste it into Instagram';
        } catch (error) {
            window.open('https://www.instagram.com/', '_blank', 'noopener,noreferrer');
        }
    });
});
</script>