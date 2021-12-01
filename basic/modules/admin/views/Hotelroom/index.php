<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\Hotelroomsearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Hotelrooms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hotelroom-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Hotelroom', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'numberOfBeds',
            'hotelBuilding',
            'floor',
            'paymentForDay',
            //'expensesForDay',
            //'isNotFree',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
