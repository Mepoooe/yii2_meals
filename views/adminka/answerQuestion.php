<div class="container">
	<div class="jumbotron">
	        <h1>Вопрос: <?= $answerQuestion->title?></h1>
	        <p class="text-success"> Id вопроса:<strong> <?= $answerQuestion->id ?></strong> </p>
	        <p class="text-success">Категория вопроса: <strong><?= $answerQuestion->category?></strong></p>
	        <p class="text-success" href="#" role="button">Ответ: 
	          	<?= $answerQuestion->body?></p>
	        </p>
	        <a class="btn btn-warning" href="<? echo yii\helpers\Url::to(['adminka/answer-questions']); ?>">Вернуться</a>
	</div>
</div>