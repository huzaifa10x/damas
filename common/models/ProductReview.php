<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_review".
 *
 * @property int $id
 * @property int|null $product_id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $review_title
 * @property string|null $message
 * @property string|null $image
 * @property int|null $rating
 * @property int $status 0->pending,1->approved,2->rejected
 * @property string|null $date
 */
class ProductReview extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_review';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'rating', 'status'], 'integer'],
            [['message'], 'string'],
            [['date'], 'safe'],
            [['name', 'email', 'review_title', 'image'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product',
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'review_title' => 'Review Title',
            'message' => 'Message',
            'image' => 'Image',
            'rating' => 'Rating',
            'status' => 'Status',
            'date' => 'Date',
        ];
    }
}
