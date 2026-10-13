<?php

namespace backend\controllers;

use Yii;
use common\models\GoogleReviews;
use common\models\GoogleReviewsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * GoogleReviewsController implements the CRUD actions for GoogleReviews model.
 */
class GoogleReviewsController extends Controller {

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
     * Lists all GoogleReviews models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new GoogleReviewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GoogleReviews model.
     * @param int $id ID
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new GoogleReviews model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new GoogleReviews();
        $model->setScenario('create');
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
            $model->date = date("Y-m-d", strtotime($model->date));
            $image = UploadedFile::getInstance($model, 'image');
            if (!empty($image)) {
                $model->image = 'review' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $image->extension;
            }
            if ($model->validate() && $model->save()) {
                $model->upload($image);
                Yii::$app->session->setFlash('success', "New Data added successfully");
                return $this->redirect(['index']);
            }
        }
        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing GoogleReviews model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $model_ = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
            $model->date = date("Y-m-d", strtotime($model->date));
            $image = UploadedFile::getInstance($model, 'image');
            if (!empty($image)) {
                $model->image = 'review' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $image->extension;
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
     * Deletes an existing GoogleReviews model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        if (!empty($model)) {
            $path1 = Yii::$app->basePath . '/../frontend/web/uploads/google-reviews/' . $model->image;
            if ($model->delete()) {
                if (file_exists($path1)) {
                    unlink($path1);
                }
                Yii::$app->session->setFlash('success', "Review removed successfully");
            }
        }
    }

    /**
     * Finds the GoogleReviews model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return GoogleReviews the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = GoogleReviews::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
