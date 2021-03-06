<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\Departments $model
 */

$this->title = Yii::t('app', 'Update').' '.Yii::t('app','Unit Kerja') . ' ' . $model->Code;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Departments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Name, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="departments-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
