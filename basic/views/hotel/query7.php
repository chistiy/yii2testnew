<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Nav;
//var_dump($count2);
//var_dump($organizations);?>
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
    <h1>Запрос7</h1>
<h5>Получить данные об объеме бронирования номеров данной фирмой за указанный период, и каким номерам отдавались предпочтения.  </h5>
    <div class="row">
        <div class="col-12 col-md-8">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'name')->label('Организация')->dropDownList($nameOrg)?>
            <?= $form->field($model, 'dateStart')->input('date')->label('Выберите начало периода')?>
            <?= $form->field($model, 'dateEnd')->input('date')->label('Выберите конец периода')?>
            <div class="form-group">
                <?= Html::submitButton('Получить', ['class' => 'btn btn-warning']) ?>
                <?= Html::a('Обновить форму', ['hotel/query7'], ['class' => 'btn btn-warning']) ?>

            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <? if($count == 0):
        Yii::$app->session->setFlash('error', 'Ничего не найдено');
    elseif ($model->name == 'Не выбрано'):
        Yii::$app->session->setFlash('error', 'Пожалуйста, выберите фирму');
    elseif ($model->load(Yii::$app->request->post()) && $model->validate()): ?>
        <h4> Общее число организаций: <?= $count ?></h4>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th> Номер комнаты </th>
                <th> Количество людей </th>
                <th> Начало бронирования </th>
                <th> Конец бронирования </th>
            </tr>
            </thead>
            <tbody>

            <?php foreach ($organizations as $organization): ?>
                <tr>
                    <?php foreach ($organization['hotelrooms'] as $org): ?>
                    <td> <?= Html::encode("{$org['id']}")?></td>
                    <td> <?= Html::encode("{$organization->countOfPeople}")?></td>
                    <td> <?= Html::encode("{$organization->startOfBooking}")?></td>
                    <td> <?= Html::encode("{$organization->endOfBooking}")?></td>
                </tr>
            <?php endforeach; ?>

            </tbody>
            <?php endforeach; ?>
        </table>
    <? $max = max($count2,$count3,$count4); ?>
        <h4>Больше всего фирма <?= $organization->organization->name ?> бронировала <?
            if ($max == $count2) echo $strForCount2;
            elseif($max == $count3)echo $strForCount3;
            else echo $strForCount4 ?>местные номера</h4>
    <? endif;?>
</div>
