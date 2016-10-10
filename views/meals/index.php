<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?> 
<h1>Список блюд	</h1>

	<?php $this->beginBlock('filterMeals'); ?>
	    <?php $form = ActiveForm::begin([
	        'id' => 'filter-form',
	        'options' => ['class' => 'form-horizontal'],
	    	]); ?>

	        <?= $form->field($model, 'nameMeal')->textInput(['autofocus' => true]) ?>
	        <?= $form->field($model, 'category')->dropDownList([
	        	'firstMeals' => 'первые блюда',
	        	'secondMeals' => 'вторые блюда',
	        	'прочее' => 'прочие блюда',

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
	<div class="col-md-9">
<?
foreach ($posts as $post) {
?>
			<div class="col-6 col-sm-6 col-lg-4">
              <h2><a href="<? echo yii\helpers\Url::to(['meals/meal', 'id' => $post->id]); ?>"> <?=$post->title ?></a></h2>
              <p>Дата добавления: <?=$post->publish_date ?></p>
              <p><a href="<? echo yii\helpers\Url::to(['meals/search', 'category' => $post->category]); ?>"> <?=$post->category ?></a> </p>
              <p>
              	<?=$post->body ?>
              </p>

              <p><a class="btn btn-default" href="<? echo yii\helpers\Url::to(['meals/add-meals', 'id' => $post->id, 'userId' => Yii::$app->user->id]); ?>" role="button">Добавить в меню заказов</a></p>
           	</div>
<? } ?>
	
		
	</div>


<?echo \yii\widgets\LinkPager::widget(['pagination' => $pages]);?>
