<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "landing_page_about".
 *
 * @property int $id
 * @property int|null $landing_page_id
 * @property string|null $welcome_title
 * @property string|null $welcome_title_arabic
 * @property string|null $welcome_description
 * @property string|null $welcome_description_arabic
 * @property string|null $about_image1
 * @property string|null $about_description1
 * @property string|null $about_description1_arabic
 * @property string|null $about_image2
 * @property string|null $about_description2_title
 * @property string|null $about_description2_title_arabic
 * @property string|null $about_description2
 * @property string|null $about_description2_arabic
 * @property string|null $about_description2_image
 * @property int $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string $updated_at
 */
class LandingPageAbout extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'landing_page_about';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['landing_page_id', 'status', 'created_by', 'updated_by'], 'integer'],
                [['welcome_description', 'welcome_description_arabic', 'about_description1', 'about_description1_arabic', 'about_description2', 'about_description2_arabic'], 'required'],
                [['welcome_description', 'welcome_description_arabic', 'about_description1', 'about_description1_arabic', 'about_description2', 'about_description2_arabic'], 'string'],
                [['created_at', 'updated_at'], 'safe'],
                 [['about_image1', 'about_image2','about_description2_image'], 'file', 'extensions' => 'jpg, png, jpeg, webp,svg'],
                 [['about_image1', 'about_image2','about_description2_image'], 'required', 'on' => 'create'],
                [['welcome_title', 'welcome_title_arabic', 'about_description2_title', 'about_description2_title_arabic'], 'string', 'max' => 255],
                [['welcome_title', 'welcome_title_arabic', 'about_description2_title', 'about_description2_title_arabic'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'landing_page_id' => 'Landing Page ID',
            'welcome_title' => 'Welcome Title',
            'welcome_title_arabic' => 'Welcome Title Arabic',
            'welcome_description' => 'Welcome Description',
            'welcome_description_arabic' => 'Welcome Description Arabic',
            'about_image1' => 'About Image1',
            'about_description1' => 'About Description1',
            'about_description1_arabic' => 'About Description1 Arabic',
            'about_image2' => 'About Image2',
            'about_description2_title' => 'About Description2 Title',
            'about_description2_title_arabic' => 'About Description2 Title Arabic',
            'about_description2' => 'About Description2',
            'about_description2_arabic' => 'About Description2 Arabic',
            'about_description2_image' => 'About Description2 Image',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function uploadAbout($about_image1, $about_image2, $about_description2_image) {
        $path = Yii::$app->basePath . '/../frontend/web/uploads/landing-page-about';
        FileHelper::createDirectory($path, $mode = 0775, $recursive = true);
        if (!empty($about_image1)) {
            $about_image1->saveAs($path . '/' . $this->about_image1);
        }
        if (!empty($about_image2)) {
            $about_image2->saveAs($path . '/' . $this->about_image2);
        }
        if (!empty($about_description2_image)) {
            $about_description2_image->saveAs($path . '/' . $this->about_description2_image);
        }
        return true;
    }

}
