<?php

namespace app\controllers;
use yii\filters\AccessControl;
use yii\web\Controller;

// общий контроллер, можно прописывать свои функции и они будут в других контроллерах
class AppController extends Controller 
{
	public function printGreat ($arr)
	{
		echo '<pre>'.print_r($arr).'</pre>';
	}

	public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'logout', 'signup'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'signup'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
}