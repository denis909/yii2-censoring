<?php

use yii\helpers\Html;

$theme = Yii::$app->backendTheme;

$form = $theme->beginActiveForm();

echo $form->field($model, 'search_for')->textInput(['maxlength' => true]);

echo $form->field($model, 'replace_with')->textInput(['maxlength' => true]);

echo $form->field($model, 'mode')->dropDownList($model->modeList, ['prompt' => '...']);

echo $form->submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'));

$theme->endActiveForm();