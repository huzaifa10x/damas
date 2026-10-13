<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "departments".
 *
 * @property int $id
 * @property string $department_name
 * @property string $department_name_arabic
 * @property string $canonical_name
 * @property string|null $banner_image
 * @property string|null $banner_description
 * @property string|null $banner_description_arabic
 * @property string|null $department_image
 * @property string $department_description
 * @property string $department_description_arabic
 * @property string|null $section3_title
 * @property string|null $section3_title_arabic
 * @property string|null $section3_description
 * @property string|null $section3_description_arabic
 * @property string|null $section3_image
 * @property string|null $section4_title
 * @property string|null $section4_title_arabic
 * @property string|null $section4_description
 * @property string|null $section4_description_arabic
 * @property string|null $section7_title
 * @property string|null $section7_title_arabic
 * @property string|null $section7_description
 * @property string|null $section7_description_arabic
 * @property int $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string $updated_at
 */
class Departments extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'departments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['department_name', 'department_name_arabic', 'canonical_name', 'department_description', 'department_description_arabic'], 'required'],
                [['banner_description', 'banner_description_arabic', 'department_description', 'department_description_arabic', 'section3_description', 'section3_description_arabic', 'section4_description', 'section4_description_arabic', 'section7_description', 'section7_description_arabic'], 'string'],
                [['status', 'created_by', 'updated_by', 'sort_order'], 'integer'],
                [['created_at', 'updated_at', 'meta_title', 'meta_keyword', 'meta_description','meta_title_ar', 'meta_keyword_ar', 'meta_description_ar', 'other_meta_tags'], 'safe'],
                [['department_name', 'department_name_arabic', 'canonical_name', 'section3_title', 'section3_title_arabic', 'section4_title', 'section4_title_arabic', 'section7_title', 'section7_title_arabic','banner_video'], 'string', 'max' => 255],
                [['banner_image', 'department_image', 'section3_image','banner_image_arabic'], 'file', 'extensions' => 'jpg, png, jpeg, webp,svg'],
                // [['banner_video'], 'file', 'extensions' => 'mp4, avi, mov, mkv,wmv'],
                [['department_image', 'banner_image','banner_image_arabic'], 'required', 'on' => 'create'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'department_name' => 'Department Name',
            'department_name_arabic' => 'Department Name Arabic',
            'canonical_name' => 'Canonical Name',
            'banner_image' => 'Banner Image',
            'banner_video' => 'Banner Video Link',
            'banner_description' => 'Banner Description',
            'banner_description_arabic' => 'Banner Description Arabic',
            'department_image' => 'Department Image',
            'department_description' => 'Department Description',
            'department_description_arabic' => 'Department Description Arabic',
            'section3_title' => 'Section3 Title',
            'section3_title_arabic' => 'Section3 Title Arabic',
            'section3_description' => 'Section3 Description',
            'section3_description_arabic' => 'Section3 Description Arabic',
            'section3_image' => 'Section3 Image',
            'section4_title' => 'Section4 Title',
            'section4_title_arabic' => 'Section4 Title Arabic',
            'section4_description' => 'Section4 Description',
            'section4_description_arabic' => 'Section4 Description Arabic',
            'section7_title' => 'Department Pros & Cons Title',
            'section7_title_arabic' => 'Department Pros & Cons Title Arabic',
            'section7_description' => 'Department Pros & Cons Description',
            'section7_description_arabic' => 'Department Pros & Cons Description Arabic',
            'meta_title_ar' => 'Meta Title Arabic',
            'meta_keyword_ar' => 'Meta Keyword Arabic',
            'meta_description_ar' => 'Meta Description Arabic',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function upload($banner_image,$banner_image_arabic, $banner_video, $department_image, $section3_image) {
        $path = Yii::$app->basePath . '/../frontend/web/uploads/departments';
        FileHelper::createDirectory($path, $mode = 0775, $recursive = true);
        if (!empty($banner_image)) {
            $banner_image->saveAs($path . '/' . $this->banner_image);
        } 
        if (!empty($banner_image_arabic)) {
            $banner_image_arabic->saveAs($path . '/' . $this->banner_image_arabic);
        }
        if (!empty($banner_video)) {
            $banner_video->saveAs($path . '/' . $this->banner_video);
        }
        if (!empty($department_image)) {
            $department_image->saveAs($path . '/' . $this->department_image);
        }
        if (!empty($section3_image)) {
            $section3_image->saveAs($path . '/' . $this->section3_image);
        }
        return true;
    }

}
