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
    <h1>Запрос15</h1>
<h5>Получить сведения о конкретном номере: кем он был занят в определенный период. </h5>
    <div class="row">
        <div class="col-12 col-md-8">
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'id')->label('Номер комнаты')->dropDownList($id)?>
            <?= $form->field($model, 'dateStart')->input('date')->label('Выберите начало периода')?>
            <?= $form->field($model, 'dateEnd')->input('date')->label('Выберите конец периода')?>
            <div class="form-group">
                <?= Html::submitButton('Получить', ['class' => 'btn btn-warning']) ?>
                <?= Html::a('Обновить форму', ['hotel/query15'], ['class' => 'btn btn-warning']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <? if($count == 0):
        Yii::$app->session->setFlash('error', 'Ничего не найдено');?>
    <? elseif ($model->load(Yii::$app->request->post()) && $model->validate()):?>
    <h3>По клиентам</h3>
        <h4> Количество клиентов: <?= $countCl ?></h4>
    <? if ($countCl == 0):?>
        <h4> Организации не найдены</h4>
    <? else: ?>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th> Номер комнаты </th>
                <th> Количество мест в комнате </th>
                <th> Класс отеля</th>
                <th> Этаж </th>
                <th> Цена за день</th>
                <th> В этот период был занят</th>
            </tr>
            </thead>
            <tbody>  <? while ($countCl != 0)
            {
            $id = $countCl - 1;
            foreach ($rooms as $room): ?>
                <tr>
<!--                    --><?php //foreach ($room->clients as $client): ?>
                    <td> <?= Html::encode("{$room->id}")?></td>
                    <td> <?= Html::encode("{$room->numberOfBeds}")?></td>
                    <td> <?= Html::encode("{$room->hotelBuildings->hotelClass}")?></td>
                    <td> <?= Html::encode("{$room->floors->numberOfFloor}")?></td>
                    <td> <?= Html::encode("{$room->paymentForDay}")?></td>
                    <td> <?= Html::encode("{$room->clients[$id]['name']}")?></td>
                </tr>
<!--            --><?php //endforeach; ?>
            </tbody>
            <?php endforeach;
            $countCl = $countCl - 1;
            }?>

        </table>
        <? endif;?>

        <h4> Количество организаций: <?= $countOrg ?></h4>
        <? if ($countOrg == 0):?>
        <h4> Организации не найдены</h4>
        <? else: ?>
        <h3>По Организациям</h3>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th> Номер комнаты </th>
                <th> Количество мест в комнате </th>
                <th> Класс отеля</th>
                <th> Этаж </th>
                <th> Цена за день</th>
                <th> В этот период был занят</th>
            </tr>
            </thead>
            <tbody>
            <? while ($countOrg != 0)
             {
                 $id = $countOrg - 1;
             foreach ($rooms as $room): ?>
            <tr>
<!--                --><?php //foreach ($room->organizations as $organization): ?>
                <td> <?= Html::encode("{$room->id}")?></td>
                <td> <?= Html::encode("{$room->numberOfBeds}")?></td>
                <td> <?= Html::encode("{$room->hotelBuildings->hotelClass}")?></td>
                <td> <?= Html::encode("{$room->floors->numberOfFloor}")?></td>
                <td> <?= Html::encode("{$room->paymentForDay}")?></td>
                <td> <?= Html::encode("{$room->organizations[$id]['name']}")?></td>
            </tr>
<!--            --><?php //endforeach; ?>
            </tbody>
            <?php endforeach;
            $countOrg = $countOrg - 1;
            }?>
        </table>
    <? endif;?>
    <? endif;?>

</div>
