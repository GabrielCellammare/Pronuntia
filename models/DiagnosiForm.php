<?php

namespace app\models;

use Yii;
use yii\base\model;

class DiagnosiForm extends Model
{


    public $DiagnosiFile;


    public function rules()
    {
        return [
            [['DiagnosiFile'], 'safe'],

        ];
    }


    public function attributeLabels()
    {
        return  [
            'DiagnosiFile' => 'File pdf della diagnosi=',
        ];
    }

    public function control($DiagnosiFile)
    {
        if ($this->validate($DiagnosiFile)) {
            return true;
        } else {
            return false;
        }
    }
}
