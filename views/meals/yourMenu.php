<?php
	foreach ($orderList as $value) { 
		if(!empty($value->meals)) {
			$mealsEmpty = false;
		} else {
			$mealsEmpty = true;
		}
	}
?>
<h1>Привет <?php echo Yii::$app->user->identity->username; ?></h1>
<h3>Ниже ваши заказы:</h3>
<?php if (empty($orderList) || $mealsEmpty === true): ?>
  <h3 class="text-danger">У вас нет заказов</h3>
<?php endif ?>
<?php 
foreach ($orderList as $value) { 
	if(!empty($value->meals)) {
?>
  <div class="col-lg-6">
          <h4><?php echo $value->meals->title; ?></h4>
          <a href="<? echo yii\helpers\Url::to(['meals/search', 'category' =>  $value->meals->category]); ?>"><?php echo $value->meals->category; ?></a>

          <p><?php echo $value->meals->body; ?></p>

          <a href="<? echo yii\helpers\Url::to(['meals/del-meals', 'id' =>  $value->id]); ?>" class="btn btn-warning">Удалить</a>
  </div>
<?php 
		}
	}
?>
