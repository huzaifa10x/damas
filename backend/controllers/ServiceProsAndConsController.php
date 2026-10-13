<?php

namespace backend\controllers;

use Yii;
use common\models\ServiceProsAndCons;
use common\models\ServiceProsAndConsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ServiceProsAndConsController implements the CRUD actions for ServiceProsAndCons model.
 */
class ServiceProsAndConsController extends Controller {

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
     * Lists all ServiceProsAndCons models.
     * @return mixed
     */
    public function actionIndex($s_id) {
        $model = \common\models\Services::findOne($s_id);
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $model->save()) {
            Yii::$app->session->setFlash('success', "Data updated successfully");
        }
        return $this->render('index', [
                    'model' => $model,
                    's_id' => $s_id,
        ]);
    }

    public function actionMoreDetails($s_id, $id = NULL) {
        $searchModel = new ServiceProsAndConsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['service' => $s_id]);
        $model_ = [];
        if ($id == '') {
            $model = new ServiceProsAndCons();
        } else {
            $model = $this->findModel($id);
            $model_ = $this->findModel($id);
        }
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
            $model->service = $s_id;
            if ($model->validate() && $model->save()) {
                Yii::$app->session->setFlash('success', "Data updated successfully");
                return $this->redirect(['more-details', 's_id' => $s_id]);
            }
        }
        return $this->render('more_details', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model,
                    'id' => $id,
                    's_id' => $s_id,
        ]);
    }

    /**
     * Deletes an existing ServiceProsAndCons model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionDelete($s_id,$id) {
        $this->findModel($id)->delete();
         Yii::$app->session->setFlash('success', "Data removed successfully");
        return $this->redirect(['more-details','s_id'=>$s_id]);
    }

    /**
     * Finds the ServiceProsAndCons model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return ServiceProsAndCons the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ServiceProsAndCons::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
