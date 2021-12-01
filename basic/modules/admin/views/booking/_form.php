<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use app\modules\admin\models\Clients;
use app\modules\admin\models\organizations;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\booking */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="booking-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'startOfBooking')->textInput() ?>

    <?= $form->field($model, 'endOfBooking')->textInput() ?>

    <?= $form->field($model, 'client')->dropDownList(ArrayHelper::map(Clients::find()->asArray()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'organization')->dropDownList(ArrayHelper::map(organizations::find()->asArray()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'countOfPeople')->textInput() ?>

    <?= $form->field($model, 'totalSum')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
