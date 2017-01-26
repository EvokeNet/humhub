<?php

namespace humhub\modules\novel\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\modules\novel\models\NovelPage;
use humhub\modules\user\models\User;
use app\modules\powers\models\UserPowers;
use app\modules\powers\models\Powers;
use app\modules\matching_questions\controllers\MatchingQuestionsController;
use app\modules\languages\models\Languages;
use humhub\models\Setting;
use app\modules\missions\models\forms\EvokeSettingsForm;


/**
 * Novel Controller
 *
 */
class NovelController extends Controller
{
    public function actionIndex()
    {
        $pages = NovelPage::find()->orderBy('page_number ASC')->all();

        return $this->render('novel/index', array('pages' => $pages));
    }

    public function actionGraphicNovel($page)
    {
      $novel_order = Setting::Get('novel_order');

      $language = Languages::find()->where(['code' => Yii::$app->language])->one();

      if(!$language){
        $language = Languages::find()->where(['code' => 'en-US'])->one();
      } 

      /*$novel_pages = NovelPage::find()->where(['language_id' => $language->id])->all();
      $page_count = count($novel_pages);

      if ($page > $page_count) {
        return $this->redirect(['transformation']);
      }
      */

      $page = NovelPage::find()->where(['page_number' => $page, 'language_id' => $language->id])->one();

      //page doesn't exist or mission is locked
      if(!$page || ($page->chapter && $page->chapter->mission->locked)){
        if($novel_order == EvokeSettingsForm::FIRST_NOVEL){
          return $this->redirect(['transformation']);
        }else{
          $user = Yii::$app->user->getIdentity();
          $user->has_read_novel = true;
          $user->save();
          return $this->redirect(['/']);
        }
      }

      return $this->render('novel/page', array('page' => $page));
    }

    public function actionTransformation()
    {
      $user = Yii::$app->user->getIdentity();
      MatchingQuestionsController::setInitialPowers();

      //make sure user hasn't already read the graphic novel
      if ($user->has_read_novel || $user->group->name == "Mentors") {
        //send em home
        return $this->redirect(['/']);
      } else {
        $power = Powers::find()->where(['title' => 'Transformation'])->one();
        if (isset($power)) {
          $points_to_level = floor(($power->improve_multiplier * pow(1,1.95)) + $power->improve_offset);
          //give them enough transformation points to get to the 1st level
          UserPowers::addPowerPoint($power, $user, $points_to_level);

          //mark that user has read the novel so they don't get double points
          $user->has_read_novel = true;
          $user->save();

          return $this->render('novel/transformation', array('points' => $points_to_level));
        } else {
          //couldn't find the power, go home
          return $this->redirect(['/']);
        }
      }
    }
}
