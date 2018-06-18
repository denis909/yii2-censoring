<?php

namespace backend\controllers;

class CensoringController extends \backend\CrudController
{

	public $modelClass = 'common\models\Censoring';

	public $searchModelClass = 'common\models\CensoringSearch';

	public $formModelClass = 'common\forms\CensoringBackend';

	public function getViewPath()
	{
		return '@modules/censoring/views/backend/censoring';
	}

}