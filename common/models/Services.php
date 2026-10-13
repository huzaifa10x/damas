<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "services".
 *
 * @property int $id
 * @property int $department
 * @property string $service_name
 * @property string $service_name_arabic
 * @property string $canonical_name
 * @property string|null $banner_image
 * @property string|null $banner_description
 * @property string|null $banner_description_arabic
 * @property string|null $service_image
 * @property string $service_description
 * @property string $service_description_arabic
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
 * @property string|null $meta_title
 * @property string|null $meta_keyword
 * @property string|null $meta_description
 * @property string|null $other_meta_tags
 * @property int $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string $updated_at
 */
class Services extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'services';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['department', 'service_name', 'service_name_arabic', 'canonical_name', 'service_description', 'service_description_arabic'], 'required'],
                [['department', 'status', 'created_by', 'updated_by', 'sort_order'], 'integer'],
                [['banner_description', 'banner_description_arabic', 'service_description', 'service_description_arabic', 'section3_description', 'section3_description_arabic', 'section4_description', 'section4_description_arabic', 'section7_description', 'section7_description_arabic', 'meta_description', 'meta_description_ar', 'other_meta_tags'], 'string'],
                [['created_at', 'updated_at','sub_service_description','sub_service_description_arabic','shown_in_landing_page'], 'safe'],
                [['service_name', 'service_name_arabic', 'canonical_name', 'banner_image', 'service_image', 'section3_title', 'section3_title_arabic', 'section3_image', 'section4_title', 'section4_title_arabic', 'section7_title', 'section7_title_arabic', 'meta_title', 'meta_title_ar', 'meta_keyword', 'meta_keyword_ar', 'sub_service_title','sub_service_title_arabic'], 'string', 'max' => 255],
                [['banner_image', 'service_image', 'section3_image','banner_image_arabic'], 'file', 'extensions' => 'jpg, png, jpeg, webp,svg'],
                [['service_image', 'banner_image','banner_image_arabic'], 'required', 'on' => 'create'],
                [['banner_video'], 'file', 'extensions' => 'mp4, avi, mov, mkv,wmv'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'department' => 'Department',
            'service_name' => 'Service Name',
            'service_name_arabic' => 'Service Name Arabic',
            'canonical_name' => 'Canonical Name',
            'banner_image' => 'Banner Image',
            'banner_description' => 'Banner Description',
            'banner_description_arabic' => 'Banner Description Arabic',
            'service_image' => 'Service Image',
            'service_description' => 'Service Description',
            'service_description_arabic' => 'Service Description Arabic',
            'section3_title' => 'Section3 Title',
            'section3_title_arabic' => 'Section3 Title Arabic',
            'section3_description' => 'Section3 Description',
            'section3_description_arabic' => 'Section3 Description Arabic',
            'section3_image' => 'Section3 Image',
            'section4_title' => 'Section4 Title',
            'section4_title_arabic' => 'Section4 Title Arabic',
            'section4_description' => 'Section4 Description',
            'section4_description_arabic' => 'Section4 Description Arabic',
            'section7_title' => 'Section7 Title',
            'section7_title_arabic' => 'Section7 Title Arabic',
            'section7_description' => 'Section7 Description',
            'section7_description_arabic' => 'Section7 Description Arabic',
            'meta_title' => 'Meta Title',
            'meta_keyword' => 'Meta Keyword',
            'meta_description' => 'Meta Description',
            'meta_title_ar' => 'Meta Title Arabic',
            'meta_keyword_ar' => 'Meta Keyword Arabic',
            'meta_description_ar' => 'Meta Description Arabic',
            'other_meta_tags' => 'Other Meta Tags',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function upload($banner_image,$banner_image_arabic, $banner_video, $service_image, $section3_image) {
        $path = Yii::$app->basePath . '/../frontend/web/uploads/services';
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
        if (!empty($service_image)) {
            $service_image->saveAs($path . '/' . $this->service_image);
        }
        if (!empty($section3_image)) {
            $section3_image->saveAs($path . '/' . $this->section3_image);
        }
        return true;
    }

}
