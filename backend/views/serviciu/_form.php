<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Serviciu */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="serviciu-form">

    <?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-8">
    <?= $form->field($model, 'denumire')->textInput(['maxlength' => true]) ?>
</div>
<div class="col-2">
    <?= $form->field($model, 'pret')->textInput() ?>
</div>
<div class="col-2">
    <?= $form->field($model, 'periodicitate')->textInput() ?>
</div>
</div>
    <div class="form-group">
        <?= Html::submitButton('Salvare', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
