<?php

use yii\helpers\Html;
use backend\widgets\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

require __DIR__ . '/_common.php';

$this->params['breadcrumbs'][] = $this->title;

$this->params['actionMenu'][] = ['label' => 'Добавить', 'url' => ['create']];

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        array(
        	'class' => 'backend\widgets\PrimaryKeyColumn',
        	'attribute' => 'id'
    	),
        'search_for',
        array(
            'class' => 'backend\grid\DataColumn',
        	'attribute' => 'replace_with',
            'size' => 'lg'
    	),
    	array(
            'class' => 'backend\grid\DataColumn',
    		'attribute' => 'length',
            'size' => 'md'
    	),
        array(
            'class' => 'backend\grid\DataColumn',
        	'attribute' => 'mode',
        	'value' => function($model) {
        		return $model->modeName;
        	},
        	'filter' => $searchModel->modeItems,
            'size' => 'sm'
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