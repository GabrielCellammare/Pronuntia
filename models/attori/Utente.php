<?php

namespace app\models\attori;

use app\models\Cura;
use yii\db\ActiveRecord;
use app\models\auth\AuthUtente;

/** 
 * * `id`, 
 * * `codiceFiscale`, 
 * * `nome`, 
 * * `cognome`, 
 * * `dataDiNascita`, 
 * * `residenza`, 
 * * `numeroDiTelefono`, 
 * * `idLogopedista`
 */
class Utente extends ActiveRecord
{
    public function rules()
    {
        return [
            [['id', 'idLogopedista'], 'integer'],
            [['codiceFiscale', 'nome', 'cognome', 'dataDiNascita', 'residenza', 'numeroDiTelefono', 'idLogopedista'], 'required', "message" => "{attribute} e' richiesto"],
        ];
    }

    public function getAuth()
    {
        return $this->hasOne(AuthUtente::class, ["id" => "id"]);
    }

    public function getLogopedista()
    {
        return $this->hasOne(Logopedista::class, ["id" => "idLogopedista"]);
    }

    public function getCaregiver()
    {
        return $this->hasOne(Caregiver::class, ["idUtente" => "id"]);
    }

    public function getCura()
    {
        return $this->hasOne(Cura::class, ["id" => "id"]);
    }

    public function getFullName()
    {
        return $this->nome . " " . $this->cognome;
    }
}
