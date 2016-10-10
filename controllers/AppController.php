<?php

namespace app\controllers;
use yii\web\Controller;

// общий контроллер, можно прописывать свои функции и они будут в других контроллерах
class AppController extends Controller 
{
	public function printGreat ($arr)
	{
		echo '<pre>'.print_r($arr).'</pre>';
	}
}