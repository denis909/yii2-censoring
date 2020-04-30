<?php

use yii\helpers\Html;
use backend\widgets\ActiveForm;

$form = ActiveForm::begin([
	'submitButtonLabel' => $model->isNewRecord ? 'Добавить' : 'Редактировать'
]);

echo Html::tag('p', Yii::t('censoring', 'Add word info', ['%s' => 'настройках']));

echo $form->field($model, 'search_for')->textInput(['maxlength' => true]);

echo $form->field($model, 'replace_with')->textInput(['maxlength' => true]);

echo $form->field($model, 'mode')->dropDownList($this->modeList, ['prompt' => '...']);

ActiveForm::end();