<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "insurance".
 *
 * @property int $id
 * @property string $department
 * @property string|null $image
 * @property int $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string $updated_at
 */
class Insurance extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'insurance';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['department'], 'required'],
                [['status', 'created_by', 'updated_by'], 'integer'],
                [['created_at', 'updated_at', 'department'], 'safe'],
                [['image'], 'file', 'extensions' => 'jpg, png, jpeg, webp,svg'],
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
            'image' => 'Image',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function upload($image) {
        $path = Yii::$app->basePath . '/../frontend/web/uploads/insurance';
        FileHelper::createDirectory($path, $mode = 0775, $recursive = true);
        if (!empty($image)) {
            $image->saveAs($path . '/' . $this->image);
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
