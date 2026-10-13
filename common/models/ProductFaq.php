<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_faq".
 *
 * @property int $id
 * @property int|null $product_id
 * @property string $question
 * @property string $question_arabic
 * @property string $answer
 * @property string $answer_arabic
 * @property int $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string $updated_at
 *
 * @property Products $product
 */
class ProductFaq extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_faq';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['question', 'question_arabic', 'answer', 'answer_arabic'], 'required'],
            [['question', 'question_arabic', 'answer', 'answer_arabic'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::class, 'targetAttribute' => ['product_id' => 'id']],
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
            'question' => 'Question',
            'question_arabic' => 'Question Arabic',
            'answer' => 'Answer',
            'answer_arabic' => 'Answer Arabic',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::class, ['id' => 'product_id']);
    }
}
