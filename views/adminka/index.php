<h1> Привет от Админа<?= $hello?> </h1>

<div class="row">
	<div class="col-md-6">
		<a href="<?php echo yii\helpers\Url::to(['adminka/meals']); ?>"> Работа с меню</a>
	</div>
	<div class="col-md-6">
		<a href="<?php echo yii\helpers\Url::to(['adminka/users']); ?>"> Работа с пользователями</a>
	</div>
</div>
