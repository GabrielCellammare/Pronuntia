<?php

use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ListView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\attori\Utente */

$this->title = 'Terapia | ' . $model->cura->utente->getFullName();
$this->params['breadcrumbs'][] = ['label' => 'Utenti', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cura->utente->getFullName(), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Terapia';
?>

<div class="terapia">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="utente-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($formModel, 'nomeTerapia')->textInput(['maxlength' => 45]) ?>
        <?= $form->field($formModel, 'dataFineTerapia')->widget(DatePicker::class, [
            'language' => 'it',
            'dateFormat' => 'dd-MM-yyyy',
        ]) ?>

        <?=
        ListView::widget([
            "dataProvider" => $eserciziProvider,
            "itemView" => "esercizio",
            "viewParams" => [
                "form" => $form,
                "formModel" => $formModel,
                "ricompense" => $ricompense,

            ],
            "summary" => ""
        ]) ?>

        <div class="form-group">
            <?= Html::submitButton('Salva', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>