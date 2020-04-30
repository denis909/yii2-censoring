<?php

return [
     'modules' => [
        'censoring' => [
            'class' => 'yii\base\Module',
            'controllerNamespace' => 'denis909\censoring\backend\controllers',
            'viewPath' => '@denis909/censoring/backend/views',
            'defaultRoute' => 'censoring'
        ]
    ],
    'params' => [
        'backendMenu' => [
            'censoring' => [
                'label' => ['censoring', 'Censoring'],
                'url' => ['/censoring'],
                'icon' => 'fa fa-fw fa-pencil-alt'
            ]
        ]
    ]
];