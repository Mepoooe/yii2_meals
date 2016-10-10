<?php

namespace app\models;
use yii\db\ActiveRecord;

class OrderList extends ActiveRecord {
	public static function tableName()
	{
		return 'order_list';
	}

	public function addOrder($id = null, $idUser = null, $count = null)
	{
		if ($count === null) {
			$count = 1;
		}

		$orderList = new OrderList();
        $orderList->id_user = $idUser;
        $orderList->id_meals = $id;
        $orderList->count = $count;
        $orderList->save();
	}

	public function delOrder($id)
	{
		$orderList = OrderList::findOne($id);
		if ($orderList !== null) {
			$orderList->delete();
		}

	}

	public function getMeals()
    {
        return $this->hasOne(Meals::className(), ['id' => 'id_meals']);
    }
} 