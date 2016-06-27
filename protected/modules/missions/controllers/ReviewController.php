<?php

namespace humhub\modules\missions\controllers;

use Yii;
use app\modules\missions\models\Evidence;
use humhub\modules\file\models\File;

use app\modules\missions\models\EvidenceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use humhub\modules\content\components\ContentContainerController;
use app\modules\missions\models\Missions;
use app\modules\missions\models\Activities;
use app\modules\languages\models\Languages;
use app\modules\powers\models\UserPowers;
use app\modules\powers\models\Powers;
use app\modules\missions\models\ActivityPowers;
use app\modules\missions\models\Votes;
use humhub\modules\missions\controllers\AlertController;
use humhub\modules\user\models\User;

class ReviewController extends ContentContainerController
{

    public function actions()
    {

    }   

   
    public function actionIndex()
    {   
        $evidence_id = 61;


        $evidence = Evidence::findOne($evidence_id);
        $files = File::findAll(array('object_model' => Evidence::classname(), 'object_id' => $evidence_id));
        return $this->render('index', array('contentContainer' => $this->contentContainer, 'evidence' => $evidence, 'files' => $files));
    }

}
