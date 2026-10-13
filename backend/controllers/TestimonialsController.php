<?php

namespace backend\controllers;

use Yii;
use common\models\Testimonials;
use common\models\TestimonialsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * TestimonialsController implements the CRUD actions for Testimonials model.
 */
class TestimonialsController extends Controller {

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
     * Lists all Testimonials models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TestimonialsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Testimonials model.
     * @param int $id ID
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Testimonials model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Testimonials();
        $model->setScenario('create');
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
            $model->department = isset($model->department) && $model->department != '' ? implode(',', $model->department) : '';
            $model->service = isset($model->service) && $model->service != '' ? implode(',', $model->service) : '';
            $image = UploadedFile::getInstance($model, 'image');
            // $video = UploadedFile::getInstance($model, 'video');
            if (!empty($image)) {
                $model->image = 'testiimage' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $image->extension;
            }
            // if (!empty($video)) {
            //     $model->video = 'video' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $video->extension;
            // }
            $video = [];
            if ($model->validate() && $model->save()) {
                $model->upload($image,$video);
                Yii::$app->session->setFlash('success', "New Data added successfully");
                return $this->redirect(['index']);
            }
        }
        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Testimonials model.
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
            $image = UploadedFile::getInstance($model, 'image');
            // $video = UploadedFile::getInstance($model, 'video');
            if (!empty($image)) {
                $model->image = 'testiimage' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $image->extension;
            } else {
                $model->image = $model_->image;
            }
            // if (!empty($video)) {
            //     $model->video = 'video' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $video->extension;
            // } else {
            //     $model->video = $model_->video;
            // }
            $video = [];
            if ($model->validate() && $model->save()) {
                $model->upload($image,$video);
                Yii::$app->session->setFlash('success', "Data updated successfully");
                return $this->redirect(['update', 'id' => $model->id]);
            }
        }
        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Testimonials model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        if (!empty($model)) {
            $path1 = Yii::$app->basePath . '/../frontend/web/uploads/testimonials/' . $model->image;
            // $path2 = Yii::$app->basePath . '/../frontend/web/uploads/testimonials/' . $model->video;
            $vname = $model->video;
            if ($model->delete()) {
                if (file_exists($path1)) {
                    unlink($path1);
                }
                // if (file_exists($path2) && $vname != '') {
                //     unlink($path2);
                // }
                Yii::$app->session->setFlash('success', "Testimonial removed successfully");
            }
        }
        return $this->redirect(['index']);
    }
    
    public function actionRemoveVideo($id) {
        $model = $this->findModel($id);
        if (!empty($model)) {
            $path1 = Yii::$app->basePath . '/../frontend/web/uploads/testimonials/' . $model->video;
            $model->video = '';
            if ($model->save(FALSE)) {
                if (file_exists($path1)) {
                    unlink($path1);
                }
                Yii::$app->session->setFlash('success', "Video removed successfully");
            }
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the Testimonials model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Testimonials the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Testimonials::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
