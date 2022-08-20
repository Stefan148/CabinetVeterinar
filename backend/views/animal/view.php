<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\Animal */

$this->title = "Foaie pacient(" . $model->nume.")";
$this->params['breadcrumbs'][] = ['label' => 'Animale', 'url' => ['index']];
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
                            //'tip',
                            ['attribute' => 'tip', 'label' => 'Tip animal', 'value' => function ($model) {
                                return $model->tip0->denumire;
                            }],
                            'nume',
                            ['attribute' => 'gen', 'value' => function ($model) {
                                return $model->gen == 0 ? 'Femela' : 'Mascul';
                            }],
                            'varsta',
                            'greutate',
                            'nr_cip',
                            ['attribute' => 'poza',
                                'value' => function ($data) {
                                    $image = 'default_logo.png';
                                    if (!is_null($data->poza)) {
                                        $image = sprintf('uploads/%s',$data->poza);
                                    
                                    }
                                    return Html::tag('div', Html::img($image, ['class' => 'img-circle', 'max-width' => '40px', 'style' => 'width:60px;height:60px;border-width:2px;border-color:#cecece']), ['style' => 'display:flexbox;align-items:center']);
                                },
                                'format' => 'raw'
                            ],
                        ],
                    ]) ?>
                    <div class="col-md-12">
                        <?= Html::a('Adauga tratament', ['tratament/create','animal'=>$model->id], ['class' => 'btn btn-success']) ?>
                    </div>
                    <br/>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'layout' => "{items}\n{summary}\n{pager}",
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            //'id',
                            ['attribute' => 'serviciu', 'value' => function ($model) {
                                return $model->serviciu0->denumire;
                            }],
                            'data_ora',
                            // ['attribute' => 'tipAnimal', 'value' => function ($model) {
                            //   return $model->animal0->tip0->denumire;
                            //}],
                            //['attribute' => 'animal', 'label' => 'Nume animal', 'value' => function ($model) {
                            // return $model->animal0->nume;
                            // }],
                            ['attribute' => 'persoana', 'value' => function ($model) {
                                return $model->persoana0->detalii;
                            }],
                            'observatii',

                            ['class' => 'hail812\adminlte3\yii\grid\ActionColumn'],
                        ],
                        'summaryOptions' => ['class' => 'summary mb-2'],
                        'pager' => [
                            'class' => 'yii\bootstrap4\LinkPager',
                        ]
                    ]); ?>


                </div>
                <!--.col-md-12-->
            </div>
            <!--.row-->
        </div>
        <!--.card-body-->
    </div>
    <!--.card-->
</div>