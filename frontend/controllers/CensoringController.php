<?php

namespace denis909\censoring\frontend\controllers;

use Yii;
use common\helpers\CensoringHelper;
use yii\web\Response;

class CensoringController extends \yii\web\Controller
{

    public function actionIndex($text)
    {
        $content = Yii::$app->censoring->censorWords($text);

        $response = Yii::$app->getResponse();
        
        $response->headers->set('Content-Type', 'text/plain');
        
        $response->format = Response::FORMAT_RAW;

        return $content;
    }

}