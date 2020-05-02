<?php

namespace denis909\censoring\backend\controllers;

use denis909\censoring\models\Censoring;
use denis909\censoring\models\CensoringSearch;
use denis909\censoring\backend\models\Censoring as CensoringForm;

class CensoringController extends \backend\components\BackendCrudController
{

    public $modelClass = Censoring::class;

    public $searchModelClass = CensoringSearch::class;

    public $formModelClass = CensoringForm::class;

    public function getViewPath()
    {
        return '@denis909/censoring/backend/views/censoring';
    }

}