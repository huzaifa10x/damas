<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "landing_page_videos".
 *
 * @property int $id
 * @property int|null $landing_page_id
 * @property string|null $thumb_image
 * @property string|null $video
 * @property int|null $sort_order
 * @property int $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string $updated_at
 */
class LandingPageVideos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'landing_page_videos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['landing_page_id', 'sort_order', 'status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['thumb_image', 'video'], 'required', 'on' => 'create'],
            [['thumb_image'], 'file', 'extensions' => 'jpg, png, jpeg, webp,svg'],
                [['video'], 'file', 'extensions' => 'mp4, avi, mov, mkv,wmv'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'landing_page_id' => 'Landing Page ID',
            'thumb_image' => 'Thumb Image',
            'video' => 'Video',
            'sort_order' => 'Sort Order',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    
    public function uploadGallery($image, $video) {
        $path = Yii::$app->basePath . '/../frontend/web/uploads/landing-page-our-videos';
        FileHelper::createDirectory($path, $mode = 0775, $recursive = true);
        if (!empty($image)) {
            $image->saveAs($path . '/' . $this->thumb_image);
        }
        if (!empty($video)) {
            $video->saveAs($path . '/' . $this->video);
        }
        return true;
    }
}
