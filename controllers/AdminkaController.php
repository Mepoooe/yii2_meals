<?php

namespace app\controllers;
use app\models\Meals;
use app\models\User;
use app\models\AddMealsForm;
use app\models\AddUsersForm;
use app\models\OrderList;
use Yii;

class AdminkaController extends AppController {

	public function actionIndex() 
	{	
        return $this->render('index');    
    }

    // Вывод обедов в Админке, добавление новых обедов
	public function actionMeals() {
		$model = new AddMealsForm();

		if ($model->load(Yii::$app->request->post())) {
            if(!$model->validate()){
                 print_r($model->errors);
            } 
            if ($model->validate()) {
                // form inputs are valid, do something here
                $valueArray = array();
                $post = Yii::$app->request->post();
                foreach ($post['AddMealsForm'] as $key => $value) {
                	$valueArray[$key] = $value; 
                }            
                Meals::addMeal($valueArray);
                $meals = Meals::getAllMeals();
                return $this->render('meals', compact('valueArray', 'meals', 'model'));;
            }
        }
		$meals = Meals::getAllMeals();
		return $this->render('meals', compact('meals', 'model'));
	}

    // удаление обедов
	public function actionDel ($id = null)
	{
		$model = new AddMealsForm();
		Meals::delMeal($id);
		$meals = Meals::getAllMeals();
        
        return $this->redirect(['meals']);
	}

    //редактирование информации про обеды
	public function actionEditMeal ($id = null)
	{
		$model = new AddMealsForm();

		if ($model->load(Yii::$app->request->post())) {
            if(!$model->validate()){
                 print_r($model->errors);
            } 
            if ($model->validate()) {
                // form inputs are valid, do something here
                $valueArray = array();
                $post = Yii::$app->request->post();
                foreach ($post['AddMealsForm'] as $key => $value) {
                	$valueArray[$key] = $value; 
                }            
                Meals::editMeal($id, $valueArray);
                $meals = Meals::getAllMeals();
                return $this->redirect(['meals']);;
            }
        }
        $meal = Meals::getMeal($id);

    	return $this->render('editMeal', compact('meal', 'model'));
	}

    // вывод пользователей
	public function actionUsers() {
		$model = new AddUsersForm();

		if ($model->load(Yii::$app->request->post())) {
            if(!$model->validate()){
                 print_r($model->errors);
            } 
            if ($model->validate()) {
                // form inputs are valid, do something here
                $valueArray = array();
                $post = Yii::$app->request->post();
                foreach ($post['AddUsersForm'] as $key => $value) {
                	$valueArray[$key] = $value; 
                }            
                User::addUser($valueArray);
                $users = User::getAllUsers();
                return $this->render('users', compact('valueArray', 'users', 'model'));;
            }
        }
        $post = $model->getUser();
		$users = User::getAllUsers();
		return $this->render('users', compact('users', 'post', 'model'));
	}

    // подробнее про пользователя и его заказах
	public function actionUser($id) {
		$user = User::findIdentity($id);
		$orderList = OrderList::find()->where(['id_user' => $id])->with('meals')->all();
		return $this->render('user', compact('user', 'orderList'));
	}

    // редактировать информацию про пользователя
	public function actionEditUser ($id = null)
	{
		$model = new AddUsersForm();

		if ($model->load(Yii::$app->request->post())) {
            if(!$model->validate()){
                 print_r($model->errors);
            } 
            if ($model->validate()) {
                // form inputs are valid, do something here
                $valueArray = array();
                $post = Yii::$app->request->post();
                foreach ($post['AddUsersForm'] as $key => $value) {
                	$valueArray[$key] = $value; 
                }            
                User::editUser($id, $valueArray);
                $users = User::getAllUsers();
                return $this->redirect(['users']);
            }
        }
        $user = User::findIdentity($id);

    return $this->render('editUser', compact('user', 'model'));

	}

    // удалить Пользователя
	public function actionDelUser ($id = null)
	{
		$model = new AddUsersForm();
		User::delUser($id);
		$meals = User::getAllUsers();
        
        return $this->redirect(['users']);
	}
	
}