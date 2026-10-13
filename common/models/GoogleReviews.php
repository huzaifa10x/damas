<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "google_reviews".
 *
 * @property int $id
 * @property string $name
 * @property string $name_arabic
 * @property string $date
 * @property string|null $image
 * @property string $message
 * @property string $message_arabic
 * @property int $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string $updated_at
 */
class GoogleReviews extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'google_reviews';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['name', 'name_arabic', 'date', 'message', 'message_arabic'], 'required'],
                [['date', 'created_at', 'updated_at'], 'safe'],
                [['message', 'message_arabic'], 'string'],
                [['status', 'created_by', 'updated_by','rating'], 'integer'],
                [['name', 'name_arabic'], 'string', 'max' => 255],
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
            'name' => 'Name',
            'name_arabic' => 'Name Arabic',
            'date' => 'Date',
            'image' => 'Photo',
            'message' => 'Message',
            'message_arabic' => 'Message Arabic',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    
    public function upload($image) {
        $path = Yii::$app->basePath . '/../frontend/web/uploads/google-reviews';
        FileHelper::createDirectory($path, $mode = 0775, $recursive = true);
        if (!empty($image)) {
            $image->saveAs($path . '/' . $this->image);
        }
        return true;
    }

}
