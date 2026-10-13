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
                    <td style="padding: 60px 60px 0;">
                        <h3
                            style="color: #2A2A2A; font-size: 22px; font-weight: 700; text-align: center; padding: 0 0 0px;margin: 0 0 25px 0;font-family: 'Open Sans', sans-serif;">
                            Slot confirmation</h3>

                        <h4
                            style="font-size: 16px; font-family: 'Open Sans', sans-serif; font-weight: 700; color: #050505; text-align: center; text-transform: capitalize; margin-bottom: 15px;">
                            <?= $model->name ?></h4>
                        <p
                            style="text-align: center; font-family: 'Open Sans', sans-serif;padding: 0px 20px 0px ; color: #747474; font-size: 16px; font-weight: 400; line-height: 26px; margin: 0; ">
                            It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum
                        </p>
                    </td>
        
                </tr>
                <tr>
                    <td style="padding: 0px 60px 0px;">
                        

                        <p
                            style="text-align: center; font-family: 'Open Sans', sans-serif;padding: 20px 20px 0px ; color: #2A2A2A; font-size: 16px; font-weight: 400; line-height: 26px; margin: 0; ">
                            Best regards
                        </p>
                        <h4 style="text-align: center; font-family: 'Open Sans', sans-serif;padding: 4px 20px 39px ;color: #2A2A2A; font-size: 15px; font-weight: 700; line-height: 26px; margin: 0; ">DAMAS MEDICAL CENTER</h4>
                    </td>
                    

                </tr>
                <tr >
                    <table style="width: 580px;margin: auto;padding: 0 0 30px;">
                        <tbody>
                            <tr style="padding: 0 35px 0;background-color: #d5ae6912;" >

                                <td style="padding: 35px ;">
                                    
            
                                    <h5
                                        style="text-align: left; font-family: 'Open Sans', sans-serif;padding: 20px 0px ; color: #763813; border-bottom: 1px solid #d0ac2a2b; font-size: 20px; font-weight: 700; line-height: 26px;padding: 0 0 20px; margin: 0; ">
                                        Booking Details
                                    </h5>
                                    <p style="text-align: left; font-family: 'Open Sans', sans-serif;padding: 20px 0px 24px ; color: #2A2A2A; font-size: 16px; font-weight: 400; line-height: 26px; margin: 0; ">
                                        There are many variations of passages of Lorem Ipsum available, but the majority words which don't look even slightly believable. </p>
                                
                                        <p
                                        style="font-size: 15px;font-family: 'Open Sans', sans-serif; color: #2A2A2A; font-weight: 400;margin: 0; text-align: left; margin-bottom: 0px; padding: 0px 0px 16px ;">
                                        Service :  <a href="#"
                                        style="color: #763813;font-weight: 700; text-decoration: none;margin-left: 2px;"> <?= $service->service_name ?>
                                            </a>
                                            
                                        </p>
                                        <p
                                        style="font-size: 15px;font-family: 'Open Sans', sans-serif; color: #2A2A2A; font-weight: 400;margin: 0; text-align: left; margin-bottom: 0px; padding: 0px 0px 16px ;">
                                        Date:  <a href="#"
                                        style="color: #763813;font-weight: 700; text-decoration: none;margin-left: 2px;"><?= date("d", strtotime($model->appointment_date)); ?>th <?= date("F Y", strtotime($model->appointment_date)); ?>
                                            </a>
                                            
                                        </p>
                                    </td>

                            </tr>
                        </tbody>
                    </table>
                    

                </tr>
                <tr>
                    <td style="padding: 30px 0 43px;">
                        <p
                        style="font-size: 16px;font-family: 'Open Sans', sans-serif; color: #7E7E7E; font-weight: 400;margin: 0; text-align: center; margin-bottom: 0px; padding: 30px 60px 6px;">
                        Thanks for Registering with  <a href="#"
                        style="color: #763813;font-weight: 700; text-decoration: none;margin-left: 2px;">Damas Medical Center

                            </a>
                            
                        </p>
                        <p
                        style="font-size: 16px;font-family: 'Open Sans', sans-serif; color: #7E7E7E; font-weight: 400;margin: 0; text-align: center; margin-bottom: 0px; padding: 0px 60px 040px 60px;">
                        Please feel free to contact us if you have any queries about us
                            
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