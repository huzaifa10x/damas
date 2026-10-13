<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "about".
 *
 * @property int $id
 * @property int|null $type 1->text,2->image,3->editor,4->text area,5->Number,6->video
 * @property string|null $label
 * @property string|null $value
 * @property string|null $value_arabic
 * @property int $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string $updated_at
 */
class About extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'about';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['type', 'status', 'created_by', 'updated_by'], 'integer'],
                [['value','value_arabic'], 'safe'],
                [['DOC', 'DOU'], 'safe'],
                [['label'], 'string', 'max' => 100],
                [
                'value',
                'file', 'extensions' => 'jpg, png, jpeg, webp', 'maxSize' => 1024 * 1024 * 2,
                'when' => function ($model) {
                    return $model->type == 2;
                },
                'whenClient' => "function (attribute, value) { 
              return $('#about-type').val() == '2'; 
          }"
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'label' => 'Label',
            'value' => 'Value',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function upload($image) {
        if (!empty($image)) {
            $path = Yii::$app->basePath . '/../frontend/web/uploads/about';
            FileHelper::createDirectory($path, $mode = 0775, $recursive = true);
            if (!empty($image)) {
                $image->saveAs($path . '/' . $this->value);
            }
        }
        return true;
    }

    public static function getValue($param,$language) {
        $data = About::find()->where(['label' => $param])->one();
        $value = '';
        if (!empty($data)) {
            if ($data->type == 2 || $data->type == 6) {
                $value = Yii::$app->homeUrl . 'uploads/about/' . $data->value;
            }elseif ($data->type == 5 || $data->type == 7) {
                $value = $data->value;
            }  else {
                $value = $data->value;
                if($language == 'ar' && $data->value_arabic != ''){
                    $value = $data->value_arabic;
                }
            }
        }
        return $value;
    }

}
