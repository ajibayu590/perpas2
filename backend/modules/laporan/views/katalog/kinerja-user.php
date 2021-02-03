<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use kartik\grid\GridView;
use kartik\date\DatePicker;

use kartik\widgets\Select2;
use kartik\widgets\ActiveForm;

use yii\widgets\Pjax;
/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var common\models\LockersSearch $searchModel
 */

$this->title = yii::t('app','Laporan Kinerja User');
$this->params['breadcrumbs'][] = $this->title;

$month = array();
$modelArticleRepeatable = \common\models\Collections::find()->select(['MIN(DATE_FORMAT(TanggalPengadaan,"%Y")) AS TanggalPengadaan'])->One();
     // print_r($modelArticleRepeatable['TanggalPengadaan']); die;
$year = range($modelArticleRepeatable['TanggalPengadaan'] , date('Y'));
rsort($year);
$y=array();

for ($m=1; $m<=12; $m++) 
{
     $month[$m] = date('F', mktime(0,0,0,$m, 1, date('Y')));
     // echo '<pre>';print_r($month); echo '</pre>';
}

foreach ($year as $year => $value) {
    $y[$value] = $value;
}

// $modelArticleRepeatable = \common\models\Collections::find()->select(['DATE_FORMAT(TanggalPengadaan,"%Y") AS TanggalPengadaan'])->groupBy (['DATE_FORMAT(TanggalPengadaan,"%Y")'])->asArray()->All();
// foreach($modelArticleRepeatable as $key => $item){
//     $group[$key] = $item['TanggalPengadaan'];
// }
// echo'<pre>';print_r($group);echo'</pre>';


?>

<style type="text/css">
    .gap-padding10{
        padding-bottom: 10px;
    }
    .padding0{
        padding: 0;
    }

    .select2-container--krajee .select2-selection {
        font-size: 12px;
    }
</style>

<div class="lockers-index">

    <form id="form-SearchFilter" method="POST" action="show-pdf">    
        <div id="SearchFilter" class="col-sm-12">
            <div class="form-horizontal">
                <div class="box-body">

                    <!-- Pilih Periode -->
                    <div class="form-group">
                        <label for="pilihPeriode" class="col-sm-2 control-label"><?= Yii::t('app','Periode')//.' '.Yii::t('app','Pengadaan') ?></label>

                        <div class="col-sm-10 row">
                            <div class="col-sm-4 padding0">
                                <?= Select2::widget([
                                'name' => 'periode',
                                'data' => ['harian' => yii::t('app','Harian'),'bulanan' => yii::t('app','Bulanan'),'tahunan' => yii::t('app','Tahunan')],
                                'options' => [
                                // 'placeholder' => Yii::t('app','Choose').' '.Yii::t('app','Periode'),
                                'id' => 'pilihPeriode',
                                'class' => 'select2'
                                ],
                                ]); ?>
                            </div>
                            
                            <!-- Harian -->
                            <div class="col-sm-8" id="periodeHarian"  >
                                <?=  DatePicker::widget([
                                    'name' => 'from_date', 
                                    'type' => DatePicker::TYPE_RANGE,
                                    'value' => date('d-m-Y'),
                                    'name2' => 'to_date', 
                                    'value2' => date('d-m-Y'),
                                    'separator' => 's/d',
                                    'options' => ['placeholder' => Yii::t('app','Choose').' '.Yii::t('app','Date')],
                                    'pluginOptions' => [
                                    'format' => 'dd-mm-yyyy',
                                    'todayHighlight' => true,
                                    'autoclose'=>true,
                                    'id' => 'rangeHarian',
                                    ]
                                    ]);
                                    ?>
                            </div><!-- /Harian -->
                            <!-- Bulanan -->
                            <div class="col-sm-8" id="periodeBulanan" hidden="hidden">
                                <div class="input-group"> 
                                    <div class="container-fluid padding0 col-sm-5">
                                        <div class="col-sm-6 padding0">
                                            <?= Select2::widget([
                                                'name' => 'fromBulan',
                                                'value' => date('m'),
                                                'data' => $month,
                                                'options' => [
                                                // 'placeholder' => Yii::t('app','Choose').' '.Yii::t('app','Month'),
                                                'id' => 'fromBulan',
                                                'class' => 'padding0'
                                                ],
                                                ]); ?>
                                        </div>
                                        <div class="col-sm-6 padding0">
                                            <?= Select2::widget([
                                                'name' => 'fromTahun',
                                                'data' => $y,
                                                'value' => date('Y'),
                                                'options' => [
                                                // 'placeholder' => Yii::t('app','Choose').' '.Yii::t('app','Year'),
                                                'id' => 'fromTahun',
                                                'class' => 'padding0'
                                                ],
                                                ]); ?>
                                        </div>
                                    </div>
                                    
                                    <center class="col-sm-1" id="basic-addon1" style="padding-top: 10px"> s/d </center> 

                                    <div class="container-fluid padding0 col-sm-5">
                                        <div class="col-sm-6 padding0">
                                            <?= Select2::widget([
                                                'name' => 'toBulan',
                                                'data' => $month,
                                                'value' => date('m'),
                                                'options' => [
                                                // 'placeholder' => Yii::t('app','Choose').' '.Yii::t('app','Month'),
                                                'id' => 'toBulan',
                                                'class' => 'padding0'
                                                ],
                                                ]); ?>
                                        </div>
                                        <div class="col-sm-6 padding0" >
                                            <?= Select2::widget([
                                                'name' => 'toTahun',
                                                'data' => $y,
                                                'value' => date('Y'),
                                                'options' => [
                                                // 'placeholder' => Yii::t('app','Choose').' '.Yii::t('app','Year'),
                                                'id' => 'toTahun',
                                                'class' => 'padding0'
                                                ],
                                                ]); ?>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /Bulanan -->
                            <!-- Tahunan -->
                            <div class="col-sm-8" id="periodeTahunan" hidden="hidden" >
                                <div class="input-group"> 
                                    <div class="">
                                        <?= Select2::widget([
                                            'name' => 'fromTahunan',
                                            'value' => date('Y'),
                                            'data' => $y,
                                            'options' => [
                                            // 'placeholder' => Yii::t('app','Choose').' '.Yii::t('app','Year'),
                                            'id' => 'fromTahunan',
                                            'class' => 'padding0'
                                            ],
                                            ]); ?>
                                    </div>
                                    
                                    <center class="input-group-addon" id="basic-addon1"> s/d </center> 

                                    <div class="">
                                        <?= Select2::widget([
                                            'name' => 'toTahunan',
                                            'value' => date('Y'),
                                            'data' => $y,
                                            'options' => [
                                            // 'placeholder' => Yii::t('app','Choose').' '.Yii::t('app','Year'),
                                            'id' => 'toTahunan',
                                            'class' => 'padding0'
                                            ],
                                            ]); ?>
                                    </div>
                                </div>
                            </div><!-- /Tahunan -->

                        </div>

                    </div>
                    <!-- /Pilih Periode -->

                    <div class="form-group">
                            <label for="" class="col-sm-2 control-label" style="margin-left:0px;"><?= Yii::t('app','Kataloger') ?></label>

                            <div id="" class="col-sm-8 content-kataloger" style="margin-left:-15px;" Name="kriteria-kataloger">
                            </div>
                    </div>
                    
                    <div class="form-group">
                            <label for="" class="col-sm-2 control-label" style="margin-left:0px;"><?= Yii::t('app','Kriteria') ?></label>

                            <div id="" class="col-sm-8 content-kriteria" style="margin-left:-15px;" Name="kriteria-kriteria">
                            </div>
                    </div>

                    
                    <div class="form-group">
                        <label for="kop" class="col-sm-2 control-label"><?= Yii::t('app','Kop') ?> </label>

                        <div class="col-sm-10 row">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="kop"> <?= yii::t('app','Ya / Tidak')?>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="form-group padding0">
                    <div class="col-sm-10 col-sm-offset-2 padding0">
                        <button id="tampilkan_frekuensi" type="button" class="btn btn-sm btn-primary"><?= Yii::t('app','Tampilkan Frekuensi') ?></button>
                        <button id="tampilkan_data" type="button" class="btn btn-sm btn-primary"><?= Yii::t('app','Tampilkan Detail Data') ?></button>
                        <div class="btn-group" style="cursor:pointer;">
                           <button type="button" id="export" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding: 4px 12px !important; display: none;">
                                Export   <span class="caret"></span>
                           </button>
                           <ul class="dropdown-menu">
                             <li><a id="export-excel-kinerja-user-frekuensi">Excel-frekuensi</a></li>
                             <li><a id="export-excel-odt-kinerja-user-frekuensi">Open-Office-Excel-frekuensi</a></li>
                             <li><a id="export-excel-kinerja-user-data">Excel-data</a></li>
                             <li><a id="export-excel-odt-kinerja-user-data">Open-Office-Excel-data</a></li>
                             <li><a id="export-word-kinerja-user-frekuensi">Word-frekuensi</a></li>
                             <li><a id="export-word-kinerja-user-data">Word-data</a></li>
                             <li><a id="export-odt-kinerja-user-frekuensi">Open-Office-Word-frekuensi</a></li>
                             <li><a id="export-odt-kinerja-user-data">Open-Office-Word-data</a></li>
                             <li><a id="export-pdf-kinerja-user-frekuensi">PDF-Frekuensi</a></li>
                             <li><a id="export-pdf-kinerja-user-data">PDF-data</a></li>
                           </ul>
                        </div>
                        <button id="reset" type="button" class="btn btn-sm btn-warning"><?= Yii::t('app','Reset') ?> <?= Yii::t('app','Kriteria') ?> </button>
                    </div>
                   
                </div>
                <!-- /.box-footer -->
            </div>
        </div>
    </form> 



    <hr class="col-sm-12">
    
    <div id="show-pdf-content" class="col-sm-12">
        <!-- Nanti show PDF Disini -->
    </div>

</div>


<script type="text/javascript">
    
</script>



<?php
$this->registerJs("

    $.fn.select2.defaults.set('theme', 'krajee');

    $.get('load-filter-kriteria',{kriteria : 'kataloger'},function(data){
    
       $( '.content-kataloger' ).html( data ); 
       $('.content-kataloger').find('.select2').select2({
        // allowClear: true,
        }); 
    });
    $.get('load-filter-kriteria',{kriteria : 'kriteria'},function(data){
    
       $( '.content-kriteria' ).html( data ); 
       $('.content-kriteria').find('.select2').select2({
        // allowClear: true,
        }); 
    });

    // Filter Periode
    $('#pilihPeriode').change(function(){
        var periode = $(this).val();
        // alert(periode);
        if (periode == 'harian') 
        {
            $('#periodeHarian').show();
            $('#periodeBulanan').hide();
            $('#periodeTahunan').hide();
           
        } 
        else if (periode == 'bulanan') 
        {
            $('#periodeHarian').hide();
            $('#periodeBulanan').show();
            $('#periodeTahunan').hide();
        }
        else 
        {
            $('#periodeHarian').hide();
            $('#periodeBulanan').hide();
            $('#periodeTahunan').show();
        }
    });

    var i = 1;
    $('.add-field').click(function(e) {    
        $.get('load-selecter-kinerja-user',{ i : i },function(data){
            $('.multi-fields').append(data);        
            // $('.multi-fields').find('.select2').select2();
            i++;
        });
    });


    // Tampilkan Frekuensi
    var form = $('#form-SearchFilter');
    $('#tampilkan_frekuensi').click(function(){
        $.ajax({
            type:\"POST\",
            url:'show-pdf?tampilkan=katalog-kinerja-user',
            data:form.serialize(),
            success: function(response){
                console.log(response);  
                $( '#show-pdf-content' ).html( response ); 
                $('#export-excel-kinerja-user-frekuensi').show();
                $('#export-excel-odt-kinerja-user-frekuensi').show();
                $('#export-word-kinerja-user-frekuensi').show();
                $('#export-odt-kinerja-user-frekuensi').show();
                $('#export-pdf-kinerja-user-frekuensi').show();
                $('#export-excel-kinerja-user-data').hide();
                $('#export-excel-odt-kinerja-user-data').hide();
                $('#export-word-kinerja-user-data').hide();
                $('#export-pdf-kinerja-user-data').hide();
                $('#export-odt-kinerja-user-data').hide();
            }
        });
    });
    $('#tampilkan_data').click(function(){
            $.ajax({
                type:\"POST\",
                url:'show-pdf?tampilkan=katalog-kinerja-user-data',
                data:form.serialize(),
                success: function(response){
                    console.log(response);  
                    $( '#show-pdf-content' ).html( response ); 
                    $('#export-excel-kinerja-user-frekuensi').hide();
                    $('#export-excel-odt-kinerja-user-frekuensi').hide();
                    $('#export-word-kinerja-user-frekuensi').hide();
                    $('#export-odt-kinerja-user-frekuensi').hide();
                    $('#export-pdf-kinerja-user-frekuensi').hide();
                    $('#export-excel-kinerja-user-data').show();
                    $('#export-excel-odt-kinerja-user-data').show();
                    $('#export-word-kinerja-user-data').show();
                    $('#export-pdf-kinerja-user-data').show();
                    $('#export-odt-kinerja-user-data').show();
                }
            });
        });
    $('#export-excel-odt-kinerja-user-frekuensi').click(function(){
        $.ajax({
            type:\"POST\",
            url: 'show-pdf?tampilkan=export-excel-odt-kinerja-user-frekuensi',
            data:form.serialize(),
            async: false,
              context: document.body,
              success: function(){ 
                 window.location.assign('export-excel-odt-kinerja-user-frekuensi')
              }
            });
            
    });
    $('#export-excel-kinerja-user-frekuensi').click(function(){
        $.ajax({
            type:\"POST\",
            url: 'show-pdf?tampilkan=export-excel-kinerja-user-frekuensi',
            data:form.serialize(),
            async: false,
              context: document.body,
              success: function(){ 
                 window.location.assign('export-excel-kinerja-user-frekuensi')
              }
            });
            
    });
    $('#export-excel-kinerja-user-data').click(function(){
        $.ajax({
            type:\"POST\",
            url: 'show-pdf?tampilkan=export-excel-kinerja-user-data',
            data:form.serialize(),
            async: false,
              context: document.body,
              success: function(){ 
                 window.location.assign('export-excel-kinerja-user-data')
              }
            });
            
    });
    $('#export-excel-odt-kinerja-user-data').click(function(){
        $.ajax({
            type:\"POST\",
            url: 'show-pdf?tampilkan=export-excel-odt-kinerja-user-data',
            data:form.serialize(),
            async: false,
              context: document.body,
              success: function(){ 
                 window.location.assign('export-excel-odt-kinerja-user-data')
              }
            });
            
    });
    $('#export-word-kinerja-user-frekuensi').click(function(){
        $.ajax({
            type:\"POST\",
            url: 'show-pdf?tampilkan=export-word-kinerja-user-frekuensi',
            data:form.serialize(),
            async: false,
              context: document.body,
              success: function(){ 
                 window.location.assign('export-word-kinerja-user-frekuensi?type=doc')
              }
            });
            
    });
    $('#export-word-kinerja-user-data').click(function(){
        $.ajax({
            type:\"POST\",
            url: 'show-pdf?tampilkan=export-word-kinerja-user-data',
            data:form.serialize(),
            async: false,
              context: document.body,
              success: function(){ 
                 window.location.assign('export-word-kinerja-user-data?type=doc')
              }
            });
            
    });
    $('#export-odt-kinerja-user-frekuensi').click(function(){
        $.ajax({
            type:\"POST\",
            url: 'show-pdf?tampilkan=export-odt-kinerja-user-frekuensi',
            data:form.serialize(),
            async: false,
              context: document.body,
              success: function(){ 
                 window.location.assign('export-word-kinerja-user-frekuensi?type=odt')
              }
            });
            
    });
    $('#export-odt-kinerja-user-data').click(function(){
        $.ajax({
            type:\"POST\",
            url: 'show-pdf?tampilkan=export-odt-kinerja-user-data',
            data:form.serialize(),
            async: false,
              context: document.body,
              success: function(){ 
                 window.location.assign('export-word-kinerja-user-data?type=odt')
              }
            });
            
    });
    $('#export-pdf-kinerja-user-frekuensi').click(function(){
        $.ajax({
            type:\"POST\",
            url: 'show-pdf?tampilkan=export-pdf-kinerja-user-frekuensi',
            data:form.serialize(),
            async: false,
              context: document.body,
              success: function(){ 
                 window.location.assign('export-pdf-kinerja-user-frekuensi')
              }
            });
            
    });
    $('#export-pdf-kinerja-user-data').click(function(){
        $.ajax({
            type:\"POST\",
            url: 'show-pdf?tampilkan=export-pdf-kinerja-user-data',
            data:form.serialize(),
            async: false,
              context: document.body,
              success: function(){ 
                 window.location.assign('export-pdf-kinerja-user-data')
              }
            });
            
    });
    $('#reset').click(function(){
        location.reload();
    });
");
?>
