<?php

namespace backend\controllers;

use Yii;
use common\models\Departments;
use common\models\DepartmentsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * DepartmentsController implements the CRUD actions for Departments model.
 */
class DepartmentsController extends Controller {

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
     * Lists all Departments models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new DepartmentsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Departments model.
     * @param int $id ID
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Departments model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Departments();
        $model->setScenario('create');
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
            $banner_image = UploadedFile::getInstance($model, 'banner_image');
            $banner_image_arabic = UploadedFile::getInstance($model, 'banner_image_arabic');
            // $banner_video = UploadedFile::getInstance($model, 'banner_video');
            $department_image = UploadedFile::getInstance($model, 'department_image');
            $section3_image = UploadedFile::getInstance($model, 'section3_image');
            if (!empty($banner_image)) {
                $model->banner_image = 'banner_image' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $banner_image->extension;
            } 
            if (!empty($banner_image_arabic)) {
                $model->banner_image_arabic = 'banner_image_ar' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $banner_image_arabic->extension;
            }
            // if (!empty($banner_video)) {
            //     $model->banner_video = 'banner_video' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $banner_video->extension;
            // }
            if (!empty($department_image)) {
                $model->department_image = 'department_image' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $department_image->extension;
            }
            if (!empty($section3_image)) {
                $model->section3_image = 'section3_image' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $section3_image->extension;
            }
            $banner_video = [];
            if ($model->validate() && $model->save()) {
                $model->upload($banner_image,$banner_image_arabic, $banner_video, $department_image, $section3_image);
                Yii::$app->session->setFlash('success', "Department added successfully");
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
     * Updates an existing Departments model.
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
            // $banner_video = UploadedFile::getInstance($model, 'banner_video');
            $department_image = UploadedFile::getInstance($model, 'department_image');
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
            // if (!empty($banner_video)) {
            //     $model->banner_video = 'banner_video' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $banner_video->extension;
            // } else {
            //     $model->banner_video = $model_->banner_video;
            // }
            if (!empty($department_image)) {
                $model->department_image = 'department_image' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $department_image->extension;
            } else {
                $model->department_image = $model_->department_image;
            }
            if (!empty($section3_image)) {
                $model->section3_image = 'section3_image' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $section3_image->extension;
            } else {
                $model->section3_image = $model_->section3_image;
            }
            $banner_video = [];
            if ($model->validate() && $model->save()) {
                $model->upload($banner_image,$banner_image_arabic, $banner_video, $department_image, $section3_image);
                Yii::$app->session->setFlash('success', "Data updated successfully");
                return $this->redirect(['update', 'id' => $model->id]);
            }
        }
        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Departments model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        if (!empty($model)) {
            $path1 = Yii::$app->basePath . '/../frontend/web/uploads/departments/' . $model->banner_image;
            $path11 = Yii::$app->basePath . '/../frontend/web/uploads/departments/' . $model->banner_image_arabic;
            // $path4 = Yii::$app->basePath . '/../frontend/web/uploads/departments/' . $model->banner_video;
            $path2 = Yii::$app->basePath . '/../frontend/web/uploads/departments/' . $model->department_image;
            $path3 = Yii::$app->basePath . '/../frontend/web/uploads/departments/' . $model->section3_image;
            \common\models\DepartmentFaq::deleteAll(['department_id' => $model->id]);
            \common\models\DepartmentProsAndCons::deleteAll(['department_id' => $model->id]);
            \common\models\DepartmentTreatmentResults::deleteAll(['department_id' => $model->id]);
            \common\models\DepartmentVideos::deleteAll(['department_id' => $model->id]);
            if ($model->delete()) {
                if (file_exists($path1) && is_file($path1)) {
                    unlink($path1);
                }
                if (file_exists($path11) && is_file($path11)) {
                    unlink($path11);
                }
                if (file_exists($path2) && is_file($path2)) {
                    unlink($path2);
                }
                if (file_exists($path3) && is_file($path3)) {
                    unlink($path3);
                }
                // if (file_exists($path4) && is_file($path4)) {
                //     unlink($path4);
                // }
                Yii::$app->session->setFlash('success', "Department removed successfully");
            }
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Departments model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Departments the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Departments::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionRemoveImage() {
        if (yii::$app->request->isAjax) {
            $flag = 0;
            $id = $_POST['id'];
            $param = $_POST['param'];
            $service = \common\models\Departments::find()->where(['id' => $id])->one();
            if (!empty($service)) {
                $path = Yii::$app->basePath . '/../frontend/web/uploads/departments/' . $service->$param;
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
