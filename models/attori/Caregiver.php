<?php

namespace app\models\attori;

use Yii;
use app\models\auth\AuthCaregiver;

/**
 * This is the model class for table "caregiver".
 *
 * @property int $id
 * @property string $codiceFiscale
 * @property string $nome
 * @property string $cognome
 * @property string $dataDiNascita
 * @property string $residenza
 * @property string|null $numeroDiTelefono
 * @property int $idUtente
 *
 * @property AuthCaregiver $authCaregiver
 * @property Utente $utente
 */
class Caregiver extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'caregiver';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dataDiNascita'], 'safe'],
            [['idUtente'], 'integer'],
            [['codiceFiscale'], 'string', 'max' => 16],
            [['nome', 'cognome', 'residenza'], 'string', 'max' => 45],
            [['numeroDiTelefono'], 'string', 'max' => 10],
            [['idUtente'], 'exist', 'skipOnError' => true, 'targetClass' => Utente::class, 'targetAttribute' => ['idUtente' => 'id']],
            [['codiceFiscale', 'nome', 'cognome', 'dataDiNascita', 'residenza', 'numeroDiTelefono'], 'required', "message" => "{attribute} e' richiesto"]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'codiceFiscale' => 'Codice Fiscale',
            'nome' => 'Nome',
            'cognome' => 'Cognome',
            'dataDiNascita' => 'Data Di Nascita',
            'residenza' => 'Residenza',
            'numeroDiTelefono' => 'Numero Di Telefono',
            'idUtente' => 'Id Utente',
        ];
    }

    /**
     * Gets query for [[AuthCaregiver]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuth()
    {
        return $this->hasOne(AuthCaregiver::class, ['id' => 'id']);
    }

    /**
     * Gets query for [[Utente]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUtente()
    {
        return $this->hasOne(Utente::class, ['id' => 'idUtente'])->inverseOf('caregiver');
    }

    public function getFullName()
    {
        return $this->nome . " " . $this->cognome;
    }
}
