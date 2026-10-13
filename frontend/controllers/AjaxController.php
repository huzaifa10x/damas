<?php

namespace frontend\controllers;

use yii;
use common\models\Products;
use common\models\CartMaster;
use common\models\Cart;

class AjaxController extends \yii\web\Controller {

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    /*
     * This function add product to cart
     * parameeters @quantity and @product_canonical_name
     * Return success if added to the cart
     */

    public function actionAddToCart() {
        if (yii::$app->request->isAjax) {
            $id = Yii::$app->request->post()['product'];
            $qty = 1;
            $product = Products::find()->where(['id' => $id])->one();
            $cart_data = 0;
            if (!empty($product)) {
                $user_id = isset(Yii::$app->user->identity->id) ? Yii::$app->user->identity->id : '';
                $cart_master = CartMaster::find()->where(Yii::$app->CartFunctionality->GetUser())->orderBy(['id' => SORT_DESC])->one();
                if (!empty($cart_master)) {
                    $cart = Cart::find()->where(['product_id' => $product->id])->andWhere(['master_id' => $cart_master->id])->one();
                    if (!empty($cart)) {
                        $quantity = $qty;
                        $cart->quantity = $quantity;
                        $cart->save();
//                        if ($cart_master->promotion_code != '') {
//                            Yii::$app->CartFunctionality->CheckPromotionCode($cart_master, $cart_master->promotion_code);
//                        }
                        Yii::$app->CartFunctionality->UpdateCartMaster($cart_master);
                    } else {
                        Yii::$app->CartFunctionality->AddToCart($user_id, Yii::$app->session['temp_user'], $product->id, $qty, '');
                        Yii::$app->CartFunctionality->UpdateCartMaster($cart_master);
                    }
                } else {
                    Yii::$app->CartFunctionality->AddToCart($user_id, Yii::$app->session['temp_user'], $product->id, $qty, '');
                    $cart_master = CartMaster::find()->where(Yii::$app->CartFunctionality->GetUser())->orderBy(['id' => SORT_DESC])->one();
                    Yii::$app->CartFunctionality->UpdateCartMaster($cart_master);
                }
                if ($_POST['current_url'] == 'wishlist' && isset(Yii::$app->user->identity->id) && Yii::$app->user->identity->id != '') {
                    $wish_list_item = \common\models\Wishlist::find()->where(['user_id' => Yii::$app->user->identity->id, 'product' => $product->id])->one();
                    if (!empty($wish_list_item)) {
                        $wish_list_item->delete();
                    }
                }
            } else {
                $cart_data = 0;
                exit;
            }
            $cart_contents = [];
            $carrt_count = 0;
            $cart_master = CartMaster::find()->where(Yii::$app->CartFunctionality->GetUser())->orderBy(['id' => SORT_DESC])->one();
            if (!empty($cart_master)) {
                $cart_contents = Cart::find()->where(['master_id' => $cart_master->id])->all();
                $carrt_count = Cart::find()->where(['master_id' => $cart_master->id])->count();
                if (!empty($cart_contents)) {
//                    $cart_data = $this->renderPartial('cart_contents', ['cart_contents' => $cart_contents, 'cart_master' => $cart_master]);
                    $redirect_url = '';
                } else {
                    $redirect_url = '';
                    $cart_data = '';
                }
                return json_encode(array(
                    'content' => $cart_data,
                    'count' => $carrt_count,
                    'sub_total' => Yii::$app->SetValues->GetPrice($cart_master->sub_total),
                    'shipping_charge' => Yii::$app->SetValues->GetPrice($cart_master->shipping_charge),
                    'redirect_url' => $redirect_url,
                    'grand_tot' => sprintf('%0.2f', Yii::$app->SetValues->GetPrice($cart_master->grand_total)),
                    'currency' => Yii::$app->SetValues->GetCurrencySymbol()));
            }
        }
    }

    /*
     * Remove item from cart
     * parameeters @cart_id
     * Return success if remove item from cart
     */

    public function actionCartRemove() {
        if (yii::$app->request->isAjax) {
            $id = Yii::$app->request->post()['id'];
            $cart_master = \common\models\CartMaster::find()->where(Yii::$app->CartFunctionality->GetUser())->orderBy(['id' => SORT_DESC])->one();
            $cart = Cart::find()->where(['id' => yii::$app->EncryptDecrypt->Encrypt('decrypt', $id)])->one();
            if (!empty($cart)) {
                if ($cart->delete()) {
                    $cart_item = \common\models\Cart::find()->where(['master_id' => $cart_master->id])->all();
                    Yii::$app->CartFunctionality->UpdateCartMaster($cart_master);
                    return json_encode(array(
                        'msg' => 'success',
                        'sub_total' => Yii::$app->SetValues->GetPrice($cart_master->sub_total),
                        'vat_total' => Yii::$app->SetValues->GetVat($cart_master->sub_total),
                        'count' => count($cart_item),
                        'grand_tot' => sprintf('%0.2f', Yii::$app->SetValues->GetPrice($cart_master->grand_total)),
                        'currency' => Yii::$app->SetValues->GetCurrencySymbol()
                    ));
                }
            } else {
                return json_encode(array('msg' => 'failed', 'reason' => 'Cannot find.'));
            }
        }
    }

}
