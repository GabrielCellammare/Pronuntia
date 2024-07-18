<?php

namespace app\controllers\caregiver;

use app\models\User;
use yii\web\Controller;
use app\models\attori\Caregiver;

class UtenteController extends Controller
{
    public function actionIndex()
    {
        $model = Caregiver::findOne(User::getShortId());
        return $this->render(
            "index",
            [
                "model" => $model
            ]
        );
    }
}
