<?php

namespace app\models\attori\profili;

use app\models\attori\Logopedista;
use Yii;

/**
 * This is the model class for table "profile_logopedista".
 *
 * @property int $id
 * @property resource|null $img
 */
class ProfileLogopedista extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile_logopedista';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['img'], 'string'],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'img' => 'Img',
        ];
    }

    public function getLopedista()
    {
        return $this->hasOne(Logopedista::class, ["id" => "id"])->inverseOf("profile");
    }
}
