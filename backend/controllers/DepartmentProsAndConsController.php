<?php

namespace backend\controllers;

use Yii;
use common\models\DepartmentProsAndCons;
use common\models\DepartmentProsAndConsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DepartmentProsAndConsController implements the CRUD actions for DepartmentProsAndCons model.
 */
class DepartmentProsAndConsController extends Controller {

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
     * Lists all DepartmentProsAndCons models.
     * @return mixed
     */
    public function actionIndex($dep_id) {
        $model = \common\models\Departments::findOne($dep_id);
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $model->save()) {
            Yii::$app->session->setFlash('success', "Data updated successfully");
        }
        return $this->render('index', [
                    'model' => $model,
                    'dep_id' => $dep_id,
        ]);
    }
    
    public function actionMoreDetails($dep_id, $id = NULL) {
        $searchModel = new DepartmentProsAndConsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['department_id' => $dep_id]);
        $model_ = [];
        if ($id == '') {
            $model = new DepartmentProsAndCons();
        } else {
            $model = $this->findModel($id);
            $model_ = $this->findModel($id);
        }
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
            $model->department_id = $dep_id;
            if ($model->validate() && $model->save()) {
                Yii::$app->session->setFlash('success', "Data updated successfully");
                return $this->redirect(['more-details', 'dep_id' => $dep_id]);
            }
        }
        return $this->render('more_details', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model,
                    'id' => $id,
                    'dep_id' => $dep_id,
        ]);
    }

    /**
     * Deletes an existing DepartmentProsAndCons model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionDelete($dep_id,$id) {
        $this->findModel($id)->delete();
         Yii::$app->session->setFlash('success', "Data removed successfully");
        return $this->redirect(['more-details','dep_id'=>$dep_id]);
    }

    /**
     * Finds the DepartmentProsAndCons model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return DepartmentProsAndCons the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = DepartmentProsAndCons::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
