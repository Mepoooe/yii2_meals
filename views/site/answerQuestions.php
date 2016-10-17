<h1>Раздел вопросов и ответов</h1>


<div class="panel-group" id="accordion">
 <?php foreach ($answerQuestions as $answerQuestion) {?>
  <!-- 2 панель -->
  <div class="panel panel-default">
    <!-- Заголовок 2 панели -->
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#<?=$answerQuestion->id?>"><?=$answerQuestion->title?></a>
      </h4>
    </div>
    <div id="<?=$answerQuestion->id?>" class="panel-collapse collapse">
      <!-- Содержимое 2 панели -->
      <div class="panel-body">
        <p><?=$answerQuestion->body?></p>
      </div>
    </div>
  </div>
 <?}?>
</div>