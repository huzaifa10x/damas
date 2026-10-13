<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "testimonials".
 *
 * @property int $id
 * @property string $department
 * @property string $service
 * @property string $name
 * @property string|null $designation
 * @property string|null $image
 * @property string|null $video
 * @property int $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string $updated_at
 */
class Testimonials extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'testimonials';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['department', 'service', 'name','name_arabic'], 'required'],
                [['status', 'created_by', 'updated_by'], 'integer'],
                [['department', 'service', 'created_at', 'updated_at'], 'safe'],
                [['name', 'designation','video'], 'string', 'max' => 255],
                [['image'], 'file', 'extensions' => 'jpg, png, jpeg, webp,svg'],
                // [['video'], 'file', 'extensions' => 'mp4, avi, mov, mkv,wmv'],
                [['image'], 'required', 'on' => 'create'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'department' => 'Department',
            'service' => 'Service',
            'name' => 'Name',
            'designation' => 'Designation',
            'image' => 'Image',
            'video' => 'Video Link',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    
    public function upload($image,$video) {
        $path = Yii::$app->basePath . '/../frontend/web/uploads/testimonials';
        FileHelper::createDirectory($path, $mode = 0775, $recursive = true);
        if (!empty($image)) {
            $image->saveAs($path . '/' . $this->image);
        }
        if (!empty($video)) {
            $video->saveAs($path . '/' . $this->video);
        }
        return true;
    }
    public function getDepartment(){
        $dep ='';
        $departments = Departments::find()->select('department_name')->where(['id'=> explode(",", $this->department)])->column();
        if(!empty($departments)){
            $dep = implode(",", $departments);
        }
        return $dep;
    }

}
