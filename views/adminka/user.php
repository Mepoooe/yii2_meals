<div class="container">
	<div class="jumbotron">
	        <h1>Пользователь <?= $user->username?></h1>
	        <p> Id пользователя: <?= $user->id ?> </p>
	        <p>Телефон: <strong><?= $user->phone?></strong></p>
	        <p>
	          <a class="btn btn-lg btn-primary" href="#" role="button">email: <?= $user->email?></a>
	        </p>
	        <p>Адрес: <strong><?= $user->address?></strong></p>
	</div>
	<h1>Список заказов пользователя</h1>
	<?php
	if (empty($orderList)) {
		echo "<h2 class='text-danger'> Заказов нет </h2>";
	}
	?>
	<?php foreach ($orderList as $value) { ?>
	<div class="row marketing">
        <div class="col-lg-6">
          <h4><?= $value->meals->title?></h4>
          <p><?= $value->meals->body?></p>
			<p>
				<a class="btn btn-primary" href="<? echo yii\helpers\Url::to(['meals/meal', 'id' => $value->meals->id]); ?>">
				Просмотреть подробнее
				</a>
			</p>
        </div>
      </div>
	<?php } ?>
</div>