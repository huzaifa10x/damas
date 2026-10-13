<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "landing_page_video_section".
 *
 * @property int $id
 * @property int|null $landing_page_id
 * @property string $title
 * @property string $title_arabic
 * @property string $description
 * @property string $description_arabic
 * @property string|null $image
 * @property string|null $video
 * @property int $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string $updated_at
 */
class LandingPageVideoSection extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'landing_page_video_section';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['landing_page_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['title', 'title_arabic', 'description', 'description_arabic'], 'required'],
            [['description', 'description_arabic'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'title_arabic', 'image', 'video'], 'string', 'max' => 255],
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
            'title' => 'Title',
            'title_arabic' => 'Title Arabic',
            'description' => 'Description',
            'description_arabic' => 'Description Arabic',
            'image' => 'Image',
            'video' => 'Video',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    
    public function uploadVideoSec($image, $video) {
        $path = Yii::$app->basePath . '/../frontend/web/uploads/landing-page-video-section';
        FileHelper::createDirectory($path, $mode = 0775, $recursive = true);
        if (!empty($image)) {
            $image->saveAs($path . '/' . $this->image);
        }
        
        if (!empty($video)) {
            $video->saveAs($path . '/' . $this->video);
        }
        return true;
    }
}
