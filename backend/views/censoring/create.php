<?php

use yii\helpers\Html;

require __DIR__ . '/_common.php';

$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Добавить';
?>

<div class="backend-form-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>