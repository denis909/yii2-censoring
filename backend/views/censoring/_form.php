<?php

$theme = Yii::$app->backendTheme;

$form = $theme->beginActiveForm();

echo $form->field($model, 'search_for')->textInput(['maxlength' => true]);

echo $form->field($model, 'replace_with')->textInput(['maxlength' => true]);

echo $form->field($model, 'mode')->dropDownList($model->modeList, ['prompt' => '...']);

?>
<div class="form-group">

<?php echo $theme->submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'));?>

<?php echo $theme->saveButton(Yii::t('backend', 'Save'));?>

</div>
<?php $theme->endActiveForm();?>