<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

printGreat($meal->title);
switch ($meal->category) {
	case 'firstMeals':
		$meal->category = 'первые блюда';
		break;
	case 'secondMeals':
		$meal->category = 'вторые блюда';
		break;
	case 'another':
		$meal->category = 'прочие блюда';
		break;
	
	default:
		break;
}
?>

<h1>hello</h1>
<?php $form = ActiveForm::begin([
	        'id' => 'filter-form',
	        'options' => ['class' => 'form-group'],
	    	]); ?>

	        <?= $form->field($model, 'title')->textInput(['autofocus' => true, 'value' => $meal->title]) ?>
	        <?= $form->field($model, 'category')->dropDownList([
	        	'firstMeals' => 'первые блюда',
	        	'secondMeals' => 'вторые блюда',
	        	'another' => 'прочие блюда',

	        ], [
	        'prompt' => $meal->category
	        ]) ?>
	        <?= $form->field($model, 'body')->textArea(['rows' => '6', 'value' => $meal->body]) ?>

	        <input type="hidden" value="<?=Yii::$app->request->getCsrfToken()?>" />

	        <div class="form-group">
	            <div class="col-lg-offset-1 col-lg-11">
	                <?= Html::submitButton('Редактировать', ['class' => 'btn btn-primary btn-lg', 'name' => 'login-button']) ?>
	            </div>
	        </div>
<?php ActiveForm::end(); ?>