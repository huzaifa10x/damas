<?php

namespace backend\controllers;

use Yii;
use common\models\MediaGallery;
use common\models\MediaGallerySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * MediaGalleryController implements the CRUD actions for MediaGallery model.
 */
class MediaGalleryController extends Controller {

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
     * Lists all MediaGallery models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new MediaGallerySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new MediaGallery model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new MediaGallery();
        $model->setScenario('create');
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
            $image = UploadedFile::getInstance($model, 'image');
            // $video = UploadedFile::getInstance($model, 'video');
            if (!empty($image)) {
                $model->image = 'galleryimg' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $image->extension;
            }
            // if (!empty($video)) {
            //     $model->video = 'galleryvideo' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $video->extension;
            // }
            $video = [];
            if ($model->validate() && $model->save()) {
                $model->upload($image, $video);
                Yii::$app->session->setFlash('success', "Media gallery added successfully");
                return $this->redirect(['index']);
            }
        }
        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing MediaGallery model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $model_ = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
            $image = UploadedFile::getInstance($model, 'image');
            // $video = UploadedFile::getInstance($model, 'video');
            if (!empty($image)) {
                $model->image = 'galleryimg' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $image->extension;
            } else {
                $model->image = $model_->image;
            }
            // if (!empty($video)) {
            //     $model->video = 'galleryvideo' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $video->extension;
            // } else {
            //     $model->video = $model_->video;
            // }
            $video = [];
            if ($model->validate() && $model->save()) {
                $model->upload($image, $video);
                Yii::$app->session->setFlash('success', "Media gallery updated successfully");
                return $this->redirect(['update', 'id' => $model->id]);
            }
        }
        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MediaGallery model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionDelete($id) {
       $model = $this->findModel($id);
        if (!empty($model)) {
            $path1 = Yii::$app->basePath . '/../frontend/web/uploads/media-gallery/' . $model->image;
            // $path2 = Yii::$app->basePath . '/../frontend/web/uploads/media-gallery/' . $model->video;
            if ($model->delete()) {
                if (file_exists($path1)) {
                    unlink($path1);
                }
                // if (file_exists($path2)) {
                //     unlink($path2);
                // }
                Yii::$app->session->setFlash('success', "Media gallery removed successfully");
            }
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the MediaGallery model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return MediaGallery the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = MediaGallery::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
