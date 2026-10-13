<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "sub_services".
 *
 * @property int $id
 * @property int|null $service
 * @property string $title
 * @property string $title_arabic
 * @property string $small_description
 * @property string $small_description_arabic
 * @property string $section1_title
 * @property string $section1_title_arabic
 * @property string $section1_description
 * @property string $section1_description_arabic
 * @property string|null $section2_title
 * @property string|null $section2_title_arabic
 * @property string|null $section2_description
 * @property string|null $section2_description_arabic
 * @property string|null $section3_title
 * @property string|null $section3_title_arabic
 * @property string|null $section3_description
 * @property string|null $section3_description_arabic
 * @property string|null $section4_description
 * @property string|null $section4_description_arabic
 * @property string|null $image
 * @property int $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string $updated_at
 */
class SubServices extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'sub_services';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['service', 'status', 'created_by', 'updated_by'], 'integer'],
                [['title', 'title_arabic', 'section1_title', 'section1_title_arabic', 'section1_description', 'section1_description_arabic','canonical_name'], 'required'],
                [['small_description', 'small_description_arabic', 'section1_description', 'section1_description_arabic', 'section2_description', 'section2_description_arabic', 'section3_description', 'section3_description_arabic', 'section4_description', 'section4_description_arabic'], 'string'],
                [['created_at', 'updated_at','meta_title','meta_keyword','meta_description','other_meta_tags'], 'safe'],
                [['title', 'title_arabic'], 'string', 'max' => 100],
                [['image'], 'file', 'extensions' => 'jpg, png, jpeg, webp,svg'],
                [['image'], 'required', 'on' => 'create'],
                [['section1_title', 'section1_title_arabic', 'section2_title', 'section2_title_arabic', 'section3_title', 'section3_title_arabic', 'image','canonical_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'service' => 'Service',
            'title' => 'Title',
            'title_arabic' => 'Title Arabic',
            'small_description' => 'Small Description',
            'small_description_arabic' => 'Small Description Arabic',
            'section1_title' => 'Section1 Title',
            'section1_title_arabic' => 'Section1 Title Arabic',
            'section1_description' => 'Section1 Description',
            'section1_description_arabic' => 'Section1 Description Arabic',
            'section2_title' => 'Section2 Title',
            'section2_title_arabic' => 'Section2 Title Arabic',
            'section2_description' => 'Section2 Description',
            'section2_description_arabic' => 'Section2 Description Arabic',
            'section3_title' => 'Section3 Title',
            'section3_title_arabic' => 'Section3 Title Arabic',
            'section3_description' => 'Section3 Description',
            'section3_description_arabic' => 'Section3 Description Arabic',
            'section4_description' => 'Section4 Description',
            'section4_description_arabic' => 'Section4 Description Arabic',
            'image' => 'Image',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    
    public function upload($banner_image) {
        $path = Yii::$app->basePath . '/../frontend/web/uploads/sub-services';
        FileHelper::createDirectory($path, $mode = 0775, $recursive = true);
        if (!empty($banner_image)) {
            $banner_image->saveAs($path . '/' . $this->image);
        }
        return true;
    }

}
