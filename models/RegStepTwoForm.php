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
class RegStepTwoForm extends Model
{
    // public $username;
    // public $password;
    // public $email;
     public $phone;
     public $address;
    //public $captcha;
 


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['phone', 'address'], 'required'],
             ['address', 'string', 'length' => [4, 24]],
             ['phone', 'number'],
        ]; 
    }
}
