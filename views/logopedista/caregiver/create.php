<?php

use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\attori\Caregiver */

$this->title = 'Crea Caregiver';
$this->params['breadcrumbs'][] = ['label' => 'Utenti', 'url' => ['logopedista/utente/index']];
$this->params['breadcrumbs'][] = ['label' => $modelUtente->getFullName(), 'url' => ['logopedista/utente/view', 'id' => $modelUtente->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="caregiver-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="caregiver-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'codiceFiscale')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'cognome')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'dataDiNascita')->widget(DatePicker::class, [
            'language' => 'it',
            'dateFormat' => 'dd-MM-yyyy',
        ]) ?>

        <?= $form->field($model, 'residenza')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'numeroDiTelefono')->textInput(['maxlength' => true]) ?>

        <?= $form->field($authModel, 'email')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Salva', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>