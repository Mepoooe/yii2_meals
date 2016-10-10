<h1>Подробнее о товаре</h1>

<?php
	if (isset($info)) {
			echo "<h3 class='text-danger'> $info </h3>";
		}	
?>

<div class="col-md-9">
    <h4><?php echo $post->title; ?> </h4>
    <div class="row">
      <div class="col-md-6">
        <p>
          Дата добавления: <?php echo $post->publish_date; ?>
        </p>
        <p>Категория:
          <a href="<? echo yii\helpers\Url::to(['meals/search', 'category' => $post->category]); ?>"> <?php echo $post->category; ?></a>
        </p>
        <div class="row">
	       <div class="col-md-6">
         <p><strong>Опиcание: </strong><?php echo $post->body; ?></p>
	      </div>
        </div>
        <a href="<? echo yii\helpers\Url::to(['meals/add-meals', 'id' => $post->id, 'userId' => Yii::$app->user->id]); ?>" class="btn btn-success">Добавить</a>
      </div>
    </div>
  </div>