<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "esercizio".
 *
 * @property int $id
 * @property string|null $nome
 * @property string|null $categoria
 * @property string|null $descrizione
 *
 * @property EsercizioSvolto[] $esercizioSvoltos
 * @property Terapia[] $idTerapias
 */
class Esercizio extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'esercizio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['immagine'], 'safe'],
            [['nome', 'categoria', 'descrizione'], 'string', 'max' => 45],
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
            'categoria' => 'Categoria',
            'descrizione' => 'Descrizione',
            'immagine' => 'Immagine'
        ];
    }

    /**
     * Gets query for [[EsercizioSvoltos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEserciziSvolti()
    {
        return $this->hasMany(EsercizioSvolto::class, ['idEsercizio' => 'id'])->inverseOf('esercizio');
    }
}
