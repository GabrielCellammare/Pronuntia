<?php

namespace app\controllers\logopedista;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\attori\Utente;
use app\models\attori\Caregiver;
use app\models\auth\AuthCaregiver;
use app\modules\Email;
use yii\web\NotFoundHttpException;

/**
 * CaregiverController implements the CRUD actions for Caregiver model.
 */
class CaregiverController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Creates a new Caregiver model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($id)
    {
        $model = new Caregiver();
        $modelUtente = Utente::findOne($id);
        $authModel = new AuthCaregiver();

        $model->idUtente = $id;

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $authModel->load($this->request->post())) {

                $model->dataDiNascita = date_format(date_create($model->dataDiNascita), "Y-m-d");
                if ($model->save()) {
                    $authModel->id = $model->id;
                    $authModel->username = explode("@", $authModel->email)[0];
                    $authModel->password = Yii::$app->security->generateRandomString(8);
                    $token = "caregiver-" . $authModel->id;
                    $authModel->authKey = $token;
                    $authModel->accessToken = $token;
                    $authModel->save();
                    Email::sendAuth($model->getFullName(), "caregiver", $authModel);
                    return $this->redirect(['logopedista/utente/view', 'id' => $model->idUtente]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            "authModel" => $authModel,
            "modelUtente" => $modelUtente
        ]);
    }

    /**
     * Updates an existing Caregiver model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['logopedista/utente/view', 'id' => $model->idUtente]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Caregiver model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();

        return $this->redirect(['logopedista/utente/view', "id" => $model->idUtente]);
    }

    /**
     * Finds the Caregiver model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Caregiver the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Caregiver::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
