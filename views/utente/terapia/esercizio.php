<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use app\modules\MyMath;

?>

<div class="row mb-2 p-5">
    <div class="col-md-4 card">
        <?= Html::img(isset($model->esercizio->immagine) ? "data:image/jpg;base64," . base64_encode($model->esercizio->immagine) : "/images/profile.png", [
            "alt" => $model->idEsercizio . "esercizio-img",
            "class" => "card-img-top"

        ]) ?>
        <div class="card-body">
            <p class="card-text text-center font-weight-bold"><?= Html::encode($model->esercizio->nome) ?>
                <?=
                isset($model->dataSvolgimento) ?
                    Html::img("/images/icons/checked.png", [
                        "alt" => "checked",
                        "class" => "img-fluid",
                        "style" => "width: 2rem"
                    ])
                    :
                    Html::a(
                        "Esegui",
                        ['utente/terapia/esercizio', "idEsercizio" => $model->idEsercizio, "idTerapia" => $model->idTerapia],
                        ['class' => 'btn btn-primary']

                    ) ?>
            </p>

            <?=
            isset($model->dataSvolgimento) ?
                Html::tag("p", "Svolto il " . date_format(date_create($model->dataSvolgimento), "d/m/Y"), ['style' => "font-size: 0.8rem"]) : ""
            ?>
        </div>

    </div>

    <div class="col-md-6 font-italic">
        <p class="mb-0"><?= Html::encode($model->esercizio->descrizione) ?></p>
    </div>
    <div class="col-md-2">
        <div class="row h-100 align-content-between">
            <div class="col-12">
                <div class="p-2 border border-dark rounded shadow">
                    <p class="mb-0 px-3 py-1 text-center ">
                        Ricompensa
                    </p>
                    <?= Html::img(
                        "data:image/jpg;base64," . base64_encode($model->ricompensa->oggetto),
                        [
                            "alt" => $model->ricompensa->id . "ricompensa-img",
                            "class" => "img-fluid"
                        ]
                    ) ?>

                </div>
            </div>
            <div class="col-12">
                <p class="d-inline-block mb-0 px-3 py-1 float-right shadow "><?= Html::encode($model->esercizio->categoria) ?></p>
            </div>

        </div>
    </div>


</div>