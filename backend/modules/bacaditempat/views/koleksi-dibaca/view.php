<?php



use yii\widgets\DetailView;
use kartik\datecontrol\DateControl;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var common\models\Bacaditempat $model
 */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Bacaditempats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bacaditempat-view">
   <p> <a class="btn btn-warning" href="/inlislite3/backend/gii">Kembali</a>        <a class="btn btn-primary" href="/inlislite3/backend/gii/default/update?id=%24model-%3Eid">Koreksi</a>        <a class="btn btn-danger" href="/inlislite3/backend/gii/default/delete?id=%24model-%3Eid" data-confirm="Apakah Anda yakin ingin menghapus item ini?" data-method="post">Hapus</a>    </p>



    <?= DetailView::widget([
            'model' => $model,
            
        'attributes' => [
            'NoPengunjung',
            'collection_id',
            'Member_id',
            'Location_Id',
        ],
       
    ]) ?>

</div>
