<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SetValues
 *
 * @author user
 */

namespace common\components;

use Yii;
use yii\base\Component;

class Helpers extends Component
{
    public static function getActiveMenu(...$desiredControllers)
    {

        return in_array(Yii::$app->controller->id, $desiredControllers) ? 'active' : '';
    }
    public static function getActiveMenuCollapsed(...$desiredController)
    {
        return in_array(Yii::$app->controller->id, $desiredController) ? 'collapsed' : '';
    }
    public static function getActiveMenuShow(...$desiredControllers)
    {
        // return Yii::$app->controller->id === $desiredController ? 'show' : '';
        return in_array(Yii::$app->controller->id, $desiredControllers) ? 'show' : '';
    }
    public static function getAreaExpanded(...$desiredControllers)
    {

        if (in_array(Yii::$app->controller->id, $desiredControllers))
            return true;
        else
            return false;
    }

}
