<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\attori\Utente */

$this->title = 'Aggiorna utente: '  . $model->getFullName();
$this->params['breadcrumbs'][] = ['label' => 'Utenti', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->getFullName(), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Aggiorna';
?>
<div class="utente-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="utente-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'cognome')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'dataDiNascita')->textInput() ?>

        <?= $form->field($model, 'residenza')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'numeroDiTelefono')->textInput(['maxlength' => 10]) ?>

        <div class="form-group">
            <?= Html::submitButton('Salva', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>