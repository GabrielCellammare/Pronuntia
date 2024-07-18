<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\attori\Utente */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="utente-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'codiceFiscale')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cognome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dataDiNascita')->textInput() ?>

    <?= $form->field($model, 'residenza')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'numeroDiTelefono')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($authModel, 'email')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Salva', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>