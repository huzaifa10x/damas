<?php

namespace backend\controllers;

use Yii;
use common\models\Banners;
use common\models\BannersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * BannersController implements the CRUD actions for Banners model.
 */
class BannersController extends Controller {

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
     * Lists all Banners models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new BannersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Creates a new Banners model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Banners();
        $model->setScenario('create');
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
            $image = UploadedFile::getInstance($model, 'image');
            $image_arabic = UploadedFile::getInstance($model, 'image_arabic');
            $video = UploadedFile::getInstance($model, 'video');
            if (!empty($image)) {
                $model->image = 'bannerimage' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $image->extension;
            } 
            if (!empty($image_arabic)) {
                $model->image_arabic = 'bannerimage_ar' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $image_arabic->extension;
            }
            if (!empty($video)) {
                $model->video = 'bannervideo' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $video->extension;
            }
            if ($model->validate() && $model->save()) {
                $model->upload($image,$image_arabic, $video);
                Yii::$app->session->setFlash('success', "Banner added successfully");
                return $this->redirect(['index']);
            }
        }
        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Banners model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $model_ = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
            $image = UploadedFile::getInstance($model, 'image');
            $image_arabic = UploadedFile::getInstance($model, 'image_arabic');
            $video = UploadedFile::getInstance($model, 'video');
            if (!empty($image)) {
                $model->image = 'bannerimage' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $image->extension;
            } else {
                $model->image = $model_->image;
            } 
            if (!empty($image_arabic)) {
                $model->image_arabic = 'bannerimage_ar' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $image_arabic->extension;
            } else {
                $model->image_arabic = $model_->image_arabic;
            }
            if (!empty($video)) {
                $model->video = 'bannervideo' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $video->extension;
            } else {
                $model->video = $model_->video;
            }
            if ($model->validate() && $model->save()) {
                $model->upload($image,$image_arabic, $video);
                Yii::$app->session->setFlash('success', "Data updated successfully");
                return $this->redirect(['index']);
            }
        }
        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Finds the Banners model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Banners the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Banners::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionRemoveFile() {
        if (yii::$app->request->isAjax) {
            $flag = 0;
            $id = $_POST['id'];
            $param = $_POST['param'];
            $banner = \common\models\Banners::find()->where(['id' => $id])->one();
            if (!empty($banner)) {
                $path = Yii::$app->basePath . '/../frontend/web/uploads/banners/' . $banner->$param;
                if (file_exists($path) && is_file($path)) {
                    if (unlink($path)) {
                        $flag = 1;
                    }
                }elseif($banner->$param != '' ){
                    $flag = 1;
                }
                $banner->$param = NULL;
                $banner->save();
            }
            return $flag;
        }
    }

}
