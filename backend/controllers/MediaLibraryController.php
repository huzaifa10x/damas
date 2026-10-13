<?php

namespace backend\controllers;

use Yii;
use common\models\MediaLibrary;
use common\models\MediaLibrarySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * MediaLibraryController implements the CRUD actions for MediaLibrary model.
 */
class MediaLibraryController extends Controller {

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
     * Lists all MediaLibrary models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new MediaLibrarySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new MediaLibrary model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new MediaLibrary();
        $model->setScenario('create');
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
            $model->posted_date = date("Y-m-d", strtotime($model->posted_date));
            $image = UploadedFile::getInstance($model, 'image');
            $doc = UploadedFile::getInstance($model, 'document');
            if (!empty($image)) {
                $model->image = 'libraryimg' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $image->extension;
            }
            if (!empty($doc)) {
                $model->document = 'libraryvideo' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $doc->extension;
            }
            if ($model->validate() && $model->save()) {
                $model->upload($image, $doc);
                Yii::$app->session->setFlash('success', "Library added successfully");
                return $this->redirect(['index']);
            }
        }
        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing MediaLibrary model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $model_ = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
            $model->posted_date = date("Y-m-d", strtotime($model->posted_date));
            $image = UploadedFile::getInstance($model, 'image');
            $doc = UploadedFile::getInstance($model, 'document');
            if (!empty($image)) {
                $model->image = 'libraryimg' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $image->extension;
            } else {
                $model->image = $model_->image;
            }
            if (!empty($doc)) {
                $model->document = 'libraryvideo' . Yii::$app->EncryptDecrypt->Encrypt('hash', date('Y-m-d H:i:s')) . '.' . $doc->extension;
            } else {
                $model->document = $model_->document;
            }
            if ($model->validate() && $model->save()) {
                $model->upload($image, $doc);
                Yii::$app->session->setFlash('success', "Library updated successfully");
                return $this->redirect(['update', 'id' => $model->id]);
            }
        }
        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MediaLibrary model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        if (!empty($model)) {
            $image = $model->image;
            $document = $model->document;
            $path1 = Yii::$app->basePath . '/../frontend/web/uploads/media-library/' . $model->image;
            $path2 = Yii::$app->basePath . '/../frontend/web/uploads/media-library/' . $model->document;
            if ($model->delete()) {
                if (file_exists($path1) && $image != '') {
                    unlink($path1);
                }
                if (file_exists($path2) && $document != '') {
                    unlink($path2);
                }
            }
            Yii::$app->session->setFlash('success', "Library removed successfully");
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the MediaLibrary model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return MediaLibrary the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = MediaLibrary::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
