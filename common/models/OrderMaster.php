<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_master".
 *
 * @property int $id
 * @property string|null $order_id
 * @property int|null $user_id
 * @property string|null $name
 * @property string|null $email
 * @property float|null $total_amount
 * @property float|null $shipping_charge
 * @property float|null $promotion_discount
 * @property float|null $special_discount
 * @property float $cod_charge
 * @property float|null $vat_amount
 * @property float|null $net_amount
 * @property string|null $order_date
 * @property int|null $payment_mode
 * @property int $payment_status 0->Not Paid,1->Paid
 * @property string|null $payment_reference_number
 * @property string|null $paymeny_response
 * @property string|null $response_status
 * @property int|null $billing_address
 * @property string|null $cancel_reason
 * @property string|null $return_reason
 * @property int|null $promotion_id
 * @property string|null $promotion_code
 * @property int|null $address_type 1->Home,2->Work
 * @property string|null $special_instruction
 * @property int|null $status
 * @property int $is_success
 * @property string $updated_at
 */
class OrderMaster extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_master';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'payment_mode', 'payment_status', 'billing_address', 'promotion_id', 'address_type', 'status', 'is_success'], 'integer'],
            [['total_amount', 'shipping_charge', 'promotion_discount', 'special_discount', 'cod_charge', 'vat_amount', 'net_amount'], 'number'],
            [['order_date', 'updated_at','booking_date'], 'safe'],
            [['paymeny_response', 'cancel_reason', 'return_reason', 'special_instruction'], 'string'],
            [['order_id', 'promotion_code'], 'string', 'max' => 100],
            [['name', 'email', 'payment_reference_number'], 'string', 'max' => 255],
            [['response_status'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'user_id' => 'User ID',
            'name' => 'Name',
            'email' => 'Email',
            'total_amount' => 'Total Amount',
            'shipping_charge' => 'Shipping Charge',
            'promotion_discount' => 'Promotion Discount',
            'special_discount' => 'Special Discount',
            'cod_charge' => 'Cod Charge',
            'vat_amount' => 'Vat Amount',
            'net_amount' => 'Net Amount',
            'order_date' => 'Order Date',
            'payment_mode' => 'Payment Mode',
            'payment_status' => 'Payment Status',
            'payment_reference_number' => 'Payment Reference Number',
            'paymeny_response' => 'Paymeny Response',
            'response_status' => 'Response Status',
            'billing_address' => 'Billing Address',
            'cancel_reason' => 'Cancel Reason',
            'return_reason' => 'Return Reason',
            'promotion_id' => 'Promotion ID',
            'promotion_code' => 'Promotion Code',
            'address_type' => 'Address Type',
            'special_instruction' => 'Special Instruction',
            'status' => 'Status',
            'is_success' => 'Is Success',
            'updated_at' => 'Updated At',
        ];
    }
}
