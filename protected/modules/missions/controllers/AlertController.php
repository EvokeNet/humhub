<?php

namespace humhub\modules\missions\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class AlertController extends Controller
{

    public static function createAlert($title, $message, $secondary = ""){
        $popup = array_fill_keys(array('title', 'message'),"");
        $popup['title'] = $title;
        $popup['message'] = $message;
        
        if($secondary !=""){
            Yii::$app->session->setFlash('popup2', $popup);
        }else{
            Yii::$app->session->setFlash('popup', $popup);
        }
    }

    public function actionAlert(){
        $popup = null;

        if (!Yii::$app->request->isAjax) {
            //throw new HttpException('403', 'Forbidden access.');
        }

        if (Yii::$app->session->getFlash('popup')) {
            $popup = json_encode(Yii::$app->session->getFlash('popup'));
        }else if(Yii::$app->session->getFlash('popup2')){
            $popup = json_encode(Yii::$app->session->getFlash('popup2'));
        }

        header('Content-Type: application/json; charset="UTF-8"');
        echo $popup;
        Yii::$app->end();
    }        
}
