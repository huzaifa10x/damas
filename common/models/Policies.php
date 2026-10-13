<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "policies".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $title_arabic
 * @property string $description
 * @property string $description_arabic
 * @property string|null $more_details
 * @property string|null $more_details_arabic
 * @property int $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string $updated_at
 */
class Policies extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'policies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'description_arabic'], 'required'],
            [['description', 'description_arabic', 'more_details', 'more_details_arabic'], 'string'],
            [['status', 'created_by', 'updated_by'], 'integer'],
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
            'title' => 'Title',
            'title_arabic' => 'Title Arabic',
            'description' => 'Description',
            'description_arabic' => 'Description Arabic',
            'more_details' => 'More Details',
            'more_details_arabic' => 'More Details Arabic',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
