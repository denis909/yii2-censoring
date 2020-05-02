<?php

return [
     'modules' => [
        'censoring' => [
            'class' => 'yii\base\Module',
            'controllerNamespace' => 'denis909\censoring\frontend\controllers',
            'viewPath' => '@denis909/censoring/frontend/views',
            'defaultRoute' => 'censoring'
        ]
    ]
];