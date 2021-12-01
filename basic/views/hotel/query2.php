<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Nav;
//var_dump($clients);
?>
<?//= Html::activeDropDownList($organizations, 's_id',$items) ?>
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
    <h1>Запрос2</h1>
<h5>Получить перечень и общее число постояльцев, заселявшихся в номера с указанными характеристиками за некоторый период. </h5>
    <div class="row">
        <div class="col-12 col-md-8">
            <?php $form = ActiveForm::begin(['id' => 'filter-form']); ?>
            <?= $form->field($model, 'hotelClass')->label('Класс отеля')->dropDownList($hotelClass)?>
            <!--            --><?//= $form->field($model, 'hotelClass')->label('Класс отеля')->dropdownlist([
//                    '' => 'Любой',
//                    'Трёхзвёздочный' => 'Трёхзвёздочный',
//                    'Четырёхзвездочный' => 'Четырёхзвездочный',
//                    'Пятизвёздочный' => 'Пятизвёздочный']
//            )?>
            <?= $form->field($model, 'numberOfBeds')->label('Местность номера')->dropdownlist([
                    '' => 'Не выбрано',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4'
             ])?>
            <?= $form->field($model, 'paymentForDay')->textInput()->label('Цена за день')?>
            <?= $form->field($model, 'dateStart')->input('date')->label('Выберите начало периода')?>
            <?= $form->field($model, 'dateEnd')->input('date')->label('Выберите конец периода')?>
            <div class="form-group">
                <?= Html::submitButton('Получить', ['class' => 'btn btn-warning']) ?>
                <?= Html::a('Обновить форму', ['hotel/query2'], ['class' => 'btn btn-warning']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <? if($count == 0):
        Yii::$app->session->setFlash('error', 'Ничего не найдено');
    elseif ($model->load(Yii::$app->request->post()) && $model->validate()): ?>
        <h4> Общее число Клиентов: <?= $count ?></h4>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
<!--                <th> Номер комнаты </th>-->
                <th> Клиент </th>
                <th> Класс отеля</th>
                <th> Местность номера</th>
                <th> Цена за ночь</th>
                <th> Начало бронирования </th>
                <th> Конец бронирования </th>
            </tr>
            </thead>
            <tbody>

            <?php foreach ($clients as $client): ?>
                <tr>
<!--                    <td> --><?//= Html::encode("{$tb->org_dtp_street['Street']}")?><!--</td>-->
<!--                    <td> --><?//= Html::encode("{$client->hotelrooms['id']}")?><!--</td>-->

                    <td> <?= Html::encode("{$client->clients['name']}")?></td>
                    <td> <?= Html::encode("{$client->hotelrooms[0]->hotelBuildings['hotelClass']}")?></td>
                    <td> <?= Html::encode("{$client->hotelrooms[0]['numberOfBeds']}")?></td>
                    <td> <?= Html::encode("{$client->hotelrooms[0]['paymentForDay']}")?></td>
                    <td> <?= Html::encode("{$client->startOfBooking}")?></td>
                    <td> <?= Html::encode("{$client->endOfBooking}")?></td>

<!--                    <td> --><?//= Html::encode("{$client->name}")?><!--</td>-->
<!--                    <td> --><?//= Html::encode("{$client->hotelrooms[0]['hotelBuilding']}")?><!--</td>-->
<!--                    <td> --><?//= Html::encode("{$client->hotelrooms[0]['numberOfBeds']}")?><!--</td>-->
<!--                    <td> --><?//= Html::encode("{$client->hotelrooms[0]['paymentForDay']}")?><!--</td>-->
<!--                    <td> --><?//= Html::encode("{$client->booking[0]['startOfBooking']}")?><!--</td>-->
<!--                    <td> --><?//= Html::encode("{$client->booking[0]['endOfBooking']}")?><!--</td>-->

<!--                    <td> --><?//= Html::encode("{$client->clients[0]['name']}")?><!--</td>-->
<!--                    <td> --><?//= Html::encode("{$client->hotelBuilding}")?><!--</td>-->
<!--                    <td> --><?//= Html::encode("{$client->numberOfBeds}")?><!--</td>-->
<!--                    <td> --><?//= Html::encode("{$client->paymentForDay}")?><!--</td>-->
<!--                    <td> --><?//= Html::encode("{$client->booking[0]['startOfBooking']}")?><!--</td>-->
<!--                    <td> --><?//= Html::encode("{$client->booking[0]['endOfBooking']}")?><!--</td>-->
                </tr>
            <?php endforeach; ?>
            </tbody>

        </table>
    <? endif;?>
</div>
