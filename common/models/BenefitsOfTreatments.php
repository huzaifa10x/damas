<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "benefits_of_treatments".
 *
 * @property int $id
 * @property int|null $product_id
 * @property string $title
 * @property string $title_arabic
 * @property string $description
 * @property string $description_arabic
 * @property string|null $image
 * @property int $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string $updated_at
 *
 * @property Services $service
 */
class BenefitsOfTreatments extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'benefits_of_treatments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['product_id', 'status', 'created_by', 'updated_by'], 'integer'],
                [['title', 'title_arabic', 'description', 'description_arabic', 'product_id'], 'required'],
                [['description', 'description_arabic'], 'string'],
                [['created_at', 'updated_at'], 'safe'],
                [['image'], 'file', 'extensions' => 'jpg, png, jpeg, webp,svg'],
                [['title', 'title_arabic'], 'string', 'max' => 255],
                [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::class, 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'product_id' => 'Product',
            'title' => 'Title',
            'title_arabic' => 'Title Arabic',
            'description' => 'Description',
            'description_arabic' => 'Description Arabic',
            'image' => 'Image',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Service]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getService() {
        return $this->hasOne(Services::class, ['id' => 'product_id']);
    }

    public function upload($image) {
        $path = Yii::$app->basePath . '/../frontend/web/uploads/product-benefits';
        FileHelper::createDirectory($path, $mode = 0775, $recursive = true);
        if (!empty($image)) {
            $image->saveAs($path . '/' . $this->image);
        }
        return true;
    }

}
