<?php

return [
	'components' => [
		'i18n' => [
			'translations' => [
				'censoring' => [
					'class' => yii\i18n\PhpMessageSource::className(),
					'basePath' => '@modules/censoring/messages'
				]
			]
		],
		'cascadeFilesystem' => [
			'aliases' => [
				'@modules/censoring/controllers' => '@frontend/controllers',
				'@modules/censoring/controllers/backend' => '@backend/controllers',
				'@modules/censoring/models' => '@common/models',
				'@modules/censoring/forms' => '@common/forms',
				'@modules/censoring/helpers' => '@common/helpers'
			]
		]
	]
];