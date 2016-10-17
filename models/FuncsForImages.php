<?php

namespace app\models;
use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

class FuncsForImages extends Model {
	public static function tableName()
	{
		return 'meals';
	}

	public function saveImg ($img=null)
    {
        if(!empty($img)){
        $randNum = mt_rand(0, 15000);
        $path = 'upload/store/'.$img->basename."-".$randNum.'.'.$img->extension;
            $img->saveAs($path);
            $pathArray = explode("/", $path);

            return array_pop($pathArray);
        } else {
            return false;
        }
    }

    public function deleteImg ($img=null)
    {
       $filePath = 'upload/store/'.$img;
       $img = is_file($filePath);
       if ($img === true) {
           unlink($filePath);
       }
       return true;
    }

} 