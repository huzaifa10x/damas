<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "meta_tags".
 *
 * @property int $id
 * @property string $meta_title
 * @property string|null $meta_title_arabic
 * @property string $meta_keyword
 * @property string|null $meta_keyword_arabic
 * @property string $meta_description
 * @property string|null $meta_description_arabic
 * @property string|null $other_meta_tags
 * @property string|null $other_meta_tags_arabic
 * @property int $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string $updated_at
 */
class MetaTags extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'meta_tags';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['meta_title', 'meta_keyword', 'meta_description'], 'required'],
            [['meta_description', 'meta_description_arabic', 'other_meta_tags', 'other_meta_tags_arabic'], 'string'],
            [['status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['meta_title', 'meta_title_arabic', 'meta_keyword', 'meta_keyword_arabic','page'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'meta_title' => 'Meta Title',
            'meta_title_arabic' => 'Meta Title Arabic',
            'meta_keyword' => 'Meta Keyword',
            'meta_keyword_arabic' => 'Meta Keyword Arabic',
            'meta_description' => 'Meta Description',
            'meta_description_arabic' => 'Meta Description Arabic',
            'other_meta_tags' => 'Other Meta Tags',
            'other_meta_tags_arabic' => 'Other Meta Tags Arabic',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
