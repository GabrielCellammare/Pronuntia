<?php

namespace app\controllers\logopedista;

use yii\web\Controller;
use app\models\Esercizio;
use yii\data\ActiveDataProvider;

class EserciziController extends Controller
{

    public function actionIndex()
    {
        $eserciziProvider = new ActiveDataProvider([
            "query" => Esercizio::find(),
        ]);
        return $this->render('index', [
            "eserciziProvider" => $eserciziProvider
        ]);
    }
}
