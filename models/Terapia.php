<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "terapia".
 *
 * @property int $id
 * @property string $nome
 * @property string $dataInizio
 * @property string|null $dataFine
 *
 * @property Cura[] $curas
 * @property EsercizioSvolto[] $esercizioSvoltos
 * @property Esercizio[] $idEsercizios
 */
class Terapia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'terapia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['nome', 'dataInizio', 'dataFine'], 'string', 'max' => 45],
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
            'nome' => 'Nome',
            'dataInizio' => 'Data Inizio',
            'dataFine' => 'Data Fine',
        ];
    }

    /**
     * Gets query for [[Curas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCura()
    {
        return $this->hasOne(Cura::class, ['id' => 'id'])->inverseOf('terapia');
    }

    /**
     * Gets query for [[EsercizioSvoltos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEserciziSvolti()
    {
        return $this->hasMany(EsercizioSvolto::class, ['idTerapia' => 'id'])->inverseOf('terapia');
    }
}
