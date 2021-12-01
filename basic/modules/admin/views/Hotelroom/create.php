<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Hotelroom */

$this->title = 'Create Hotelroom';
$this->params['breadcrumbs'][] = ['label' => 'Hotelrooms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hotelroom-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
