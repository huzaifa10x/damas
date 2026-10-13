<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_details".
 *
 * @property int $id
 * @property int $master_id
 * @property string $order_id
 * @property int $product_id
 * @property int $quantity
 * @property float|null $orginal_price
 * @property float $amount
 * @property float|null $tax
 * @property string|null $delivered_date
 * @property float $rate
 * @property float|null $gst
 * @property int $item_type
 * @property string $doc
 * @property int $status
 * @property string|null $cancel_reason
 * @property string|null $return_reason
 * @property int|null $varient_id
 * @property string|null $varient_values
 * @property int|null $category_id
 * @property string|null $order_number
 * @property int|null $delivery_status
 */
class OrderDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['master_id', 'order_id', 'product_id', 'quantity', 'amount', 'rate'], 'required'],
            [['master_id', 'product_id', 'quantity', 'item_type', 'status', 'varient_id', 'category_id', 'delivery_status'], 'integer'],
            [['orginal_price', 'amount', 'tax', 'rate', 'gst'], 'number'],
            [['delivered_date', 'doc'], 'safe'],
            [['cancel_reason', 'return_reason', 'varient_values'], 'string'],
            [['order_id'], 'string', 'max' => 200],
            [['order_number'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'master_id' => 'Master ID',
            'order_id' => 'Order ID',
            'product_id' => 'Product ID',
            'quantity' => 'Quantity',
            'orginal_price' => 'Orginal Price',
            'amount' => 'Amount',
            'tax' => 'Tax',
            'delivered_date' => 'Delivered Date',
            'rate' => 'Rate',
            'gst' => 'Gst',
            'item_type' => 'Item Type',
            'doc' => 'Doc',
            'status' => 'Status',
            'cancel_reason' => 'Cancel Reason',
            'return_reason' => 'Return Reason',
            'varient_id' => 'Varient ID',
            'varient_values' => 'Varient Values',
            'category_id' => 'Category ID',
            'order_number' => 'Order Number',
            'delivery_status' => 'Delivery Status',
        ];
    }
}
