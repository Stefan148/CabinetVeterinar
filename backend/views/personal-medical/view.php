<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\PersonalMedical */

$this->title = $model->numeComplet;
$this->params['breadcrumbs'][] = ['label' => 'Personal Medical', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

\yii\web\YiiAsset::register($this);
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <?= Html::a('Actualizeaza', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Sterge', ['delete', 'id' => $model->id], [
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
                            ['attribute'=>'tip','value'=>$model->tip0->denumire],
                            'nume',
                            'prenume',['attribute'=>'gen','value'=> $model->gen===0?'Feminin':'Masculin'
                        ],['attribute'=>'email','value'=> function($model){
                            if(!is_null($model->user0)){
                                return $model->user0->email;
                            }
                            
                            return null;
                        }
                            ]
                        
                            ,'telefon',
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
                            'cod_parafa',
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