<?php

use app\models\TestBvlForm;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use dosamigos\multiselect\MultiSelect;

$this->title = 'TestBVL';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="testBvl-container">
    <h1><?= Html::encode($this->title) ?></h1>
    <h3>
        Da questa pagina e' possibile scaricare il questionario per la valutazione della comunicazione del linguaggio nei primi anni di vita.
        Dopo aver scaricato e compilato correttamente ogni campo del test, e' possibile inviarlo ad uno dei nostri esperti per ricevere i risultati ed eventualmente iniziare una terapia.
    </h3>
    <?= Html::a("Scarica Test", ["download/download-test-bvl"], ["class" => "btn btn-primary"]) ?>
</div>