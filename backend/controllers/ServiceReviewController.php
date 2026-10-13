<?php

namespace backend\controllers;

use Yii;
use common\models\ServiceReview;
use common\models\ServiceReviewSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ServiceReviewController implements the CRUD actions for ServiceReview model.
 */
class ServiceReviewController extends Controller {

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
     * Lists all ServiceReview models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ServiceReviewSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionApprove($id) {
        $model = $this->findModel($id);
        if (!empty($model)) {
            $model->status = 1;
            $model->save();
            Yii::$app->session->setFlash('success', "Review Approved");
        }
        return $this->redirect(['index']);
    }

    public function actionReject($id) {
        $model = $this->findModel($id);
        if (!empty($model)) {
            $model->status = 2;
            $model->save();
            Yii::$app->session->setFlash('success', "Review Rejected");
        }
        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing ServiceReview model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ServiceReview model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return ServiceReview the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ServiceReview::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
