<?php

namespace app\models\attori;

use app\models\attori\profili\ProfileLogopedista;
use app\models\auth\AuthLogopedista;
use yii\db\ActiveRecord;

/** 
 * * `id`, 
 * * `codiceFiscale`, 
 * * `nome`, 
 * * `cognome`, 
 * * `dataDiNascita`, 
 * * `residenza`, 
 * * `biografia`, 
 * * `numeroDiTelefono`, 
 * * `organizzazione`
 */
class Logopedista extends ActiveRecord
{

    //$logopedista->auth
    public function getAuth()
    {
        return $this->hasOne(AuthLogopedista::class, ["id" => "id"]);
    }

    public function getProfile()
    {
        return $this->hasOne(ProfileLogopedista::class, ["id" => "id"]);
    }

    public function getUtenti()
    {
        return $this->hasMany(Utente::class, ["idLogopedista" => "id"])->inverseOf("logopedista");
    }
}

// public static function getLogopedisti()
    // {
    //     $logopedisti = [];
    //     $query = "SELECT * FROM logopedista";
    //     $result = Yii::$app->db->createCommand($query)->queryAll();
    //     Yii::getLogger()->log($result, Logger::LEVEL_INFO);
    //     foreach ($result as $record) {
    //         $logopedista = new self($record);
    //         array_push($logopedisti, $logopedista);
    //     }
    //     return $logopedisti;
    // }
