<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;
/**
 * This is the model class for table "home_banner".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $title_arabic
 * @property string|null $description
 * @property string|null $description_arabic
 * @property int $type 0->image,1->video
 * @property string|null $mobile_image
 * @property string|null $desktop_image
 * @property string|null $video
 * @property int $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string $updated_at
 */
class HomeBanner extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'home_banner';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['type','alt_tag_arabic','alt_tag'], 'required'],
                [['type', 'status', 'created_by', 'updated_by'], 'integer'],
                [['created_at', 'updated_at','link','link_arabic'], 'safe'],
                [['title', 'title_arabic', 'description', 'description_arabic','alt_tag_arabic','alt_tag'], 'string', 'max' => 255],
                [['mobile_image', 'desktop_image','desktop_image_arabic'], 'file', 'extensions' => 'jpg, png, jpeg, webp,svg'],
                [['video'], 'file', 'extensions' => 'mp4, avi, mov, mkv,wmv'],
                ['desktop_image', 'required', 'on' => 'create', 'when' => function ($model) {
                    return $model->type == '0';
                }, 'whenClient' => "function (attribute, value) {
                return $('#homebanner-type').val() == '0';
            }"],
            ['desktop_image_arabic', 'required', 'on' => 'create', 'when' => function ($model) {
                    return $model->type == '0';
                }, 'whenClient' => "function (attribute, value) {
                return $('#homebanner-type').val() == '0';
            }"],
                ['mobile_image', 'required', 'on' => 'create', 'when' => function ($model) {
                    return $model->type == '0';
                }, 'whenClient' => "function (attribute, value) {
                return $('#homebanner-type').val() == '0';
            }"],
                        ['video', 'required', 'on' => 'create', 'when' => function ($model) {
                    return $model->type == '1';
                }, 'whenClient' => "function (attribute, value) {
                return $('#homebanner-type').val() == '1';
            }"],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'title_arabic' => 'Title Arabic',
            'description' => 'Description',
            'description_arabic' => 'Description Arabic',
            'type' => 'Type',
            'mobile_image' => 'Mobile Image',
            'desktop_image' => 'Desktop Image',
            'video' => 'Video',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function upload($image,$desktop_image_arabic, $image_mob, $video) {
        $path = Yii::$app->basePath . '/../frontend/web/uploads/home-banners';
        FileHelper::createDirectory($path, $mode = 0775, $recursive = true);
        if (!empty($image)) {
            $image->saveAs($path . '/' . $this->desktop_image);
        } 
        if (!empty($desktop_image_arabic)) {
            $desktop_image_arabic->saveAs($path . '/' . $this->desktop_image_arabic);
        }
        if (!empty($image_mob)) {
            $image_mob->saveAs($path . '/' . $this->mobile_image);
        }
        if (!empty($video)) {
            $video->saveAs($path . '/' . $this->video);
        }
        return true;
    }

}
