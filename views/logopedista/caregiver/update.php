<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\attori\Caregiver */

$this->title = 'Aggiorna caregiver ' . $model->getFullName();
$this->params['breadcrumbs'][] = ['label' => 'Utenti', 'url' => ['logopedista/utente/index']];
$this->params['breadcrumbs'][] = ['label' => $model->utente->getFullName(), 'url' => ['logopedista/utente/view', 'id' => $model->utente->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="caregiver-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="caregiver-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'residenza')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'numeroDiTelefono')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>