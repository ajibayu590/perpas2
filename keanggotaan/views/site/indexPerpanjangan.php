<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\Url;

use kartik\grid\GridView;


/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var common\models\MemberPerpanjanganSearch $searchModel
 */

$this->title = Yii::t('app', 'Daftar Perpanjangan');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-perpanjangan-index">
     
   
    <?php Pjax::begin(); echo GridView::widget([
        'dataProvider' => $dataProvider,
		'toolbar'=> [
            ['content'=>
                 \common\components\PageSize::widget(
                    [
                        'template'=> '{label} <div class="col-sm-8" style="width:175px">{list}</div>',
                        'label'=>'Tampilkan :',
                        'labelOptions'=>[
                            'class'=>'col-sm-4 control-label',
                            'style'=>[
                                'width'=> '75px',
                                'margin'=> '0px',
                                'padding'=> '0px',
                            ]

                        ],
                        'sizes'=>Yii::$app->params['pageSize'],
                        'options'=>[
                            'id'=>'aa',
                            'class'=>'form-control'
                        ]
                    ]
                 )

            ],

            //'{toggleData}',
            '{export}',
        ],
        'filterSelector' => 'select[name="per-page"]',
        //'filterModel' => $searchModel,
 'columns' => [
		
            ['class' => 'yii\grid\SerialColumn'],

            'member.MemberNo',
            [
                         //'label'=>'Nama',
                         'format'=>'raw',
                         'attribute'=>'member.Fullname',
                         'value' => function($data){
                             $url = Url::to(['update','id'=>$data->ID]);
                             return Html::a($data->member->Fullname, $url, ['title' => $data->member->Fullname]); 
                         }
            ],
            [
                'attribute'=>'Tanggal',
                'label' => Yii::t('app', 'Tanggal Berakhir'),
                'contentOptions'=>['style'=>'width: 100px;'],
                'format'=>['datetime',(isset(Yii::$app->modules['datecontrol']['displaySettings']['date'])) ? Yii::$app->modules['datecontrol']['displaySettings']['date'] : 'd-m-Y']],
            [
                'attribute'=>'Biaya',
                'label' => Yii::t('app', 'Biaya'),
                'contentOptions'=>['style'=>'width: 100px;text-align:right;'],
            ],
            // 'IsLunas:boolean',
            [
            'attribute'=>'IsLunas',
            'label'=>Yii::t('app', 'Lunas'),
            'format'=>'boolean',
            ], 
            [
                'attribute'=>'Keterangan',
                'label' => Yii::t('app', 'Keterangan'),
            ],

            
        ],
        'responsive'=>true,
        'hover'=>true,
        'condensed'=>true,
        'floatHeader'=>false,

        'panel' => [
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> '.Html::encode($this->title).' </h3>',
            'type'=>'info',
            //'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> '.Yii::t('app','Add'), ['create'], ['class' => 'btn btn-success']),
            'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> '.Yii::t('app','Reset List'), ['index'], ['class' => 'btn btn-info']),
            'showFooter'=>false
        ],
    ]); Pjax::end(); ?>

</div>
