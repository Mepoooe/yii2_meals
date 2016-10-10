<?php

namespace app\controllers;
use app\models\Meals;
use app\models\Search;
use app\models\OrderList;
use app\models\User;
use app\models\FilterMealsForm;
use Yii;

class MealsController extends AppController {
	// добавление и вывод обедов
	public function actionIndex() {
		$model = new FilterMealsForm();

		if ($model->load(Yii::$app->request->post())) {
            if(!$model->validate()){
                 print_r($model->errors);
            } 
            if ($model->validate()) {
                // form inputs are valid, do something here
                $valueArray = array();
                $post = Yii::$app->request->post();
                foreach ($post['FilterMealsForm'] as $key => $value) {
                	$valueArray[$key] = $value; 
                }
                $search = new Search();
                if (is_array($valueArray)) {
                	$findMealsByName = $search->findOne('Meals', $valueArray);
                }
                
                return $this->render('search', compact('findMealsByName'));;
            }
        }

		$query = Meals::find()->select('id, title, category, body, publish_date')->orderBy('id DESC');
		$pages = new \yii\data\Pagination(['totalCount' => $query->count(), 'pageSize' => 8, 'pageSizeParam' => false, 'forcePageParam' => false]);
		$posts = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('index', compact('posts', 'pages', 'model'));
	}
	// просмотр подробной информации про Обед
	public function actionMeal($id = null) {
		$post = Meals::findOne($id);

		return $this->render('meal', compact('post'));
	}
	//фильтр по обедам
	public function actionSearch($category = null)
	{
		$searchValue['category'] = $category;

        $search = new Search();
        if (is_array($searchValue)) {
        	$findMealsByName = $search->findOne('Meals', $searchValue);
        }
                
        return $this->render('search', compact('findMealsByName', 'searchValue'));
	}

	//добавить Meal order_list а от туда потом в личный кабинет
	public function actionAddMeals ($id = null, $userId = null, $count = null)
	{
		$id = $id;
		$userId = $userId;
		if($userId === null) {
			return $this->redirect('http://happyfood/site/login');
		}

		$searchMealsById = new Search();
		$searchMeals = $searchMealsById->findById('OrderList', $id, $userId);
		if ($searchMeals !== null) {
			$post = Meals::findOne($id);
			$info = 'Товар '.$post->title.' уже добавлен!';
			return $this->render('meal', compact('post', 'info'));
		}
		$orderList = new OrderList();
		$orderList->addOrder($id, $userId, $count);

		return $this->redirect(['index']);
	}

	// удалить обед
	public function actionDelMeals ($id = null)
	{
		if ($id !== null) {
			$orderList = new OrderList();
			$orderList->delOrder($id);
		}
		

		$orderList = OrderList::find()->with('meals')->all();
		return $this->render('yourMenu', compact('orderList'));
	}

	//вывод меню для конкрутного пользователя
	public function actionYourMenu()
	{
		$id = Yii::$app->user->identity->id;
	 $orderList = OrderList::find()->where(['id_user' => $id])->with('meals')->all();

	 return $this->render('yourMenu', compact('orderList'));
	}
}