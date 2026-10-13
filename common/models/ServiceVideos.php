<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "service_videos".
 *
 * @property int $id
 * @property int|null $service
 * @property string|null $thumb_image
 * @property string|null $video
 * @property int|null $sort_order
 * @property int $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string $updated_at
 */
class ServiceVideos extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'service_videos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['service', 'sort_order', 'status', 'created_by', 'updated_by'], 'integer'],
                [['created_at', 'updated_at'], 'safe'],
                [['video'], 'string', 'max' => 255],
                // [['video'], 'file', 'extensions' => 'mp4, avi, mov, mkv,wmv'],
                [['thumb_image'], 'file', 'extensions' => 'jpg, png, jpeg, webp,svg'],
                [['thumb_image', 'video'], 'required', 'on' => 'create'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'service' => 'Service',
            'thumb_image' => 'Thumb Image',
            'video' => 'Video Link',
            'sort_order' => 'Sort Order',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    
    public function upload($image, $video) {
        $path = Yii::$app->basePath . '/../frontend/web/uploads/service-videos';
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
