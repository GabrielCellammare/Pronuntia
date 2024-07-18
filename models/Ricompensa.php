<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ricompensa".
 *
 * @property int $id
 * @property string $descrizione
 * @property resource $oggetto
 *
 * @property EsercizioSvolto[] $esercizioSvoltos
 */
class Ricompensa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ricompensa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'descrizione', 'oggetto'], 'required'],
            [['id'], 'integer'],
            [['oggetto'], 'string'],
            [['descrizione'], 'string', 'max' => 45],
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
            'descrizione' => 'Descrizione',
            'oggetto' => 'Oggetto',
        ];
    }

    /**
     * Gets query for [[EsercizioSvoltos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEserciziSvolti()
    {
        return $this->hasMany(EsercizioSvolto::class, ['idRicompensa' => 'id'])->inverseOf('ricompensa');
    }
}
