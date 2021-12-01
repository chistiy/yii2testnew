<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\bookingsearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bookings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="booking-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Booking', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//
//            'id',
            'startOfBooking',
            'endOfBooking',
            //'client',
            [
                    'attribute' => 'client',
                    'value' => function($data){
                        return $data->clientinfo->name;
                    },
            ],
            [
                'attribute' => 'organization',
                'value' => function($data){
                    return $data->organizationinfo->name;
                },
            ],
            //'organization',
            'countOfPeople',
            'totalSum',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
