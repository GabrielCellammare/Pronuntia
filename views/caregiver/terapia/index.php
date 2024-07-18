<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\widgets\ListView;

$this->title = 'Pronuntia - Esercizi utente';
?>
<h1 class="mb-5 py-3 shadow text-center">Terapia utente</h1>
<h2 class="p-2 shadow">Esercizi utente</h2>

<?=
ListView::widget([
    "dataProvider" => $eserciziProvider,
    "itemView" => "esercizio",
    "summary" => ""
]) ?>