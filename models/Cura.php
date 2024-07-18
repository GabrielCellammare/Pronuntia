<?php

namespace app\models;

use app\models\attori\Utente;
use yii\db\ActiveRecord;

class Cura extends ActiveRecord
{

    public function rules()
    {
        return [
            ["id", "integer"],
            ["id", "required"],
            [['diagnosi'], 'file', 'skipOnEmpty' => true, 'extensions' => ['pdf'], "checkExtensionByMimeType" => false],
        ];
    }

    public function getUtente()
    {
        return $this->hasOne(Utente::class, ["id" => "id"])->inverseOf("cura");
    }

    public function getTerapia()
    {
        return $this->hasOne(Terapia::class, ["id" => "id"])->inverseOf("cura");
    }
}
