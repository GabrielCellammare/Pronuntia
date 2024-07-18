<?php

use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ListView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\attori\Utente */

$this->title = 'Terapia | ' . $model->cura->utente->getFullName();
$this->params['breadcrumbs'][] = ['label' => 'Utenti', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cura->utente->getFullName(), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Monitoraggio';
?>

<div class="terapia">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="esercizi">
        <?=
        ListView::widget([
            "dataProvider" => $eserciziProvider,
            "itemView" => "esercizio",
            "summary" => ""
        ]) ?>
    </div>

</div>