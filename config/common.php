<?php

return [
    'components' => [
        'censoring' => [
            'class' => 'denis909\censoring\components\CensoringComponent'
        ],
        'i18n' => [
            'translations' => [
                'censoring' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@denis909/censoring/messages'
                ]
            ]
        ]
    ]
];