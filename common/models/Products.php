<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property int|null $department
 * @property int $service
 * @property string $product_name
 * @property string $product_name_arabic
 * @property string $canonical_name
 * @property string|null $image
 * @property string $short_description
 * @property string $short_description_arabic
 * @property string $description
 * @property string $description_arabic
 * @property float $price
 * @property float|null $offer_price
 * @property string|null $meta_title
 * @property string|null $meta_keyword
 * @property string|null $meta_description
 * @property int|null $sort_order
 * @property int $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string $updated_at
 *
 * @property BenefitsOfTreatments[] $benefitsOfTreatments
 * @property ProductFaq[] $productFaqs
 * @property ProductImages[] $productImages
 */
class Products extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['department', 'service', 'sort_order', 'status', 'created_by', 'updated_by'], 'integer'],
                [['product_name', 'product_name_arabic', 'canonical_name', 'short_description', 'short_description_arabic', 'description', 'description_arabic'], 'required'],
                [['description', 'description_arabic', 'meta_description','meta_description_ar'], 'string'],
                [['price', 'offer_price'], 'number'],
                [['created_at', 'updated_at'], 'safe'],
                [['image', 'banner_image'], 'file', 'extensions' => 'jpg, png, jpeg, webp,svg'],
                [['image'], 'required', 'on' => 'create'],
                [['banner_video'], 'file', 'extensions' => 'mp4, avi, mov, mkv,wmv'],
                [['product_name', 'product_name_arabic', 'canonical_name', 'image', 'short_description', 'short_description_arabic', 'meta_title', 'meta_keyword', 'meta_title_ar', 'meta_keyword_ar','link'], 'string', 'max' => 255],
                [['tag'], 'string', 'max' => 15],
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
            'product_name' => 'Offer Title',
            'product_name_arabic' => 'Offer Title Arabic',
            'canonical_name' => 'Canonical Name',
            'image' => 'Image',
            'short_description' => 'Short Description',
            'short_description_arabic' => 'Short Description Arabic',
            'description' => 'Description',
            'description_arabic' => 'Description Arabic',
            'price' => 'Price',
            'offer_price' => 'Offer Price',
            'meta_title' => 'Meta Title',
            'meta_keyword' => 'Meta Keyword',
            'meta_description' => 'Meta Description',
             'meta_title_ar' => 'Meta Title Arabic',
            'meta_keyword_ar' => 'Meta Keyword Arabic',
            'meta_description_ar' => 'Meta Description Arabic',
            'sort_order' => 'Sort Order',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[BenefitsOfTreatments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBenefitsOfTreatments() {
        return $this->hasMany(BenefitsOfTreatments::class, ['product_id' => 'id']);
    }

    /**
     * Gets query for [[ProductFaqs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductFaqs() {
        return $this->hasMany(ProductFaq::class, ['product_id' => 'id']);
    }

    /**
     * Gets query for [[ProductImages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductImages() {
        return $this->hasMany(ProductImages::class, ['product_id' => 'id']);
    }

    public function upload($image) {
        $path = Yii::$app->basePath . '/../frontend/web/uploads/products';
        FileHelper::createDirectory($path, $mode = 0775, $recursive = true);
        if (!empty($image)) {
            $image->saveAs($path . '/' . $this->image);
        }
        return true;
    }

}
