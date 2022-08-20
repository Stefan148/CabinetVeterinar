<?php

/* @var $this yii\web\View */
/* @var $model backend\models\Animal */

$this->title = 'Actualizeaza Animal: ' . $model->nume;
$this->params['breadcrumbs'][] = ['label' => 'Animale', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nume, 'url' => ['view', 'id' => $model->nume]];
$this->params['breadcrumbs'][] = 'Actualizare';
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <?=$this->render('_form', [
                        'model' => $model
                    ]) ?>
                </div>
            </div>
        </div>
        <!--.card-body-->
    </div>
    <!--.card-->
</div>