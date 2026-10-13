<?php

namespace frontend\controllers;

use yii;
use common\models\Cart;
use common\models\CartMaster;

class CartController extends \yii\web\Controller {

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionIndex($language) {
        $this->view->params['language'] = $language;
        if (isset(Yii::$app->user->identity->id)) {
            if (isset(Yii::$app->session['temp_user'])) {
                Yii::$app->CartFunctionality->changecart(Yii::$app->session['temp_user']);
            }
        }
        $condition = Yii::$app->CartFunctionality->UserCheck();
        $cart_master = CartMaster::find()->where(Yii::$app->CartFunctionality->GetUser())->orderBy(['id'=>SORT_DESC])->one();
        if (!empty($cart_master)) {
            $cart_master->promotion_id = '';
            $cart_master->promotion_code = '';
            $cart_master->promotion_amount = 0;
            $cart_master->shipping_charge = 0;
            $cart_master->gift_wrap = 0;
            $cart_master->gift_wrap_amount = 0;
            $cart_master->save();
            Yii::$app->CartFunctionality->UpdateCartMaster($cart_master);
        }
        $cart_items = Cart::find()->where($condition)->all();
        if (!empty($cart_items)) {
            Yii::$app->CartFunctionality->UpdateCartMaster($cart_master);
        }
        if (!empty($cart_items)) {
            return $this->render('cart', ['cart_items' => $cart_items, 'cart_master' => $cart_master,'language' => $language]);
        } else {
            return $this->render('emptycart', ['language' => $language]);
        }
    }

}
