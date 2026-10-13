<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "service_pros_and_cons".
 *
 * @property int $id
 * @property int|null $service
 * @property string $title
 * @property string $title_arabic
 * @property string $description
 * @property string $description_arabic
 * @property int $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string $updated_at
 */
class ServiceProsAndCons extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'service_pros_and_cons';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['service', 'status', 'created_by', 'updated_by'], 'integer'],
            [['title', 'title_arabic', 'description', 'description_arabic'], 'required'],
            [['description', 'description_arabic'], 'string'],
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
            'service' => 'Service',
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
