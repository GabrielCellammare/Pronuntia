<?php

namespace app\models\auth;

use yii\db\ActiveRecord;

/**
 * * `id`, 
 * * `username`, 
 * * `email`, 
 * * `password`
 */
class AuthCaregiver extends ActiveRecord
{
    public function getCaregiver()
    {
        return $this->hasOne(Caregiver::class, ["id" => "id"])->inverseOf("auth");
    }

    public function rules()
    {
        return [
            [["id", "username", "email", "password"], "required"]
        ];
    }
}
