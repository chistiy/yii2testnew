<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\paymentforservicessearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Paymentforservices';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paymentforservices-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Paymentforservices', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'client',
                'value' => function($data){
                    return $data->client0->name;
                },
            ],
            [
                'attribute' => 'service',
                'value' => function($data){
                    return $data->service0->name;
                },
            ],
            'cost',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
