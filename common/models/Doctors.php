<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "doctors".
 *
 * @property int $id
 * @property string $department
 * @property string $doctor_name
 * @property string $doctor_name_arabic
 * @property string $designation
 * @property string $designation_arabic
 * @property string $email
 * @property string $languages_known
 * @property string $description
 * @property string $description_arabic
 * @property string|null $overview
 * @property string|null $overview_arabic
 * @property string|null $qualifications
 * @property string|null $qualifications_arabic
 * @property string|null $work_experience
 * @property string|null $work_experience_arabic
 * @property int $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string $updated_at
 */
class Doctors extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'doctors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['doctor_name', 'doctor_name_arabic', 'designation', 'designation_arabic', 'languages_known', 'description', 'description_arabic'], 'required'],
                [['description', 'description_arabic', 'overview', 'overview_arabic', 'qualifications', 'qualifications_arabic', 'work_experience', 'work_experience_arabic'], 'string'],
                [['status', 'created_by', 'updated_by'], 'integer'],
                [['department', 'created_at', 'updated_at','canonical_name','languages_known','service'], 'safe'],
                ['canonical_name', 'unique'],
                [['image'], 'file', 'extensions' => 'jpg, png, jpeg, webp,svg'],
                [['image'], 'required', 'on' => 'create'],
                [['doctor_name', 'doctor_name_arabic', 'designation', 'designation_arabic', 'email'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'department' => 'Departments',
            'doctor_name' => 'Doctor Name',
            'doctor_name_arabic' => 'Doctor Name Arabic',
            'designation' => 'Designation',
            'designation_arabic' => 'Designation Arabic',
            'email' => 'Email',
            'languages_known' => 'Languages Known',
            'description' => 'Description',
            'description_arabic' => 'Description Arabic',
            'overview' => 'Overview',
            'overview_arabic' => 'Overview Arabic',
            'qualifications' => 'Qualifications',
            'qualifications_arabic' => 'Qualifications Arabic',
            'work_experience' => 'Work Experience',
            'work_experience_arabic' => 'Work Experience Arabic',
            'image' => 'Photo',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function upload($image) {
        $path = Yii::$app->basePath . '/../frontend/web/uploads/doctors';
        FileHelper::createDirectory($path, $mode = 0775, $recursive = true);
        if (!empty($image)) {
            $image->saveAs($path . '/' . $this->image);
        }
        return true;
    }

}
