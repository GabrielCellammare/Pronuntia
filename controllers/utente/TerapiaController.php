<?php

namespace app\controllers\utente;

use app\models\User;
use yii\web\Controller;
use app\models\EsercizioSvolto;
use yii\data\ActiveDataProvider;



class TerapiaController extends Controller
{

    public function actionIndex()
    {
        $id = User::getShortId();
        $eserciziProvider = new ActiveDataProvider([
            "query" => EsercizioSvolto::find()->where(['idTerapia' => $id])
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
