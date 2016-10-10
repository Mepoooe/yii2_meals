<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\captcha\Captcha;
printGreat($valueArray['username']);
?>

<h1>hello users</h1>

	<div class="col-md-10">
		<a data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-primary btn-lg btn-block" >Добавить нового пользователя</a>
		<table class="table table-condensed">

<?php
foreach ($users as $user) {
?>
	    	
	    	<tr>
	    		<td colspan="50">
	        		<a href="<? echo yii\helpers\Url::to(['adminka/user', 'id' => $user->id]); ?>"> <?=$user->username ?></a> 
	        	
		        </td>
		      
		        <td>
			        	<a class="btn btn-warning" href="<? echo yii\helpers\Url::to(['adminka/edit-user', 'id' => $user->id]); ?>"> Редактировать</a> 

			        	<a class="btn btn-danger" href="<? echo yii\helpers\Url::to(['adminka/del-user', 'id' => $user->id]); ?>"> Удалить </a> 
			        
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
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'email')->textInput() ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'phone')->textInput() ?>

        <?= $form->field($model, 'address')->textInput() ?>

        <input type="hidden" value="<?=Yii::$app->request->getCsrfToken()?>" />

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
    	</div>
    </div>
  </div>
</div>