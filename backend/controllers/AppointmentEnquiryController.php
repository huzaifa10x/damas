<?php

namespace backend\controllers;

use Yii;
use common\models\AppointmentEnquiry;
use common\models\AppointmentEnquirySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AppointmentEnquiryController implements the CRUD actions for AppointmentEnquiry model.
 */
class AppointmentEnquiryController extends Controller {

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
     * Lists all AppointmentEnquiry models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new AppointmentEnquirySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->orderBy(['id' => SORT_DESC]);
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Approve appointment enquiry
     * @param int $id ID
     * @return mixed
     */
    public function actionApprove($id) {
        $model = $this->findModel($id);
        $model->status = 1;
        if ($model->save()) {
            Yii::$app->SetValues->bookingconfirmation($model);
            Yii::$app->session->setFlash('success', "Enquiry approved");
        }
        return $this->redirect(['index']);
    }
    
    /**
     * Reject appointment enquiry
     * @param int $id ID
     * @return mixed
     */
    public function actionReject($id) {
        $model = $this->findModel($id);
        $model->status = 2;
        if ($model->save()) {
            Yii::$app->session->setFlash('success', "Enquiry rejected");
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the AppointmentEnquiry model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return AppointmentEnquiry the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = AppointmentEnquiry::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
