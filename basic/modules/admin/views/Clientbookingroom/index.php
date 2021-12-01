<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\Clientbookingroomsearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Clientbookingrooms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clientbookingroom-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Clientbookingroom', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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
            //'isBookedNow',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
