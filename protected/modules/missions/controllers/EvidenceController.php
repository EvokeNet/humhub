<?php

namespace humhub\modules\missions\controllers;

use Yii;
use app\modules\missions\models\Evidence;
use app\modules\missions\models\EvidenceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use humhub\modules\content\components\ContentContainerController;

class EvidenceController extends ContentContainerController
{

    public function actions()
    {
        return array(
            'stream' => array(
                'class' => \humhub\modules\missions\components\StreamAction::className(),
                'mode' => \humhub\modules\missions\components\StreamAction::MODE_NORMAL,
                'contentContainer' => $this->contentContainer
            ),
        );
    }	

   
    /**
     * Posts a new question  throu the question form
     *
     * @return type
     */
    public function actionShow()
    {	
      return $this->render('show', array(
                    'contentContainer' => $this->contentContainer
        ));
    }

        /**
     * Posts a new question  throu the question form
     *
     * @return type
     */
    public function actionCreate()
    {
        if (!$this->contentContainer->permissionManager->can(new \humhub\modules\missions\permissions\CreateEvidence())) {
            throw new HttpException(400, 'Access denied!');
        }
        
        $evidence = new Evidence();
        $evidence->scenario = Evidence::SCENARIO_CREATE;
        $evidence->title = Yii::$app->request->post('title');
       	$evidence->text = Yii::$app->request->post('text');
        return \humhub\modules\missions\widgets\WallCreateForm::create($evidence, $this->contentContainer);
    }

}
