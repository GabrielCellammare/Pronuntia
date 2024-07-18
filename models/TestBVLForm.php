<?php

namespace app\models;

use yii\base\Model;


class TestBvlForm extends Model
{


    public $paroleBambino = [];
    public $testFrasi = [];
    public $comportamentiBambino;


    public function rules()
    {
        return [
            [['paroleBambino', 'testFrasi', 'comportamentiBambino'], 'required']
        ];
    }

    public function attributeLabels()
    {
        return  [
            'paroleBambino' => 'Cliccare i cerchietti delle parole dette spontaneamente dal bambino:',
            'comportamentiBambino' => 'Il bambino riesce a formulare frasi complete? Se il bambino riesce a formulare frasi complete, spuntare le frasi che "suonano" più simili a quelle che dice:',
            'testFrasi' => '',
        ];
    }
}
