<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
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
<div>
    <h1>Запрос14</h1>
<h5>Получить сведения о конкретном человеке, сколько раз он посещал гостиницу, в каких номерах и в какой период останавливался, какие счета оплачивал. </h5>
    <div class="row">
        <div class="col-12 col-md-8">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'name')->label('Клиент')->dropDownList($name)?>

            <div class="form-group">
                <?= Html::submitButton('Получить', ['class' => 'btn btn-warning']) ?>
                <?= Html::a('Обновить форму', ['hotel/query11'], ['class' => 'btn btn-warning']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <? if($count == 0):
        Yii::$app->session->setFlash('error', 'Ничего не найдено');
    elseif ($model->load(Yii::$app->request->post()) && $model->validate()): ?>
        <h4> Количество посещений клиента: <?= $count ?></h4>

        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th> Клиент </th>
                <th> Номер телефона </th>
                <th> Номер комнаты </th>
                <th> Дата начала бронирования </th>
                <th> Дата конца бронирования </th>
                <th> Доп услуги </th>
                <th> Счет </th>

            </tr>
            </thead>
            <tbody>
            <? while ($count != 0)
                {
                    $id = $count - 1;
//                                     var_dump($id);
                    foreach ($clients as $client): ?>
                     <tr>
<!--                         --><?php //foreach ($client['hotelrooms'] as $room): ?>
<!--                         --><?php //foreach ($client['booking'] as $booking): ?>

                         <td> <?= Html::encode("{$client->name}")?></td>
                         <td> <?= Html::encode("{$client->numberOfPhone}")?></td>
                         <td> <?= Html::encode("{$client['hotelrooms'][$id]['id']}")?></td>
                         <td> <?= Html::encode("{$client['booking'][$id]['startOfBooking']}")?></td>
                         <td> <?= Html::encode("{$client['booking'][$id]['startOfBooking']}")?></td>
                         <td> <?= Html::encode("{$client->services[0]['name']}")?></td>
                         <td> <?= Html::encode("{$client->paymentforservices[0]['cost']}")?></td>
                     </tr>
<!--                 --><?php //endforeach; ?>
<!--                 --><?php //endforeach; ?>
                 <?php endforeach;
                 $count = $count - 1;
                }?>

            </tbody>
        </table>
    <? endif;?>
</div>
