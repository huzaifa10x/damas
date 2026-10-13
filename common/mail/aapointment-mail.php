<?php

use yii\helpers\Html;
 
/* @var $this yii\web\View */

/* @var $model common\models\AppointmentEnquiryListing */

?>
 
<div style="font-family: Arial, sans-serif; max-width: 600px; margin: 20px auto; border: 1px solid #e0e0e0; border-radius: 8px; overflow: hidden; background-color: #ffffff;">
<!-- Email Header -->
<div style="background-color: #8b4513; color: #ffffff; padding: 20px; text-align: center;">
<h2 style="margin: 0; font-size: 22px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px;">New Appointment Enquiry</h2>
</div>
 
    <!-- Email Body -->
<div style="padding: 25px; color: #333333; line-height: 1.6;">
<p style="font-size: 15px; margin-top: 0;">A new appointment request has been submitted on the website:</p>
 
        <table style="width: 100%; border-collapse: collapse; margin-top: 15px;">
<tr style="border-bottom: 1px solid #eeeeee;">
<td style="padding: 10px; font-weight: bold; width: 35%; color: #555555;">Name:</td>
<td style="padding: 10px; color: #222222;"><?= Html::encode($model->name ?? 'N/A') ?></td>
</tr>
<tr style="border-bottom: 1px solid #eeeeee;">
<td style="padding: 10px; font-weight: bold; color: #555555;">Age:</td>
<td style="padding: 10px; color: #222222;"><?= Html::encode($model->age ?? 'N/A') ?></td>
</tr>
<tr style="border-bottom: 1px solid #eeeeee;">
<td style="padding: 10px; font-weight: bold; color: #555555;">Gender:</td>
<td style="padding: 10px; color: #222222;"><?= Html::encode($model->gender ?? 'N/A') ?></td>
</tr>
<tr style="border-bottom: 1px solid #eeeeee;">
<td style="padding: 10px; font-weight: bold; color: #555555;">Phone Number:</td>
<td style="padding: 10px; color: #222222;"><?= Html::encode($model->phone_number ?? $model->phone_no ?? 'N/A') ?></td>
</tr>
<tr style="border-bottom: 1px solid #eeeeee;">
<td style="padding: 10px; font-weight: bold; color: #555555;">Email:</td>
<td style="padding: 10px; color: #222222;"><?= Html::encode($model->email ?? 'N/A') ?></td>
</tr>
<tr style="border-bottom: 1px solid #eeeeee;">
<td style="padding: 10px; font-weight: bold; color: #555555;">Appointment Date:</td>
<td style="padding: 10px; color: #222222;"><?= Html::encode($model->appointment_date ?? 'N/A') ?></td>
</tr>
<tr style="border-bottom: 1px solid #eeeeee;">
<td style="padding: 10px; font-weight: bold; color: #555555;">Department / Service:</td>
<td style="padding: 10px; color: #222222;"><?= Html::encode($model->service ?? $model->department ?? 'N/A') ?></td>
</tr>
<tr>
<td style="padding: 10px; font-weight: bold; color: #555555; vertical-align: top;">Message:</td>
<td style="padding: 10px; color: #222222;"><?= nl2br(Html::encode($model->message ?? 'No message provided')) ?></td>
</tr>
</table>
</div>
 
    <!-- Email Footer -->
<div style="background-color: #f8f9fa; padding: 15px; text-align: center; font-size: 12px; color: #777777; border-top: 1px solid #eeeeee;">

        This email was automatically generated from the Damas Website Appointment Form.
</div>
 
</div>
 