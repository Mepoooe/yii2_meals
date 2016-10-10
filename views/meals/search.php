<h1>Поиски</h1>
	<h2 class="text-success">Было найденно <?= count($findMealsByName)?> блюда:</h2>
<?php
//printGreat($findMealsByName);
foreach ($findMealsByName as $post) {
?>
			<div class="col-6 col-sm-6 col-lg-4">
              <h2><a href="<? echo yii\helpers\Url::to(['meals/meal', 'id' => $post["id"]]); ?>"> <?=$post['title'] ?></a></h2>
              <p>Дата добавления: <?=$post['publish_date'] ?></p>
              <p><a href="<? echo yii\helpers\Url::to(['meals/search', 'category' => $post["category"]]); ?>"> <?=$post->category ?></a> </p>
              <p>
              	<?=$post['body'] ?>
              </p>

              <p><a class="btn btn-default" href="<? echo yii\helpers\Url::to(['meals/add-meals', 'id' => $post["id"], 'userId' => Yii::$app->user->id]); ?>" role="button">Добавить в меню заказов</a></p>
           	</div>
<? } ?>
