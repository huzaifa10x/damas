<?php

/** @var yii\web\View $this */
use yii\helpers\Url;
use common\models\Words;

// $this->params['breadcrumbs'][] = $this->title;
// $this->title = 'Damas | Careers';
?>

<div id="pageWrapper" class="careerPage">
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
                <li class="active"><?= Words::getValue($language, 'careers') ?></li>
            </ul>
        </div>
    </section>

    <!-- Breadcrumb end -->

    <section id="career">
        <div class="container">
            
            
            
            <!-- <div class="emptyBx">-->
            <!--    <div class="title">No data found</div>-->
            <!--</div>-->
        
            <div class="accordion" id="carrerAccord">
                <?php
                if (!empty($datas)) {
                    $i = 0;
                    foreach ($datas as $career) {
                        $i++;
                        ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading<?= $i ?>">
                                <button class="accordion-button <?= $i == 1 ? '' : 'collapsed' ?>" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#carrerAccord<?= $i ?>" aria-expanded="<?= $i == 1 ? 'true' : '' ?>" aria-controls="carrerAccord<?= $i ?>">
                                    <div class="flxBx">
                                        <div class="item">
                                            <div class="title"><?= $language == 'ar' ? $career->title_arabic : $career->title ?></div>
                                            <div class="cmnTxt"><?= date("d F, Y", strtotime($career->created_at)); ?></div>
                                        </div>
                                        <div class="item">
                                            <div class="cmnTxt clr"><?= Words::getValue($language, "experience") ?>: <span><?= $language == 'ar' ? $career->experience_arabic : $career->experience ?></span></div>
                                            <div class="cmnTxt"><?= Words::getValue($language, "location") ?>: <span><?= $language == 'ar' ? $career->location_arabic : $career->location ?></span></div>
                                        </div>
                                        <div class="item">
                                            <a href="javscript:void(0)" class="viewMore">
                                                <span class="clse"><?= Words::getValue($language, "view_more") ?></span>
                                                <span class="opn"><?= Words::getValue($language, "view_less") ?></span>
                                            </a>
                                        </div>
                                    </div>

                                </button>
                            </h2>
                            <div id="carrerAccord<?= $i ?>" class="accordion-collapse collapse <?= $i == 1 ? 'show' : '' ?>" aria-labelledby="heading<?= $i ?>"
                                 data-bs-parent="#carrerAccord">
                                <div class="accordion-body">
                                    <?= $language == 'ar' ? $career->description_arabic : $career->description ?>
                                    <ul>
                                        <li><?= Words::getValue($language, "experience") ?>: <span><?= $language == 'ar' ? $career->experience_arabic : $career->experience ?></span></li>
                                        <li><?= Words::getValue($language, "location") ?>: <span><?= $language == 'ar' ? $career->location_arabic : $career->location ?></span></li>
                                    </ul>

                                    <a href="javascript:void(0)" class="cmnBtn hoveranim career-apply" data-id="<?= $career->id ?>" data-experience="<?= $language == 'ar' ? $career->experience_arabic : $career->experience ?>" data-title="<?= $language == 'ar' ? $career->title_arabic : $career->title ?>" data-bs-toggle="modal" data-bs-target="#applyModal">
                                        <span><?= Words::getValue($language, "apply_now") ?></span>
                                    </a>

                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </section>



    <div class="modal fade bookingModal applymodal" id="applyModal" tabindex="-1" aria-labelledby="applyModal"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <a href="javascript:void(0)" class="closeBtn" data-bs-dismiss="modal" aria-label="Close">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="27.764" height="27.764"
                             viewBox="0 0 27.764 27.764">
                        <g id="Group_11467" data-name="Group 11467" transform="translate(-2 -2)">
                        <path id="Path_12146" data-name="Path 12146"
                              d="M9.185,8.2a.694.694,0,0,0-.982.982l4.368,4.368L8.2,17.921a.694.694,0,0,0,.982.982l4.368-4.368L17.921,18.9a.694.694,0,1,0,.982-.982l-4.368-4.368L18.9,9.185a.694.694,0,0,0-.982-.982l-4.368,4.368Z"
                              transform="translate(2.329 2.329)" />
                        <path id="Path_12147" data-name="Path 12147"
                              d="M2,8.941A6.941,6.941,0,0,1,8.941,2H22.823a6.941,6.941,0,0,1,6.941,6.941V22.823a6.941,6.941,0,0,1-6.941,6.941H8.941A6.941,6.941,0,0,1,2,22.823ZM8.941,3.388H22.823a5.553,5.553,0,0,1,5.553,5.553V22.823a5.553,5.553,0,0,1-5.553,5.553H8.941a5.553,5.553,0,0,1-5.553-5.553V8.941A5.553,5.553,0,0,1,8.941,3.388Z"
                              fill-rule="evenodd" />
                        </g>
                        </svg>
                    </div>
                </a>

                <div class="modal-body">
                    <div class="flxBx">
                        <div class="lftBx">
                            <div class="imgBx">
                                <img src="<?= Yii::$app->homeUrl ?>images/popup.jpg" data-src="<?= Yii::$app->homeUrl ?>images/popup.jpg" width="700"
                                     height="630" alt="popupBg">
                            </div>
                        </div>
                        <div class="rtSec">
                            <div class="appointMentBox ">
                                <div class="imgBox">
                                    <img src="<?= Yii::$app->homeUrl ?>images/logIcon.svg" alt="Icon">
                                </div>
                                <div class="title"><?= Words::getValue($language, "apply_now") ?></div>
                                <form id="career-enquiry" enctype="multipart/form-data">
                                    <input type="text" value="1" name="honeypot" style="display: none;">
                                    <input type="hidden" value="" name="job_id" id="job_id" />
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="formGroup">
                                                <input type="text" class="form-control" placeholder="<?= Words::getValue($language, "enter_your_name") ?>" name="name" required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="formGroup">
    <input type="text" class="form-control" 
           pattern="^\+?[0-9\s\-]{7,15}$" 
           title="Phone number should be 7 to 15 digits, and can include spaces, hyphens, and an optional plus sign." 
           placeholder="<?= Words::getValue($language, 'enter_your_phone_number') ?>" 
           name="phone" required>
</div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="formGroup">
    <input type="email" class="form-control" 
           pattern="^[^@]+@[^@]+\.[^@]+$" 
           title="Please enter a valid email address with a proper domain (e.g., user@example.com)." 
           placeholder="<?= Words::getValue($language, 'enter_your_email_id') ?>" 
           name="email" required>
</div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="formGroup">
                                                <div class="fileUploadInput">
                                                    <label for="file-upload" class="form-control file-label">
                                                        <?= Words::getValue($language, "upload_cv") ?>
                                                    </label>
                                                    <input id="file-upload" name="resume" type="file" accept=".pdf,.doc,.docx" required="">
                                                    <div class="iconBx">
                                                        <div class="icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="8.494"
                                                                 height="16.988" viewBox="0 0 8.494 16.988">
                                                            <path id="path2"
                                                                  d="M13.247,17.774a3.034,3.034,0,0,1-3.034-3.034V5.032a1.819,1.819,0,0,1,1.819-1.819h0a1.819,1.819,0,0,1,1.819,1.819v8.5a.606.606,0,0,1-.605.605h0a.607.607,0,0,1-.607-.607V6.247a.607.607,0,0,0-1.213,0v7.281a1.82,1.82,0,0,0,1.82,1.82h0a1.819,1.819,0,0,0,1.819-1.819v-8.5A3.033,3.033,0,0,0,12.035,2h0A3.033,3.033,0,0,0,9,5.032v9.709a4.247,4.247,0,1,0,8.494,0V6.247a.607.607,0,0,0-1.213,0v8.494a3.033,3.033,0,0,1-3.034,3.034Z"
                                                                  transform="translate(-9 -2)" fill="#763813"
                                                                  fill-rule="evenodd" />
                                                            </svg>
                                                        </div>
                                                        <?= Words::getValue($language, "attach_file") ?>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-lg-12">
                                            <button class="hoveranim cmnBtn" type="submit" id="sbt_button">
                                                <span><?= Words::getValue($language, "submit") ?></span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#file-upload').change(function () {
                var labelElement = $(this).closest('.fileUploadInput').find("label");
                var file = this.files[0].name;
                labelElement.text(file);
            });
            
            $('.career-apply').click(function (e) {
                $("#job_id").val($(this).attr('data-title'));
            });

            $(document).on('submit', '#career-enquiry', function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                grecaptcha.ready(function () {
                    grecaptcha.execute('6Lc3TJgpAAAAAHVnvfpARQYHFU2stIzamHVLiWbE', {action: 'submit'}).then(function (token) {
                        $.ajax({
                            type: "POST",
                            url: '<?= Yii::$app->homeUrl ?>en/career-enquiry',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (data) {
                                if (data != 0) {
                                    $("#career-enquiry").after('<div id="subscribe-msg" class="action-alert success" style="color:green;"><?= Words::getValue($language, "career_enquiry_message") ?></div>');
                                    $('#career-enquiry')[0].reset();
                                    $(".file-label").text('<?= Words::getValue($language, "attach_file") ?>');
                                    setTimeout(function () {
                                        $("#subscribe-msg").remove();
                                    }, 3000);
                                }
                            }
                        });
                    });
                });
            });
        });
    </script>

</div>
