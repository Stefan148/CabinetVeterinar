<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Tratament */

$this->title = $model->serviciu0->denumire;
$this->params['breadcrumbs'][] = ['label' => 'Tratamente', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <?= Html::a('Actualizare', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Stergere', ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]) ?>
                    </p>
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            ['attribute' =>'serviciu','value'=>$model->serviciu0->denumire],
                            'data_ora',
                            ['attribute' =>'tipAnimal','value'=>$model->animal0->tip0->denumire],
                            ['attribute' =>'animal','value'=>$model->animal0->nume],
                            ['attribute'=>'persoana','value'=>$model->persoana0->detalii],
                            'observatii',
                        ],
                    ]) ?>
                </div>
                <!--.col-md-12-->
            </div>
            <!--.row-->
        </div>
        <!--.card-body-->
    </div>
    <!--.card-->
</div>