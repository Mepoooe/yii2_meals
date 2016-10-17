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
    public $image;
   
   public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
         [['title', 'category'], 'required', 'message' => 'Заполните поля!'],
            'title' => [['title'], 'string', 'max' => 60],
             [['image'], 'file', 'extensions' => 'png, jpg'],
            'category' => [['category'], 'string', 'max' => 60],
            'body' => [['body'], 'string'],
        ]; 
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Название обеда',
            'category' => 'Категория',
            'body' => 'Описание',
            'image' => 'Загрузить картинку'
        ];
    }

    // public function upload ()
    // {
    //     if ($this->validate()) {
    //         $path = 'upload/store/'.$this->image->basename.'.'.$this->image->extension;
    //         $this->image->saveAs($path);
    //         $this->attachImage($path);
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
    
}
