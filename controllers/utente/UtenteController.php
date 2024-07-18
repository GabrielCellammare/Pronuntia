<?php

namespace app\controllers\utente;

use app\models\User;
use yii\web\Controller;
use app\models\attori\Utente;

class UtenteController extends Controller
{
    public function actionIndex()
    {
        $model = Utente::findOne(User::getShortId());
        return $this->render(
            "index",
            [
                "model" => $model
            ]
        );
    }
}
