<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>
<div class="row mx-2 my-5 py-4 px-2 shadow">
    <div class="col-md-4 mb-4 mb-md-0">
        <?=
        Html::img(isset($model->profile) ? "data:image/jpg;base64," . base64_encode($model->profile->img) : "/images/profile.png", [
            "alt" => $model->id . "profile-img",
            "class" => "img-fluid m-auto d-block index-img"
        ])
        ?>
    </div>
    <div class="col-md-8">
        <div class="row">
            <?php $organizzazione = !empty($model->organizzazione) ? $model->organizzazione : "Non fa parte di nessuna organizzazione" ?>
            <div class="col-12 p-2 border rounded border-1"><?= Html::encode($model->getAttributeLabel("nome") . ": " . $model->nome . " " . $model->cognome, $doubleEncode = true) ?></div>
            <div class="col-12 p-2 border border-1"><?= Html::encode($model->getAttributeLabel("biografia") . ": " . $model->biografia, $doubleEncode = true) ?></div>
            <div class="col-12 p-2 border border-1"><?= Html::encode($model->getAttributeLabel("residenza") . ": " . $model->residenza, $doubleEncode = true) ?></div>
            <div class="col-12 p-2 border border-1"><?= Html::encode($model->getAttributeLabel("organizzazione") . ": " . $organizzazione, $doubleEncode = true) ?></div>
            <div class="col-12 p-2 border border-1"><span><?= Html::encode("{$model->auth->getAttributeLabel("email")}: ") ?></span><?= Html::a($model->auth->email, "mailto: {$model->auth->email}") ?></div>
        </div>
    </div>
</div>