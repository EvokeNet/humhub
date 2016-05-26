<?php

namespace app\modules\matching_questions\controllers;

use Yii;
use app\modules\matching_questions\models\MatchingQuestions;
use app\modules\matching_questions\models\MatchingQuestionTranslations;
use app\modules\matching_questions\models\MatchingAnswers;
use app\modules\matching_questions\models\MatchingAnswerTranslations;
use app\modules\matching_questions\models\Qualities;
use app\modules\powers\models\QualityPowers;
use app\modules\matching_questions\models\QualityTranslations;
use app\modules\matching_questions\models\SuperheroIdentities;
use app\modules\matching_questions\models\SuperheroIdentityTranslations; 

/**
 * AdminController
 *
 */
class AdminController extends \humhub\modules\admin\components\Controller
{
    
    public function actionIndex()
    {
        $matching_questions = MatchingQuestions::find()->all();
        return $this->render('matching-questions/index', array('matching_questions' => $matching_questions));
    }
    
    public function actionCreate()
    {
        $model = new MatchingQuestions();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } 
        
        return $this->render('matching-questions/create', array('model' => $model));
    }

    public function actionUpdate($id)
    {
        $model = MatchingQuestions::findOne(['id' => Yii::$app->request->get('id')]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('matching-questions/update', array('model' => $model));
    }
    
    public function actionDelete()
    {
        $model = MatchingQuestions::findOne(['id' => Yii::$app->request->get('id')]);

        if ($model !== null) {
            $model->delete();
        }

        return $this->redirect(['index']);
    }
    
    /**
    * Matching Answers actions
    *
    */
 
    public function actionIndexMatchingAnswers($id)
    {
        $matching_answers = MatchingAnswers::find()
        ->where(['matching_question_id' => Yii::$app->request->get('id')])
        ->all();
        
        $matching_question = MatchingQuestions::findOne(['id' => Yii::$app->request->get('id')]);
        
        return $this->render('matching-answers/index', array('matching_answers' => $matching_answers, 'matching_question' => $matching_question));
    }
    
    public function actionCreateMatchingAnswers($id)
    {
        $model = new MatchingAnswers();
        $model->matching_question_id = $id;
        
        $matching_question = MatchingQuestions::findOne(['id' => Yii::$app->request->get('id')]);
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index-matching-answers', 'id' => $id]);
        } 
        
        return $this->render('matching-answers/create', array('model' => $model, 'matching_question' => $matching_question));
    }

    public function actionUpdateMatchingAnswers($id)
    {
        $model = MatchingAnswers::findOne(['id' => Yii::$app->request->get('id')]);
        
        $matching_question = MatchingQuestions::findOne(['id' => $model->matching_question_id]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index-matching-answers', 'id' => $model->matching_question_id]);
        }

        return $this->render('matching-answers/update', array('model' => $model, 'matching_question' => $matching_question));
    }
    
    public function actionDeleteMatchingAnswers()
    {
        $model = MatchingAnswers::findOne(['id' => Yii::$app->request->get('id')]);
        $mid = $model->matching_question_id;

        if ($model !== null) {
            $model->delete();
        }

        return $this->redirect(['index-matching-answers', 'id' => $mid]);
    }
    
    /**
    * Matching Questions Translations actions
    *
    */
 
    public function actionIndexMatchingQuestionTranslations($id)
    {
        $matching_questions = MatchingQuestionTranslations::find()
        ->where(['matching_question_id' => Yii::$app->request->get('id')])
        ->with('language')
        ->all();
        
        $matching_question = MatchingQuestions::findOne(['id' => Yii::$app->request->get('id')]);
        
        return $this->render('matching-question-translations/index', array('matching_questions' => $matching_questions, 'matching_question' => $matching_question));
    }
    
    public function actionCreateMatchingQuestionTranslations($id)
    {
        $model = new MatchingQuestionTranslations();
        $model->matching_question_id = $id;
        
        $matching_question = MatchingQuestions::findOne(['id' => Yii::$app->request->get('id')]);
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index-matching-question-translations', 'id' => $id]);
        } 
        
        return $this->render('matching-question-translations/create', array('model' => $model, 'matching_question' => $matching_question));
    }

    public function actionUpdateMatchingQuestionTranslations($id)
    {
        $model = MatchingQuestionTranslations::findOne(['id' => Yii::$app->request->get('id')]);
        
        $matching_question = MatchingQuestions::findOne(['id' => $model->matching_question_id]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index-matching-question-translations', 'id' => $model->matching_question_id]);
        }

        return $this->render('matching-question-translations/update', array('model' => $model, 'matching_question' => $matching_question));
    }
    
    public function actionDeleteMatchingQuestionTranslations()
    {
        $model = MatchingQuestionTranslations::findOne(['id' => Yii::$app->request->get('id')]);
        $mid = $model->matching_question_id;

        if ($model !== null) {
            $model->delete();
        }

        return $this->redirect(['index-matching-question-translations', 'id' => $mid]);
    }
    
    /**
    * Matching Questions Translations actions
    *
    */
 
    public function actionIndexMatchingAnswerTranslations($id)
    {
        $matching_answers = MatchingAnswerTranslations::find()
        ->where(['matching_answer_id' => Yii::$app->request->get('id')])
        ->with('language')
        ->all();
        
        $matching_answer = MatchingAnswers::findOne(['id' => Yii::$app->request->get('id')]);
        
        return $this->render('matching-answer-translations/index', array('matching_answers' => $matching_answers, 'matching_answer' => $matching_answer));
    }
    
    public function actionCreateMatchingAnswerTranslations($id)
    {
        $model = new MatchingAnswerTranslations();
        $model->matching_answer_id = $id;
        
        $matching_answer = MatchingAnswers::findOne(['id' => Yii::$app->request->get('id')]);
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index-matching-answer-translations', 'id' => $id]);
        } 
        
        return $this->render('matching-answer-translations/create', array('model' => $model, 'matching_answer' => $matching_answer));
    }

    public function actionUpdateMatchingAnswerTranslations($id)
    {
        $model = MatchingAnswerTranslations::findOne(['id' => Yii::$app->request->get('id')]);
        
        $matching_answer = MatchingAnswers::findOne(['id' => $model->matching_answer_id]);
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index-matching-answer-translations', 'id' => $model->matching_answer_id]);
        }

        return $this->render('matching-answer-translations/update', array('model' => $model, 'matching_answer' => $matching_answer));
    }
    
    public function actionDeleteMatchingAnswerTranslations()
    {
        $model = MatchingAnswerTranslations::findOne(['id' => Yii::$app->request->get('id')]);
        $mid = $model->matching_answer_id;

        if ($model !== null) {
            $model->delete();
        }

        return $this->redirect(['index-matching-answer-translations', 'id' => $mid]);
    }
    
    /*
    * Qualities
    */
    
    public function actionIndexQualities()
    {
        $qualities = Qualities::find()->all();
        return $this->render('qualities/index', array('qualities' => $qualities));
    }
    
    public function actionCreateQualities()
    {
        $model = new Qualities();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index-qualities']);
        } 
        
        return $this->render('qualities/create', array('model' => $model));
    }

    public function actionUpdateQualities($id)
    {
        $model = Qualities::findOne(['id' => Yii::$app->request->get('id')]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index-qualities']);
        }

        return $this->render('qualities/update', array('model' => $model));
    }
    
    public function actionDeleteQualities()
    {
        $model = Qualities::findOne(['id' => Yii::$app->request->get('id')]);

        if ($model !== null) {
            $model->delete();
        }

        return $this->redirect(['index-qualities']);
    }
    
    /*
    * Quality Translations
    */
    
    public function actionIndexQualityTranslations($id)
    {
        $translations = QualityTranslations::find()
        ->where(['quality_id' => Yii::$app->request->get('id')])
        ->all();
        
        $quality = Qualities::findOne(['id' => Yii::$app->request->get('id')]);
        
        return $this->render('quality-translations/index', array('translations' => $translations, 'quality' => $quality));
    }
    
    public function actionCreateQualityTranslations($id)
    {
        $model = new QualityTranslations();
        $model->quality_id = $id;
        
        $quality = Qualities::findOne(['id' => Yii::$app->request->get('id')]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index-quality-translations', 'id' => $id]);
        } 
        
        return $this->render('quality-translations/create', array('model' => $model, 'quality' => $quality));
    }

    public function actionUpdateQualityTranslations($id)
    {
        $model = QualityTranslations::findOne(['id' => Yii::$app->request->get('id')]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index-quality-translations', 'id' => $model->quality_id]);
        }

        return $this->render('quality-translations/update', array('model' => $model));
    }
    
    public function actionDeleteQualityTranslations()
    {
        $model = QualityTranslations::findOne(['id' => Yii::$app->request->get('id')]);
        $id = $model->quality_id;
        
        if ($model !== null) {
            $model->delete();
        }

        return $this->redirect(['index-quality-translations', 'id' => $id]);
    }
    
    /*
    * Superhero Identities
    */
    
    public function actionIndexSuperheroIdentities()
    {
        $identities = SuperheroIdentities::find()->all();
        return $this->render('superhero-identities/index', array('identities' => $identities));
    }
    
    public function actionCreateSuperheroIdentities()
    {
        $model = new SuperheroIdentities();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index-superhero-identities']);
        } 
        
        return $this->render('superhero-identities/create', array('model' => $model));
    }

    public function actionUpdateSuperheroIdentities($id)
    {
        $model = SuperheroIdentities::findOne(['id' => Yii::$app->request->get('id')]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index-superhero-identities']);
        }

        return $this->render('superhero-identities/update', array('model' => $model));
    }
    
    public function actionDeleteSuperheroIdentities()
    {
        $model = SuperheroIdentities::findOne(['id' => Yii::$app->request->get('id')]);

        if ($model !== null) {
            $model->delete();
        }

        return $this->redirect(['index-superhero-identities']);
    }
    
    /*
    * Superhero Identity Translations
    */
    
    public function actionIndexSuperheroIdentityTranslations($id)
    {
        $translations = SuperheroIdentityTranslations::find()->all();
        
        $superhero_identity = SuperheroIdentities::findOne(['id' => Yii::$app->request->get('id')]);
        
        return $this->render('superhero-identity-translations/index', array('translations' => $translations, 'superhero_identity' => $superhero_identity));
    }
    
    public function actionCreateSuperheroIdentityTranslations($id)
    {
        $model = new SuperheroIdentityTranslations();
        $model->superhero_identity_id = $id;
        
        $superhero_identity = SuperheroIdentities::findOne(['id' => Yii::$app->request->get('id')]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index-superhero-identity-translations', 'id' => $id]);
        } 
        
        return $this->render('superhero-identity-translations/create', array('model' => $model, 'superhero_identity' => $superhero_identity));
    }

    public function actionUpdateSuperheroIdentityTranslations($id)
    {
        $model = SuperheroIdentityTranslations::findOne(['id' => Yii::$app->request->get('id')]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index-superhero-identity-translations', 'id' => $model->superhero_identity_id]);
        }

        return $this->render('superhero-identity-translations/update', array('model' => $model));
    }
    
    public function actionDeleteSuperheroIdentityTranslations()
    {
        $model = SuperheroIdentityTranslations::findOne(['id' => Yii::$app->request->get('id')]);
        $id = $model->superhero_identity_id;
        
        if ($model !== null) {
            $model->delete();
        }

        return $this->redirect(['index-superhero-identity-translations', 'id' => $id]);
    }
    
    /**
    * Quality Powers Actions
    *
    **/
    public function actionIndexQualityPowers($id)
    {
        $quality_powers = QualityPowers::find()
        ->where(['quality_id' => Yii::$app->request->get('id')])
        ->all();
        
        // $customers = Books::find()->with([
        //     'bookTranslations' => function ($query) {
        //         $lang = Languages::findOne(['code' => Yii::$app->language]);
        //         $query->andWhere(['language_id' => $lang->id]);
        //     },
        // ])->all();
        
        $quality = Qualities::findOne(['id' => Yii::$app->request->get('id')]);
        
        return $this->render('quality-powers/index', array('quality_powers' => $quality_powers, 'quality' => $quality));
    }
    
    public function actionCreateQualityPowers($id)
    {
        $model = new QualityPowers();
        $model->quality_id = $id;
        
        $quality = Qualities::findOne(['id' => Yii::$app->request->get('id')]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['index-activities', 'id' => $model->mission_id]);
            return $this->redirect(['index-quality-powers', 'id' => $model->quality_id]);
        } 
        
        return $this->render('quality-powers/create', array('model' => $model, 'quality' => $quality));
    }
    
    public function actionUpdateQualityPowers($id)
    {
        $model = QualityPowers::findOne(['id' => Yii::$app->request->get('id')]);

        $quality = Qualities::findOne(['id' => $model->quality_id]);
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index-quality-powers', 'id' => $model->quality_id]);
        }

        return $this->render('quality-powers/update', array('model' => $model, 'quality' => $quality));
    }
    
    public function actionDeleteQualityPowers()
    {
        $model = QualityPowers::findOne(['id' => Yii::$app->request->get('id')]);
        $mid = $model->quality_id;
        
        if ($model !== null) {
            $model->delete();
        }

        return $this->redirect(['index-quality-powers', 'id' => $mid]);
    }
    
}