<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "department_pros_and_cons".
 *
 * @property int $id
 * @property int|null $department_id
 * @property string $title
 * @property string $title_arabic
 * @property string $description
 * @property string $description_arabic
 * @property int $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string $updated_at
 *
 * @property Departments $department
 */
class DepartmentProsAndCons extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'department_pros_and_cons';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['department_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['title', 'title_arabic', 'description', 'description_arabic'], 'required'],
            [['description', 'description_arabic'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'title_arabic'], 'string', 'max' => 255],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Departments::class, 'targetAttribute' => ['department_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'department_id' => 'Department ID',
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

    /**
     * Gets query for [[Department]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Departments::class, ['id' => 'department_id']);
    }
}
