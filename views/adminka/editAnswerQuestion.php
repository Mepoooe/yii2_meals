<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<h1>hello</h1>
<?php $form = ActiveForm::begin([
	        'id' => 'filter-form',
	        'options' => ['class' => 'form-group'],
	    	]); ?>

	        <?= $form->field($model, 'title')->textInput(['autofocus' => true, 'value' => $answerQuestion->title]) ?>
	        <?= $form->field($model, 'category')->dropDownList([
	        	'Жаркое' => 'Жаркое',
	        	'Супы' => 'Супы',
	        	'Десерты' => 'Десерты',

	        ], [
	        'prompt' => $answerQuestion->category
	        ]) ?>
	        <?= $form->field($model, 'body')->textArea(['rows' => '6', 'value' => $answerQuestion->body]) ?>

	        <input type="hidden" value="<?=Yii::$app->request->getCsrfToken()?>" />

	        <div class="form-group">
	            <div class="col-lg-offset-1 col-lg-11">
	                <?= Html::submitButton('Редактировать', ['class' => 'btn btn-primary btn-lg', 'name' => 'login-button']) ?>
	            </div>
	        </div>
<?php ActiveForm::end(); ?>