<?php

namespace backend\controllers;

use Yii;
use common\models\LandingPages;
use common\models\LandingPagesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * LandingPagesController implements the CRUD actions for LandingPages model.
 */
class LandingPagesController extends Controller {

    public function beforeAction($action) {
        if (!parent::beforeAction($action)) {
            return false;
        }
        if (Yii::$app->user->isGuest) {
            $this->redirect(['/site/index']);
            return false;
        }
        return true;
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all LandingPages models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new LandingPagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LandingPages model.
     * @param int $id ID
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new LandingPages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new LandingPages();
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
            $model->services = isset($model->services) && $model->services != '' ? implode(',', $model->services) : '';
            if($model->save()){
                Yii::$app->session->setFlash('success', "New landing page added successfully");
                return $this->redirect(['update', 'id' => $model->id]);
            }
        } return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing LandingPages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
            $model->services = isset($model->services) && $model->services != '' ? implode(',', $model->services) : '';
            if($model->save()){
                Yii::$app->session->setFlash('success', "Data updated successfully");
                return $this->redirect(['update', 'id' => $model->id]);
            }
        }
        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    public function actionBanner($page_id, $id = NULL) {
        $searchModel = new \common\models\LandingPageBannerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['landing_page_id' => $page_id]);
        $model_ = [];
        if ($id == '') {
            $model = new \common\models\LandingPageBanner();
        } else {
            $model = \common\models\LandingPageBanner::findOne($id);
            $model_ = \common\models\LandingPageBanner::findOne($id);
        }
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
            $model->landing_page_id = $page_id;
            $image = UploadedFile::getInstance($model, 'desktop_image');
            $mob_image = UploadedFile::getInstance($model, 'mobile_image');
            $video = UploadedFile::getInstance($model, 'video');
            $flag = 0;
            if (!empty($video)) {
                $flag = 1;
            } elseif (!empty($image) && !empty($mob_image)) {
                $flag = 1;
            }
            if ($flag == 0) {
                 Yii::$app->session->setFlash('error', "Please choose video / images");
            } else {
                if (!empty($image)) {
                    $model->desktop_image = 'image' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $image->extension;
                } else {
                    $model->desktop_image = !empty($model_) ? $model_->desktop_image : '';
                }
                if (!empty($mob_image)) {
                    $model->mobile_image = 'mobile_image' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $mob_image->extension;
                } else {
                    $model->mobile_image = !empty($model_) ? $model_->mobile_image : '';
                }
                if (!empty($video)) {
                    $model->video = 'video' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $video->extension;
                } else {
                    $model->video = !empty($model_) ? $model_->video : '';
                }
                if ($model->validate() && $model->save()) {
                    $model->uploadBanner($image, $mob_image, $video);
                    Yii::$app->session->setFlash('success', "Banner added successfully");
                    return $this->redirect(['banner', 'page_id' => $page_id]);
                }
            }
        }
        return $this->render('banner', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model,
                    'id' => $id,
                    'page_id' => $page_id,
        ]);
    }

    public function actionAbout($page_id) {
        $model = \common\models\LandingPageAbout::find()->where(['landing_page_id' => $page_id])->one();
        $model_ = \common\models\LandingPageAbout::find()->where(['landing_page_id' => $page_id])->one();
        if (empty($model)) {
            $model = new \common\models\LandingPageAbout();
            $model->setScenario('create');
        }
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
            $model->landing_page_id = $page_id;
            $about_image1 = UploadedFile::getInstance($model, 'about_image1');
            $about_image2 = UploadedFile::getInstance($model, 'about_image2');
            $about_description2_image = UploadedFile::getInstance($model, 'about_description2_image');
            if (!empty($about_image1)) {
                $model->about_image1 = 'image1' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $about_image1->extension;
            } else {
                $model->about_image1 = !empty($model_) ? $model_->about_image1 : '';
            }
            if (!empty($about_image2)) {
                $model->about_image2 = 'image2' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $about_image2->extension;
            } else {
                $model->about_image2 = !empty($model_) ? $model_->about_image2 : '';
            }
            if (!empty($about_description2_image)) {
                $model->about_description2_image = 'image3' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $about_description2_image->extension;
            } else {
                $model->about_description2_image = !empty($model_) ? $model_->about_description2_image : '';
            }
            if ($model->validate() && $model->save()) {
                $model->uploadAbout($about_image1, $about_image2, $about_description2_image);
                Yii::$app->session->setFlash('success', "Data updated successfully");
                return $this->redirect(['about', 'page_id' => $page_id]);
            }
        }
        return $this->render('about', [
                    'model' => $model,
                    'page_id' => $page_id,
        ]);
    }

    public function actionVideoSection($page_id) {
        $model = \common\models\LandingPageVideoSection::find()->where(['landing_page_id' => $page_id])->one();
        $model_ = \common\models\LandingPageVideoSection::find()->where(['landing_page_id' => $page_id])->one();
        if (empty($model)) {
            $model = new \common\models\LandingPageVideoSection();
        }
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
            $model->landing_page_id = $page_id;
            $image = UploadedFile::getInstance($model, 'image');
            $video = UploadedFile::getInstance($model, 'video');
            if (!empty($image)) {
                $model->image = 'image' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $image->extension;
            } else {
                $model->image = !empty($model_) ? $model_->image : '';
            }
            if (!empty($video)) {
                $model->video = 'video' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $video->extension;
            } else {
                $model->video = !empty($model_) ? $model_->video : '';
            }
            if ($model->validate() && $model->save()) {
                $model->uploadVideoSec($image, $video);
                Yii::$app->session->setFlash('success', "Data updated successfully");
                return $this->redirect(['video-section', 'page_id' => $page_id]);
            }
        }
        return $this->render('video-section', [
                    'model' => $model,
                    'page_id' => $page_id,
        ]);
    }

    public function actionOurGallery($page_id, $id = NULL) {
        $searchModel = new \common\models\LandingPageImageGallerySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['landing_page_id' => $page_id]);
        $model_ = [];
        if ($id == '') {
            $model = new \common\models\LandingPageImageGallery();
            $model->setScenario('create');
        } else {
            $model = \common\models\LandingPageImageGallery::findOne($id);
            $model_ = \common\models\LandingPageImageGallery::findOne($id);
        }
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
            $model->landing_page_id = $page_id;
            $before_image = UploadedFile::getInstance($model, 'before_image');
            $after_image = UploadedFile::getInstance($model, 'after_image');
            if (!empty($before_image)) {
                $model->before_image = 'before_image' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $before_image->extension;
            } else {
                $model->before_image = !empty($model_) ? $model_->before_image : '';
            }
            if (!empty($after_image)) {
                $model->after_image = 'after_image' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $after_image->extension;
            } else {
                $model->after_image = !empty($model_) ? $model_->after_image : '';
            }
            if ($model->validate() && $model->save()) {
                $model->uploadGallery($before_image, $after_image);
                Yii::$app->session->setFlash('success', "Details added successfully");
                return $this->redirect(['our-gallery', 'page_id' => $page_id]);
            }
        }
        return $this->render('our-gallery', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model,
                    'id' => $id,
                    'page_id' => $page_id,
        ]);
    }
    
    public function actionOurVideos($page_id, $id = NULL) {
        $searchModel = new \common\models\LandingPageVideosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['landing_page_id' => $page_id]);
        $model_ = [];
        if ($id == '') {
            $model = new \common\models\LandingPageVideos();
            $model->setScenario('create');
        } else {
            $model = \common\models\LandingPageVideos::findOne($id);
            $model_ = \common\models\LandingPageVideos::findOne($id);
        }
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
            $model->landing_page_id = $page_id;
            $image = UploadedFile::getInstance($model, 'thumb_image');
            $video = UploadedFile::getInstance($model, 'video');
            if (!empty($image)) {
                $model->thumb_image = 'thumb_image' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $image->extension;
            } else {
                $model->thumb_image = !empty($model_) ? $model_->thumb_image : '';
            }
            if (!empty($video)) {
                $model->video = 'video' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $video->extension;
            } else {
                $model->video = !empty($model_) ? $model_->video : '';
            }
            if ($model->validate() && $model->save()) {
                $model->uploadGallery($image, $video);
                Yii::$app->session->setFlash('success', "Details added successfully");
                return $this->redirect(['our-videos', 'page_id' => $page_id]);
            }
        }
        return $this->render('our-videos', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model,
                    'id' => $id,
                    'page_id' => $page_id,
        ]);
    }

    /**
     * Deletes an existing LandingPages model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionDeleteBanner($page_id,$id) {
        $model = \common\models\LandingPageBanner::find()->where(['id'=>$id])->one();
        if (!empty($model)) {
            $path1 = Yii::$app->basePath . '/../frontend/web/uploads/landing-page-banners/' . $model->desktop_image;
            $path2 = Yii::$app->basePath . '/../frontend/web/uploads/landing-page-banners/' . $model->mobile_image;
            $path3 = Yii::$app->basePath . '/../frontend/web/uploads/landing-page-banners/' . $model->video;
            if ($model->delete()) {
                if (file_exists($path1) && is_file($path1)) {
                    unlink($path1);
                }
                if (file_exists($path2) && is_file($path2)) {
                    unlink($path2);
                }
                if (file_exists($path3) && is_file($path3)) {
                    unlink($path3);
                }
                Yii::$app->session->setFlash('success', "Banner removed successfully");
            }
        }
        return $this->redirect(['banner','page_id'=>$page_id]);
    }
    
    public function actionOurGalleryDelete($page_id,$id) {
       $model = \common\models\LandingPageImageGallery::find()->where(['id'=>$id])->one();
        if (!empty($model)) {
            $path1 = Yii::$app->basePath . '/../frontend/web/uploads/landing-page-our-gallery/' . $model->before_image;
            $path2 = Yii::$app->basePath . '/../frontend/web/uploads/landing-page-our-gallery/' . $model->after_image;
            if ($model->delete()) {
                if (file_exists($path1) && is_file($path1)) {
                    unlink($path1);
                }
                if (file_exists($path2) && is_file($path2)) {
                    unlink($path2);
                }
                Yii::$app->session->setFlash('success', "Gallery image removed successfully");
            }
        }
        return $this->redirect(['our-gallery','page_id'=>$page_id]);
    }
    
    public function actionVideoGalleryDelete($page_id, $id) {
        $model = \common\models\LandingPageVideos::find()->where(['id' => $id])->one();
        if (!empty($model)) {
            $path1 = Yii::$app->basePath . '/../frontend/web/uploads/landing-page-our-videos/' . $model->thumb_image;
            $path2 = Yii::$app->basePath . '/../frontend/web/uploads/landing-page-our-videos/' . $model->video;
            if ($model->delete()) {
                if (file_exists($path1) && is_file($path1)) {
                    unlink($path1);
                }
                if (file_exists($path2) && is_file($path2)) {
                    unlink($path2);
                }
                Yii::$app->session->setFlash('success', "Gallery image removed successfully");
            }
        }
        return $this->redirect(['our-gallery', 'page_id' => $page_id]);
    }

    /**
     * Finds the LandingPages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return LandingPages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = LandingPages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionDelete($id) {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', "Page removed successfully");
        return $this->redirect(['index']);
    }

}
