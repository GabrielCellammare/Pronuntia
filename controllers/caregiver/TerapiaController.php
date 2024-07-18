<?php

namespace app\controllers\caregiver;

use app\models\User;
use yii\web\Controller;
use app\models\EsercizioSvolto;
use app\models\attori\Caregiver;
use yii\data\ActiveDataProvider;



class TerapiaController extends Controller
{

    public function actionIndex()
    {
        $idCaregiver = User::getShortId();

        $caregiver = new Caregiver();

        $caregiverDef = $caregiver->find()->where(["id" => $idCaregiver])->one();
        $idUtente = $caregiverDef->idUtente;

        $eserciziProvider = new ActiveDataProvider([
            "query" => EsercizioSvolto::find()->where(['idTerapia' => $idUtente])
        ]);
        return $this->render('index', [
            "eserciziProvider" => $eserciziProvider
        ]);
    }

    public function actionEsercizio($idEsercizio, $idTerapia)
    {
        $esercizioSvolto = EsercizioSvolto::findOne(["idEsercizio" => $idEsercizio, "idTerapia" =>  $idTerapia]);
        $esercizioSvolto->dataSvolgimento = date("Y-m-d");
        $esercizioSvolto->save();

        return $this->redirect(["index"]);
    }
}
