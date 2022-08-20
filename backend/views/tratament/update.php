<?php

/* @var $this yii\web\View */
/* @var $model backend\models\Tratament */

$this->title = 'Actualizeaza tratamente: ' . $model->serviciu0->denumire;
$this->params['breadcrumbs'][] = ['label' => 'Tratamente', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->serviciu0->denumire, 'url' => ['view', 'id' => $model->id]];
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