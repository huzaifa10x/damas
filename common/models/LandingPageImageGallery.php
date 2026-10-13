<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "landing_page_image_gallery".
 *
 * @property int $id
 * @property int|null $landing_page_id
 * @property string|null $before_image
 * @property string|null $after_image
 * @property int|null $sort_order
 * @property int $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string $updated_at
 */
class LandingPageImageGallery extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'landing_page_image_gallery';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['landing_page_id', 'sort_order', 'status', 'created_by', 'updated_by'], 'integer'],
                [['created_at', 'updated_at'], 'safe'],
                [['before_image', 'after_image'], 'file', 'extensions' => 'jpg, png, jpeg, webp,svg'],
                [['before_image', 'after_image'], 'required', 'on' => 'create'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'landing_page_id' => 'Landing Page ID',
            'before_image' => 'Before Image',
            'after_image' => 'After Image',
            'sort_order' => 'Sort Order',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function uploadGallery($before_image, $after_image) {
        $path = Yii::$app->basePath . '/../frontend/web/uploads/landing-page-our-gallery';
        FileHelper::createDirectory($path, $mode = 0775, $recursive = true);
        if (!empty($before_image)) {
            $before_image->saveAs($path . '/' . $this->before_image);
        }
        if (!empty($after_image)) {
            $after_image->saveAs($path . '/' . $this->after_image);
        }
        return true;
    }

}
