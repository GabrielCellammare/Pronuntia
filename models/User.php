<?php

namespace app\models;

use Yii;
use app\models\auth\AuthUtente;
use app\models\auth\AuthCaregiver;
use app\models\auth\AuthLogopedista;

class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $email;
    public $password;
    public $authKey;
    public $accessToken;
    public $tipoAttore;

    public static function getIdentity($idOrUsernameWithType, $search_conditions = null)
    {
        Yii::info([$idOrUsernameWithType, $search_conditions]);
        if (!str_contains($idOrUsernameWithType, "-")) return null;
        [$tipoAttore, $idOrUsername] = explode("-", $idOrUsernameWithType);
        $_search_conditions = isset($search_conditions) ? $search_conditions : $idOrUsername;

        $auth = null;
        switch ($tipoAttore) {
            case 'logopedista':
                $auth = AuthLogopedista::findOne($_search_conditions);
                break;
            case 'utente':
                $auth = AuthUtente::findOne($_search_conditions);
                break;
            case 'caregiver':
                $auth = AuthCaregiver::findOne($_search_conditions);
                break;
            default:
                $auth = AuthLogopedista::findOne($_search_conditions);
                break;
        }

        $user = isset($auth) ? new static($auth) : null;
        if (isset($user)) {
            $user->id = $tipoAttore . "-" . $auth->id;
            $user->tipoAttore = $tipoAttore;
        }
        return $user;
    }

    /**
     * {@inheritdoc}
     * @param $id = {tipoAttore}-{id}
     */
    public static function findIdentity($id)
    {
        return self::getIdentity($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::getIdentity($token);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($usernameWithType)
    {
        Yii::info([$usernameWithType]);
        if (!str_contains($usernameWithType, "-")) return null;
        [$tipoAttore, $username] = explode("-", $usernameWithType);
        return self::getIdentity($usernameWithType, ["username" => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public static function getShortId()
    {
        [$type, $id] = explode("-", Yii::$app->user->id);
        return $id;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}
