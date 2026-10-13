<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\BaseMessage instance of newly created mail message */
if (isset($touser) && $touser != '')
    $name = $touser;
else
    $name = '';
// var_dump($model);exit;
?>

<html>
    <head>
        <style>
            .main-content p{
                line-height: 1.8;
            }
            .body{
                font-family: Open Sans !important;
            }
        </style>
    </head>
    <body>
        <?php
        // var_dump($model);exit;
        ?>
        <div style="border: 1px solid #9E9E9E;padding: 15px 0px;">
            <table border ="0"  class="main-tabl" style="width:100%">
                <thead>
                    <tr>
                        <th style="width:100%">
                <div class="header" style="padding-bottom: 0px;">
                    <div class="main-header">
                       
                    </div>
                    <br/>
                </div>
                </th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="width:100%">
                            <div class="replay-content" style="text-align: justify;padding-right: 50px;padding-left: 50px;">
                                <div class="main-content">
                                    <table style="border-collapse: collapse;width: 100%;text-align: left;margin-bottom: 30px;border: 1px solid #c7c4c4;">
                                        <tr>
                                            <th style="border: 1px solid #c7c4c4;text-align: left;padding: 5px 10px;">Name</th>
                                            <td style="border: 1px solid #c7c4c4;text-align: left;padding: 5px 10px;"><?= $model->name ?></td>
                                        </tr>
                                         
                                        <tr>
                                            <th style="border: 1px solid #c7c4c4;text-align: left;padding: 5px 10px;">Email</th>
                                            <td style="border: 1px solid #c7c4c4;text-align: left;padding: 5px 10px;"><?= $model->email ?></td>
                                        </tr>
                                        <tr>
                                            <th style="border: 1px solid #c7c4c4;text-align: left;padding: 5px 10px;">Phone</th>
                                            <td style="border: 1px solid #c7c4c4;text-align: left;padding: 5px 10px;"><?= $model->phone_number ?></td>
                                        </tr>
                                       <tr>
                                            <th style="border: 1px solid #c7c4c4;text-align: left;padding: 5px 10px;">Message</th>
                                            <td style="border: 1px solid #c7c4c4;text-align: left;padding: 5px 10px;"><?= $model->message ?></td>
                                        </tr>
                                       
                                    </table>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
</html>