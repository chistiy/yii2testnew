<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Clientbookingroom */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clientbookingroom-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'booking')->textInput() ?>

    <?= $form->field($model, 'room')->textInput() ?>

    <?= $form->field($model, 'client')->textInput() ?>

    <?= $form->field($model, 'organization')->textInput() ?>

    <?= $form->field($model, 'isBookedNow')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
