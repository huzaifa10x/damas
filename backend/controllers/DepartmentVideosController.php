<?php

namespace backend\controllers;

use Yii;
use common\models\DepartmentVideos;
use common\models\DepartmentVideosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * DepartmentVideosController implements the CRUD actions for DepartmentVideos model.
 */
class DepartmentVideosController extends Controller {

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
     * Lists all DepartmentVideos models.
     * @return mixed
     */
    public function actionIndex($dep_id, $id = NULL) {
        $searchModel = new DepartmentVideosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['department_id' => $dep_id]);
        $model_ = [];
        if ($id == '') {
            $model = new DepartmentVideos();
            $model->setScenario('create');
        } else {
            $model = $this->findModel($id);
            $model_ = $this->findModel($id);
        }
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
            $model->department_id = $dep_id;
            $thumb_image = UploadedFile::getInstance($model, 'thumb_image');
            // $video = UploadedFile::getInstance($model, 'video');
            if (!empty($thumb_image)) {
                $model->thumb_image = 'thumb_image' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $thumb_image->extension;
            } else {
                $model->thumb_image = !empty($model_) ? $model_->thumb_image : '';
            }
            // if (!empty($video)) {
            //     $model->video = 'video' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $video->extension;
            // } else {
            //     $model->video = !empty($model_) ? $model_->video : '';
            // }
            $video =[];
            if ($model->validate() && $model->save()) {
                $model->upload($thumb_image, $video);
                Yii::$app->session->setFlash('success', "Video added successfully");
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
     * Deletes an existing DepartmentVideos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionDelete($dep_id, $id) {
        $model = $this->findModel($id);
        if (!empty($model)) {
            $path1 = Yii::$app->basePath . '/../frontend/web/uploads/department-videos/' . $model->thumb_image;
            // $path2 = Yii::$app->basePath . '/../frontend/web/uploads/department-videos/' . $model->video;
            if ($model->delete()) {
                if (is_file($path1) && file_exists($path1)) {
                    unlink($path1);
                }
                // if (is_file($path2) && file_exists($path2)) {
                //     unlink($path2);
                // }
                Yii::$app->session->setFlash('success', "Video removed successfully");
            }
        }
        return $this->redirect(['index', 'dep_id' => $dep_id]);
    }

    /**
     * Finds the DepartmentVideos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return DepartmentVideos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = DepartmentVideos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
