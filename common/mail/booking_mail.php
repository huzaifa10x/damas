<?php
$contact_data = common\models\ContactUs::findOne(1);
?>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
    <div style="margin:auto; width:700px;background: #ffffff;">
        <table id="Table_01" width="700" border="0" cellpadding="0" cellspacing="0" align="center"
               style="margin: auto;">
            <thead>
                <tr>
                    <td>
                        <table width="700" style="margin: auto; background-color: #d5ae692b;" border="0" cellpadding="0"
                               cellspacing="0" align="center">
                            <tbody>
                                <tr>
                                    <td style="text-align:center;padding: 10px 0;">
                                        <a style="display: block; margin: auto;" href="#!" target="_blank">
                                            <img src="<?= Yii::$app->params['filepath'] ?>images/logo.png" width="85" height="73">
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </thead>
            <tbody>
                
                <tr>
                    <td style="padding: 60px 60px 22px;">


                        <p
                            style="text-align: center; font-family: 'Open Sans', sans-serif;padding: 0px 20px 0px ; color: #2A2A2A; font-size: 16px; font-weight: 400; line-height: 26px; margin: 0; ">
                            Thank you for booking your service with Damas Medical Center. To confirm your preferred date and time, one of our professionals will reach out to you shortly.
                        </p>
                        <p
                            style="text-align: center; font-family: 'Open Sans', sans-serif;padding: 20px 20px 0px ; color: #2A2A2A; font-size: 16px; font-weight: 400; line-height: 26px; margin: 0; ">
                            If you would like to proceed with payment and finalize your booking, please visit our website to complete the payment online.
                        </p>
                        <p
                            style="text-align: center; font-family: 'Open Sans', sans-serif;padding: 20px 20px 0px ; color: #2A2A2A; font-size: 16px; font-weight: 400; line-height: 26px; margin: 0; ">
                            Preferred Date : <?= date("d", strtotime($model->appointment_date)); ?>th <?= date("F Y", strtotime($model->appointment_date)); ?>
                        </p>
                        <h4 style="text-align: center; font-family: 'Open Sans', sans-serif;padding: 4px 20px 30px ;border-bottom: 1px solid #d0ac2a2b; color: #2A2A2A; font-size: 15px; font-weight: 700; line-height: 26px; margin: 0; ">DAMAS MEDICAL CENTER</h4>
                    </td>


                </tr>
                <tr>
                    <td style="padding: 30px 0 43px;">
                        
                        <p
                            style="font-size: 16px;font-family: 'Open Sans', sans-serif; color: #7E7E7E; font-weight: 400;margin: 0; text-align: center; margin-bottom: 0px; padding: 0px 60px 0px 60px;">
                            Should you have any questions or need further assistance, feel free to contact us.

                        </p>
                    </td>


                </tr>

                <tr>
                    <td style="padding: 0 60px 0 60px;">
                        <table style="padding: 0px 0 45px 0; width: 100%; border-bottom: 1px solid #EAEAEA;">
                            <tbody>
                                <tr>
                                    <td style="width: 50%;">
                                        <table align="left">
                                            <tbody>
                                                <tr>
                                                <td>
                                                    <a href="mailto:<?= $contact_data->email ?>"
                                                       style="font-size: 14px; font-family: 'Open Sans', sans-serif; text-decoration: none; font-weight: 700; color: #434242; display: block; margin-bottom: 5px;"><?= $contact_data->email ?>

                                                    </a>
                                                    <p
                                                        style="font-size: 14px; font-family: 'Open Sans', sans-serif; margin: 0px; font-weight: 700; color: #434242;">
                                                        Whatsapp No. 
                                                        <a href="tel:<?= $contact_data->whatsapp_no ?>" style="text-decoration: none; color: #434242;">
                                                            <?= $contact_data->whatsapp_no ?>
                                                        </a>
                                                    </p>
                                                </td>

                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td style="width: 50%;">
                                        <table align="right">
                                            <tbody>
                                                <tr>
                                                    <td >
                                                        <a href="<?= $contact_data->facebook_link ?>"
                                                           style="width: 17px; height: 17px;">
                                                            <img src="<?= Yii::$app->params['filepath'] ?>images/fb.png"
                                                                 style="width: 17px; height: 17px;">
                                                        </a>

                                                    </td>
                                                    <td >
                                                        <p style="font-size: 13px; font-family: 'Open Sans', sans-serif; text-decoration: none; font-weight: 400; color: #2F2F2F;padding-bottom: 5px;margin-left: 12px;">facebook</p>

                                                    </td>

                                                    <td style="padding-left: 25px;">
                                                        <a href="<?= $contact_data->instagram_link ?>"
                                                           style="width: 17px; height: 17px;">
                                                            <img src="<?= Yii::$app->params['filepath'] ?>images/insta.png"
                                                                 style="width: 17px; height: 17px;">
                                                        </a>

                                                    </td>
                                                    <td >
                                                        <p style="font-size: 13px; font-family: 'Open Sans', sans-serif; text-decoration: none; font-weight: 400; color: #2F2F2F;padding-bottom: 5px;margin-left: 12px;">instagram</p>

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td style="padding: 27px 0px 35px;">
                        <p
                            style="color: #323232; font-size: 14px; font-family: 'Open Sans', sans-serif; font-weight: 400; text-align: center; padding: 25px 0 35px;margin: 0;">
                            Copyright © 2022 Damas Medical Center. All Rights Reserved.</p>
                    </td>

                </tr>
            </tfoot>
        </table>
    </div>
</body>