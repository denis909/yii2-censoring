<?php

$this->title = Yii::t('censoring', 'Censoring');

Yii::$app->params['backendMenu']['censoring']['active'] = true;

$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['/censoring']];