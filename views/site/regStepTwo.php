<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form ActiveForm */
?>
<div class="site-reg">
    <h1><?= Html::encode($this->title) ?></h1>
    <?// $session = Yii::$app->session;?>
    <?  
    //Записываем в сессию полученные данные из regStepOne
        // $stepOneValue = $session->getFlash('valueArray');
        // $session->open();
        // $valueArray = $session->set('stepOneValue', $stepOneValue);
        // $session->close();

        
    ?>
    <?php
    $this->params['breadcrumbs'][] = ['label' => 'Первый шаг', 'url' => ['/site/reg-step-one']];
    $this->params['breadcrumbs'][] = ['label' => 'Второй шаг', 'url' => ['/site/reg-step-two']];
?>
    <p>Заполните личные данные:</p>
    
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>
        <?= $form->field($model, 'phone')->textInput() ?>

        <?= $form->field($model, 'address')->textInput() ?>

        <input type="hidden" value="<?=Yii::$app->request->getCsrfToken()?>" />

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Далее', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

</div><!-- site-reg -->
