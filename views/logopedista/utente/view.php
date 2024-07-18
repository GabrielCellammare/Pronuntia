<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\attori\Utente */

$this->title = $model->getFullName();
$this->params['breadcrumbs'][] = ['label' => 'Utenti', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="utente-view">

    <div class="row align-items-center">
        <div class="col-auto">
            <h1 class="m-0"><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col">
            <?= Html::a('Elimina', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Sei sicuro di voler eliminare questo utente?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>

    </div>


    <h2 class="mt-5"><?= Html::encode("Informazioni anagrafiche") ?></h2>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'codiceFiscale',
            'nome',
            'cognome',
            [
                "attribute" => 'dataDiNascita',
                "value" => date_format(date_create($model->dataDiNascita), "d/m/Y")
            ],
            'residenza',
            'numeroDiTelefono',
        ],
    ]) ?>

    <p>
        <?= Html::a(
            'Modifica dati anagrafici',
            ['update', 'id' => $model->id],
            ['class' => 'btn btn-success']
        ) ?>
    </p>

    <h2 class="mt-5"><?= Html::encode("Informazioni cura") ?></h2>

    <?php $fileName = $model->nome . $model->cognome . "_Diagnosi.pdf" ?>

    <?= DetailView::widget([
        'model' => $model->cura,
        'attributes' => [
            [
                "attribute" => 'diagnosi',
                "format" => "html",
                "value" => isset($model->cura->diagnosi) ?
                    Html::a(
                        $fileName,
                        Url::to(
                            [
                                "download/download-diagnosi",
                                "id" => $model->id,
                                "fileName" => $fileName,
                            ]
                        ),
                    )
                    : "<span class='text-danger'>Diagnosi non inserita</span>"
            ],
            [
                "attribute" => 'dataDiagnosi',
                "value" => date_format(date_create($model->cura->dataDiagnosi), "d/m/Y"),
                "visible" => isset($model->cura->dataDiagnosi)
            ],
            [
                "attribute" => 'terapia',
                "value" => isset($model->cura->terapia) ? $model->cura->terapia->nome : "",
                "visible" => isset($model->cura->terapia->nome)
            ],
            [

                "attribute" => 'dataInizio',
                "value" => isset($model->cura->terapia) ? $model->cura->terapia->dataInizio : "",
                "label" => "Data inizio terapia",
                "visible" => isset($model->cura->terapia->dataInizio)
            ],
            [
                "attribute" => 'dataFine',
                "value" => isset($model->cura->terapia) ? $model->cura->terapia->dataFine : "",
                "label" => "Data fine terapia",
                "visible" => isset($model->cura->terapia->dataFine)
            ],

        ],

    ]) ?>


    <?= Html::a(
        (isset($model->cura->diagnosi) ? "Modifica" : "Inserisci") . ' diagnosi',
        ['diagnosi', 'id' => $model->id],
        ['class' => 'btn ' . (isset($model->cura->diagnosi) ? 'btn-success' : 'btn-primary')]
    ) ?>

    <?= (isset($model->cura->diagnosi) && isset($model->cura->terapia->nome)) ?
        Html::a(
            ("Monitoraggio terapia"),
            ['monitoraggio', 'id' => $model->id],
            ['class' => 'ml-3 btn btn-primary']
        )

        :
        ""
    ?>

    <?=
    isset($model->cura->diagnosi) ?
        Html::a(
            (isset($model->cura->terapia->nome) ? "Modifica" : "Inserisci") . ' terapia',
            ['terapia', 'id' => $model->id],
            ['class' => 'ml-3 btn ' . (isset($model->cura->terapia->nome) ? 'btn-success' : 'btn-primary')]

        ) : "" ?>

    <h2 class="mt-5"><?= Html::encode("Informazioni caregiver") ?></h2>

    <?= isset($model->caregiver) ?
        DetailView::widget([
            'model' => $model->caregiver,
            'attributes' => [
                'id',
                'codiceFiscale',
                'nome',
                'cognome',
                [
                    "attribute" => 'dataDiNascita',
                    "value" => date_format(date_create($model->caregiver->dataDiNascita), "d/m/Y")
                ],
                'residenza',
                'numeroDiTelefono',
            ],
        ]) :
        DetailView::widget([
            "model" => ["caregiver"],
            "attributes" => [
                [
                    "attribute" => 'caregiver',
                    "format" => "html",
                    "value" => "<span class='text-danger'>Nessun caregiver associato</span>",
                ],
            ]
        ]) ?>

    <?php
    if (isset($model->caregiver)) {
        echo Html::a(
            "Modifica caregiver",
            ['logopedista/caregiver/update', 'id' => $model->caregiver->id],
            ['class' => 'btn btn-success']
        );
        echo Html::a(
            "Elimina caregiver",
            ['logopedista/caregiver/delete', 'id' => $model->caregiver->id],
            [
                'class' => 'btn btn-danger ml-3',
                'data' => [
                    'confirm' => 'Sei sicuro di voler eliminare questo caregiver?',
                    'method' => 'post',
                ],
            ]
        );
    } else
        echo Html::a(
            "Inserisci caregiver",
            ['logopedista/caregiver/create', 'id' => $model->id],
            ['class' => 'btn btn-primary'],
        )
    ?>

</div>