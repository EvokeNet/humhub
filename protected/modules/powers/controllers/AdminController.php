<?php

namespace humhub\modules\powers\controllers;

use Yii;
use yii\web\Controller;
use app\models\UploadForm;
use yii\web\UploadedFile;
use app\modules\powers\models\Powers;
use app\modules\powers\models\PowerTranslations;

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

    public function actionCreate()
    {
        $model = new Powers();

        if ($model->load(Yii::$app->request->post())) {
          $model->image = UploadedFile::getInstance($model, 'image');
          $model->image->saveAs('uploads/' . $model->image->baseName . '.' . $model->image->extension);
          $model->image = 'uploads/' . $model->image->baseName . '.' . $model->image->extension;

            if($model->save())
                return $this->redirect(['index']);
        }

        return $this->render('powers/create', array('model' => $model));
    }

    public function actionUpdate($id)
    {
        $model = Powers::findOne(['id' => Yii::$app->request->get('id')]);

        if ($model->load(Yii::$app->request->post())) {

            if(isset($model->image)){
                $model->image = UploadedFile::getInstance($model, 'image');
                $model->image->saveAs('uploads/' . $model->image->baseName . '.' . $model->image->extension);
                $model->image = 'uploads/' . $model->image->baseName . '.' . $model->image->extension;
            }
            
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

    /**
    * Matching Questions Translations actions
    *
    */

    public function actionIndexPowerTranslations($id)
    {
        $translations = PowerTranslations::find()
        ->where(['power_id' => Yii::$app->request->get('id')])
        ->with('language')
        ->all();

        $power = Powers::findOne(['id' => Yii::$app->request->get('id')]);

        return $this->render('power-translations/index', array('translations' => $translations, 'power' => $power));
    }

    public function actionCreatePowerTranslations($id)
    {
        $model = new PowerTranslations();
        $model->power_id = $id;

        $power = Powers::findOne(['id' => Yii::$app->request->get('id')]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index-power-translations', 'id' => $id]);
        }

        return $this->render('power-translations/create', array('model' => $model, 'power' => $power));
    }

    public function actionUpdatePowerTranslations($id)
    {
        $model = PowerTranslations::findOne(['id' => Yii::$app->request->get('id')]);

        $power = Powers::findOne(['id' => $model->power_id]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index-power-translations', 'id' => $model->power_id]);
        }

        return $this->render('power-translations/update', array('model' => $model, 'power' => $power));
    }

    public function actionDeletePowerTranslations()
    {
        $model = PowerTranslations::findOne(['id' => Yii::$app->request->get('id')]);
        $mid = $model->power_id;

        if ($model !== null) {
            $model->delete();
        }

        return $this->redirect(['index-power-translations', 'id' => $mid]);
    }

}
