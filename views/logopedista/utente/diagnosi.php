<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Modifica diagnosi | ' . $utenteModel->getFullName();
$this->params['breadcrumbs'][] = ['label' => 'Utenti', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $utenteModel->getFullName(), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Diagnosi';
?>

<h1>Inserimento Diagnosi</h1>
<p>Inserire la diagnosi del paziente come file .pdf</p>

<?php $form = ActiveForm::begin([
    'id' => 'diagnosi-form',
    'options' => ['class' => 'form-horizontal'],
]) ?>

<?=
$form->field($model, 'diagnosi')->fileInput();
?>


<div class="form-group">
    <div class="col-lg-offset-1 col-lg-11">
        <?= Html::submitButton('Invia', ['class' => 'btn btn-primary']) ?>
    </div>
</div>
<?php ActiveForm::end() ?>