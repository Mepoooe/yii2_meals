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
class FilterMealsForm extends Model
{
    public $nameMeal;
    public $category;
    public $timeAdd = 'new';
 
    private $_user = true;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            'nameMeal' => [['nameMeal'], 'string', 'max' => 60],
        ]; 
    }

    public function attributeLabels()
    {
        return [
            'nameMeal' => 'Что ищем',
            'category' => 'Категория',
            'timeAdd' => '',
        ];
    }
    
}
