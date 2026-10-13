<?php

namespace backend\controllers;

use Yii;
use common\models\HomeBanner;
use common\models\HomeBannerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * HomeBannerController implements the CRUD actions for HomeBanner model.
 */
class HomeBannerController extends Controller {

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
     * Lists all HomeBanner models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new HomeBannerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single HomeBanner model.
     * @param int $id ID
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new HomeBanner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new HomeBanner();
        $model->setScenario('create');
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
            $image = UploadedFile::getInstance($model, 'desktop_image');
            $desktop_image_arabic = UploadedFile::getInstance($model, 'desktop_image_arabic');
            $image_mob = UploadedFile::getInstance($model, 'mobile_image');
            $video = UploadedFile::getInstance($model, 'video');
            if (!empty($image)) {
                $model->desktop_image = 'home_banner' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $image->extension;
            }
            if (!empty($desktop_image_arabic)) {
                $model->desktop_image_arabic = 'home_banner_ar' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $desktop_image_arabic->extension;
            }
            if (!empty($image_mob)) {
                $model->mobile_image = 'home_banner_mob' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $image_mob->extension;
            }
            if (!empty($video)) {
                $model->video = 'home_banner' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $video->extension;
            }
            if ($model->validate() && $model->save()) {
                $model->upload($image,$desktop_image_arabic, $image_mob, $video);
                Yii::$app->session->setFlash('success', "Banner added successfully");
                return $this->redirect(['index']);
            }
        }
        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing HomeBanner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $model_ = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
            $image = UploadedFile::getInstance($model, 'desktop_image');
            $desktop_image_arabic = UploadedFile::getInstance($model, 'desktop_image_arabic');
            $image_mob = UploadedFile::getInstance($model, 'mobile_image');
            $video = UploadedFile::getInstance($model, 'video');
            if (!empty($image)) {
                $model->desktop_image = 'home_banner' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $image->extension;
            } else {
                $model->desktop_image = $model_->desktop_image;
            }
            if (!empty($desktop_image_arabic)) {
                $model->desktop_image_arabic = 'home_banner_ar' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $desktop_image_arabic->extension;
            } else {
                $model->desktop_image_arabic = $model_->desktop_image_arabic;
            }
            if (!empty($image_mob)) {
                $model->mobile_image = 'home_banner_mob' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $image_mob->extension;
            } else {
                $model->mobile_image = $model_->mobile_image;
            }
            if (!empty($video)) {
                $model->video = 'home_banner' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $video->extension;
            } else {
                $model->video = $model_->video;
            }
            if ($model->validate() && $model->save()) {
                $model->upload($image,$desktop_image_arabic, $image_mob, $video);
                Yii::$app->session->setFlash('success', "Banner updated successfully");
                return $this->redirect(['index']);
            }
        }
        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing HomeBanner model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        if (!empty($model)) {
            $path1 = Yii::$app->basePath . '/../frontend/web/uploads/home-banners/' . $model->desktop_image;
            $path2 = Yii::$app->basePath . '/../frontend/web/uploads/home-banners/' . $model->mobile_image;
            $path3 = Yii::$app->basePath . '/../frontend/web/uploads/home-banners/' . $model->video;
            if ($model->delete()) {
                if (file_exists($path1)) {
                    unlink($path1);
                }
                if (file_exists($path2)) {
                    unlink($path2);
                }
                if (file_exists($path3)) {
                    unlink($path3);
                }
                Yii::$app->session->setFlash('success', "Department removed successfully");
            }
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the HomeBanner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return HomeBanner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = HomeBanner::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
