<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use app\modules\MyMath;

?>
<?php



$mediaValutazione = count($model->eserciziSvolti) ? (array_reduce(
    $model->eserciziSvolti,

    function ($total, $item) {
        return $total + $item->valutazione;
    },

    0
)  / count($model->eserciziSvolti))

    : "ND";


if (!$mediaValutazione) {
    $mediaValutazione = "ND";
}



?>
<div class="row mb-2 p-5">
    <div class="col-md-4 card">
        <?= Html::img(isset($model->immagine) ? "data:image/jpg;base64," . base64_encode($model->immagine) : "/images/profile.png", [
            "alt" => $model->id . "esercizio-img",
            "class" => "card-img-top"

        ]) ?>
        <div class="card-body">
            <p class="card-text text-center font-weight-bold"><?= Html::encode($model->nome) ?></p>
        </div>

    </div>

    <div class="col-md-6 font-italic">
        <p class="mb-0"><?= Html::encode($model->descrizione) ?></p>
    </div>
    <div class="col-md-2">
        <div class="row h-100 align-content-between">
            <div class="col-12">
                <p class="d-inline-block mb-0 px-3 py-1 float-right border border-dark rounded shadow "><?= Html::encode($mediaValutazione) ?></p>
            </div>
            <div class="col-12">
                <p class="d-inline-block mb-0 px-3 py-1 float-right shadow "><?= Html::encode($model->categoria) ?></p>
            </div>
        </div>
    </div>


</div>