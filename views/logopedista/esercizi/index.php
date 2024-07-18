<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\widgets\ListView;

$this->title = 'Pronuntia - Esercizi';
?>
<h1 class="mb-5 py-3 shadow text-center">Esercizi</h1>
<h2 class="p-2 shadow">Tutti gli esercizi</h2>

<?=
ListView::widget([
    "dataProvider" => $eserciziProvider,
    "itemView" => "esercizio",
    "summary" => ""
]) ?>