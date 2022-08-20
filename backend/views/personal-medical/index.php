<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Personal Medical';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <?= Html::a('Adauga Personal Medical', ['create'], ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>



                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'layout'=> "{items}\n{pager}\n{summary}",
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            ['attribute' => 'poza',
                            'value' => function ($data) {
                                $image = 'doctor.jpg';
                                if (!is_null($data->poza)) {
                                    $image = sprintf('uploads/%s',$data->poza);
                                
                                }
                                return Html::tag('div', Html::img($image, ['class' => 'img-circle', 'max-width' => '40px', 'style' => 'width:60px;height:60px;border-width:2px;border-color:#cecece']), ['style' => 'display:flexbox;align-items:center']);
                            },
                            'format' => 'raw'
                        ],
                            //'id',
                            ['attribute'=>'tip','value'=>function($model){
                                return $model->tip0->denumire;
                        }],
                            'nume',
                            'prenume',
                            
                           ['attribute'=>'gen','value'=>function($model){
                            return $model->gen===0?'Feminin':'Masculin';
                    }],'telefon',
                            
                            'cod_parafa',

                            ['class' => 'hail812\adminlte3\yii\grid\ActionColumn'],
                        ],
                        'summaryOptions' => ['class' => 'summary mb-2'],
                        'pager' => [
                            'class' => 'yii\bootstrap4\LinkPager',
                        ]
                    ]); 
                   ?>


                </div>
                <!--.card-body-->
            </div>
            <!--.card-->
        </div>
        <!--.col-md-12-->
    </div>
    <!--.row-->
</div>
