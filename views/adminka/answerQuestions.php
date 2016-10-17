<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<h1>Hello in the F.A.Q</h1>

	<div class="col-md-10">
		<a data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-primary btn-lg btn-block" >Добавить новый вопрос</a>
		<table class="table table-condensed">
		<th>Вопрос</th>
		<th>Категория вопроса</th>
<?php
foreach ($answerQuestions as $answerQuestion) {
	//printGreat($answerQuestions);
?>
	    	
	    	<tr>
	    		<td>
	        		<a href="<? echo yii\helpers\Url::to(['adminka/answer-question', 'id' => $answerQuestion->id]); ?>"> <?=$answerQuestion->title ?></a> 
	        	
		        </td>
		        <td colspan="50">
	        		 <?=$answerQuestion->category ?> 
	        	
		        </td>
		        <td>
			        	<a class="btn btn-warning" href="<? echo yii\helpers\Url::to(['adminka/edit-answer-question', 'id' => $answerQuestion->id]); ?>"> Редактировать</a> 

			        	<a class="btn btn-danger" href="<? echo yii\helpers\Url::to(['adminka/del-answer-question', 'id' => $answerQuestion->id]); ?>"> Удалить </a> 
			        
		        </td>
	        </tr>	    
<?php } ?>
       </table>
	</div>

	
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="formAdminkaAddMeals">
      <?php $form = ActiveForm::begin([
	        'id' => 'filter-form',
	        'options' => ['class' => 'form-group'],
	    	]); ?>

	        <?= $form->field($model, 'title')->textInput(['autofocus' => true]) ?>
	        <?= $form->field($model, 'category')->dropDownList([
	        	'Жаркое' => 'Жаркое',
	        	'Супы' => 'Супы',
	        	'Десерты' => 'Десерты',

	        ], [
	        'prompt' => 'Выберите один или несколько вариантов'
	        ]) ?>
	        <?= $form->field($model, 'body')->textArea(['rows' => '6']) ?>

	        <input type="hidden" value="<?=Yii::$app->request->getCsrfToken()?>" />

	        <div class="form-group">
	            <div class="col-lg-offset-1 col-lg-11">
	                <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary btn-lg', 'name' => 'login-button']) ?>
	            </div>
	        </div>
    	<?php ActiveForm::end(); ?>
    	</div>
    </div>
  </div>
</div>