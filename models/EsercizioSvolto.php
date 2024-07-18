<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "esercizio_svolto".
 *
 * @property int $idEsercizio
 * @property int $idTerapia
 * @property string|null $dataSvolgimento
 * @property int $idRicompensa
 *
 * @property Esercizio $idEsercizio0
 * @property Ricompensa $idRicompensa0
 * @property Terapia $idTerapia0
 */
class EsercizioSvolto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'esercizio_svolto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idEsercizio', 'idTerapia', 'idRicompensa'], 'required'],
            [['idEsercizio', 'idTerapia', 'idRicompensa', 'valutazione'], 'integer'],
            [['dataSvolgimento', 'valutazione'], 'safe'],
            [['idEsercizio', 'idTerapia'], 'unique', 'targetAttribute' => ['idEsercizio', 'idTerapia']],
            [['idEsercizio'], 'exist', 'skipOnError' => true, 'targetClass' => Esercizio::class, 'targetAttribute' => ['idEsercizio' => 'id']],
            [['idRicompensa'], 'exist', 'skipOnError' => true, 'targetClass' => Ricompensa::class, 'targetAttribute' => ['idRicompensa' => 'id']],
            [['idTerapia'], 'exist', 'skipOnError' => true, 'targetClass' => Terapia::class, 'targetAttribute' => ['idTerapia' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idEsercizio' => 'Id Esercizio',
            'idTerapia' => 'Id Terapia',
            'dataSvolgimento' => 'Data Svolgimento',
            'idRicompensa' => 'Id Ricompensa',
            'valutazione' => 'Valutazione'
        ];
    }

    /**
     * Gets query for [[IdEsercizio0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEsercizio()
    {
        return $this->hasOne(Esercizio::class, ['id' => 'idEsercizio']);
    }

    /**
     * Gets query for [[IdRicompensa0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRicompensa()
    {
        return $this->hasOne(Ricompensa::class, ['id' => 'idRicompensa']);
    }

    /**
     * Gets query for [[IdTerapia0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTerapia()
    {
        return $this->hasOne(Terapia::class, ['id' => 'idTerapia']);
    }
}
