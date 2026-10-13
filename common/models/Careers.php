<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "careers".
 *
 * @property int $id
 * @property string $title
 * @property string $title_arabic
 * @property string $job_type
 * @property string $job_type_arabic
 * @property string $location
 * @property string $location_arabic
 * @property string $description
 * @property string $description_arabic
 * @property string|null $experience
 * @property string|null $experience_arabic
 * @property int $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string $updated_at
 */
class Careers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'careers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'title_arabic', 'location', 'location_arabic', 'description', 'description_arabic'], 'required'],
            [['description', 'description_arabic'], 'string'],
            [['status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'title_arabic', 'experience', 'experience_arabic'], 'string', 'max' => 255],
            [['job_type', 'job_type_arabic', 'location', 'location_arabic'], 'string', 'max' => 100],
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
            'job_type' => 'Job Type',
            'job_type_arabic' => 'Job Type Arabic',
            'location' => 'Location',
            'location_arabic' => 'Location Arabic',
            'description' => 'Description',
            'description_arabic' => 'Description Arabic',
            'experience' => 'Experience',
            'experience_arabic' => 'Experience Arabic',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
