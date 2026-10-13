<?php

use yii\helpers\Url;
use common\models\Words;
use common\models\About;
use yii\widgets\ActiveForm;

$currentUrl = Url::to(Yii::$app->request->url, true);
?>
<section id="appointment" data-anchor="appointment" data-jarallax data-type="scroll" class="jarallax">
    <img src="<?= About::getValue('book_an_appointment_image', $language) ?>" data-src="<?= About::getValue('book_an_appointment_image', $language) ?>" class="lazy jarallax-img"
         loading="lazy" width="1920" height="720" alt="">
    <div class="container">
        <div class="appointMentBox wow animate__fadeInLeft" data-wow-duration="1.5s">
            <div class="imgBox">
                <img src="<?= Yii::$app->homeUrl ?>images/logIcon.svg" alt="">
            </div>
            <div class="title"><?= Words::getValue($language, 'book_appointment') ?></div>
            <?= \common\widgets\Alert::widget() ?>
            <?php $form = ActiveForm::begin(['id' => 'appointment-form']); ?>
            <div class="row">
                <input type="hidden" name="AppointmentEnquiry[page_url]" value="<?= $currentUrl ?>"/>
                <div class="col-lg-12">
                    <?= $form->field($model, 'name')->textInput(['placeholder' => Words::getValue($language, 'name') . ' *','required' => TRUE])->label(FALSE) ?>
                </div>
                <div class="col-lg-6">
                    <?= $form->field($model, 'age')->textInput(['placeholder' => Words::getValue($language, 'age') . ' *','required' => TRUE])->label(FALSE) ?>
                </div>
                <div class="col-lg-6">
                    <?php
                    echo $form->field($model, 'gender')
                            ->dropDownList(
                                    $genders, // Flat array ('id'=>'label')
                                    ['prompt' => Words::getValue($language, 'gender') . ' *', 'class' => 'select select2','required' => TRUE]    // options
                            )->label(FALSE);
                    ?>
                    
                    <!--<div class="form-group field-appointmentenquiry-gender required">-->
                    <!--    <select name="AppointmentEnquiry[gender]" class="select select2" required>-->
                    <!--        <option value=""><?php echo Words::getValue($language, 'gender') . ' *'; ?></option>-->
                    <!--        <?php foreach ($genders as $id => $label): ?>-->
                    <!--            <option value="<?php echo $id; ?>"><?php echo $label; ?></option>-->
                    <!--        <?php endforeach; ?>-->
                    <!--    </select>-->
                    <!--</div>-->
                </div>
                <div class="col-lg-12">
                    <?= $form->field($model, 'phone_number')->textInput(['placeholder' => Words::getValue($language, 'phone_no') . ' *'])->label(FALSE) ?>
                </div>
                <div class="col-lg-12">
                    <?= $form->field($model, 'email')->textInput(['placeholder' => Words::getValue($language, 'email') . ' *','required' => TRUE])->label(FALSE) ?>
                </div>
                <!--<div class="col-sm-12">-->
                <!--    <?php // $form->field($model, 'appointment_date')->textInput(['placeholder' => Words::getValue($language, 'your_preferred_date') . ' *', 'id' => 'dateInput'])->label(FALSE) ?>-->
                <!--</div>-->
                <div class="col-sm-12">
                            <div class="dateBx">
                                <div class="icon">
                                    <svg id="Group_21637" data-name="Group 21637" xmlns="http://www.w3.org/2000/svg"
                                        width="18.895" height="18.895" viewBox="0 0 18.895 18.895">
                                        <g id="Group_21636" data-name="Group 21636">
                                            <g id="Group_21635" data-name="Group 21635">
                                                <ellipse id="Ellipse_23" data-name="Ellipse 23" cx="1.176" cy="0.588"
                                                    rx="1.176" ry="0.588" transform="translate(12.935 7.055)"
                                                    fill="#888" />
                                                <path id="Path_237" data-name="Path 237"
                                                    d="M15.942,1.476h-.959V.738a.738.738,0,1,0-1.476,0v.738H10.148V.738a.738.738,0,0,0-1.476,0v.738H5.351V.738a.738.738,0,0,0-1.476,0v.738H2.952A2.956,2.956,0,0,0,0,4.428V15.942a2.956,2.956,0,0,0,2.952,2.952H8.6a.738.738,0,0,0,0-1.476H2.952a1.478,1.478,0,0,1-1.476-1.476V4.428A1.478,1.478,0,0,1,2.952,2.952h.923V3.69a.738.738,0,0,0,1.476,0V2.952H8.672V3.69a.738.738,0,1,0,1.476,0V2.952h3.358V3.69a.738.738,0,0,0,1.476,0V2.952h.959a1.478,1.478,0,0,1,1.476,1.476V8.635a.738.738,0,1,0,1.476,0V4.428A2.956,2.956,0,0,0,15.942,1.476Z"
                                                    fill="#888" />
                                                <path id="Path_238" data-name="Path 238"
                                                    d="M274.465,270a4.465,4.465,0,1,0,4.465,4.465A4.47,4.47,0,0,0,274.465,270Zm0,7.454a2.989,2.989,0,1,1,2.989-2.989A2.993,2.993,0,0,1,274.465,277.454Z"
                                                    transform="translate(-260.036 -260.036)" fill="#888" />
                                                <path id="Path_239" data-name="Path 239"
                                                    d="M372.808,331.513h-.332v-.775a.738.738,0,1,0-1.476,0v1.513a.738.738,0,0,0,.738.738h1.07a.738.738,0,0,0,0-1.476Z"
                                                    transform="translate(-357.309 -317.822)" fill="#888" />
                                                <ellipse id="Ellipse_24" data-name="Ellipse 24" cx="1.176" cy="0.588"
                                                    rx="1.176" ry="0.588" transform="translate(9.407 7.055)"
                                                    fill="#888" />
                                                <circle id="Ellipse_25" data-name="Ellipse 25" cx="1.176" cy="1.176"
                                                    r="1.176" transform="translate(7.055 9.407)" fill="#888" />
                                                <ellipse id="Ellipse_26" data-name="Ellipse 26" cx="1.176" cy="0.588"
                                                    rx="1.176" ry="0.588" transform="translate(3.528 7.055)"
                                                    fill="#888" />
                                                <circle id="Ellipse_27" data-name="Ellipse 27" cx="1.176" cy="1.176"
                                                    r="1.176" transform="translate(3.528 9.407)" fill="#888" />
                                                <circle id="Ellipse_28" data-name="Ellipse 28" cx="1.176" cy="1.176"
                                                    r="1.176" transform="translate(3.528 12.935)" fill="#888" />
                                                <circle id="Ellipse_29" data-name="Ellipse 29" cx="1.176" cy="1.176"
                                                    r="1.176" transform="translate(7.055 12.935)" fill="#888" />
                                                <ellipse id="Ellipse_30" data-name="Ellipse 30" cx="1.176" cy="0.588"
                                                    rx="1.176" ry="0.588" transform="translate(7.055 7.055)"
                                                    fill="#888" />
                                            </g>
                                        </g>
                                    </svg>

                                </div>
                                <input required="" type="text" id="eventDate" name="AppointmentEnquiry[appointment_date]" data-input class="form-control datepicker"
                                    placeholder="<?= Words::getValue($language, 'your_preferred_date') ?> *" required>

                            </div>
                        </div>
                <div class="col-lg-12">
                    <?php
                    echo $form->field($model, 'service')
                            ->dropDownList(
                                    $services, // Flat array ('id'=>'label')
                                    ['prompt' => Words::getValue($language, 'select_department'), 'class' => 'select select2','required' => TRUE]    // options
                            )->label(FALSE);
                    ?>
                </div>
                <div class="col-lg-12">
                                           <?= $form->field($model, 'message')->textarea(['placeholder' => Words::getValue($language, 'message')])->label(FALSE) ?>
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

