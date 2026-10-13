<?php

namespace backend\controllers;

use Yii;
use common\models\TreatmentResultsGallery;
use common\models\TreatmentResultsGallerySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * TreatmentResultsGalleryController implements the CRUD actions for TreatmentResultsGallery model.
 */
class TreatmentResultsGalleryController extends Controller {

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
     * Lists all TreatmentResultsGallery models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TreatmentResultsGallerySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new TreatmentResultsGallery model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new TreatmentResultsGallery();
        $model->setScenario('create');
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
            $before_image = UploadedFile::getInstance($model, 'before_image');
            $after_image = UploadedFile::getInstance($model, 'after_image');
            if (!empty($before_image)) {
                $model->before_image = 'before_image' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $before_image->extension;
            }
            if (!empty($after_image)) {
                $model->after_image = 'after_image' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $after_image->extension;
            }
            if ($model->validate() && $model->save()) {
                $model->upload($before_image, $after_image);
                Yii::$app->session->setFlash('success', "Image added successfully");
                return $this->redirect(['index']);
            }
        }
        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing TreatmentResultsGallery model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $model_ = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
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
                $model->upload($before_image, $after_image);
                Yii::$app->session->setFlash('success', "Image updated successfully");
                return $this->redirect(['index']);
            }
        }
        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TreatmentResultsGallery model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionDelete($id) {
         $model = $this->findModel($id);
        if (!empty($model)) {
            $path1 = Yii::$app->basePath . '/../frontend/web/uploads/treatment-gallery/' . $model->before_image;
            $path2 = Yii::$app->basePath . '/../frontend/web/uploads/treatment-gallery/' . $model->after_image;
            if ($model->delete()) {
                if (file_exists($path1)) {
                    unlink($path1);
                }
                if (file_exists($path2)) {
                    unlink($path2);
                }
                Yii::$app->session->setFlash('success', "Data removed successfully");
            }
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the TreatmentResultsGallery model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return TreatmentResultsGallery the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = TreatmentResultsGallery::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
