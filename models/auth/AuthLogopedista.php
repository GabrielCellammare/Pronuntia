<?php

namespace app\models\auth;

use app\models\attori\Logopedista;
use yii\db\ActiveRecord;

/**
 * * `id`, 
 * * `username`, 
 * * `email`, 
 * * `password`
 */
class AuthLogopedista extends ActiveRecord
{
    public function getLogopedista()
    {
        return $this->hasOne(Logopedista::class, ["id" => "id"])->inverseOf("auth");
    }

    public function rules()
    {
        return [
            [["id", "username", "email", "password"], "required"]
        ];
    }
}
