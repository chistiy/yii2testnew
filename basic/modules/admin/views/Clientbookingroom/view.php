<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Clientbookingroom */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Clientbookingrooms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="clientbookingroom-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'booking',
            'room',

            [
                'attribute' => 'client',
                'value' => function($data){
                    return $data->client0->name;
                },
            ],
            [
                'attribute' => 'organization',
                'value' => function($data){
                    return $data->organization0->name;
                },
            ],
            'isBookedNow',
        ],
    ]) ?>

</div>
