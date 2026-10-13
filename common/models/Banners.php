<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "banners".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $title_arabic
 * @property string|null $description
 * @property string|null $description_arabic
 * @property string|null $image
 * @property string|null $video
 * @property int $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string $updated_at
 */
class Banners extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'banners';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'description_arabic'], 'string'],
            [['status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at','page'], 'safe'],
            [['title', 'title_arabic'], 'string', 'max' => 255],
            [['video'], 'file', 'extensions' => 'mp4, avi, mov, mkv,wmv'],
            [['image','image_arabic'], 'file', 'extensions' => 'jpg, png, jpeg, webp,svg'],
            [['image','video','image_arabic'], 'required', 'on' => 'create'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
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
    
    public function upload($image,$image_arabic, $video) {
        $path = Yii::$app->basePath . '/../frontend/web/uploads/banners';
        FileHelper::createDirectory($path, $mode = 0775, $recursive = true);
        if (!empty($image)) {
            $image->saveAs($path . '/' . $this->image);
        }
        if (!empty($image_arabic)) {
            $image_arabic->saveAs($path . '/' . $this->image_arabic);
        }
        if (!empty($video)) {
            $video->saveAs($path . '/' . $this->video);
        }
        return true;
    }
}
