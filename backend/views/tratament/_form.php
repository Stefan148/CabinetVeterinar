<?php

use backend\models\Animal;
use backend\models\PersonalMedical;
use backend\models\Serviciu;
use backend\models\TipAnimal;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\widgets\SwitchInput;
use kartik\datetime\DateTimePicker;
use kartik\widgets\FileInput;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Tratament */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="tratament-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php
    //print_r($model->errors);




    ?>
    <div class="row">

        <div class="col-4">
            <?= $form->field($model, 'serviciu')->dropDownList(ArrayHelper::map(Serviciu::find()->all(), 'id', 'denumire'), ['prompt' => '--Selectati serviciul--']) ?>
        </div>

        <div class="col-4">
            <?= $form->field($model, 'data_ora')->widget(DateTimePicker::classname(), [
                'options' => ['placeholder' => 'Introdu data si ora ...'],

                'pluginOptions' => [
                    'autoclose' => true,

                    'format' => 'dd.mm.yyyy HH:ii P'
                ]
            ]) ?>
        </div>




        <div class="col-4">
            <?= $form->field($model, 'tipAnimal')->dropDownList(ArrayHelper::map(TipAnimal::find()->all(), 'id', 'denumire'), [
                'prompt' => '--Selectati tip animal--',
                'onchange' => '
            $.get( "index.php?r=animal/list&id=' . '" +$(this).val(), function( data ) {
                $("select#tratament-animal" ).html( data ) ;
            });'
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-8">
            <div class="row">
                <div class="col-6">
                    <?= $form->field($model, 'animal')->dropDownList(ArrayHelper::map(Animal::find()->where(['tip' => $model->tipAnimal])->all(), 'id', 'nume'), ['prompt' => '--Selectati animalul--']) ?>
                </div>

                <div class="col-6">
                    <?= $form->field($model, 'persoana')->dropDownList(ArrayHelper::map(PersonalMedical::find()->all(), 'id', 'numeComplet'), ['prompt' => '--Selectati persoana--']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12">

                    <?= $form->field($model, 'images[]')->widget(FileInput::className(), [


                        //'name' => 'attachment_49[]',
                        'options' => [
                            'multiple' => true
                        ],
                        'pluginOptions' => [
                           /* 'initialPreview' => [
                                "https://upload.wikimedia.org/wikipedia/commons/thumb/e/e1/FullMoon2010.jpg/631px-FullMoon2010.jpg",
                                "https://upload.wikimedia.org/wikipedia/commons/thumb/6/6f/Earth_Eastern_Hemisphere.jpg/600px-Earth_Eastern_Hemisphere.jpg"
                            ],*/
                           // 'uploadUrl' => Url::to(['/site/file-upload']),
                           /*'uploadExtraData' => [
                                'album_id' => 20,
                             //   'showUpload' => false,
                                'cat_id' => 'Nature'
                            ],*/
                            'fileActionSettings'=>[
                                'showUpload'=>false,
                                'showZoom'=>false,
                            ],
                            'showUpload'=>false,
                           // 'initialPreviewAsData' => true,
                            //'initialCaption' => "The Moon and the Earth",
                            // 'initialPreviewConfig' => [
                            //     ['caption' => 'Moon.jpg', 'size' => '873727'],
                            //     ['caption' => 'Earth.jpg', 'size' => '1287883'],
                            // ],
                            'overwriteInitial' => false,
                            'uploadAsync'=>false,
                            'autoReplace'=>false,
                            'maxFileCount' => 10,
                            'maxFileSize' => 2800
                        ]
                    ]);
                    ?>
                </div>
            </div>  
        </div>
        <div class="col-4">
            <?= $form->field($model, 'observatii')->textarea(['maxlength' => 200, 'rows' => 17]) ?>
        </div>

    </div>
    <div class="form-group">
        <?= Html::submitButton('Salvare', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>