<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\Hotelbuildingsearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Hotelbuildings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hotelbuilding-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Hotelbuilding', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'hotelClass',
            'numberOfFloors',
            'numberOfRooms',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
