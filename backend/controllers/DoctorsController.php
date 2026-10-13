<?php

namespace backend\controllers;

use Yii;
use common\models\Doctors;
use common\models\DoctorsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * DoctorsController implements the CRUD actions for Doctors model.
 */
class DoctorsController extends Controller {

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
     * Lists all Doctors models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new DoctorsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Doctors model.
     * @param int $id ID
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Doctors model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Doctors();
        $model->setScenario('create');
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
            $model->department = isset($model->department) && $model->department != '' ? implode(',', $model->department) : '';
            $model->service = isset($model->service) && $model->service != '' ? implode(',', $model->service) : '';
            $model->languages_known = isset($model->languages_known) && $model->languages_known != '' ? implode(',', $model->languages_known) : '';
            $image = UploadedFile::getInstance($model, 'image');
            if (!empty($image)) {
                $model->image = 'doctor' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $image->extension;
            }
            if ($model->validate() && $model->save()) {
                $model->upload($image);
                Yii::$app->session->setFlash('success', "Doctor added successfully");
                return $this->redirect(['index']);
            }
        }
        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Doctors model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $model_ = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
            $model->department = isset($model->department) && $model->department != '' ? implode(',', $model->department) : '';
            $model->service = isset($model->service) && $model->service != '' ? implode(',', $model->service) : '';
            $model->languages_known = isset($model->languages_known) && $model->languages_known != '' ? implode(',', $model->languages_known) : '';
            $image = UploadedFile::getInstance($model, 'image');
            if (!empty($image)) {
                $model->image = 'doctor' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $image->extension;
            } else {
                $model->image = $model_->image;
            }
            if ($model->validate() && $model->save()) {
                $model->upload($image);
                Yii::$app->session->setFlash('success', "Data updated successfully");
                return $this->redirect(['update', 'id' => $model->id]);
            }
        }
        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Doctors model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        if (!empty($model)) {
            $path1 = Yii::$app->basePath . '/../frontend/web/uploads/doctors/' . $model->image;
            \common\models\DoctorGallery::deleteAll(['doctor_id'=>$model->id]);
            if ($model->delete()) {
                if (file_exists($path1) && is_file($path1)) {
                    unlink($path1);
                }
            }
            Yii::$app->session->setFlash('success', "Doctor removed successfully");
        }
         return $this->redirect(['index']);
    }

    /**
     * Finds the Doctors model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Doctors the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Doctors::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
