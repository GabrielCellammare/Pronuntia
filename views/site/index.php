<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\widgets\ListView;

$this->title = 'Pronuntia - Homepage';
?>
<h1 class="mb-5 py-3 shadow text-center">Pronuntia</h1>
<h2 class="p-2 shadow">I nostri esperti</h2>

<?=
ListView::widget([
    "dataProvider" => $logopedistiProvider,
    "itemView" => "home\logopedista",
    "summary" => ""
]) ?>