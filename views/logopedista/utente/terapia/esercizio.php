<?php

use yii\helpers\Html;
use app\modules\MyMath;
use yii\bootstrap4\Dropdown;
use yii\helpers\ArrayHelper;
use yii\helpers\HtmlPurifier;

?>
<?php

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

    <div class="col-md-4 font-italic">
        <p class="mb-0"><?= Html::encode($model->descrizione) ?></p>
    </div>
    <div class="col-md-4">
        <div class="row h-100 align-content-between">
            <div class="col-12">
                <?= $form->field($formModel, "eserciziAssegnati[$index]", [
                    "labelOptions" => ["class" => " mb-0 mr-3"],
                    "options" =>
                    ["class" => "form-group d-flex justify-content-end align-items-center"]
                ])->checkbox(["style" => "transform: scale(2.0)"], false) ?>
            </div>
            <div class="col-12">
                <p class="d-inline-block mb-0 px-3 py-1 float-right shadow">
                    <?= $form->field($formModel, "ricompenseEsercizi[$index]")->dropDownList(ArrayHelper::map($ricompense, "id", "descrizione")) ?>
                </p>
            </div>
            <div class="col-12">
                <p class="d-inline-block mb-0 px-3 py-1 float-right shadow ">
                    <?= Html::encode($model->categoria) ?>
                </p>
            </div>
        </div>
    </div>




</div>