<?php

namespace app\models;
use yii\db\ActiveRecord;

class Meals extends ActiveRecord {
	public static function tableName()
	{
		return 'meals';
	}

	public function getAllMeals ()
	{
		$meals = new Meals();
		$meals = $meals->find()->orderBy('id desc')->all();
		return $meals;
	}

	public function getMeal ($id)
	{
		$meals = new Meals();
		$meals = $meals->findOne($id);
		return $meals;
	}

	public function addMeal ($validPost)
	{
		$meal = new Meals();
        $meal->title = $validPost['title'];
        $meal->category = $validPost['category'];
        $meal->body = $validPost['body'];
        $meal->save();
    
    return $meal;
	}

	public function editMeal ($id, $validPost)
	{
		$meal = Meals::findOne($id);
        $meal->title = $validPost['title'];
        $meal->category = $validPost['category'];
        $meal->body = $validPost['body'];
        $meal->save();
    
    return $meal;
	}

	public function delMeal ($id)
	{
		$meal = Meals::findOne($id);
		$meal->delete();
	}


	public function getOrderList ()
    {
        return $this->hasOne(OrderList::className(), ['id' => 'id_meals']);
    }
} 