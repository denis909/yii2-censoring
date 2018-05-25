<?php

use yii\helpers\Html;
use backend\widgets\ActiveForm;
use backend\widgets\FormCard;

Yii::$app->controller->layout = 'main-page';

$form = ActiveForm::begin();

$form->submitButtonLabel = $model->isNewRecord ? 'Добавить' : 'Редактировать';

echo FormCard::widget([
	'title' => $this->title,
	'body' => $model->render($form),
	'footer' => $form->renderButtons()
]);

ActiveForm::end();

?>

<?/*

<div class="backend-censoring-form">

    <p><?= ;?></p>


    <?= ;?>

	<?= ;?>

    <div class="form-group">

        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);?>
    
    </div>

</div>

<?php

$this->params['footer'] = $form->submitButton($model->isNewRecord ? 'Добавить' : 'Редактировать');

?>

*/?>