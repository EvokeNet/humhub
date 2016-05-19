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

   
    /**
     * Posts a new question  throu the question form
     *
     * @return type
     */
    public function actionCreate()
    {	
      return $this->render('show', array(
                    'contentContainer' => $this->contentContainer
        ));
    }

}
