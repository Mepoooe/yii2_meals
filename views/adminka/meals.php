<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<h1>hello meals</h1>

	<div class="col-md-10">
		<a data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-primary btn-lg btn-block" >Добавить новый обед</a>
		<table class="table table-condensed">

<?php
foreach ($meals as $meal) {
?>
	    	
	    	<tr>
	    		<td colspan="50">
	        		<a href="<? echo yii\helpers\Url::to(['meals/meal', 'id' => $meal->id]); ?>"> <?=$meal->title ?></a> 
	        	
		        </td>
		      
		        <td>
			        	<a class="btn btn-warning" href="<? echo yii\helpers\Url::to(['adminka/edit-meal', 'id' => $meal->id]); ?>"> Редактировать</a> 

			        	<a class="btn btn-danger" href="<? echo yii\helpers\Url::to(['adminka/del', 'id' => $meal->id]); ?>"> Удалить </a> 
			        
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