<?php

use backend\models\TipPersonalMedical;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\widgets\SwitchInput;
use yii\helpers\ArrayHelper;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model backend\models\PersonalMedical */
/* @var $form yii\bootstrap4\ActiveForm */
?>
<style>
    .kv-avatar .krajee-default.file-preview-frame,
    .kv-avatar .krajee-default.file-preview-frame:hover {
        margin: 0;
        padding: 0;
        border: none;
        box-shadow: none;
        text-align: center;
    }

    .file-drop-zone {
        max-height: 180px;
        max-width: 240px;
    }

    .kv-avatar {
        display: inline-block;
    }

    .kv-avatar .file-input {
        display: table-cell;
        min-width: 240px;
    }

    .kv-reqd {
        color: red;
        font-family: monospace;
        font-weight: normal;
    }
</style>
<?php
$style = <<< CSS




CSS;
$this->registerCss($style);
/* $script = <<< JS
  var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' +
  'onclick="alert(\'Call your custom code here.\')">' +
  '<i class="bi-tag"></i>' +
  '</button>';
  $("#avatar-1").fileinput({
  overwriteInitial: true,
  maxFileSize: 1500,
  showClose: false,
  showCaption: false,
  browseLabel: '',
  removeLabel: '',
  browseIcon: '<i class="bi-folder2-open"></i>',
  removeIcon: '<i class="bi-x-lg"></i>',
  removeTitle: 'Cancel or reset changes',
  elErrorContainer: '#kv-avatar-errors-1',
  msgErrorClass: 'alert alert-block alert-danger',
  defaultPreviewContent: '<img src="/samples/default-avatar-male.png" alt="Your Avatar">',
  layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
  allowedFileExtensions: ["jpg", "png", "gif"]
  });


  JS;
  $this->registerJs($script); */
?>



<div class="personal-medical-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
    
        <div class="col-3">
            <?= $form->field($model, 'tip')->dropDownList(ArrayHelper::map(TipPersonalMedical::find()->all(), 'id', 'denumire'), ($model->scenario == 'profile') ?   ['disabled'=>'disabled','prompt' => '--Selectati tipul--'] :['prompt' => '--Selectati tipul--']) ?>
        </div>
        <div class="col-3">
            <?= $form->field($model, 'nume')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-3">
            <?= $form->field($model, 'prenume')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-3">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>

    </div>



    <div class="row">
        <div class="col-3">
             <?= $form->field($model, 'gen')->widget(SwitchInput::classname(),[
                'pluginOptions' => [ 
                    //'handleWidth'=>60,
                    'onText' => 'Masculin',
                    'offText' => 'Feminin'
                ],
                'disabled'=>$model->scenario=='profile'
            ]); ?>
        </div>
        <div class="col-3">
            <?= $form->field($model, 'telefon')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-3">
                <?= $form->field($model, 'cod_parafa')->textInput(($model->scenario == 'profile') ?   ['readOnly'=>'readOnly','maxlength' => true] :['maxlength' => true]) ?>
            </div>
            
        <div class="col-3 text-center">
            <div class="kv-avatar">
                <?php
                $imgSource = Html::img(sprintf('uploads/%s',$model->poza), ['width' => '230px', 'height' => '230px', 'max-width' => '230px', 'max-height' => '230px','alt' => 'Your Avatar']) . "<h6 class='text-muted'>Click to select</h6>";
                echo $form->field($model, 'image')->widget(FileInput::classname(), [
                    'options' => ['accept' => 'image/*'],
                    'pluginOptions' => [
                        'overwriteInitial' => true,
                        'maxFileSize' => 1500,
                        'showClose' => false,
                        'showCaption' => false,
                        'showBrowse' => false,
                        'showUpload' => false,
                        'fileActionSettings' => [
                            'showZoom' => false,
                            'showUpload' => false,
                            'indicatorNew' => ''
                        ],
                        'previewSettings' => [
                            'image' => ['width' => '230px', 'height' => '230px', 'max-width' => '230px', 'max-height' => '230px']
                        ],
                        'previewTemplates' => [
                            'image' =>
                            '<div class="file-preview-frame" style="height:240px" id="{previewId}" data-fileindex="{fileindex}" data-template="{template}">'
                                . '<img src="{data}" class="kv-preview-data file-preview-image" title="{caption}" alt="{caption}" {style}>'
                                . '</div>',
                        ],
                        'browseOnZoneClick' => true,
                        //   'removeLabel' => '',
                        //'removeIcon' => '<i class="glyphicon glyphicon-remove"></i>',
                        //'removeTitle' => 'Cancel or reset changes',
                        'elErrorContainer' => '#kv-avatar-errors-2',
                        // 'msgErrorClass' => 'alert alert-block alert-danger',
                        'allowedFileExtensions' => ["jpg", "png", "gif"],
                        'layoutTemplates' => "{main2: '{preview} {remove} {browse}'}",
                        'defaultPreviewContent' => $imgSource
                    ],
                ])->label(false);
                ?>
            </div>
        </div>
    
            
            <div class="form-group">
                <?= Html::submitButton('Salvare', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
</div>