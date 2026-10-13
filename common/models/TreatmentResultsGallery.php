<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "treatment_results_gallery".
 *
 * @property int $id
 * @property int|null $department
 * @property int|null $service
 * @property string|null $before_image
 * @property string|null $after_image
 * @property int|null $sort_order
 * @property int $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string $updated_at
 */
class TreatmentResultsGallery extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'treatment_results_gallery';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['department', 'service', 'sort_order', 'status', 'created_by', 'updated_by'], 'integer'],
                [['created_at', 'updated_at'], 'safe'],
                [['before_image', 'after_image'], 'file', 'extensions' => 'jpg, png, jpeg, webp,svg'],
                [['before_image', 'after_image'], 'required', 'on' => 'create'],
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
            'before_image' => 'Before Image',
            'after_image' => 'After Image',
            'sort_order' => 'Sort Order',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    
    public function upload($before_image, $after_image) {
        $path = Yii::$app->basePath . '/../frontend/web/uploads/treatment-gallery';
        FileHelper::createDirectory($path, $mode = 0775, $recursive = true);
        if (!empty($before_image)) {
            $before_image->saveAs($path . '/' . $this->before_image);
        }
        if (!empty($after_image)) {
            $after_image->saveAs($path . '/' . $this->after_image);
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
