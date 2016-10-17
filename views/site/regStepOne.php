<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'cite';

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form ActiveForm */
?>
<div class="site-reg">
<?php
    $this->params['breadcrumbs'][] = ['label' => 'Первый шаг', 'url' => ['/site/reg-step-one']];
?>
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Заполните данные для регистрации:</p>

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

        <?//= $form->field($model, 'phone')->textInput() ?>

        <?//= $form->field($model, 'address')->textInput() ?>

        <!-- <?= $form->field($model, 'reCaptcha')->widget(
            \himiklab\yii2\recaptcha\ReCaptcha::className(),
            ['siteKey' => '6LejABgTAAAAAKj_HiKJUf8lO8g_2Exs6Yh6jk_E']
        ) ?> -->

        <input type="hidden" value="<?=Yii::$app->request->getCsrfToken()?>" />

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

</div><!-- site-reg -->
