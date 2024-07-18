<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\attori\GestioneCaregiver */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="caregiver-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'codiceFiscale') ?>

    <?= $form->field($model, 'nome') ?>

    <?= $form->field($model, 'cognome') ?>

    <?= $form->field($model, 'dataDiNascita') ?>

    <?php // echo $form->field($model, 'residenza') ?>

    <?php // echo $form->field($model, 'numeroDiTelefono') ?>

    <?php // echo $form->field($model, 'idUtente') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
