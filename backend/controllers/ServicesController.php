<?php

namespace backend\controllers;

use Yii;
use common\models\Services;
use common\models\ServicesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ServicesController implements the CRUD actions for Services model.
 */
class ServicesController extends Controller {

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
     * Lists all Services models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ServicesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Services model.
     * @param int $id ID
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Services model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Services();
        $model->setScenario('create');
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
            $banner_image = UploadedFile::getInstance($model, 'banner_image');
            $banner_image_arabic = UploadedFile::getInstance($model, 'banner_image_arabic');
            $banner_video = UploadedFile::getInstance($model, 'banner_video');
            $servive_image = UploadedFile::getInstance($model, 'service_image');
            $section3_image = UploadedFile::getInstance($model, 'section3_image');
            if (!empty($banner_image)) {
                $model->banner_image = 'banner_image' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $banner_image->extension;
            }
            if (!empty($banner_image_arabic)) {
                $model->banner_image_arabic = 'banner_image_ar' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $banner_image_arabic->extension;
            }
            if (!empty($banner_video)) {
                $model->banner_video = 'banner_video' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $banner_video->extension;
            }
            if (!empty($servive_image)) {
                $model->service_image = 'service_image' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $servive_image->extension;
            }
            if (!empty($section3_image)) {
                $model->section3_image = 'section3_image' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $section3_image->extension;
            }
            if ($model->validate() && $model->save()) {
                $model->upload($banner_image,$banner_image_arabic, $banner_video, $servive_image, $section3_image);
                Yii::$app->session->setFlash('success', "Service added successfully");
                return $this->redirect(['index']);
            } else {
                var_dump($model->getErrors());
                exit;
            }
        }
        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Services model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $model_ = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
            $banner_image = UploadedFile::getInstance($model, 'banner_image');
            $banner_image_arabic = UploadedFile::getInstance($model, 'banner_image_arabic');
            $banner_video = UploadedFile::getInstance($model, 'banner_video');
            $service_image = UploadedFile::getInstance($model, 'service_image');
            $section3_image = UploadedFile::getInstance($model, 'section3_image');
            if (!empty($banner_image)) {
                $model->banner_image = 'banner_image' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $banner_image->extension;
            } else {
                $model->banner_image = $model_->banner_image;
            }
            if (!empty($banner_image_arabic)) {
                $model->banner_image_arabic = 'banner_image_ar' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $banner_image_arabic->extension;
            } else {
                $model->banner_image_arabic = $model_->banner_image_arabic;
            }
            if (!empty($banner_video)) {
                $model->banner_video = 'banner_video' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $banner_video->extension;
            } else {
                $model->banner_video = $model_->banner_video;
            }
            if (!empty($service_image)) {
                $model->service_image = 'service_image' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $service_image->extension;
            } else {
                $model->service_image = $model_->service_image;
            }
            if (!empty($section3_image)) {
                $model->section3_image = 'section3_image' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $section3_image->extension;
            } else {
                $model->section3_image = $model_->section3_image;
            }
            if ($model->validate() && $model->save()) {
                $model->upload($banner_image,$banner_image_arabic, $banner_video, $service_image, $section3_image);
                Yii::$app->session->setFlash('success', "Data updated successfully");
                return $this->redirect(['update', 'id' => $model->id]);
            }
        }
        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Services model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        if (!empty($model)) {
            $path1 = Yii::$app->basePath . '/../frontend/web/uploads/services/' . $model->banner_image;
            $path11 = Yii::$app->basePath . '/../frontend/web/uploads/services/' . $model->banner_image_arabic;
            $path4 = Yii::$app->basePath . '/../frontend/web/uploads/services/' . $model->banner_video;
            $path2 = Yii::$app->basePath . '/../frontend/web/uploads/services/' . $model->service_image;
            $path3 = Yii::$app->basePath . '/../frontend/web/uploads/services/' . $model->section3_image;
            \common\models\ServiceFaq::deleteAll(['service' => $model->id]);
            \common\models\ServiceProsAndCons::deleteAll(['service' => $model->id]);
            \common\models\ServiceTreatmentResults::deleteAll(['service' => $model->id]);
            \common\models\ServiceVideos::deleteAll(['service' => $model->id]);
            if ($model->delete()) {
                if (file_exists($path1) && is_file($path1)) {
                    unlink($path1);
                }
                if (file_exists($path11) && is_file($path11)) {
                    unlink($path11);
                }
                if (file_exists($path4) && is_file($path4)) {
                    unlink($path4);
                }
                if (file_exists($path2) && is_file($path2)) {
                    unlink($path2);
                }
                if (file_exists($path3) && is_file($path3)) {
                    unlink($path3);
                }
                Yii::$app->session->setFlash('success', "Service removed successfully");
            }
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Services model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Services the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Services::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGetServices() {
        if (yii::$app->request->isAjax) {
            $department = $_POST['department'];
            $services = \common\models\Services::find()->where(['department' => $department, 'status' => 1])->orderBy(['service_name' => SORT_ASC])->all();
            $options = '<option value="" >Select </option>';
            if (!empty($services)) {
                foreach ($services as $service) {
                    $options .= '<option value="' . $service->id . '" >' . $service->service_name . ' </option>';
                }
            }
            return $options;
        }
    }
    
    public function actionRemoveImage() {
        if (yii::$app->request->isAjax) {
            $flag = 0;
            $id = $_POST['id'];
            $param = $_POST['param'];
            $service = \common\models\Services::find()->where(['id' => $id])->one();
            if (!empty($service)) {
                $path = Yii::$app->basePath . '/../frontend/web/uploads/services/' . $service->$param;
                if (file_exists($path) && is_file($path)) {
                    if (unlink($path)) {
                        $flag = 1;
                    }
                }elseif($service->$param != '' ){
                    $flag = 1;
                }
                $service->$param = NULL;
                $service->save();
            }
            return $flag;
        }
    }

}
