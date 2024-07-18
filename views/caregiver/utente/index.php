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
<div class="caregiver-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <h2 class="mt-5"><?= Html::encode("Informazioni anagrafiche utente") ?></h2>

    <?= DetailView::widget([
        'model' => $model->utente,
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
    ]) ?>

    <h2 class="mt-5"><?= Html::encode("Informazioni cura utente") ?></h2>

    <?php $fileName = $model->utente->nome . $model->utente->cognome . "_Diagnosi.pdf" ?>

    <?= DetailView::widget([
        'model' => $model->utente->cura,
        'attributes' => [
            [
                "attribute" => 'diagnosi',
                "format" => "html",
                "value" => isset($model->utente->cura->diagnosi) ?
                    Html::a(
                        $fileName,
                        Url::to(
                            [
                                "download/download-diagnosi",
                                "id" => $model->utente->id,
                                "fileName" => $fileName,
                            ]
                        ),
                    )
                    : "<span class='text-danger'>Diagnosi non inserita</span>"
            ],
            [
                "attribute" => 'dataDiagnosi',
                "value" => date_format(date_create($model->utente->cura->dataDiagnosi), "d/m/Y"),
                "visible" => isset($model->utente->cura->diagnosi)
            ],
            [
                "attribute" => 'dataDiagnosi',
                "value" => date_format(date_create($model->utente->cura->dataDiagnosi), "d/m/Y"),
                "visible" => isset($model->utente->cura->diagnosi)
            ],
            [

                "attribute" => 'terapia',
                "value" => isset($model->utente->cura->terapia) ? $model->utente->cura->terapia->nome : "",
                "visible" => isset($model->utente->cura->terapia->nome)
            ],
            [

                "attribute" => 'dataInizio',
                "value" => isset($model->utente->cura->terapia) ? $model->utente->cura->terapia->dataInizio : "",
                "label" => "Data inizio terapia",
                "visible" => isset($model->utente->cura->terapia->dataInizio)
            ],
            [
                "attribute" => 'dataFine',
                "value" => isset($model->utente->cura->terapia) ? $model->utente->cura->terapia->dataFine : "",
                "label" => "Data fine terapia",
                "visible" => isset($model->utente->cura->terapia->dataFine)
            ],


        ],
    ]) ?>

    <?=
    (isset($model->utente->cura->terapia) && isset($model->utente->cura->terapia->nome)) ?
        Html::a(
            "Visualizza terapia",
            ['caregiver/terapia/index'],
            ['class' => 'btn btn-primary']

        ) : "" ?>


    <h2 class="mt-5"><?= Html::encode("Informazioni logopedista") ?></h2>

    <?= DetailView::widget([
        'model' => $model->utente->logopedista,
        'attributes' => [
            'nome',
            'cognome',
            'biografia',
            'numeroDiTelefono',
            [
                "attribute" => "email",
                "format" => "html",
                "value" => Html::a($model->utente->logopedista->auth->email, "mailto: {$model->utente->logopedista->auth->email}")
            ]
        ],
    ]) ?>



</div>