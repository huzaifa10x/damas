<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "media_library".
 *
 * @property int $id
 * @property string $department
 * @property string $service
 * @property int $category
 * @property string $title
 * @property string $title_arabic
 * @property string|null $document
 * @property string|null $image
 * @property string $posted_date
 * @property int $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string $updated_at
 */
class MediaLibrary extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'media_library';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['department', 'service', 'category', 'title', 'title_arabic', 'posted_date'], 'required'],
                [['category', 'status', 'created_by', 'updated_by'], 'integer'],
                [['posted_date', 'created_at', 'updated_at'], 'safe'],
                [['department', 'service', 'title', 'title_arabic'], 'string', 'max' => 255],
                [['document'], 'file', 'extensions' => 'pdf'],
                [['image'], 'file', 'extensions' => 'jpg, png, jpeg, webp,svg'],
                [['image'], 'required', 'on' => 'create'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'department' => 'Department',
            'service' => 'Service',
            'category' => 'Category',
            'title' => 'Title',
            'title_arabic' => 'Title Arabic',
            'document' => 'Document',
            'image' => 'Image',
            'posted_date' => 'Posted Date',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    
    public function upload($image, $document) {
        $path = Yii::$app->basePath . '/../frontend/web/uploads/media-library';
        FileHelper::createDirectory($path, $mode = 0775, $recursive = true);
        if (!empty($image)) {
            $image->saveAs($path . '/' . $this->image);
        }
        if (!empty($document)) {
            $document->saveAs($path . '/' . $this->document);
        }
        return true;
    }

}
