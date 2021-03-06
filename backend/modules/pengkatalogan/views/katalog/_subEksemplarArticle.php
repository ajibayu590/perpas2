<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use common\models\CollectionSearchKardeks;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var common\models\QuarantinedCollectionSearch $searchModel
 */
/*$model=$dataProvider->getModels();
\common\components\OpacHelpers::print__r($model);*/


?>

<?php 
    // echo GridView::widget([
    // Pjax::begin(['linkSelector'=>false]); echo GridView::widget([
    Pjax::begin(['id' => 'test2','linkSelector'=>false]); echo GridView::widget([
    // 'id'=>'GridArtikelKontenDigital',
    'pjax'=>true,
    // 'id'=>'test',
    'dataProvider' => $dataProvider,
    'options' => ['id' => 'gridcek'],
    /*'toolbar'=> [
        ['content'=>
             \common\components\PageSize::widget(
                [
                    'template'=> '{label} <div class="col-sm-8" style="width:175px">{list}</div>',
                    'label'=>Yii::t('app', 'Showing :'),
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
    ],*/
    'filterSelector' => 'select[name="per-page"]',
    //'filterModel' => $searchModel,
    'columns' => [
        [
            'class'       => '\kartik\grid\CheckboxColumn',
            'pageSummary' => true,
            'rowSelectedClass' => GridView::TYPE_INFO,
            'name' => 'cekss',
            'checkboxOptions' => function ($data, $key, $index, $column) {
                // echo'<pre>';print_r($index);
                return [
                    'id' => 'test',
                    'value' => $data['ID']
                ];
            },
            'vAlign' => GridView::ALIGN_TOP
        ],
        ['class' => 'yii\grid\SerialColumn'],
        'FileURL',
        'FileFlash',
        'sizeFile',
        [
            'attribute'=>'IsPublish',
            'format' => 'raw',
            'value'=>function($data){
                if($data['IsPublish'] == 1){
                    return '<span class="label label-success">Publik</span>';
                }else if($data['IsPublish'] == 2){
                    return '<span class="label label-primary">Hanya untuk anggota</span>';
                }elseif($data['IsPublish'] == 0){
                    return '<span class="label label-warning">Tidak dipublikasikan</span>';
                }else{
                    return '<span class="label label-default">Tidak diketahui</span>';
                }


            }
        ],
        
    ],
    'summary' => false,
    'responsive' => true,
    'containerOptions' => ['style' => 'font-size:13px'],
    'hover' => true,
    'condensed' => true,
    'headerRowOptions' => ['class' => GridView::TYPE_SUCCESS],
    'options' => ['font-size' => '12px']
]); Pjax::end();?>




