<?php

namespace backend\controllers;

use Yii;
use common\models\OrderMaster;
use common\models\OrderMasterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderMasterController implements the CRUD actions for OrderMaster model.
 */
class OrderMasterController extends Controller {

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
     * Lists all OrderMaster models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new OrderMasterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OrderMaster model.
     * @param int $id ID
     * @return mixed
     */
    public function actionView($id) {
        $order_master = OrderMaster::find()->where(['id' => $id])->one();
        $order_status = \common\models\OrderStatus::findOne($order_master->status)->order_status;
        $bill_address = \common\models\OrderAddress::find()->where(['id' => $order_master->billing_address])->one();
        $order_details = \common\models\OrderDetails::find()->where(['master_id' => $order_master->id])->all();
        return $this->render('view', [
                    'order_master' => $order_master,
                    'order_status' => $order_status,
                    'bill_address' => $bill_address,
                    'order_details' => $order_details,
        ]);
    }

    /**
     * Finds the OrderMaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return OrderMaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = OrderMaster::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /*
     * Update Order Status
     */

    public function actionUpdateOrderStatus() {
        if (Yii::$app->request->post()) {
            $data = Yii::$app->request->post();
            $model = OrderMaster::findOne($_POST['OrderMaster']['id']);
            if (!empty($model)) {
                $flag = 0;
                $status = $_POST['OrderMaster']['status'];
                $payment_status = $_POST['OrderMaster']['payment_status'];
                $model->payment_status = $payment_status;
                $prev_status = $model->status;
                $model->save();
                if ($status > $prev_status) {
                    $flag = 1;
                    $model->status = $status;
                    if ($model->save()) {
//                        Yii::$app->SetValues->AddOrderHistory($model->id, $model->status, date('Y-m-d'), '');
//                        Yii::$app->Emails->orderstatusmail($model->id);
                    }
                }
                Yii::$app->session->setFlash('success', "Status updated successfully");
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
    }

}
