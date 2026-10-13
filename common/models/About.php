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

    /** @var array|null label => [type, value, value_arabic], loaded once per request */
    private static $_dictionary;

    /**
     * Same result as before, but served from one cached read of the whole table
     * instead of one SELECT per call (≈12 per homepage). Cache is cleared on any admin save.
     */
    public static function getValue($param,$language) {
        $dict = self::dictionary();
        $param = self::key($param);
        if (!isset($dict[$param])) {
            return '';
        }
        list($type, $raw, $rawArabic) = $dict[$param];
        if ($type == 2 || $type == 6) {
            return Yii::$app->homeUrl . 'uploads/about/' . $raw; // homeUrl resolved per app (frontend vs /web-admin/)
        }
        if ($type == 5 || $type == 7) {
            return $raw;
        }
        if ($language == 'ar' && $rawArabic != '') {
            return $rawArabic;
        }
        return $raw;
    }

    /** MySQL matched labels case- and trailing-space-insensitively; keep that behaviour. */
    private static function key($label) {
        return strtolower(rtrim((string) $label));
    }

    public static function dictionary() {
        if (self::$_dictionary === null) {
            self::$_dictionary = Yii::$app->cache->getOrSet('about_dictionary_v2', function () {
                $map = [];
                $rows = (new \yii\db\Query())
                    ->select(['label', 'type', 'value', 'value_arabic'])
                    ->from(self::tableName())
                    ->orderBy(['id' => SORT_ASC])
                    ->all(self::getDb());
                foreach ($rows as $row) {
                    $k = self::key($row['label']);
                    if ($row['label'] !== null && !isset($map[$k])) { // first row wins, like ->one() did
                        $map[$k] = [$row['type'], $row['value'], $row['value_arabic']];
                    }
                }
                return $map;
            }, \common\components\ContentCache::DURATION, \common\components\ContentCache::dependency());
        }
        return self::$_dictionary;
    }

}
