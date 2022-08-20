<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TipAnimal */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="tip-animal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'denumire')->textInput(['maxlength' => true]) ?>



    <?= $form->field($model, 'activ')->textInput() ?>





    <div class="form-group">
        <?= Html::submitButton('Salvare', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>