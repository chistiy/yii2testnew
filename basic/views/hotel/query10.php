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
    <h1>Запрос10</h1>
<h5>Получить сведения о постояльце из заданного номера: его счет гостинице за дополнительные услуги, поступавшие от него жалобы, виды дополнительных услуг, которыми он пользовался. </h5>
    <div class="row">
        <div class="col-12 col-md-8">
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'id')->label('Номер комнаты')->dropDownList($id)?>
            <div class="form-group">
                <?= Html::submitButton('Получить', ['class' => 'btn btn-warning']) ?>
                <?= Html::a('Обновить форму', ['hotel/query10'], ['class' => 'btn btn-warning']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <? if($model->id == 'Не выбрано' && $model->load(Yii::$app->request->post()) && $count == 0):
        Yii::$app->session->setFlash('error', 'Ничего не найдено. Выберите номер.');
     elseif ($model->load(Yii::$app->request->post()) && $model->validate()):?>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th> Клиент </th>
               <th>Id</th>
                <th> Счет за доп услуги </th>
                <th> Жалобы </th>
                <th> Виды доп услуг </th>
            </tr>
            </thead>
            <tbody>

            <?php foreach ($clients as $client): ?>
                <tr>
                    <td> <?= Html::encode("{$client->name}")?></td>
                    <td> <?= Html::encode("{$client->hotelrooms[1]['id']}")?></td>
                    <td> <?= Html::encode("{$client->paymentforservices[0]['cost']}")?></td>
                    <td> <?= Html::encode("{$client->feedback[0]['textOfComplaint']}")?></td>
                    <td> <?= Html::encode("{$client->services[0]['name']}")?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <? endif;?>
</div>
