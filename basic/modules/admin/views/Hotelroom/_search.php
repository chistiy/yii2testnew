<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Hotelroomsearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hotelroom-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'numberOfBeds') ?>

    <?= $form->field($model, 'hotelBuilding') ?>

    <?= $form->field($model, 'floor') ?>

    <?= $form->field($model, 'paymentForDay') ?>

    <?php // echo $form->field($model, 'expensesForDay') ?>

    <?php // echo $form->field($model, 'isNotFree') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
