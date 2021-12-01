<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Clientbookingroomsearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clientbookingroom-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'booking') ?>

    <?= $form->field($model, 'room') ?>

    <?= $form->field($model, 'client') ?>

    <?= $form->field($model, 'organization') ?>

    <?php // echo $form->field($model, 'isBookedNow') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
