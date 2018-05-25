<?php

namespace frontend\controllers;

use Yii;
use common\helpers\CensoringHelper;
use yii\web\Response;

class CensoringController extends \yii\web\Controller
{

	public $defaultAction = 'get';

	public function actionGet($text)
	{
		$text = CensoringHelper::censor_words($text);

		$response = Yii::$app->getResponse();
		$response->headers->set('Content-Type', 'text/plain');
		$response->format = Response::FORMAT_RAW;

		return $text;
	}

}