<?php

namespace humhub\modules\missions\controllers;

use Yii;
use yii\web\Controller;
use app\modules\missions\models\QuizUserAnswers;

class QuizController extends Controller
{

	public function actionAnswer(){
		$user_id = $user = Yii::$app->user->getIdentity()->id;
		$question_id = Yii::$app->request->post('question_id');
		$answers_id = Yii::$app->request->post('answers_ids');

		if($answers_id){
			foreach($answers_id as $answer_id){
				$user_answer = new QuizUserAnswers();
				$user_answer->user_id = $user_id;
				$user_answer->quiz_question_id = $question_id;
				$user_answer->quiz_question_answer_id = $answer_id;
				$user_answer->save();
			}
		}
	}
}