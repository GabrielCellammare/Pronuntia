<?php

namespace app\models\auth;

use yii\db\ActiveRecord;

/**
 * * `id`, 
 * * `username`, 
 * * `email`, 
 * * `password`
 */
class AuthUtente extends ActiveRecord
{
    public function getUtente()
    {
        return $this->hasOne(Utente::class, ["id" => "id"])->inverseOf("auth");
    }

    public function rules()
    {
        return [
            [["id", "username", "email", "password"], "required"]
        ];
    }
}
