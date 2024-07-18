<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\DataColumn;
use yii\grid\ActionColumn;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\attori\GestioneUtente */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pannello di controllo';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="utente-index">

    <h1><?= Html::encode($this->title) ?></h1>


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
                "visible" => isset($model->cura->diagnosi)
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

    <?=
    (isset($model->cura->terapia) && isset($model->cura->terapia->nome)) ?
        Html::a(
            "Visualizza terapia",
            ['utente/terapia/index'],
            ['class' => 'btn btn-primary']

        ) : "" ?>


    <h2 class="mt-5"><?= Html::encode("Informazioni logopedista") ?></h2>

    <?= DetailView::widget([
        'model' => $model->logopedista,
        'attributes' => [
            'nome',
            'cognome',
            'biografia',
            'numeroDiTelefono',
            [
                "attribute" => "email",
                "format" => "html",
                "value" => Html::a($model->logopedista->auth->email, "mailto: {$model->logopedista->auth->email}")
            ]
        ],
    ]) ?>


    <h2 class="mt-5"><?= Html::encode("Informazioni anagrafiche caregiver") ?></h2>

    <?= isset($model->caregiver) ?

        DetailView::widget([

            'model' => $model->caregiver,
            'attributes' => [
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
        ])

        :

        DetailView::widget([
            "model" => ["caregiver"],
            "attributes" => [
                [
                    "attribute" => 'caregiver',
                    "format" => "html",
                    "value" => "<span class='text-danger'>Nessun caregiver associato</span>",
                ]
            ]
        ])

    ?>


</div>