<?php

namespace backend\controllers;

use Yii;
use common\models\SubServices;
use common\models\SubServicesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * SubServicesController implements the CRUD actions for SubServices model.
 */
class SubServicesController extends Controller {

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
     * Lists all SubServices models.
     * @return mixed
     */
    public function actionIndex($s_id) {
        $service = \common\models\Services::findOne($s_id);
        $searchModel = new SubServicesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['service' => $s_id]);
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'service' => $service,
                    's_id' => $s_id,
        ]);
    }

    /**
     * Displays a single SubServices model.
     * @param int $id ID
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SubServices model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($s_id) {
        $model = new SubServices();

        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
            $model->service = $s_id;
            $image = UploadedFile::getInstance($model, 'image');
            if (!empty($image)) {
                $model->image = 'banner' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $image->extension;
            }
            if ($model->validate() && $model->save()) {
                $model->upload($image);
                Yii::$app->session->setFlash('success', "Subservice added successfully");
                return $this->redirect(['index', 's_id' => $s_id]);
            }
        } return $this->render('create', [
                    'model' => $model,
                    's_id' => $s_id,
        ]);
    }

    /**
     * Updates an existing SubServices model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionUpdate($s_id, $id) {
        $model = $this->findModel($id);
        $model_ = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
            $image = UploadedFile::getInstance($model, 'image');
            if (!empty($image)) {
                $path1 = Yii::$app->basePath . '/../frontend/web/uploads/sub-services/' . $model_->image;
                if (is_file($path1) && file_exists($path1)) {
                    unlink($path1);
                }
                $model->image = 'banner' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $image->extension;
            } else {
                $model->image = !empty($model_) ? $model_->image : '';
            }
            if ($model->validate() && $model->save()) {
                $model->upload($image);
                Yii::$app->session->setFlash('success', "Subservice updated successfully");
                return $this->redirect(['index', 's_id' => $s_id]);
            }
        }return $this->render('update', [
                    'model' => $model,
                    's_id' => $s_id,
        ]);
    }

    /**
     * Deletes an existing SubServices model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionDelete($s_id, $id) {
        $model = $this->findModel($id);
        if (!empty($model)) {
            $path1 = Yii::$app->basePath . '/../frontend/web/uploads/sub-services/' . $model->image;
            if ($model->delete()) {
                if (file_exists($path1)) {
                    unlink($path1);
                }
                Yii::$app->session->setFlash('success', "Subservice removed successfully");
            }
        }
        return $this->redirect(['index', 's_id' => $s_id]);
    }

    /**
     * Finds the SubServices model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return SubServices the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = SubServices::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
