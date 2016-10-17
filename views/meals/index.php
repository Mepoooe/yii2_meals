<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

//$this->registerJsFile('@web/js/script.js', ['depends' => 'yii\web\YiiAsset']); //с помощью depends объявляем зависимости файла, для правильной хронологии подключения 
?> 
<h1>Список блюд	</h1>

	<?php $this->beginBlock('filterMeals'); ?>
	    <?php $form = ActiveForm::begin([
	        'id' => 'filter-form',
	        'options' => ['class' => 'form-horizontal'],
	    	]); ?>

	        <?= $form->field($model, 'nameMeal')->textInput(['autofocus' => true]) ?>
	        <?= $form->field($model, 'category')->dropDownList([
	        	'Жаркое' => 'Жаркое',
	        	'Супы' => 'Супы',
	        	'Десерты' => 'Десерты',

	        ], [
	        'prompt' => 'Выберите один или несколько вариантов'
	        ]) ?>
	        <?= $form->field($model, 'timeAdd')
		    ->radioList([
		        'new' => 'Новые',
		        'old' => 'Старые',
		    ]); ?>

	        <input type="hidden" value="<?=Yii::$app->request->getCsrfToken()?>" />

	        <div class="form-group">
	            <div class="col-lg-offset-1 col-lg-11">
	                <?= Html::submitButton('Filter', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
	            </div>
	        </div>
    	<?php ActiveForm::end(); ?>
    <?php $this->endBlock(); ?>
	</div>
	<div id='notUser' style="display: none">
		<p class="text-danger">Зарегистрируйтесь чтобы добавить обед</p>
	</div>
	<div id='mealAdds' style="display: none">
		<p class="text-success">Блюдо успешно добавлено в ваше меню</p>
	</div>
	<div id='mealExist' style="display: none">
		<p class="text-warning">Блюдо уже добавлено в ваше меню</p>
	</div>
	<div class="col-md-9">
<?
foreach ($posts as $post) {

?>
			<div class="col-6 col-sm-6 col-lg-6 ">
			   <img src="/upload/store/<?= $post->image ?>" width="300" height="200" alt='<?= $post->title?>'>
              <h2><a href="<? echo yii\helpers\Url::to(['meals/meal', 'id' => $post->id]); ?>"> <?=$post->title ?></a></h2>
              <p>Дата добавления: <?=$post->publish_date ?></p>
              <p><a href="<? echo yii\helpers\Url::to(['meals/search', 'category' => $post->category]); ?>"> <?=$post->category ?></a> </p>
              <p>
              	<?=$post->body ?>
              </p>

              <p>
              <a class="btn btn-primary" href="<? echo yii\helpers\Url::to(['meals/meal', 'id' => $post->id]); ?>" role="button">Подробнее</a>
              <button class="addMealBotton btn btn-success" id="<?= $id = $post->id; ?>">добавить обед</button>
              </p> 
           	</div>
<? } ?>
	
		
	</div>
<?echo \yii\widgets\LinkPager::widget(['pagination' => $pages]);?>
<?php
$idUser = Yii::$app->user->id;
if ($idUser === null) {
	$idUser = 'false';
}
$mealAdd = <<<JS
	var idMeals;

    $('.addMealBotton').on('click', function(event){
        t=event.target||event.srcElement; 
        idMeals = t.id;

	 	$.ajax({
			url: 'add-meals',
			data: {idMeal:idMeals, idUser:$idUser},// idUser:$idUser},
			type: 'GET',
			success: function(res){
				switch (res) {
				  case 'notUser':
				    $("#notUser").show(300);
					setTimeout('$("#notUser").hide(300);', 4000)
						break;
				   case 'mealAdd':
					$("#mealAdds").show(300);;
					setTimeout('$("#mealAdds").hide(300);', 4000)
				  
				     	break;
				  case 'mealExist':
				    $("#mealExist").show(300);;
					setTimeout('$("#mealExist").hide(300);', 4000)
				    	break;
				  default:
				    console.log( 'Я таких значений не знаю' );
				}

				console.log(res);
			},
			error: function(){
				console.log('Ошибка при добавлении meal');
			}
	 	});
	 });
JS;
$this->registerJs($mealAdd);
?>