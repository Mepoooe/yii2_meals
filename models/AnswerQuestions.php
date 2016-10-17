<?php

namespace app\models;
use yii\db\ActiveRecord;

class AnswerQuestions extends ActiveRecord {

	public static function tableName()
	{
		return 'answer_question';
	}

	public function getAllAnswerQuestions ()
	{
		$answerQuestions = new AnswerQuestions();
		$answerQuestions = $answerQuestions->find()->orderBy('id desc')->all();
		return $answerQuestions;
	}

	public function getAnswerQuestion ($id)
	{
		$answerQuestions = new AnswerQuestions();
		$answerQuestions = $answerQuestions->findOne($id);
		return $answerQuestions;
	}

	public function addAnswerQuestions ($validPost)
	{
		$answerQuestions = new AnswerQuestions();
        $answerQuestions->title = $validPost['title'];
        $answerQuestions->category = $validPost['category'];
        $answerQuestions->body = $validPost['body'];
        $answerQuestions->save();
    
    return $answerQuestions;
	}

	public function editAnswerQuestions ($id, $validPost)
	{
		$answerQuestions = AnswerQuestions::findOne($id);
        $answerQuestions->title = $validPost['title'];
        $answerQuestions->category = $validPost['category'];
        $answerQuestions->body = $validPost['body'];
        $answerQuestions->save();
    
    return $answerQuestions;
	}

	public function delAnswerQuestions ($id)
	{
		$answerQuestions = AnswerQuestions::findOne($id);
		$answerQuestions->delete();
	}
} 