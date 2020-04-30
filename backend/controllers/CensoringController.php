<?php

namespace denis909\censoring\backend\controllers;

class CensoringController extends \backend\components\BackendCrudController
{

    public $modelClass = 'common\models\Censoring';

    public $searchModelClass = 'common\models\CensoringSearch';

    public $formModelClass = 'common\forms\CensoringBackend';

    public function getViewPath()
    {
        return '@modules/censoring/views/backend/censoring';
    }

}