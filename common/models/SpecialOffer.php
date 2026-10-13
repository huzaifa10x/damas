<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "special_offer".
 *
 * @property int $id
 * @property string $title
 * @property string $title_arabic
 * @property string $link
 * @property string $link_arabic
 * @property string|null $image
 * @property int $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string $updated_at
 */
class SpecialOffer extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'special_offer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['title', 'title_arabic', 'link', 'link_arabic'], 'required'],
                [['status', 'created_by', 'updated_by'], 'integer'],
                [['created_at', 'updated_at'], 'safe'],
                [['title', 'title_arabic', 'link', 'link_arabic'], 'string', 'max' => 255],
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
            'title' => 'Title',
            'title_arabic' => 'Title Arabic',
            'link' => 'Link',
            'link_arabic' => 'Link Arabic',
            'image' => 'Image',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    
    public function upload($image) {
        $path = Yii::$app->basePath . '/../frontend/web/uploads/special-offer';
        FileHelper::createDirectory($path, $mode = 0775, $recursive = true);
        if (!empty($image)) {
            $image->saveAs($path . '/' . $this->image);
        }
        return true;
    }

}
