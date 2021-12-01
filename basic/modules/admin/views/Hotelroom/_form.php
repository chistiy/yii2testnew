<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Hotelroom */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hotelroom-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'numberOfBeds')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hotelBuilding')->textInput() ?>

    <?= $form->field($model, 'floor')->textInput() ?>

    <?= $form->field($model, 'paymentForDay')->textInput() ?>

    <?= $form->field($model, 'expensesForDay')->textInput() ?>

    <?= $form->field($model, 'isNotFree')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
