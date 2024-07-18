<?php

use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\attori\Utente */

$this->title = 'Crea utente';
$this->params['breadcrumbs'][] = ['label' => 'Utenti', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="utente-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="utente-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'codiceFiscale')->textInput(['maxlength' => 16]) ?>

        <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'cognome')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'dataDiNascita')->widget(DatePicker::class, [
            'language' => 'it',
            'dateFormat' => 'dd-MM-yyyy',
        ]) ?>

        <?= $form->field($model, 'residenza')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'numeroDiTelefono')->textInput(['maxlength' => 10]) ?>

        <?= $form->field($authModel, 'email')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Salva', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>