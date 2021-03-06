<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Hotelbuilding */

$this->title = 'Update Hotelbuilding: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Hotelbuildings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hotelbuilding-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
