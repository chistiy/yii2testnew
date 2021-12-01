<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Hotelbuilding */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hotelbuilding-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'hotelClass')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'numberOfFloors')->textInput() ?>

    <?= $form->field($model, 'numberOfRooms')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
