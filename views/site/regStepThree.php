<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form ActiveForm */
?>
<div class="site-reg">
<?php
    $this->params['breadcrumbs'][] = ['label' => 'Первый шаг', 'url' => ['/site/reg-step-one']];
    $this->params['breadcrumbs'][] = ['label' => 'Второй шаг', 'url' => ['/site/reg-step-two']];
    $this->params['breadcrumbs'][] = ['label' => 'Третий шаг', 'url' => ['/site/reg-step-three']];
?>
    <h1><?= Html::encode($this->title) ?></h1>
    <? $session = Yii::$app->session;?>
    <?  
        $session->open();
        $stepOneValue = $session->get('stepOneValue');
        $stepTwoValue = $session->get('stepTwoValue');
        $session->close();

        printGreat($result['phone']);

    ?>
    <h2>Спасибо за терпение <?= $stepOneValue['username']?> :</h2>
    <h3>Проверте информацию о себе:</h3>
    <p>Ваш mail: <?= $stepOneValue['email']?>  </p>
    <p>Ваш телефон: <?= $stepTwoValue['phone']?></p>
    <p>Ваш адресс: <?= $stepTwoValue['address']?> </p>
    <h3>Условия регистрации: </h3>
    <p>   Право на осуществление предпринимательской деятельности является одним из конституционных прав гражданина. Согласно ст. 42 Конституции Украины каждый имеет право на предпринимательскую деятельность, не запрещенную законом.
        В соответствии с п. 1 ст. 50 Гражданского кодекса Украины право заниматься предпринимательской деятельностью имеет физическое лицо с полной гражданской дееспособностью, достигшее 18 лет. Осуществлять такую деятельность можно только при условии ее государственной регистрации. После регистрации гражданин приобретает статус ФЛП.
        Заниматься предпринимательской деятельностью действующее законодательство позволяет не всем. Так, не могут совмещать свою деятельность с предпринимательской отдельные категории государственных служащих (включая военнослужащих, находящихся на действительной службе), работники органов прокуратуры, СБУ, МВД, судов и других правительственных органов, а также лица, которым осуществлять определенные виды деятельности запрещено решением суда.
    </p>
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'confirm')->checkbox([
            'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ]) ?>

    

        <input type="hidden" value="<?=Yii::$app->request->getCsrfToken()?>" />

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

</div><!-- site-reg -->
