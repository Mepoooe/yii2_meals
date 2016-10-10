<?php

namespace app\models;
use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

class Search extends Model {
	public static function tableName()
	{
		return 'meals';
	}

	public function findOne($nameTable, $valueArray){
        switch ($nameTable) {
            case 'Meals':
            $desc = 'DESC';
            if ($valueArray['timeAdd'] === 'old') {
            	$desc = '';
            }

            if ($valueArray['nameMeal'] === '' && $valueArray['category'] === '') {
            	$params = [':category' => $valueArray['category']];

	            return $post = Yii::$app->db->createCommand('SELECT * FROM meals ORDER BY publish_date '.$desc.'' )
	           		->bindValues($params)
	           		->queryAll();
	                    break;
            }
            $params = [':name' => $valueArray['nameMeal'], ':category' => $valueArray['category']];

            return $post = Yii::$app->db->createCommand('SELECT * FROM meals WHERE title=:name OR category=:category ORDER BY publish_date '.$desc.'' )
           		->bindValues($params)
           		->queryAll();
                    break;
            
            default:
                return null;
                break;
        }
    }

    public function findById ($tableName, $id, $id_user)
    {	
    	if ($tableName === 'OrderList') {
    		return OrderList::find()->where(['id_meals' => $id, 'id_user' => $id_user])->one();
    	} else {
    		return null;
    	}
    }

} 