<?php

namespace common\forms;

use Yii;
use yii\helpers\Html;

class CensoringBase extends \common\models\Censoring
{

	public function rules()
	{
		return [
			[['search_for', 'replace_with'], 'trim'],
			[['search_for', 'replace_with'], 'string', 'max' => 255],
			[['search_for'], 'unique'],
			[['search_for'], 'required'],
			[['mode'], 'in', 'range' => array_keys($this->modeItems)]
		];
	}

	public function render($form)
	{
		$model = $this;

		$return = Html::tag('p', Yii::t('censoring', 'Add word info', ['%s' => 'настройках']));

		$return .= $form->field($model, 'search_for')->textInput(['maxlength' => true]);

		$return .= $form->field($model, 'replace_with')->textInput(['maxlength' => true]);

		$return .= $form->field($model, 'mode')->dropDownList($this->modeItems);

		return $return;
	}

}