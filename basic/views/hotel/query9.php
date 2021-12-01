<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Nav;
//var_dump($clients);
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
<h1>Запрос9</h1>
<h5> Получить данные о рентабельности номеров с определенными характеристиками: соотношение об объеме продаж номеров к накладным расходам за указанный период. </h5>
<div class="row">
<div class="col-12 col-md-8">
<?php $form = ActiveForm::begin(['id' => 'filter-form']); ?>
<?= $form->field($model, 'hotelClass')->label('Класс отеля')->dropDownList($hotelClass)?>
<?= $form->field($model, 'numberOfBeds')->label('Местность номера')->dropdownlist([
  '' => 'Не выбрано',
  '1' => '1',
  '2' => '2',
  '3' => '3',
  '4' => '4'
  ])?>
  <div class="form-group">
  <?= Html::submitButton('Получить', ['class' => 'btn btn-warning']) ?>
  <?= Html::a('Обновить форму', ['hotel/query9'], ['class' => 'btn btn-warning']) ?>
  </div>
  <?php ActiveForm::end(); ?>
  </div>
  </div>
  <? if($count == 0):
    Yii::$app->session->setFlash('error', 'Ничего не найдено');
    elseif ($model->hotelClass == 'Не выбрано' || $model->numberOfBeds == ''  && $model->load(Yii::$app->request->post()) && $model->validate()):
      {
        Yii::$app->session->setFlash('error', 'Пожалуйста, выберите интересующие вас характеристики');
      }
      elseif ($model->load(Yii::$app->request->post()) && $model->validate()): ?>
      <table class="table table-striped table-bordered">
      <thead>
      <tr>
      <th> id</th>
      <th> Класс отеля</th>
      <th> Местность номера</th>
      <th> Доход</th>
      <th> Затраты</th>
      </tr>
      </thead>
      <tbody>

      <?php foreach ($rooms as $room): ?>
      <tr>
      <!--                    <td> --><?//= Html::encode("{$client->hotelrooms[0]['id']}")?><!--</td>-->
      <!--                    <td> --><?//= Html::encode("{$client->hotelrooms[0]->hotelBuildings['hotelClass']}")?><!--</td>-->
      <!--                    <td> --><?//= Html::encode("{$client->hotelrooms[1]['numberOfBeds']}")?><!--</td>-->
      <!--                    --><?// $expenses =(date('d', strtotime($client['endOfBooking'])) - date('d', strtotime($client['startOfBooking']))) * $client->hotelrooms[0]['expensesForDay'];
      ////                    var_dump($expenses);
      //                    $input = (date('d', strtotime($client['endOfBooking'])) - date('d', strtotime($client['startOfBooking']))) * $client->hotelrooms[0]['paymentForDay'];
      ////                    var_dump($input);
      //
      //                    $totalEx = $totalEx + $expenses;
      //                    $totalIn = $totalIn + $input?>
      <!--                    <td> --><?//= Html::encode("{$input}")?><!--</td>-->
      <!--                    <td> --><?//= Html::encode("{$expenses}")?><!--</td>-->

      <?php foreach ($room['booking'] as $r): ?>
      <td> <?= Html::encode("{$room->id}")?></td>
      <td> <?= Html::encode("{$room->hotelBuildings['hotelClass']}")?></td>
      <td> <?= Html::encode("{$room->numberOfBeds}")?></td>

      <? $expenses =(date('d', strtotime($r['endOfBooking'])) - date('d', strtotime($r['startOfBooking'])) +1) * $room->expensesForDay  ;
      //                    var_dump($expenses);
      $input =(date('d', strtotime($r['endOfBooking'])) - date('d', strtotime($r['startOfBooking'])) +1) * $room->paymentForDay  ;

      //                    var_dump($input);

      $totalEx = $totalEx + $expenses;
      $totalIn = $totalIn + $input?>
      <td> <?= Html::encode("{$input}")?></td>
      <td> <?= Html::encode("{$expenses}")?></td>
      </tr>
      <?php endforeach; ?>
      <?php endforeach; ?>
      </tbody>
      </table>
      Доход за номера с характеристиками (Класс Отеля -<?= $model->hotelClass ?> , Местность номера - <?=$model->numberOfBeds?>) =  <?= $totalIn ?>
      <br>
      Затраты за номера с характеристиками (Класс Отеля -<?= $model->hotelClass ?> , Местность номера - <?=$model->numberOfBeds?>) =  <?= $totalEx ?>
      <br>
      Рентабельность номеров = <?= (($totalIn - $totalEx)/$totalIn)*100 ?>%
      <!--        --><?//$days =  date('d', strtotime($client['endOfBooking'])) - date('d', strtotime($client['startOfBooking']));
      //        var_dump($days); ?>
      <? endif;?>
      </div>
