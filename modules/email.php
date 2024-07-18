<?php

namespace app\modules;

use Yii;

class Email
{
    public static function sendAuth($name, $actorType, $authModel)
    {
        return Yii::$app->mailer->compose()
            ->setTo($authModel->email)
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setSubject("Pronuntia - Credenziali $actorType")
            ->setTextBody(
                <<<EOD
                Gentile $name,

                Queste sono le credenziali per il suo account da $actorType:
                Username: $authModel->username
                Password: $authModel->password

                Puo' accedere visitando questo link http://localhost:8080/index.php?r=site%2Flogin
                                    
                <<Non rispondere a questa mail>>
                EOD
            )
            ->send();
    }
}
