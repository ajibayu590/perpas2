<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use common\models\CollectionSearchKardeks;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var common\models\QuarantinedCollectionSearch $searchModel
 */

?>
<style>
    #myWorkContent{
        width: 600px;
        height:auto;
        overflow-x: scroll;
        overflow-y: hidden;
        white-space: nowrap;
    }
    #myWorkContent a {
        display: inline-block;
        vertical-align: middle;
    }

    #myWorkContent img {
        border: 0;
    }
</style>
<div class="quarantined-collections-index" id="myWorkContent">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php Pjax::begin(['id' => 'myGridviewArticle']);
    echo GridView::widget([
        'id' => 'myGridArticle'.$catID,
        'pjax' => true,
        'dataProvider' => $dataProvider,
        'toolbar' => [
            ['content' =>
                \common\components\PageSize::widget(
                    [
                        'template' => '{label} <div class="col-sm-6" style="width:175px">{list}</div>',
                        'label' => Yii::t('app', 'Showing :'),
                        'labelOptions' => [
                            'class' => 'col-sm-4 control-label',
                            'style' => [
                                'width' => '75px',
                                'margin' => '0px',
                                'padding' => '0px',
                            ]

                        ],
                        'sizes' => Yii::$app->params['pageSize'],
                        'options' => [
                            'id' => 'aa',
                            'class' => 'form-control'
                        ]
                    ]
                )

            ],
            //'{pager}',
            //'{toggleData}',
            //'{export}',
        ],
        //'filterSelector' => 'select[name="per-page"]',
        //'filterModel' => $searchModel,
        'columns' => [
            /*[
                'class' => 'kartik\grid\ExpandRowColumn',
                'value' => function ($model, $key, $index, $column) {
                    return GridView::ROW_COLLAPSED;
                },
                'detail' => function ($model, $key, $index) {
                    $searchModel = new \common\models\SerialArticleFilesSearch();
                    $params['ArticleID'] = $model->id;
                    $dataProvider = $searchModel->search2($params);

                    return Yii::$app->controller->renderPartial('_subEksemplarArticle', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                    ]);

                }
            ],*/
            ['class' => 'yii\grid\SerialColumn'],
            'Title',
            'Article_type',
            'Creator',
            'EDISISERIAL',
            'TANGGAL_TERBIT_EDISI_SERIAL',
            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'value' => function ($model, $key, $index, $column) {
                    return GridView::ROW_COLLAPSED;
                },
                'expandTitle' => 'lihat konten digital',
                'collapseTitle' => 'tutup konten digital',
                'expandAllTitle' => 'lihat semua konten digital',
                'collapseAllTitle' => 'tutup semua konten digital',
                'detail' => function ($model, $key, $index) {
                    $searchModel = new \common\models\SerialArticleFilesSearch();
                    $params['ArticleID'] = $model->id;
                    $dataProvider = $searchModel->search2($params);

                    return Yii::$app->controller->renderPartial('_subEksemplarArticle', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                    ]);

                }
            ],

        ],
        //'summary'=>'',
        'responsive' => true,
        'containerOptions' => ['style' => 'font-size:13px'],
        'hover' => true,
        'condensed' => true,
        'options' => ['font-size' => '12px'],
    ]);
    Pjax::end(); ?>

</div>
