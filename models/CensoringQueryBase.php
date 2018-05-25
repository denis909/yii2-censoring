<?php

namespace common\models;

class CensoringQueryBase extends \yii\db\ActiveQuery
{

	public function createdDate($date)
	{
		$time = strtotime($date /*. ' 00:00:00'*/);

		return $this->andWhere('YEAR(created)=:year AND MONTH(created)=:month AND DAY(created)=:day', [
			':year' => date('Y', $time),
			':month' => date('m', $time),
			':day' => date('d', $time)
		]);
	}

}