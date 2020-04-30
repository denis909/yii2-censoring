<?php

namespace denis909\censoring\backend\models;

use yii\helpers\ArrayHelper;

class Censoring extends \denis909\censoring\models\Censoring
{

	public function rules()
	{
		return ArrayHelper::merge(parent::rules(), [
			[['search_for'], 'required']
		]);
	}

}