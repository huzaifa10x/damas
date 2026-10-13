<?php

namespace backend\controllers;

use Yii;
use common\models\DoctorGallery;
use common\models\DoctorGallerySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * DoctorGalleryController implements the CRUD actions for DoctorGallery model.
 */
class DoctorGalleryController extends Controller {

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
     * Lists all DoctorGallery models.
     * @return mixed
     */
    public function actionIndex($doctor_id, $id = NULL) {
        $searchModel = new DoctorGallerySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['doctor_id' => $doctor_id]);
        $model_ = [];
        if ($id == '') {
            $model = new DoctorGallery();
            $model->setScenario('create');
        } else {
            $model = $this->findModel($id);
            $model_ = $this->findModel($id);
        }
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
            $model->doctor_id = $doctor_id;
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
                Yii::$app->session->setFlash('success', "Details added successfully");
                return $this->redirect(['index', 'doctor_id' => $doctor_id]);
            }
        }
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model,
                    'id' => $id,
                    'doctor_id' => $doctor_id,
        ]);
    }

    /**
     * Deletes an existing DoctorGallery model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionDelete($doctor_id, $id) {
        $model = $this->findModel($id);
        if (!empty($model)) {
            $path1 = Yii::$app->basePath . '/../frontend/web/uploads/doctor-gallery/' . $model->before_image;
            $path2 = Yii::$app->basePath . '/../frontend/web/uploads/doctor-gallery/' . $model->after_image;
            if ($model->delete()) {
                if (file_exists($path1)) {
                    unlink($path1);
                }
                if (file_exists($path2)) {
                    unlink($path2);
                }
            }
            Yii::$app->session->setFlash('success', "Data removed successfully");
        }
        return $this->redirect(['index', 'doctor_id' => $doctor_id]);
    }

    /**
     * Finds the DoctorGallery model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return DoctorGallery the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = DoctorGallery::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
