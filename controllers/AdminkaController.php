<?php

namespace app\controllers;
use yii\filters\AccessControl;
use app\models\Meals;
use app\models\User;
use app\models\AddMealsForm;
use app\models\AddUsersForm;
use app\models\OrderList;
use app\models\FuncsForImages;
use yii\web\UploadedFile;
use app\models\AnswerQuestionsForm;
use app\models\AnswerQuestions;
use Yii;

class AdminkaController extends AppController {

    // только пользователи 
    public function behaviors()
    {
        return [
       'access' => [
           'class' => AccessControl::className(),
           'only' => [ '*'],
           'rules' => [
               [
                   'controllers' => ["adminka"],
                   'allow' => true,
                   'roles' => ['@'],
                   'matchCallback' => function ($rule, $action) {
                       return User::isUserAdmin(Yii::$app->user->identity->username);
                   }
               ],
           ],
       ],
    ];
    } 

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
                $image = $model->image = UploadedFile::getInstance($model, 'image');
                $images = new FuncsForImages();
                $images = $images->saveImg($image);

                $valueArray = array();
                $post = Yii::$app->request->post();
                foreach ($post['AddMealsForm'] as $key => $value) {
                	$valueArray[$key] = $value; 
                }            
                $valueArray['image'] = $images;
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
        $img = new FuncsForImages();
		$meal = new Meals();
        // получаем img
        $imgForDel = $meal->getMeal($id);
        $imgForDel = $imgForDel->image;
        // удаляем само изображение
        $img = $img->deleteImg($imgForDel);
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
                // удаляем img
                $images = new FuncsForImages();
                $meal = new Meals();
                // получаем img
                $imgForDel = $meal->getMeal($id);
                $imgForDel = $imgForDel->image;
                // удаляем само изображение
                $images = $images->deleteImg($imgForDel);

                // получаем и перезаписываем
                $images = new FuncsForImages();
                $image = $model->image = UploadedFile::getInstance($model, 'image');
                // printGreat($image);
                // die;
                $images = $images->saveImg($image);

                $valueArray = array();
                $post = Yii::$app->request->post();
                foreach ($post['AddMealsForm'] as $key => $value) {
                	$valueArray[$key] = $value; 
                }            
                $valueArray['image'] = $images;
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

    // вывод вопросов-ответов + добавление новых
	public function actionAnswerQuestions() {
        $model = new AnswerQuestionsForm();

        if ($model->load(Yii::$app->request->post())) {
            if(!$model->validate()){
                 print_r($model->errors);
            } 
            if ($model->validate()) {
                // form inputs are valid, do something here
                $valueArray = array();
                $post = Yii::$app->request->post();
                foreach ($post['AnswerQuestionsForm'] as $key => $value) {
                    $valueArray[$key] = $value; 
                }            
                AnswerQuestions::addAnswerQuestions($valueArray);
                $answerQuestions = AnswerQuestions::getAllAnswerQuestions();
                return $this->render('answerQuestions', compact('valueArray', 'answerQuestions', 'model'));;
            }
        }
        $answerQuestions = AnswerQuestions::getAllAnswerQuestions();
        return $this->render('answerQuestions', compact('answerQuestions', 'model'));
    }

    // редактировать информацию вопроса ответа
    public function actionEditAnswerQuestion ($id = null)
    {
        $model = new AnswerQuestionsForm();

        if ($model->load(Yii::$app->request->post())) {
            if(!$model->validate()){
                 print_r($model->errors);
            } 
            if ($model->validate()) {
                // form inputs are valid, do something here
                $valueArray = array();
                $post = Yii::$app->request->post();
                foreach ($post['AnswerQuestionsForm'] as $key => $value) {
                    $valueArray[$key] = $value; 
                }            
                AnswerQuestions::editAnswerQuestions($id, $valueArray);
                return $this->redirect(['answer-questions']);
            }
        }
        $answerQuestion = AnswerQuestions::getAnswerQuestion($id);

    return $this->render('editAnswerQuestion', compact('answerQuestion', 'model'));

    }

    // подробнее о вопросе
    public function actionAnswerQuestion($id) {
        $answerQuestion = AnswerQuestions::getAnswerQuestion($id);
        return $this->render('answerQuestion', compact('answerQuestion'));
    }

    // удалить вопрос
    public function actionDelAnswerQuestion($id = null)
    {
        $model = new AnswerQuestions();
        AnswerQuestions::delAnswerQuestions($id);
        
        return $this->redirect(['answer-questions']);
    }
}