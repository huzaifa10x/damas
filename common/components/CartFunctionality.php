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
use common\models\Products;
use common\models\CartMaster;
use common\models\Cart;

class CartFunctionality extends Component {
    /*
     * Get user id when login other wise create session id and return it
     */

    public function GetUser() {
        if (isset(Yii::$app->user->identity->id)) {
            $user_id = Yii::$app->user->identity->id;
            $condition = ['user_id' => $user_id];
        } else {
            if (!isset(Yii::$app->session['temp_user'])) {
                $milliseconds = round(microtime(true) * 1000);
                Yii::$app->session['temp_user'] = $milliseconds;
            }
            $sessonid = Yii::$app->session['temp_user'];
            $condition = ['user_id' => $sessonid];
        }
        return $condition;
    }
    
    public function UserCheck() {
        if (isset(Yii::$app->user->identity->id)) {
            $user_id = Yii::$app->user->identity->id;
            $condition = ['user_id' => $user_id];
        } else {
            if (!isset(Yii::$app->session['temp_user'])) {
                $milliseconds = round(microtime(true) * 1000);
                Yii::$app->session['temp_user'] = $milliseconds;
            }
            $sessonid = Yii::$app->session['temp_user'];
            $condition = ['session_id' => $sessonid];
        }
        return $condition;
    }

    /*
     * this function update cart master values
     */

    public static function UpdateCartMaster($cart_master) {
        if (!empty($cart_master)) {
            $cart_items = Cart::find()->where(['master_id' => $cart_master->id])->all();
            if (!empty($cart_items)) {
                $sub_total = Yii::$app->CartFunctionality->cartTotal($cart_items);
                $cart_master->gst = Yii::$app->SetValues->GetVat($sub_total);
                $cart_master->sub_total = $sub_total;
            } else {
                $cart_master->gift_wrap = 0;
                $cart_master->gift_wrap_amount = 0;
                $cart_master->shipping_charge = 0;
                $cart_master->special_discount = 0;
                $cart_master->sub_total = 0;
                $cart_master->mrp_total = 0;
                $cart_master->promotion_amount = 0;
                $cart_master->cod_charge = 0;
                $cart_master->gst = 0;
                $cart_master->promotion_id = '';
                $cart_master->promotion_code = '';
            }
            $cart_master->grand_total = ($cart_master->sub_total + $cart_master->shipping_charge + $cart_master->gift_wrap_amount + $cart_master->gst + $cart_master->cod_charge) - ($cart_master->promotion_amount + $cart_master->special_discount);
            $cart_master->save(FALSE);
        }
        return TRUE;
    }

    /*
     * This function returns the total amount of cart items
     */

    public static function cartTotal($cart_items) {
        $subtotal = '0';
        foreach ($cart_items as $cart_item) {
            if ($cart_item->quantity > 0) {
                $product = Products::find()->where(['id' => $cart_item->product_id])->one();
                $price = Yii::$app->CartFunctionality->getProductPrice($product->id);
                $subtotal += ($price * $cart_item->quantity);
            }
        }
        return $subtotal;
    }

    public static function getProductPrice($product_id) {
        $product_details = Products::findOne($product_id);
        $main_price = $product_details->price;

        if (!empty($product_details->offer_price) && $product_details->offer_price > 0) {
            $main_price = $product_details->offer_price;
        }
        return $main_price;
    }
    
    /*
     * This function add product to cart
     * parameeter @product_id,@user_id,@session_id and @qty
     */

    public function AddToCart($user_id, $temp_session, $product_id, $qty, $variant) {
        if ($user_id != '') {
            $cart_master = CartMaster::find()->where(['user_id' => $user_id])->orderBy(['id' => SORT_DESC])->one();
        } elseif ($temp_session != '') {
            $cart_master = CartMaster::find()->where(['user_id' => $temp_session])->orderBy(['id' => SORT_DESC])->one();
        }
        if (empty($cart_master)) {
            $cart_master = new CartMaster();
            if ($user_id != '') {
                $cart_master->user_id = $user_id;
            } elseif ($temp_session != '') {
                $cart_master->user_id = $temp_session;
            }
            $cart_master->doc = date('Y-m-d H:i:s');
            if ($cart_master->save()) {
                
            } else {
//                var_dump($cart_master->getErrors());
//                exit;
            }
        }
        $model = new Cart();
        $model->master_id = $cart_master->id;
        $model->user_id = $user_id;
        $model->session_id = $temp_session;
        $model->product_id = $product_id;
        $model->quantity = $qty;
        $model->date = date('Y-m-d H:i:s');
        if ($model->save()) {
            if ($cart_master->promotion_code != '') {
//                Yii::$app->CartFunctionality->CheckPromotionCode($cart_master, $cart_master->promotion_code);
            }
            return TRUE;
        }
        Yii::$app->CartFunctionality->UpdateCartMaster($cart_master);
    }
    
    public static function clearcart() {
        $cart_master = \common\models\CartMaster::find()->where(Yii::$app->CartFunctionality->GetUser())->orderBy(['id' => SORT_DESC])->all();
        if (!empty($cart_master)) {
            foreach ($cart_master as $cart_mst) {
                $cart_items = Cart::find()->where(['master_id' => $cart_mst->id])->all();
                if (!empty($cart_items)) {
                    foreach ($cart_items as $cart_item) {
                        $cart_item->delete();
                    }
                }
                $cart_mst->delete();
            }
        }
    }

}
