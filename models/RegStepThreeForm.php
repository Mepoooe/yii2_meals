<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;


/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class RegStepThreeForm extends Model
{
    // public $username;
    // public $password;
    // public $email;
     public $confirm;
    //public $captcha;
 


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['confirm', 'compare', 'compareValue'=>1, 'message' => 'Подтвердите условия регистрации'],
        ]; 
    }

     public function attributeLabels()
    {
        return [
            'confirm' => 'Я прочитал, и подтверждаю условия регистрации',
        ];
    }
}
