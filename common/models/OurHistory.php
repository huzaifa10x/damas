<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "our_history".
 *
 * @property int $id
 * @property int $year
 * @property string $title
 * @property string $title_arabic
 * @property string $description
 * @property string $description_arabic
 * @property int $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class OurHistory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'our_history';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['year', 'title', 'title_arabic', 'description', 'description_arabic'], 'required'],
            [['status', 'created_by', 'updated_by','sort_order'], 'integer'],
            [['description', 'description_arabic'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['year'], 'unique'],
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
            'year' => 'Year',
            'title' => 'Title',
            'title_arabic' => 'Title Arabic',
            'description' => 'Description',
            'description_arabic' => 'Description Arabic',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
