<?php

use yii\helpers\Html;
use backend\widgets\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\CensoringSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

require __DIR__ . '/_common.php';

$this->params['breadcrumbs'][] = $this->title;

$this->params['actionMenu'][] = ['label' => 'Добавить', 'url' => ['create']];

//Yii::$app->controller->layout = 'main-page';

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        array(
        	'class' => 'backend\widgets\PrimaryKeyColumn',
        	'attribute' => 'id'
    	),
        //'created',
        'search_for',
        'replace_with',
        'length',
        array(
        	'attribute' => 'mode',
        	'value' => function($model) {
        		return $model->modeName;
        	},
        	'filter' => $searchModel->modeItems
        ),
        array(
            'class' => 'backend\widgets\ActionColumn',
            'template' => '{update}'
        ),
        array(
            'class' => 'backend\widgets\ActionColumn',
            'template' => '{delete}'
        )
    ]
]);

/*

echo GridCard::widget([
    'menu' => [
        'items' => isset($this->params['actionMenu']) ? $this->params['actionMenu'] : []
    ],
    'title' => $this->title,
    'body' => GridView::widget([
        'layout' => '{items}',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            array(
            	'class' => 'backend\widgets\PrimaryKeyColumn',
            	'attribute' => 'id'
        	),
            //'created',
            'search_for',
            'replace_with',
            'length',
            array(
            	'attribute' => 'mode',
            	'value' => function($model) {
            		return $model->modeName;
            	},
            	'filter' => $searchModel->modeItems
            ),
            array(
                'class' => 'backend\widgets\ActionColumn',
                'template' => '{update}'
            ),
            array(
                'class' => 'backend\widgets\ActionColumn',
                'template' => '{delete}'
            )
        ]
    ]),
    'footer' => GridView::widget([
        'dataProvider' => $dataProvider,
        'layout' => '{summary}{pager}'
    ])
]);

*/