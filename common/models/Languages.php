<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "languages".
 *
 * @property int $id
 * @property string $language_name
 * @property string $language_name_arabic
 * @property string|null $flag
 * @property int $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string $updated_at
 */
class Languages extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'languages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['language_name', 'language_name_arabic'], 'required'],
                [['status', 'created_by', 'updated_by'], 'integer'],
                [['created_at', 'updated_at'], 'safe'],
                [['language_name', 'language_name_arabic'], 'string', 'max' => 255],
                [['flag'], 'file', 'extensions' => 'jpg, png, jpeg, webp,svg'],
                [['flag'], 'required', 'on' => 'create'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'language_name' => 'Language Name',
            'language_name_arabic' => 'Language Name Arabic',
            'flag' => 'Flag',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    public function upload($image) {
        $path = Yii::$app->basePath . '/../frontend/web/uploads/languages';
        FileHelper::createDirectory($path, $mode = 0775, $recursive = true);
        if (!empty($image)) {
            $image->saveAs($path . '/' . $this->flag);
        }
        return true;
    }

}
