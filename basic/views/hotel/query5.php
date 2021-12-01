<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Nav;
?>
<div class="wrap">
  <?php
  echo Nav::widget([
    'activateItems' => false,
    'options' => ['class' => 'nav-justified'],
    'items' => [
      ['label' => 'Запрос №1', 'url' => ['/hotel/query1']],
    ['label' => 'Запрос №2 ', 'url' => ['/hotel/query2']],
    ['label' => 'Запрос №3 ', 'url' => ['/hotel/query3']],
    ['label' => 'Запрос №4 ', 'url' => ['/hotel/query4']],
    ['label' => 'Запрос №5 ', 'url' => ['/hotel/query5']],
    ['label' => 'Запрос №6 ', 'url' => ['/hotel/query6']],
    ['label' => 'Запрос №7 ', 'url' => ['/hotel/query7']],
    ['label' => 'Запрос №8 ', 'url' => ['/hotel/query8']],
    ['label' => 'Запрос №9 ', 'url' => ['/hotel/query9']],
    ['label' => 'Запрос №10 ', 'url' => ['/hotel/query10']],
    ['label' => 'Запрос №11 ', 'url' => ['/hotel/query11']],
    ['label' => 'Запрос №12 ', 'url' => ['/hotel/query12']],
    ['label' => 'Запрос №13 ', 'url' => ['/hotel/query13']],
    ['label' => 'Запрос №14 ', 'url' => ['/hotel/query14']],
    ['label' => 'Запрос №15 ', 'url' => ['/hotel/query15']],
    ['label' => 'Запрос №16 ', 'url' => ['/hotel/query16']],
  ],
]);
?>


</div>
<?= date('Y-m-d');?>

<div>
    <h1>Запрос5</h1>
<h5>Получить сведения о конкретном свободном номере: в течение какого времени он будет пустовать и о его характеристиках. </h5>
    <div class="row">
        <div class="col-12 col-md-8">
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'id')->label('Номер комнаты')->dropDownList($id)?>
            <div class="form-group">
                <?= Html::submitButton('Получить', ['class' => 'btn btn-warning']) ?>
                <?= Html::a('Обновить форму', ['hotel/query5'], ['class' => 'btn btn-warning']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <? if($count == 0):
        Yii::$app->session->setFlash('error', 'Ничего не найдено');?>
    <? elseif($count > 1):?>
        <h4> Общее число свободных номеров: <?= $count ?></h4>
    <h3> Свободны следующие номера:</h3>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th> Номер комнаты </th>
            <th> Количество мест в комнате </th>
            <th> Класс отеля</th>
            <th> Этаж </th>
            <th> Цена за день</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($rooms as $room): ?>
            <tr>
                <td> <?= Html::encode("{$room->id}")?></td>
                <td> <?= Html::encode("{$room->numberOfBeds}")?></td>
                <td> <?= Html::encode("{$room->hotelBuildings->hotelClass}")?></td>
                <td> <?= Html::encode("{$room->floors->numberOfFloor}")?></td>
                <td> <?= Html::encode("{$room->paymentForDay}")?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <? elseif($count == 1):?>
    <h3> Свободны следующие номера:</h3>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th> Номер комнаты </th>
            <th> Количество мест в комнате </th>
            <th> Класс отеля</th>
            <th> Этаж </th>
            <th> Цена за день</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($rooms as $room): ?>
            <tr>
                <td> <?= Html::encode("{$room->id}")?></td>
                <td> <?= Html::encode("{$room->numberOfBeds}")?></td>
                <td> <?= Html::encode("{$room->hotelBuildings->hotelClass}")?></td>
                <td> <?= Html::encode("{$room->floors->numberOfFloor}")?></td>
                <td> <?= Html::encode("{$room->paymentForDay}")?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<!--    --><?// endif;?>
    <? $cur_date = date('Y-m-d');
       $qwer = $rooms[0]->booking[0]->startOfBooking;
//    $qwer =  date_diff($qwer, '2021-03-03');
    $qwer = date('d', strtotime($qwer)) - date('d', strtotime($cur_date));
       if (isset($rooms[0]->booking[0]->startOfBooking))
       {?>
            <h4> Этот номер будет пустовать <?= $qwer; ?> дней до <?= $rooms[0]->booking[0]->startOfBooking; ?> </h4>
       <?}
       else
       {?>
           <h4> Этот номер еще не забронировали </h4>
       <?}
    ?>
<!--    <h2> Этот номер будет пустовать --><?//= $qwer; ?><!-- дней (КАКАЯЖЕ ШЛЯПА Я УСТАЛ) до --><?//= $rooms[0]->booking[0]->startOfBooking; ?><!-- </h2>-->
    <? endif;?>
</div>
