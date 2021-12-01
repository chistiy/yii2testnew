<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\paymentforservices */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="paymentforservices-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'client')->textInput() ?>

    <?= $form->field($model, 'service')->textInput() ?>

    <?= $form->field($model, 'cost')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
