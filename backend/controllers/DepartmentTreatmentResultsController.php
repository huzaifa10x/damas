<?php

namespace backend\controllers;

use Yii;
use common\models\DepartmentTreatmentResults;
use common\models\DepartmentTreatmentResultsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * DepartmentTreatmentResultsController implements the CRUD actions for DepartmentTreatmentResults model.
 */
class DepartmentTreatmentResultsController extends Controller {

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
     * Lists all DepartmentTreatmentResults models.
     * @return mixed
     */
    public function actionIndex($dep_id, $id = NULL) {
        $searchModel = new DepartmentTreatmentResultsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['department_id' => $dep_id]);
        $model_ = [];
        if ($id == '') {
            $model = new DepartmentTreatmentResults();
            $model->setScenario('create');
        } else {
            $model = $this->findModel($id);
            $model_ = $this->findModel($id);
        }
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
            $model->department_id = $dep_id;
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
                return $this->redirect(['index', 'dep_id' => $dep_id]);
            }
        }
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model,
                    'id' => $id,
                    'dep_id' => $dep_id,
        ]);
    }

    /**
     * Deletes an existing DepartmentTreatmentResults model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionDelete($dep_id, $id) {
        $model = $this->findModel($id);
        if (!empty($model)) {
            $path1 = Yii::$app->basePath . '/../frontend/web/uploads/department-treatments/' . $model->before_image;
            $path2 = Yii::$app->basePath . '/../frontend/web/uploads/department-treatments/' . $model->after_image;
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
        return $this->redirect(['index', 'dep_id' => $dep_id]);
    }

    /**
     * Finds the DepartmentTreatmentResults model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return DepartmentTreatmentResults the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = DepartmentTreatmentResults::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
