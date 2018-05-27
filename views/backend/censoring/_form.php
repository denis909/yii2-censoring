<?php

use yii\helpers\Html;
use backend\widgets\ActiveForm;

//Yii::$app->controller->layout = 'main-page';

$form = ActiveForm::begin([
	'submitButtonLabel' => $model->isNewRecord ? 'Добавить' : 'Редактировать'
]);

echo $model->render($form);

ActiveForm::end(); 

/*
$form = ActiveForm::begin();

$form->submitButtonLabel = ;

echo FormCard::widget([
	'title' => $this->title,
	'body' => $model->render($form),
	'footer' => $form->renderButtons()
]);

ActiveForm::end();

*/

?>