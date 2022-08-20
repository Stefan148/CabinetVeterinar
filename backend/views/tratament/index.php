<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tratamente';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <?= Html::a('Creeaza tratamente', ['create'], ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>



                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'layout'=> "{items}\n{pager}\n{summary}",
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'id',
                            ['attribute' =>'serviciu','value'=>function($model){
                                return $model->serviciu0->denumire;
                            }],
                            'data_ora',
                            ['attribute'=>'tipAnimal','value'=>function($model){
                                return $model->animal0->tip0->denumire;
                            }],
                            ['attribute'=>'animal','label'=>'Nume animal','value'=>function($model){
                                return $model->animal0->nume;
                            }],
                            ['attribute'=>'persoana','value'=>function($model){
                                return $model->persoana0->detalii;
                            }],
                            //'observatii'

                            ['class' => 'hail812\adminlte3\yii\grid\ActionColumn'],
                        ],
                        'summaryOptions' => ['class' => 'summary mb-2'],
                        'pager' => [
                            'class' => 'yii\bootstrap4\LinkPager',
                        ]
                    ]); ?>


                </div>
                <!--.card-body-->
            </div>
            <!--.card-->
        </div>
        <!--.col-md-12-->
    </div>
    <!--.row-->
</div>
