<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cart".
 *
 * @property int $id
 * @property int|null $master_id
 * @property int|null $user_id
 * @property string|null $session_id
 * @property int|null $product_id
 * @property int|null $quantity
 * @property int|null $options
 * @property string|null $date
 * @property int|null $gift_option
 * @property float|null $rate
 * @property int $item_type
 * @property int|null $varient_id
 * @property string|null $varient_values
 */
class Cart extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cart';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['master_id', 'user_id', 'product_id', 'quantity', 'options', 'gift_option', 'item_type', 'varient_id'], 'integer'],
            [['date','session_id'], 'safe'],
            [['rate'], 'number'],
            [['varient_values'], 'string'],
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
            'user_id' => 'User ID',
            'session_id' => 'Session ID',
            'product_id' => 'Product ID',
            'quantity' => 'Quantity',
            'options' => 'Options',
            'date' => 'Date',
            'gift_option' => 'Gift Option',
            'rate' => 'Rate',
            'item_type' => 'Item Type',
            'varient_id' => 'Varient ID',
            'varient_values' => 'Varient Values',
        ];
    }
}
