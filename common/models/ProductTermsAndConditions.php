<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_terms_and_conditions".
 *
 * @property int $id
 * @property int|null $product_id
 * @property string $title
 * @property string $title_arabic
 * @property string $terms_and_condition
 * @property string $terms_and_condition_arabic
 * @property int $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string $updated_at
 */
class ProductTermsAndConditions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_terms_and_conditions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['title', 'title_arabic', 'terms_and_condition', 'terms_and_condition_arabic'], 'required'],
            [['terms_and_condition', 'terms_and_condition_arabic'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'title_arabic'], 'string', 'max' => 255],
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
            'title' => 'Title',
            'title_arabic' => 'Title Arabic',
            'terms_and_condition' => 'Terms And Condition',
            'terms_and_condition_arabic' => 'Terms And Condition Arabic',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
