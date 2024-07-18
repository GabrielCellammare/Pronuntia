<?php

namespace app\controllers\logopedista;

use Yii;
use app\models\Cura;
use app\models\User;
use app\modules\Email;
use app\models\Terapia;
use yii\web\Controller;
use app\models\Esercizio;
use yii\web\UploadedFile;
use app\models\Ricompensa;
use app\models\TerapiaForm;
use yii\filters\VerbFilter;
use app\models\attori\Utente;
use app\models\auth\AuthUtente;
use app\models\EsercizioSvolto;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use app\models\attori\GestioneUtente;
use yii\helpers\ArrayHelper;

/**
 * UtenteController implements the CRUD actions for Utente model.
 */
class UtenteController extends Controller
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
     * Lists all Utente models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new GestioneUtente();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Utente model.
     * @param int $id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Utente model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Utente();
        $model->idLogopedista = User::getShortId();

        $authModel = new AuthUtente();
        $curaModel = new Cura();
        $terapiaModel = new Terapia();


        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $authModel->load($this->request->post())) {
                $model->dataDiNascita = date_format(date_create($model->dataDiNascita), "Y-m-d");
                if ($model->save()) {


                    $curaModel->id = $terapiaModel->id = $authModel->id = $model->id;
                    $authModel->username = explode("@", $authModel->email)[0];
                    $authModel->password = Yii::$app->security->generateRandomString(8);
                    $token = "utente-" . $authModel->id;
                    $authModel->authKey = $token;
                    $authModel->accessToken = $token;
                    $authModel->save();
                    $curaModel->save();
                    $terapiaModel->save();
                    Email::sendAuth($model->getFullName(), "utente", $authModel);
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'authModel' => $authModel
        ]);
    }

    /**
     * Updates an existing Utente model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDiagnosi($id)
    {
        $utenteModel = $this->findModel($id);
        $model = $utenteModel->cura;

        if ($this->request->isPost) {

            $model->diagnosi = UploadedFile::getInstance($model, 'diagnosi');
            if (isset($model->diagnosi)) {
                $model->dataDiagnosi = date("Y-m-d");
                if ($model->validate()) {
                    $model->diagnosi = base64_encode(file_get_contents($model->diagnosi->tempName));
                    if ($model->save(false))
                        return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                Yii::$app->session->setFlash("error", "Inserire un file di diagnosi");
            }
        }

        return $this->render(
            'diagnosi',
            [
                'model' => $model,
                "utenteModel" => $utenteModel
            ]
        );
    }

    /**
     * Deletes an existing Utente model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Utente model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return Utente the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Utente::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionTerapia($id)
    {
        $model = Terapia::findOne($id);
        $formModel = new TerapiaForm;
        $formModel->nomeTerapia = $model->nome;
        $formModel->dataFineTerapia = $model->dataFine;
        $idEsercizi = ArrayHelper::getColumn(Esercizio::find()->all(), "id");


        foreach ($idEsercizi as $index => $value) {

            $esercizioSvolto = $model->getEserciziSvolti()->where(['idEsercizio' => $value])->one();

            if ($esercizioSvolto !== null) {
                $formModel->eserciziAssegnati[$index] = true;
                $formModel->ricompenseEsercizi[$index] = $esercizioSvolto->idRicompensa;
            } else {
                $formModel->eserciziAssegnati[$index] = false;
                $formModel->ricompenseEsercizi[$index] = null;
            }
        }

        $eserciziProvider = new ActiveDataProvider(
            [
                "query" => Esercizio::find()
            ]
        );

        $ricompense = Ricompensa::find()->all();

        if ($this->request->isPost) {

            $model->nome = $this->request->post('TerapiaForm')['nomeTerapia'];
            $model->dataInizio = date("Y-m-d");
            $model->dataFine = date_format(date_create($this->request->post('TerapiaForm')['dataFineTerapia']), "Y-m-d");

            if ($model->save()) {

                foreach ($idEsercizi as $index => $value) {
                    $esercizioSvolto = $model->getEserciziSvolti()->where(['idEsercizio' => $value])->one();

                    if ($this->request->post('TerapiaForm')['eserciziAssegnati'][$index]) {
                        $ricompensaEsercizioScelta =  $this->request->post('TerapiaForm')['ricompenseEsercizi'][$index];
                        if (isset($esercizioSvolto)) {
                            $esercizioSvolto->idRicompensa = $ricompensaEsercizioScelta;
                        } else {
                            $esercizioSvolto = new EsercizioSvolto(
                                ['idEsercizio' => $value, 'idTerapia' => $model->id, 'idRicompensa' => $ricompensaEsercizioScelta,]

                            );

                            $esercizioSvolto->save();
                        }
                    } else {
                        if (isset($esercizioSvolto)) {
                            $esercizioSvolto->delete();
                        }
                    }
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render(
            'terapia/index',
            [
                'model' => $model,
                'eserciziProvider' => $eserciziProvider,
                'ricompense' => $ricompense,
                'formModel' => $formModel,
            ]
        );
    }

    public function actionMonitoraggio($id)
    {
        $model = $this->findModel($id);

        $eserciziProvider = new ActiveDataProvider([
            "query" => EsercizioSvolto::find()->where(['idTerapia' => $id])
        ]);
        return $this->render('monitoraggio/index', [
            "model" => $model,
            "eserciziProvider" => $eserciziProvider
        ]);
    }
}
