<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cart_master".
 *
 * @property int $id
 * @property string|null $user_id
 * @property int|null $gift_wrap
 * @property float|null $gift_wrap_amount
 * @property int|null $promotion_id
 * @property string|null $promotion_code
 * @property float|null $promotion_amount
 * @property float|null $shipping_charge
 * @property float|null $special_discount
 * @property float|null $sub_total
 * @property float|null $mrp_total
 * @property float $cod_charge
 * @property float|null $gst
 * @property float|null $grand_total
 * @property int|null $shipping_address
 * @property int $shipping_method
 * @property int|null $billing_address
 * @property string|null $special_instruction
 * @property int $address_type 1->home,2->work
 * @property string|null $doc
 * @property string|null $dou
 */
class CartMaster extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cart_master';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gift_wrap', 'promotion_id', 'shipping_address', 'shipping_method', 'billing_address', 'address_type'], 'integer'],
            [['gift_wrap_amount', 'promotion_amount', 'shipping_charge', 'special_discount', 'sub_total', 'mrp_total', 'cod_charge', 'gst', 'grand_total'], 'number'],
            [['special_instruction'], 'string'],
            [['user_id', 'doc', 'dou'], 'safe'],
            [['promotion_code'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'gift_wrap' => 'Gift Wrap',
            'gift_wrap_amount' => 'Gift Wrap Amount',
            'promotion_id' => 'Promotion ID',
            'promotion_code' => 'Promotion Code',
            'promotion_amount' => 'Promotion Amount',
            'shipping_charge' => 'Shipping Charge',
            'special_discount' => 'Special Discount',
            'sub_total' => 'Sub Total',
            'mrp_total' => 'Mrp Total',
            'cod_charge' => 'Cod Charge',
            'gst' => 'Gst',
            'grand_total' => 'Grand Total',
            'shipping_address' => 'Shipping Address',
            'shipping_method' => 'Shipping Method',
            'billing_address' => 'Billing Address',
            'special_instruction' => 'Special Instruction',
            'address_type' => 'Address Type',
            'doc' => 'Doc',
            'dou' => 'Dou',
        ];
    }
}
