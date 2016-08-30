<?php

namespace app\modules\matching_questions\controllers;

use Yii;
use app\modules\matching_questions\models\MatchingAnswers;
use app\modules\matching_questions\models\MatchingQuestions;
use app\modules\matching_questions\models\MatchingQuestionsSearch;
use app\modules\matching_questions\models\UserMatchingAnswers;

use app\modules\matching_questions\models\Qualities;
use app\modules\matching_questions\models\SuperheroIdentities;
use app\modules\matching_questions\models\User;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\powers\models\QualityPowers;
use app\modules\powers\models\UserPowers;
use app\modules\powers\models\Powers;
use app\modules\powers\models\UserQualities;
use app\modules\languages\models\Languages;
use humhub\modules\space\models\Space;

/**
 * MatchingQuestionsController implements the CRUD actions for MatchingQuestions model.
 */
class MatchingQuestionsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionMatching()
    {

        $request = Yii::$app->request;
        $user = Yii::$app->user->getIdentity();

        // if user has superhero id, redirect
        //admin may re-answer it
        if($user->super_admin != 1 && isset($user->superhero_identity_id) && $user->superhero_identity_id >= 0){

            $superhero_identity = SuperheroIdentities::findOne(['id' => $user->superhero_identity_id]);
            $quality_1 = Qualities::findOne(['id' => $superhero_identity->quality_1]);
            $quality_2 = Qualities::findOne(['id' => $superhero_identity->quality_2]);
            $powers_quality_1 = QualityPowers::findAll(['quality_id' => $quality_1->id]);
            $relevant_powers = [];

            foreach ($powers_quality_1 as $quality_power) {
              $userPower = UserPowers::findOne(['power_id' => $quality_power->power_id, 'user_id' => $user->id]);
              if($userPower)
                $relevant_powers[] = $userPower;
            }

            $other_qualities = Qualities::find()->where(['not in', 'id', $quality_1->id])->all();

            $super_powers = Qualities::find()->all();
            $welcome_space = Space::find()->where(['id' => 1])->one();

            return $this->render('matching-results', compact('quality_1', 'quality_2', 'superhero_identity', 'relevant_powers', 'other_qualities', 'super_powers', 'welcome_space'));

        }

        if ($request->isPost){
            $qualities = $this->build_qualities_array(); // each position represents on of the social innovator qualities [0] is nothing
            $user_answers = array();
            $answers = MatchingAnswers::find()->All();
            $weights = array( 1 => 3, 2 => 2, 3 => 1, 4 => 0);

            foreach ($request->post() as $key => $answer)
            {
                // check if it is SINGLE CHOICE
                if(strpos($key, 'matching_question', 0) === 0){
                    // get matching question id
                    $matching_question = (int) str_replace('matching_question_', '', $key);

                    //get matching answer id
                    $matching_answer = $answer;

                    //save answer
                    $user_matching_answer = new UserMatchingAnswers();
                    $user_matching_answer->user_id = Yii::$app->user->getIdentity()->id;
                    $user_matching_answer->matching_answer_id = (int) $matching_answer;
                    $user_matching_answer->save();

                    // get quality id
                    $quality_id = MatchingAnswers::findOne(['id' => $matching_answer])->quality_id;

                    // add to calculation
                    $qualities[$quality_id] = !isset($qualities[$quality_id]) ? 1 : $qualities[$quality_id] + 1;

                // check if it is MULTIPLE CHOICE
                }elseif(strpos($key, 'matching_answer', 0) === 0){
                    // get matching answer id

                    //remove matching answer tag
                    $matching_answer = str_replace('matching_answer_', '', $key);
                    //remove matching question info
                    $matching_answer = (int) substr($matching_answer, 0, strpos($matching_answer, "_"));

                    //save answer

                    $user_matching_answer = new UserMatchingAnswers();
                    $user_matching_answer->user_id = Yii::$app->user->getIdentity()->id;
                    $user_matching_answer->matching_answer_id = (int) $matching_answer;
                    $user_matching_answer->order = (int) $answer;
                    $user_matching_answer->save();

                    // get matching question id
                    $matching_question = (int) substr($key, strrpos($key, "_") + 1, strlen($key) - 1);

                    if(!$answer){
                        Yii::$app->session->setFlash('matching_questions_incomplete_answers');
                        return $this->redirectQuestionnaire();
                    }

                    // get quality id
                    $quality_id = MatchingAnswers::findOne(['id' => $matching_answer])->quality_id;

                    // add to calculation
                    $qualities[$quality_id] = !isset($qualities[$quality_id]) ? $weights[$answer] : $qualities[$quality_id] + $weights[$answer];
                }
            }

            arsort($qualities);
            $quality_1 = Qualities::findOne(['id' => array_keys($qualities)[0]]);
            $quality_2 = Qualities::findOne(['id' => array_keys($qualities)[1]]);

            $superhero_identity = SuperheroIdentities::findOne(['quality_1' => $quality_1->id, 'quality_2' => $quality_2->id]);

            // SAVE SUPER HERO ID
            $user = User::findOne(['id' => $user->id]);
            $user->superhero_identity_id = $superhero_identity->id;
            //$user->attributes = array('superhero_identity_id' => $superhero_identity);
            $user->save();

            //CREATE USER'S POWERS & SUPER POWERS
            $powers = Powers::find()->all();
            $super_powers = Qualities::find()->all();

            foreach ($super_powers as $super_power) {
              // check if user has the super power already
              if (null === UserQualities::find()->where(['and', ['quality_id' => $super_power->id], ['user_id' => $user->id]])->one()) {
                $user_super_power = new UserQualities();
                $user_super_power->quality_id = $super_power->id;
                $user_super_power->user_id = $user->id;
                $user_super_power->level = 0;
                $user_super_power->save();
              }
            }

            foreach($powers as $power){
                $userPower = UserPowers::findOne(['power_id' => $power->id, 'user_id' => $user->id]);
                if(!isset($userPower)){
                    UserPowers::addPowerPoint($power, $user, 0);
                }
            }

            //SET USER'S FIRST POWER POINTS
            $powers_quality_1 = QualityPowers::findAll(['quality_id' => $quality_1->id]);
            // $powers_quality_2 = QualityPowers::findAll(['quality_id' => $quality_2->id]);

            foreach($powers_quality_1 as $power_quality_1){
              $power = $power_quality_1->getPower();
              $starter_points = floor((($power->improve_multiplier * pow(1, 1.95)) + $power->improve_offset) * 0.125); // give them 12.5% of the points needed for the first level

              UserPowers::addPowerPoint($power, $user, $starter_points);
            }

            // foreach($powers_quality_2 as $power_quality_2){
            //     UserPowers::addPowerPoint($power_quality_2->getPower(), $user, 5);
            // }

            foreach ($powers_quality_1 as $quality_power) {
              $userPower = UserPowers::findOne(['power_id' => $quality_power->power_id, 'user_id' => $user->id]);
              if($userPower)
                $relevant_powers[] = $userPower;
            }

            $other_qualities = Qualities::find()->where(['not in', 'id', $quality_1->id])->all();

            $welcome_space = Space::find()->where(['id' => 1])->one();

            return $this->render('matching-results', compact('quality_1', 'quality_2', 'superhero_identity', 'relevant_powers', 'other_qualities', 'super_powers', 'welcome_space'));

        } else{
            return $this->redirectQuestionnaire();
        }
    }

    private function redirectQuestionnaire(){

        $questions = MatchingQuestions::find()->with([
            'matchingQuestionTranslations' => function ($query) {
                $lang = Languages::findOne(['code' => Yii::$app->language]);

                if(isset($lang))
                    $query->andWhere(['language_id' => $lang->id]);
                else{
                    $lang = Languages::findOne(['code' => 'en-US']);
                    $query->andWhere(['language_id' => $lang->id]);
                }
            },
            'matchingAnswers.matchingAnswerTranslations' => function ($query) {
                $lang = Languages::findOne(['code' => Yii::$app->language]);
                if(isset($lang))
                    $query->andWhere(['language_id' => $lang->id]);
                else{
                    $lang = Languages::findOne(['code' => 'en-US']);
                    $query->andWhere(['language_id' => $lang->id]);
                }
            },
        ])->all();

        return $this->render('matching', compact('questions'));
    }

     private function build_qualities_array() {
        $qualities = array();

        for($i = 0; $i <= 6; $i++) {
          $qualities[] = 0;
        }
        return $qualities;
      }


    public function setInitialPowers(){
        $user = Yii::$app->user->getIdentity();


        //CREATE USER'S POWERS & SUPER POWERS
        $powers = Powers::find()->all();
        $super_powers = Qualities::find()->all();

        foreach ($super_powers as $super_power) {
          // check if user has the super power already
          if (null === UserQualities::find()->where(['and', ['quality_id' => $super_power->id], ['user_id' => $user->id]])->one()) {
            $user_super_power = new UserQualities();
            $user_super_power->quality_id = $super_power->id;
            $user_super_power->user_id = $user->id;
            $user_super_power->level = 0;
            $user_super_power->save();
          }
        }

        foreach($powers as $power){
            $userPower = UserPowers::findOne(['power_id' => $power->id, 'user_id' => $user->id]);
            if(!isset($userPower)){
                UserPowers::addPowerPoint($power, $user, 0);
            }
        }
    }

    /**
     * Lists all MatchingQuestions models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MatchingQuestionsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MatchingQuestions model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new MatchingQuestions model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MatchingQuestions();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MatchingQuestions model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing MatchingQuestions model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MatchingQuestions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MatchingQuestions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MatchingQuestions::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
