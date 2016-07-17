<?php

namespace humhub\modules\teams\controllers;

use Yii;
use yii\web\Controller;
use app\modules\teams\models\Space;

/**
 * AdminController
 *
 */
class AdminController extends \humhub\modules\admin\components\Controller
{
    
    public function actionIndex()
    {
        $powers = Powers::find()->all();
        return $this->render('powers/index', array('powers' => $powers));
    }


    public function actionUpdate($id)
    {
        $model = Powers::findOne(['id' => Yii::$app->request->get('id')]);

        if ($model->load(Yii::$app->request->post())) {
            // $model->image = UploadedFile::getInstance($model, 'image');
            // var_dump($model->image);
            // var_dump(is_null($model->image));
            // die();    
            
            if($model->save())
                return $this->redirect(['index']);
        } 

        return $this->render('powers/update', array('model' => $model));
    }
    
    public function actionDelete()
    {
        $model = Powers::findOne(['id' => Yii::$app->request->get('id')]);

        if ($model !== null) {
            $model->delete();
        }

        return $this->redirect(['index']);
    }
    
}