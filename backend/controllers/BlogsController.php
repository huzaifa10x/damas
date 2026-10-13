<?php

namespace backend\controllers;

use Yii;
use common\models\Blogs;
use common\models\BlogsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * BlogsController implements the CRUD actions for Blogs model.
 */
class BlogsController extends Controller {

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
     * Lists all Blogs models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new BlogsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Blogs model.
     * @param int $id ID
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Blogs model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Blogs();
        $model->setScenario('create');
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
            $model->date = date("Y-m-d", strtotime($model->date));
            $main_image = UploadedFile::getInstance($model, 'main_image');
            $image1 = UploadedFile::getInstance($model, 'image1');
            $image2 = UploadedFile::getInstance($model, 'image2');
            $video = UploadedFile::getInstance($model, 'video');
            if (!empty($main_image)) {
                $model->main_image = 'blogimage' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $main_image->extension;
            }
            if (!empty($image1)) {
                $model->image1 = 'blogimage1' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $image1->extension;
            }
            if (!empty($image2)) {
                $model->image2 = 'blogimage2' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $image2->extension;
            }
            if (!empty($video)) {
                $model->video = 'video' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $video->extension;
            }
            if ($model->validate() && $model->save()) {
                $model->upload($main_image, $image1, $image2, $video);
                Yii::$app->session->setFlash('success', "Blog added successfully");
                return $this->redirect(['index']);
            }
        }
        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Blogs model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $model_ = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
            $model->date = date("Y-m-d", strtotime($model->date));
            $main_image = UploadedFile::getInstance($model, 'main_image');
            $image1 = UploadedFile::getInstance($model, 'image1');
            $image2 = UploadedFile::getInstance($model, 'image2');
            $video = UploadedFile::getInstance($model, 'video');
            if (!empty($main_image)) {
                $model->main_image = 'blogimage' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $main_image->extension;
            } else {
                $model->main_image = $model_->main_image;
            }
            if (!empty($image1)) {
                $model->image1 = 'blogimage1' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $image1->extension;
            } else {
                $model->image1 = $model_->image1;
            }
            if (!empty($image2)) {
                $model->image2 = 'blogimage2' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $image2->extension;
            } else {
                $model->image2 = $model_->image2;
            }
            if (!empty($video)) {
                $model->video = 'video' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $video->extension;
            } else {
                $model->video = $model_->video;
            }
            if ($model->validate() && $model->save()) {
                $model->upload($main_image, $image1, $image2, $video);
                Yii::$app->session->setFlash('success', "Data updated successfully");
                return $this->redirect(['index']);
            }
        }
        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Blogs model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        if (!empty($model)) {
            $path1 = Yii::$app->basePath . '/../frontend/web/uploads/blogs/' . $model->main_image;
            $path2 = Yii::$app->basePath . '/../frontend/web/uploads/blogs/' . $model->image1;
            $path3 = Yii::$app->basePath . '/../frontend/web/uploads/blogs/' . $model->image2;
            $path4 = Yii::$app->basePath . '/../frontend/web/uploads/blogs/' . $model->video;
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
                if (file_exists($path4) && is_file($path4)) {
                    unlink($path4);
                }
                Yii::$app->session->setFlash('success', "Blog removed successfully");
            }
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Blogs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Blogs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Blogs::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
