<?php

namespace backend\controllers;

use Yii;
use common\models\ProductReview;
use common\models\ProductReviewSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductReviewController implements the CRUD actions for ProductReview model.
 */
class ProductReviewController extends Controller {

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
     * Lists all ProductReview models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ProductReviewSearch();
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
     * Deletes an existing ProductReview model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProductReview model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return ProductReview the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ProductReview::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
