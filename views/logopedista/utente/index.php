<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\DataColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\attori\GestioneUtente */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pannello di controllo';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="utente-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'codiceFiscale',
            'nome',
            'cognome',

            [
                'class' => DataColumn::class,
                'attribute' => 'dataDiNascita',
                'format' => 'text',
                'label' => 'Data di nascita',
                "format" => ['date', 'php:d/m/Y']
            ],

            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                "buttons" => [
                    "delete" => function ($url, $model, $key) {
                        return
                            Html::a('<svg aria-hidden="true" style="display:inline-block;font-size:inherit;height:1em;overflow:visible;vertical-align:-.125em;width:.875em" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M32 464a48 48 0 0048 48h288a48 48 0 0048-48V128H32zm272-256a16 16 0 0132 0v224a16 16 0 01-32 0zm-96 0a16 16 0 0132 0v224a16 16 0 01-32 0zm-96 0a16 16 0 0132 0v224a16 16 0 01-32 0zM432 32H312l-9-19a24 24 0 00-22-13H167a24 24 0 00-22 13l-9 19H16A16 16 0 000 48v32a16 16 0 0016 16h416a16 16 0 0016-16V48a16 16 0 00-16-16z"></path></svg>', $url, [
                                'data' => [
                                    'confirm' => 'Sei sicuro di voler eliminare questo utente?',
                                    'method' => 'post',
                                ],
                            ]);
                    }
                ]
            ],
        ],
        "emptyText" => "Nessun utente trovato",
        "summary" => "Mostrando <b>{count}</b> utente/i su <b>{totalCount}</b>"
    ]); ?>

    <p>
        <?= Html::a('Aggiungi utente', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

</div>