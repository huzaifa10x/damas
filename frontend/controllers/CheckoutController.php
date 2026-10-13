<?php

namespace frontend\controllers;

use yii;
use common\models\UserAddress;
use common\models\Genders;
use common\models\OrderMaster;
use common\models\OrderDetails;
use common\models\Cart;
use common\models\CartMaster;
use common\models\Products;
use yii\helpers\ArrayHelper;

class CheckoutController extends \yii\web\Controller {

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionIndex($language) {
        $this->view->params['language'] = $language;
        $model = new UserAddress();
        if ($language == 'ar') {
            $genders = ArrayHelper::map(Genders::find()->where(['status' => 1])->all(), 'id', 'gender_arabic');
        } else {
            $genders = ArrayHelper::map(Genders::find()->where(['status' => 1])->all(), 'id', 'gender');
        }
        $cart_master = \common\models\CartMaster::find()->where(Yii::$app->CartFunctionality->GetUser())->orderBy(['id' => SORT_DESC])->one();
        if (!empty($cart_master) && $cart_master->grand_total > 0) {
            $cart_items = Cart::find()->where(['master_id' => $cart_master->id])->all();
            if (empty($cart_items)) {
                return $this->redirect(['cart/index', 'language' => $language]);
            }
        } else {
            return $this->redirect(['cart/index', 'language' => $language]);
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $cart_master->billing_address = $model->id;
            $cart_master->save();
            $data = [];
            $order_id = $this->CreateOrder($data, $cart_master);
            if (isset($order_id) && $order_id != '' && $order_id != 0) {
                $order_master = OrderMaster::find()->where(['id' => $order_id])->one();
                $order_master->status = 1;
                if ($order_master->save()) {
                    $this->AddOrderAddress($order_master);
                    $this->redirect(array('payment-gateway', 'language' => $language, 'id' => $order_master->order_id));
                } else {
//                        Yii::$app->Emails->errormail($model, $model->getErrors(), 'checkout-payment');
                }
            } else {
                return $this->redirect(['cart/index']);
            }
        } else {
            $cart_master->cod_charge = 0;
            $cart_master->save();
            Yii::$app->CartFunctionality->UpdateCartMaster($cart_master);
        }
        return $this->render('checkout', [
                    'cart_master' => $cart_master,
                    'cart_items' => $cart_items,
                    'model' => $model,
                    'genders' => $genders,
                    'language' => $language,
        ]);
    }

    public function CreateOrder($data, $cart_master) {
        $cart_items = Cart::find()->where(['master_id' => $cart_master->id])->all();
        if (!empty($cart_items)) {
            $model = new OrderMaster();
            $model->user_id = !Yii::$app->user->isGuest && isset(Yii::$app->user->identity->id) ? Yii::$app->user->identity->id : Yii::$app->session['user_identity'];
            $model->total_amount = $cart_master->sub_total;
            $model->billing_address = $cart_master->billing_address;
            $billing_address = \common\models\UserAddress::find()->where(['id' => $cart_master->billing_address])->one();
            if (!empty($billing_address)) {
                $model->name = $billing_address->name;
                $model->email = $billing_address->email;
                $model->booking_date = $billing_address->booking_date;
            }
            $model->payment_mode = 2;
            $model->vat_amount = $cart_master->gst;
            $model->net_amount = $model->total_amount + $model->vat_amount;
            $model->order_date = date('Y-m-d');
            if ($model->save()) {
                $model->order_id = 'DMC' . sprintf('%05d', $model->id);
                $model->id;
                if ($model->update()) {
                    if ($model->order_id != '') {
                        if ($this->AddOrderDetails($model, $cart_items)) {
                            return $model->id;
                        }
                    }
                }
            }
        }
    }

    public function AddOrderDetails($order_master, $cart_items) {
        $flag = 0;
        if (!empty($cart_items)) {
            foreach ($cart_items as $cart) {
                if ($cart->quantity > 0) {
                    $prod_details = Products::findOne($cart->product_id);
                    $model_prod = new OrderDetails;
                    $model_prod->master_id = $order_master->id;
                    $model_prod->order_id = $order_master->order_id;
                    $model_prod->product_id = $cart->product_id;
                    $model_prod->quantity = $cart->quantity;
                    $price = Yii::$app->CartFunctionality->getProductPrice($prod_details->id);
                    $model_prod->item_type = $cart->item_type;
                    $model_prod->amount = $price;
                    $model_prod->orginal_price = $prod_details->price;
                    $model_prod->rate = ($cart->quantity) * ($price);
                    $model_prod->tax = Yii::$app->SetValues->GetVat($model_prod->rate);
                    $model_prod->status = 1;
                    $model_prod->doc = date('Y-m-d H:i:s');
                    if ($model_prod->save()) {
                        $flag = 1;
                    } else {
                        $flag = 0;
                    }
                }
            }
        }
        if ($flag == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function AddOrderAddress($order) {
        $address = UserAddress::find()->where(['id' => $order->billing_address])->one();
        if (!empty($address)) {
            $model = new \common\models\OrderAddress();
            $model->order_id = $order->id;
            $model->name = $address->name;
            $model->booking_date = $address->booking_date;
            $model->email = $address->email;
            $model->age = $address->age;
            $model->landmark = $address->landmark;
            $model->country_code = $address->country_code;
            $model->mobile_number = $address->mobile_number;
            $model->emirate = $address->emirate;
            $model->country = $address->country;
            $model->city = $address->city;
            $model->address = $address->address;
            $model->post_code = $address->post_code;
            if ($model->save()) {
                $order->billing_address = $model->id;
                $order->update();
            }
        }
        return TRUE;
    }

    /**
     * Payment gateway purchase.
     * @return mixed
     */
    public function actionPaymentGateway($language, $id) {
        $order_master = OrderMaster::find()->where(['order_id' => $id])->one();
        $address = \common\models\OrderAddress::find()->where(['order_id' => $order_master->id])->one();
        Yii::$app->session['orderid'] = $order_master->order_id;
        $cartid_1 = $order_master->order_id;
        // $authkey = Yii::$app->params['liveAuthKey'];
        // $storeid = Yii::$app->params['liveStoreId']; 
        $authkey = Yii::$app->params['TestAuthKey'];
        $storeid = Yii::$app->params['TestStoreId'];
        $authurl = Yii::$app->params['filepath'] . $language . '/payment-success/' . $order_master->order_id;
        $decl = Yii::$app->params['filepath'] . $language . '/payment-failed/' . $order_master->order_id;
        $cncl = Yii::$app->params['filepath'] . $language . '/payment-failed/' . $order_master->order_id;
        $environment = 0;  // Either 1 Or 0
        $custref = '';  //Store card unique id for each customer
        $params = array(
            'ivp_method' => 'create',
            'ivp_store' => $storeid,
            'ivp_authkey' => $authkey,
            'ivp_cart' => $cartid_1,
            'bill_custref' => $custref,
            'bill_fname' => $address->name,
            'bill_sname' => '',
            'bill_addr1' => $address->address,
            'bill_addr2' => '',
            'bill_city' => $address->city,
            'bill_country' => 'ae',
            'bill_phone' => $address->mobile_number,
            'bill_email' => $address->email,
            'bill_zip' => $address->post_code,
            'bill_region' => 'Arab Emirates',
            'ivp_test' => $environment,
            'ivp_amount' => $order_master->net_amount,
            'ivp_lang' => Yii::$app->params['ivp_lang'],
            'ivp_framed' => '0',
            'ivp_currency' => Yii::$app->params['ivp_currency'],
            'ivp_desc' => 'Product Description',
            'return_auth' => $authurl,
            'return_can' => $decl,
            'return_decl' => $cncl
        );

//printing request
        // echo '<pre>';
        // print_r($params);
        // echo '</pre>';exit;
//cURL request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://secure.telr.com/gateway/order.json");
        curl_setopt($ch, CURLOPT_POST, count($params));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
        $results = curl_exec($ch);
        curl_close($ch);
        // echo $results;exit;

        $results = json_decode($results, true);
       if (isset($results['order']['ref'], $results['order']['url'])) {
    $ref = trim($results['order']['ref']);
    $url = trim($results['order']['url']);
    
    $order_master->payment_reference_number = $ref;
    $order_master->save();
    
    header('Location: ' . $url);
    exit; // Always add exit after header redirects
} else {
    // Handle the case where 'order' or its keys are missing
    // You could log an error, throw an exception, or provide feedback
    // echo "Order information is missing from the response.";
}
//        echo '<br><br><b>Printing Ref no:</b> ' . $ref . '<br><br>';
//        echo '<b>Printing URL:</b> ' . $url . '<br><br>';
//if error then
//        if (empty($ref) || empty($url)) {
//            echo "Some error in request!!!";
//        }
    }

    public function actionPaymentSuccess($language, $order_id) {
        $order_master = OrderMaster::find()->where(['order_id' => $order_id])->one();
        if (!empty($order_master)) {
            $order_master->payment_status = 1;
            $order_master->save();
            Yii::$app->session['orderid'] = $order_master->order_id;
            return $this->redirect(['order-success', 'language' => $language]);
        } else {
            return $this->redirect(['index', 'language' => $language]);
        }
    }

    public function actionPaymentFailed($language, $order_id) {
        $order_master = OrderMaster::find()->where(['order_id' => $order_id])->one();
        if (!empty($order_master)) {
            $order_master->payment_status = 0;
            $order_master->save();
            return $this->redirect(['order-failed', 'language' => $language]);
        } else {
            return $this->redirect(['index', 'language' => $language]);
        }
    }

    public function actionOrderSuccess($language) {
        $this->view->params['language'] = $language;
        if (isset(Yii::$app->session['orderid']) && Yii::$app->session['orderid'] != '') {
            $order_master = OrderMaster::find()->where(['order_id' => Yii::$app->session['orderid']])->one();
            if (!empty($order_master)) {
                $order_master->is_success = 1;
                $order_master->save();
                Yii::$app->CartFunctionality->clearcart();
                Yii::$app->SetValues->purchasemail($order_master->id);
            }
            Yii::$app->session['orderid'] = '';
            Yii::$app->session['user_identity'] = '';
            return $this->render('order-success', [
                        'order_master' => $order_master,
                        'language' => $language,
            ]);
        } else {
            return $this->redirect(['/site/index', 'language' => $language]);
        }
    }

    public function actionOrderFailed($language) {
        $this->view->params['language'] = $language;
        return $this->render('order-failed', [
                    'language' => $language,
        ]);
    }

}
