<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

require __DIR__ . '/_common.php';

$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактировать';
?>

<div class="backend-form-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>