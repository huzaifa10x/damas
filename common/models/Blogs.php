<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "blogs".
 *
 * @property int $id
 * @property int $department_id
 * @property string $title
 * @property string $title_arabic
 * @property string $canonical_name
 * @property string|null $image1
 * @property string|null $image2
 * @property string|null $video
 * @property string $date
 * @property string $description
 * @property string $description_arabic
 * @property string|null $more_details
 * @property string|null $more_details_arabic
 * @property int|null $views
 * @property int $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string $updated_at
 */
class Blogs extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'blogs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['department_id', 'title', 'title_arabic', 'canonical_name', 'date', 'description', 'description_arabic'], 'required'],
                [['department_id', 'views', 'status', 'created_by', 'updated_by'], 'integer'],
                [['date', 'created_at', 'updated_at','meta_title','meta_keyword','meta_description','other_meta_tags'], 'safe'],
                [['description', 'description_arabic', 'more_details', 'more_details_arabic'], 'string'],
                [['title', 'title_arabic', 'canonical_name', 'image1', 'image2', 'video'], 'string', 'max' => 255],
                [['video'], 'file', 'extensions' => 'mp4, avi, mov, mkv,wmv'],
                [['image1', 'image2','main_image'], 'file', 'extensions' => 'jpg, png, jpeg, webp,svg'],
                [['main_image'], 'required', 'on' => 'create'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'department_id' => 'Department',
            'title' => 'Title',
            'title_arabic' => 'Title Arabic',
            'canonical_name' => 'Canonical Name',
            'image1' => 'Image1',
            'image2' => 'Image2',
            'video' => 'Video',
            'date' => 'Date',
            'description' => 'Description',
            'description_arabic' => 'Description Arabic',
            'more_details' => 'More Details',
            'more_details_arabic' => 'More Details Arabic',
            'views' => 'Views',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function upload($main_image,$image1,$image2, $video) {
        $path = Yii::$app->basePath . '/../frontend/web/uploads/blogs';
        FileHelper::createDirectory($path, $mode = 0775, $recursive = true);
        if (!empty($main_image)) {
            $main_image->saveAs($path . '/' . $this->main_image);
        }
        if (!empty($image1)) {
            $image1->saveAs($path . '/' . $this->image1);
        }
        if (!empty($image2)) {
            $image2->saveAs($path . '/' . $this->image2);
        }
        if (!empty($video)) {
            $video->saveAs($path . '/' . $this->video);
        }
        return true;
    }

}
