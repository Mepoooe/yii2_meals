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
class AddMealsForm extends Model
{
    public $title;
    public $category;
    public $body;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
         [['title', 'category'], 'required', 'message' => 'Заполните поля!'],
            'title' => [['title'], 'string', 'max' => 60],
            'category' => [['category'], 'string', 'max' => 60],
            'body' => [['body'], 'string'],
             // ['username', 'unique', 'message' => 'Please choose a username.'],

            // username is validated by validatePassword()
        ]; 
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Название обеда',
            'category' => 'Категория',
            'body' => 'Описание',
        ];
    }
    
}
