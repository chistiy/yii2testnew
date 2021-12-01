<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Clientbookingroom */

$this->title = 'Create Clientbookingroom';
$this->params['breadcrumbs'][] = ['label' => 'Clientbookingrooms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clientbookingroom-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
