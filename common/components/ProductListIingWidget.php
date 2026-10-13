<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AppointmentWidget
 *
 * @author
 * JIthin Wails
 */

namespace common\components;

use Yii;
use yii\base\Widget;
use common\models\Products;

class ProductListIingWidget extends Widget {

    public $product_id;
    public $language;

    public function init() {
        parent::init();
        if ($this->id === null) {
            return '';
        }
    }

    public function run() {
        if ($this->product_id != '') {
            $related_products = Products::find()->where(['id' => $this->product_id, 'status' => 1])->all();
        } else {
            $related_products = [];
        }
        return $this->render('product-listing', ['related_products' => $related_products, 'language' => $this->language]);
    }

}

?>
