<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use common\models\Words;

// $this->params['breadcrumbs'][] = $this->title;
// $this->title = 'Damas | Contact Us';
?>

<?php
// Register the Google reCAPTCHA script in the view
$this->registerJsFile(
    'https://www.google.com/recaptcha/api.js',
    ['position' => \yii\web\View::POS_HEAD, 'async' => true, 'defer' => true]
);
?>

<div id="pageWrapper" class="contactPage">
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
                <li class="active"><?= Words::getValue($language, 'contact_us') ?></li>
            </ul>
        </div>
    </section>

    <!-- Breadcrumb end -->

    <section id="contact">
        <div class="container">
            <div class="mainHead">
                <div class="head"><?= Words::getValue($language, 'talk_to_expert') ?></div>
            </div>
            <div class="row">
                <div class="col-lg-5">
                    <div class="contactbx">

                        <div class="item">
                            <div class="mainTxt"><?= Words::getValue($language, 'address') ?></div>

                            <ul class="links cnt">
                                <li>
                                    <div class="linkBtn contLink">
                                        <span>
                                            <?= $language == 'ar' ? $data->address_arabic : $data->address ?> 
                                        </span>
                                    </div>
                                </li>
                                <li>
                                    <a href="<?= $data->location_link ?>" target="_blank" class="locationBtn">
                                        <div class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="17.307" height="24.614"
                                                 viewBox="0 0 17.307 24.614">
                                                <g id="Group_21984" data-name="Group 21984" transform="translate(-76)">
                                                    <g id="Google_Maps_2_" transform="translate(76.462 7.86)">
                                                        <g id="Group_21982" data-name="Group 21982"
                                                           transform="translate(0)">
                                                            <path id="Path_11189" data-name="Path 11189"
                                                                  d="M94.585,168.548l-2.642,4.084-2.521,1.079a16.98,16.98,0,0,1-3.822-6.274l1.51-2.808,2.428-1.13a4.776,4.776,0,0,0-.072.793,4.339,4.339,0,0,0,4.327,4.327A4.777,4.777,0,0,0,94.585,168.548Z"
                                                                  transform="translate(-85.6 -163.5)" fill="#ffda2d" />
                                                        </g>
                                                    </g>
                                                    <path id="Path_11190" data-name="Path 11190"
                                                          d="M244.548,20.58a4.722,4.722,0,0,0,.072-.789,4.339,4.339,0,0,0-4.321-4.327h-.005a4.771,4.771,0,0,0-.793.072l3.836-3.836a8.632,8.632,0,0,1,5.048,5.048l-3.836,3.836S244.548,20.581,244.548,20.58Z"
                                                          transform="translate(-155.64 -11.138)" fill="#80aef8" />
                                                    <path id="Path_11191" data-name="Path 11191"
                                                          d="M264.119,16.748l-1.312,2.562-2.524,1.274s0,0,0,0a4.719,4.719,0,0,0,.072-.789,4.34,4.34,0,0,0-4.321-4.327h0v-.723l.864-1.922,2.178-1.12A8.632,8.632,0,0,1,264.119,16.748Z"
                                                          transform="translate(-171.375 -11.138)" fill="#4086f4" />
                                                    <g id="Group_21983" data-name="Group 21983"
                                                       transform="translate(80.283 5.61)">
                                                        <path id="Path_11192" data-name="Path 11192"
                                                              d="M177.559,116.7l-3.836,3.836A4.371,4.371,0,0,1,170.261,124h0l-4.176,4.176-.987.987c.245.274.462.519.692.779,1.586,1.8,2.957,3.457,2.957,5.043a.721.721,0,1,0,1.442,0c0-1.586,1.37-3.24,2.957-5.043,2.221-2.5,4.976-5.61,4.976-10.2A8.264,8.264,0,0,0,177.559,116.7Z"
                                                              transform="translate(-165.098 -116.7)" fill="#59c36a" />
                                                        <path id="Path_11193" data-name="Path 11193"
                                                              d="M264.12,116.7l-3.836,3.836h0A4.371,4.371,0,0,1,256.823,124h0l-.792.792V135.7a.714.714,0,0,0,.72-.721c0-1.586,1.37-3.24,2.957-5.043,2.221-2.5,4.976-5.61,4.976-10.2a8.263,8.263,0,0,0-.562-3.043Z"
                                                              transform="translate(-251.659 -116.7)" fill="#00a66c" />
                                                    </g>
                                                    <g id="Google_Maps_3_" transform="translate(84.655 12.908)">
                                                        <path id="Path_11194" data-name="Path 11194"
                                                              d="M256.031,269.292l.792-.792a4.794,4.794,0,0,1-.792.072Z"
                                                              transform="translate(-256.031 -268.5)" fill="#fdbf00" />
                                                    </g>
                                                    <path id="Path_11195" data-name="Path 11195"
                                                          d="M137.958.562,134.122,4.4a4.377,4.377,0,0,0-2.264,1.2l-2.231-.933L128.8,2.538A8.573,8.573,0,0,1,134.915,0,8.264,8.264,0,0,1,137.958.562Z"
                                                          transform="translate(-50.262 0)" fill="#4086f4" />
                                                    <path id="Path_11196" data-name="Path 11196"
                                                          d="M256.031,3.607,259.073.565A8.263,8.263,0,0,0,256.031,0v3.6Z"
                                                          transform="translate(-171.376 -0.003)" fill="#4175df" />
                                                    <path id="Path_11197" data-name="Path 11197"
                                                          d="M81.6,55.857a4.378,4.378,0,0,0-1.2,2.264l-3.937,3.937A10.888,10.888,0,0,1,76,58.915,8.573,8.573,0,0,1,78.538,52.8Z"
                                                          transform="translate(0 -50.262)" fill="#f03800" />
                                                </g>
                                            </svg>

                                        </div>
                                        <span><?= Words::getValue($language, 'our_location_map') ?></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="item">
                            <div class="mainTxt"><?= Words::getValue($language, 'phone') ?></div>
                            <ul class="links callBx">
                                <li>
                                    <div class="cnBx">
                                        <div class="icon">
                                            <svg id="call_1_" data-name="call (1)" xmlns="http://www.w3.org/2000/svg"
                                                 width="16.089" height="16.089" viewBox="0 0 16.089 16.089">
                                                <g id="Group_22629" data-name="Group 22629">
                                                    <path id="Path_103719" data-name="Path 103719"
                                                          d="M14.8,10.56a9.135,9.135,0,0,1-2.869-.457,1.311,1.311,0,0,0-1.275.269L8.845,11.738A10,10,0,0,1,4.35,7.244L5.675,5.482A1.3,1.3,0,0,0,6,4.165a9.149,9.149,0,0,1-.459-2.873A1.292,1.292,0,0,0,4.246,0H1.291A1.292,1.292,0,0,0,0,1.291a14.814,14.814,0,0,0,14.8,14.8A1.292,1.292,0,0,0,16.089,14.8V11.851A1.293,1.293,0,0,0,14.8,10.56Z" />
                                                </g>
                                            </svg>
                                        </div>
                                        <div class="info">
                                            <a href="tel:<?= $data->phone1 ?>" class="linkBtn fw">
                                                <span> <?= $data->phone1 ?> </span>
                                                <div class="Txt"><?= Words::getValue($language, 'phone_no1_description') ?></div>
                                            </a>
                                            <a href="tel:<?= $data->phone2 ?>" class="linkBtn fw">
                                                <span> <?= $data->phone2 ?> </span>
                                                <div class="Txt"><?= Words::getValue($language, 'phone_no2_description') ?></div>
                                            </a>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <div class="mainTxt"><?= Words::getValue($language, 'email') ?></div>
                                    <a href="mailto:<?= $data->email ?>" class="linkBtn  ">
                                        <span><?= $data->email ?></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="socialBx">
                            <div class="mainTxt"><?= Words::getValue($language, 'social_media') ?></div>
                            <ul>
                                <?php
                                if($data->facebook_link != ''){
                                ?>
                                <li>
                                    <a href="<?= $data->facebook_link ?>" class="links" target="_blank">
                                        <div class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="13.247" height="23.339"
                                                 viewBox="0 0 13.247 23.339">
                                                <path id="facebook"
                                                      d="M9.929,5.777c.032-.036.181-.153.766-.153h1.919A1.133,1.133,0,0,0,13.746,4.49V1.136A1.134,1.134,0,0,0,12.616,0L9.766,0A5.866,5.866,0,0,0,5.441,1.678,6.159,6.159,0,0,0,3.812,6.091V7.9H1.632A1.133,1.133,0,0,0,.5,9.032v3.612a1.133,1.133,0,0,0,1.132,1.132H3.812v8.43a1.133,1.133,0,0,0,1.132,1.132H8.682a1.133,1.133,0,0,0,1.132-1.132v-8.43H12.48a1.133,1.133,0,0,0,1.132-1.132V9.032a1.136,1.136,0,0,0-.582-.99,1.15,1.15,0,0,0-.56-.142H9.814V6.471c0-.466.063-.634.115-.694Zm0,0"
                                                      transform="translate(-0.5 0)" />
                                            </svg>

                                        </div>
                                    </a>
                                </li>
                                <?php
                                }
                                if($data->instagram_link != ''){
                                ?>
                                <li>
                                    <a href="<?= $data->instagram_link ?>" target="_blank" class="links">
                                        <div class="icon">
                                            <svg id="instagram" xmlns="http://www.w3.org/2000/svg" width="23.72"
                                                 height="23.72" viewBox="0 0 23.72 23.72">
                                                <g id="Group_183" data-name="Group 183" transform="translate(0)">
                                                    <g id="Group_182" data-name="Group 182">
                                                        <path id="Path_143" data-name="Path 143"
                                                              d="M17.795,0H5.935A5.948,5.948,0,0,0,0,5.93V17.79a5.948,5.948,0,0,0,5.93,5.93h11.86a5.948,5.948,0,0,0,5.93-5.93V5.93A5.948,5.948,0,0,0,17.795,0Zm3.953,17.79a3.958,3.958,0,0,1-3.953,3.953H5.935A3.958,3.958,0,0,1,1.982,17.79V5.93A3.958,3.958,0,0,1,5.935,1.977h11.86A3.957,3.957,0,0,1,21.748,5.93V17.79Z"
                                                              transform="translate(-0.005 0)" />
                                                    </g>
                                                </g>
                                                <g id="Group_185" data-name="Group 185"
                                                   transform="translate(16.802 3.953)">
                                                    <g id="Group_184" data-name="Group 184">
                                                        <ellipse id="Ellipse_14" data-name="Ellipse 14" cx="1.482"
                                                                 cy="1.482" rx="1.482" ry="1.482" />
                                                    </g>
                                                </g>
                                                <g id="Group_187" data-name="Group 187"
                                                   transform="translate(5.93 5.93)">
                                                    <g id="Group_186" data-name="Group 186">
                                                        <path id="Path_144" data-name="Path 144"
                                                              d="M108.335,102.4a5.93,5.93,0,1,0,5.93,5.93A5.929,5.929,0,0,0,108.335,102.4Zm0,9.884a3.953,3.953,0,1,1,3.953-3.954A3.953,3.953,0,0,1,108.335,112.284Z"
                                                              transform="translate(-102.405 -102.4)" />
                                                    </g>
                                                </g>
                                            </svg>

                                        </div>
                                    </a>
                                </li>
                                <?php
                                }
                                if($data->youtube_link != ''){
                                ?>
                                <li>
                                    <a href="<?= $data->youtube_link ?>" target="_blank" class="links">
                                        <div class="icon" id="youtube">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="30.018" height="21.692"
                                                 viewBox="0 0 30.018 21.692">
                                                <path id="youtube"
                                                      d="M15.006,22.192H15c-.906-.006-8.913-.079-11.182-.693A4.639,4.639,0,0,1,.552,18.237,34.047,34.047,0,0,1,0,11.375,34.688,34.688,0,0,1,.55,4.461l0-.006A4.737,4.737,0,0,1,3.812,1.171l.012,0C6.067.578,14.091.506,15,.5h.016c.908.006,8.937.079,11.185.694A4.638,4.638,0,0,1,29.46,4.451a33.031,33.031,0,0,1,.553,6.95,34.141,34.141,0,0,1-.55,6.852l0,.006a4.64,4.64,0,0,1-3.266,3.263l-.006,0c-2.243.589-10.266.661-11.174.668h-.008ZM2.817,5.062a33.545,33.545,0,0,0-.472,6.3v.031a31.521,31.521,0,0,0,.472,6.239,2.287,2.287,0,0,0,1.61,1.6c1.674.453,8.2.6,10.579.612,2.39-.017,8.921-.155,10.583-.59a2.288,2.288,0,0,0,1.607-1.6,31.629,31.629,0,0,0,.472-6.239c0-.012,0-.025,0-.037A30.528,30.528,0,0,0,27.2,5.07v0a2.288,2.288,0,0,0-1.611-1.608c-1.658-.453-8.19-.6-10.579-.612-2.388.017-8.913.155-10.58.589a2.352,2.352,0,0,0-1.61,1.628ZM28.329,17.954h0Zm-16.311-1.86V6.6l8.208,4.749Zm0,0"
                                                      transform="translate(0.002 -0.5)" />
                                            </svg>

                                        </div>
                                    </a>
                                </li>
                                <?php
                                }
                                if($data->twitter_link != ''){
                                ?>

                                <li>
                                    <a href="<?= $data->twitter_link ?>" target="_blank" class="links">
                                        <div class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="21.407" height="20.793"
                                                 viewBox="0 0 21.407 20.793">
                                                <path id="Path_321" data-name="Path 321"
                                                      d="M24.711,8.381,31.921,0H30.213l-6.26,7.277L18.952,0H13.185l7.561,11-7.561,8.789h1.709L21.5,12.108l5.281,7.685h5.767L24.711,8.381Zm-2.34,2.72-.766-1.1-6.1-8.719h2.624l4.919,7.037.766,1.1,6.395,9.146H27.589L22.371,11.1Z"
                                                      transform="translate(-12.095 0.5)" stroke-width="1" />
                                            </svg>

                                        </div>
                                    </a>
                                </li>
                                <?php
                                }
                                if($data->threads_link != ''){
                                ?>
                                <li>
                                    <a href="<?= $data->threads_link ?>" target="_blank" class="links">
                                        <div class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="23.158" height="26.396"
                                                 viewBox="0 0 23.158 26.396">
                                                <path id="threads"
                                                      d="M43.186,26.4h-.008c-3.938-.027-6.966-1.325-9-3.86-1.811-2.256-2.744-5.395-2.776-9.328v-.019c.031-3.934.965-7.072,2.776-9.328,2.033-2.535,5.062-3.834,9-3.86h.015A12.149,12.149,0,0,1,50.7,2.306a11.108,11.108,0,0,1,3.86,6.013l-2.243.626C51.1,4.59,48.032,2.364,43.185,2.329c-3.2.023-5.619,1.029-7.192,2.989C34.52,7.153,33.759,9.8,33.731,13.2c.029,3.394.79,6.045,2.262,7.879,1.573,1.96,3.992,2.966,7.192,2.989,2.884-.021,4.793-.693,6.38-2.248a4.724,4.724,0,0,0,1.2-5.276,4.238,4.238,0,0,0-1.8-1.923,7.266,7.266,0,0,1-1.413,3.6,5.383,5.383,0,0,1-4.1,1.969A6.037,6.037,0,0,1,39.87,19.3a4.125,4.125,0,0,1-.466-6.649,6.5,6.5,0,0,1,3.94-1.419,15.076,15.076,0,0,1,3.321.157,3.824,3.824,0,0,0-.822-1.932,3.318,3.318,0,0,0-2.6-.98h-.032a3.452,3.452,0,0,0-2.994,1.451l-1.933-1.3a5.715,5.715,0,0,1,4.926-2.48h.048c3.514.022,5.607,2.171,5.815,5.925.12.05.237.1.353.157A6.814,6.814,0,0,1,52.9,15.609a7.038,7.038,0,0,1-1.7,7.874c-2.032,1.99-4.5,2.889-8,2.913h-.007Zm1.1-12.859c-.266,0-.536.008-.812.024-2.02.114-3.279,1.039-3.207,2.357.075,1.38,1.6,2.022,3.061,1.943,1.347-.072,3.1-.6,3.394-4.081a11.7,11.7,0,0,0-2.435-.242Z"
                                                      transform="translate(-31.403)" />
                                            </svg>

                                        </div>
                                    </a>
                                </li>
                                <?php
                                }
                                if($data->linkedin_link != ''){
                                ?>
                                <li>
                                    <a href="<?= $data->linkedin_link ?>" target="_blank" class="links">
                                        <div class="icon">
                                            <svg id="Group_176" data-name="Group 176" xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="22.755"
                                                 height="21.749" viewBox="0 0 22.755 21.749">
                                                <defs>
                                                    <clipPath id="clip-path">
                                                        <rect id="Rectangle_91" data-name="Rectangle 91" width="22.754"
                                                              height="21.749" />
                                                    </clipPath>
                                                </defs>
                                                <g id="Group_175" data-name="Group 175">
                                                    <g id="Group_174" data-name="Group 174" clip-path="url(#clip-path)">
                                                        <path id="Path_139" data-name="Path 139"
                                                              d="M2.759,0A2.542,2.542,0,1,0,2.7,5.071h.032A2.543,2.543,0,1,0,2.759,0" />
                                                        <rect id="Rectangle_90" data-name="Rectangle 90" width="4.878"
                                                              height="14.675" transform="translate(0.288 7.074)" />
                                                        <path id="Path_140" data-name="Path 140"
                                                              d="M230.273,189.108c-2.631,0-4.4,2.473-4.4,2.473v-2.128H221v14.675h4.878v-8.195a3.343,3.343,0,0,1,.161-1.19,2.67,2.67,0,0,1,2.5-1.784c1.765,0,2.471,1.346,2.471,3.318v7.85h4.877v-8.414c0-4.507-2.407-6.6-5.616-6.6"
                                                              transform="translate(-213.134 -182.378)" />
                                                    </g>
                                                </g>
                                            </svg>

                                        </div>
                                    </a>
                                </li>
                                <?php
                                }
                                ?>
                            </ul>

                        </div>
                    </div>
                </div>

                <div class="col-lg-7 contactUs">
                    <?php // \common\widgets\Alert::widget() ?>
                    <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                    <input type="text" value="1" name="honeypot" style="display: none;">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="itemList">
                                <div class="item">
                                    <div class="rd_bx ">
                                        <input type="radio" class="type" id="type" name="ContactEnquiry[type]" value="0"
                                               required="" data-trigger="contactus" checked="">
                                            <label for="type">
                                                <?= Words::getValue($language, 'enquiry') ?>
                                            </label>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="rd_bx ">
                                        <input type="radio" class="trigger type" id="type1" name="ContactEnquiry[type]"
                                               value="1" required="" data-trigger="contactus">
                                            <label for="type1">
                                                <?= Words::getValue($language, 'feedback') ?>
                                            </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <?= $form->field($model, 'name')->textInput(['placeholder' => Words::getValue($language, 'enter_your_name')])->label(FALSE) ?>
                        </div>
                        <div class="col-lg-6">
                             <?= $form->field($model, 'phone_number')->textInput(['placeholder' => Words::getValue($language, 'enter_your_phone_number')])->label(FALSE) ?>
                        </div>
                        <div class="col-lg-12">
                             <?= $form->field($model, 'email')->textInput(['placeholder' => Words::getValue($language, 'enter_your_email_id')])->label(FALSE) ?>
                        </div>
                        <div class="col-lg-12">
                            <?= $form->field($model, 'message')->textarea(['placeholder' => Words::getValue($language, 'message')])->label(FALSE) ?>
                        </div>

                        <!-- reCAPTCHA Checkbox -->
<div class="col-lg-12 mb-3">
    <div class="g-recaptcha" data-sitekey="6LeIN5stAAAAAH4T1_W3wKcBxlKmq8P-8bzJTga4"></div>
    
    <?php if ($model->hasErrors('reCaptcha')): ?>
        <div class="text-danger" style="margin-top: 5px;">
            <?= $model->getFirstError('reCaptcha') ?>
        </div>
    <?php endif; ?>
</div>
                    <div class="col-lg-12">
                             <?= Html::submitButton('<span>'.Words::getValue($language, "submit_message").'</span>', ['class' => 'hoveranim cmnBtn']) ?>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
    </section>
</div>
