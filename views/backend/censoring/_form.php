<?php

use yii\helpers\Html;
use backend\widgets\ActiveForm;

$form = ActiveForm::begin([
	'submitButtonLabel' => $model->isNewRecord ? 'Добавить' : 'Редактировать'
]);

echo $model->render($form);

ActiveForm::end();