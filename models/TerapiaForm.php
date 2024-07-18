<?php

namespace app\models;

use yii\base\Model;


class TerapiaForm extends Model
{


    public $nomeTerapia;
    /**
     * Formato da array associativi di questo tipo: 
     * [idEsercizio => idRicompensa] 
     */
    public $eserciziAssegnati = [];
    public $ricompenseEsercizi = [];
    public $dataFineTerapia;


    public function rules()
    {
        return [
            [['nomeTerapia', 'ricompenseEsercizi', 'eserciziAssegnati'], 'required']
        ];
    }

    public function attributeLabels()
    {
        return  [
            'nomeTerapia' => 'Nome terapia',
            'dataFineTerapia' => 'Data fine terapia',
            'eserciziAssegnati' => "Assegnato",
        ];
    }
}
