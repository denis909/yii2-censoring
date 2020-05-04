<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

require __DIR__ . '/_common.php';

$theme = Yii::$app->backendTheme;

$this->params['cardTitle'] = Yii::t('backend', 'Manage');

$this->params['breadcrumbs'][] = $this->params['cardTitle'];

$this->params['actionMenu'][] = ['label' => Yii::t('backend', 'Create'), 'url' => ['create']];

echo $theme->gridView([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        [
            'class' => $theme::PRIMARY_KEY_COLUMN,
            'attribute' => 'id'
        ],
        'search_for',
        [
            //'class' => 'backend\grid\DataColumn',
            'attribute' => 'replace_with',
            //'size' => 'lg'
        ],
        [
            //'class' => 'backend\grid\DataColumn',
            'attribute' => 'mode',
            'value' => function($model) {
                return $model->modeName;
            },
            'filter' => $searchModel->modeList,
            //'size' => 'sm'
        ],
        [
            'class' => $theme::ACTION_COLUMN,
            'template' => '{update}'
        ],
        [
            'class' => $theme::ACTION_COLUMN,
            'template' => '{delete}'
        ]
    ]
]);