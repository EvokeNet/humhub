<?php

namespace humhub\modules\novel\controllers;

use Yii;
use app\modules\novel\models\NovelPage;
use app\modules\novel\models\Chapter;
use app\modules\novel\models\ChapterPages;
use app\modules\missions\models\Missions;
use app\models\UploadForm;
use yii\web\UploadedFile;

/**
 * AdminController
 *
 */
class AdminController extends \humhub\modules\admin\components\Controller
{

    public function actionChapter()
    {
        $chapters = Chapter::find()->orderBy('number ASC')->all();

        return $this->render('chapter/index', array('chapters' => $chapters));
    }

    public function actionChapterCreate(){
      $model = new Chapter();

      if ($model->load(Yii::$app->request->post())) {

        $mission = Missions::findOne($model->mission_id);

        if($mission->getChapter() != null){
          Yii::$app->session->setFlash('fail', Yii::t('NovelModule.base', 'This mission is already associated to a chapter, choose another one.'));
          return $this->render('chapter/create', array('model' => $model));
        }

        if($model->save())
            return $this->redirect(['chapter']);

      }

      return $this->render('chapter/create', array('model' => $model));

    }

    public function actionChapterUpdate($id)
    {
        $model = Chapter::findOne(['id' => Yii::$app->request->get('id')]);

        if ($model->load(Yii::$app->request->post())) {

          $mission = Missions::findOne($model->mission_id);

          if($mission->getChapter() != null && $mission->getChapter()->id != $model->id){
            Yii::$app->session->setFlash('fail', Yii::t('NovelModule.base', 'This mission is already associated to a chapter, choose another one.'));
            return $this->render('chapter/create', array('model' => $model));
          }

          if($model->save())
              return $this->redirect(['chapter']);
        }

        return $this->render('chapter/update', array('model' => $model));
    }

    public function actionChapterDelete()
    {
        $model = Chapter::findOne(['id' => Yii::$app->request->get('id')]);

        if ($model !== null) {
            $model->delete();
        }

        return $this->redirect(['chapter']);
    }

    public function actionIndex()
    {
        $pages = NovelPage::find()->orderBy('page_number ASC')->all();

        return $this->render('novel-page/index', array('pages' => $pages));
    }

    public function actionCreate()
    {
      $model = new NovelPage();

      if ($model->load(Yii::$app->request->post())) {

        $uploadedFile = UploadedFile::getInstance($model, 'page_image');

        // only upload a file if it was attached
        if ($uploadedFile !== null) {
          $model->page_image = UploadedFile::getInstance($model, 'page_image');
          $model->page_image->saveAs('uploads/' . $model->page_image->baseName . '.' . $model->page_image->extension);
          $model->page_image = 'uploads/' . $model->page_image->baseName . '.' . $model->page_image->extension;
        }

        if($model->save())
            return $this->redirect(['index']);
      }

      return $this->render('novel-page/create', array('model' => $model));
    }

    public function actionUpdate($id)
    {
        $model = NovelPage::findOne(['id' => Yii::$app->request->get('id')]);
        $old_image = $model->page_image;

        if ($model->load(Yii::$app->request->post())) {
          $uploadedFile = UploadedFile::getInstance($model, 'page_image');

          // only upload a file if it was attached
          if ($uploadedFile !== null) {
            $model->page_image = UploadedFile::getInstance($model, 'page_image');
            $model->page_image->saveAs('uploads/' . $model->page_image->baseName . '.' . $model->page_image->extension);
            $model->page_image = 'uploads/' . $model->page_image->baseName . '.' . $model->page_image->extension;
          } else {
            $model->page_image = $old_image;
          }

          if($model->save())
              return $this->redirect(['index']);
        }

        return $this->render('novel-page/update', array('model' => $model));
    }

    public function actionDelete()
    {
        $model = NovelPage::findOne(['id' => Yii::$app->request->get('id')]);

        if ($model !== null) {
            $model->delete();
        }

        return $this->redirect(['index']);
    }

    public function actionIndexChapterPages($id)
    {
        $pages = ChapterPages::find()
        ->where(['chapter_id' => Yii::$app->request->get('id')])
        ->all();

        $chapter = Chapter::findOne(['id' => Yii::$app->request->get('id')]);

        return $this->render('chapter-pages/index', array('pages' => $pages, 'chapter' => $chapter));
    }

    public function actionCreateChapterPages($chapter_id)
    {

      $model = new NovelPage();
      $chapter = Chapter::findOne(['id' => Yii::$app->request->get('chapter_id')]);

      if ($model->load(Yii::$app->request->post())) {

        $uploadedFile = UploadedFile::getInstance($model, 'page_image');

        // only upload a file if it was attached
        if ($uploadedFile !== null) {
          $model->page_image = UploadedFile::getInstance($model, 'page_image');
          $model->page_image->saveAs('uploads/' . $model->page_image->baseName . '.' . $model->page_image->extension);
          $model->page_image = 'uploads/' . $model->page_image->baseName . '.' . $model->page_image->extension;
        }

        //if save page
        if($model->save()){
          $chapter_page = new ChapterPages();
          $chapter_page->chapter_id = $chapter_id;
          $chapter_page->novel_id = $model->id;

          if($chapter_page->save()){
            return $this->redirect(['index-chapter-pages', 'id' => $chapter_id]);
          }
        }
            
      }

      return $this->render('chapter-pages/create', array('model' => $model, 'chapter' => $chapter_id));
    }

    public function actionAddChapterPages($id)
    {
        $model = new ChapterPages();
        $model->chapter_id = $id;

        $chapter = Chapter::findOne(['id' => Yii::$app->request->get('id')]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index-chapter-pages', 'id' => $id]);
        }

        return $this->render('chapter-pages/add', array('model' => $model, 'chapter' => $chapter));
    }

    public function actionUpdateChapterPages($chapter_id, $page_id)
    {
        $model = NovelPage::findOne(['id' => Yii::$app->request->get('page_id')]);
        $old_image = $model->page_image;

        if ($model->load(Yii::$app->request->post())) {
          $uploadedFile = UploadedFile::getInstance($model, 'page_image');

          // only upload a file if it was attached
          if ($uploadedFile !== null) {
            $model->page_image = UploadedFile::getInstance($model, 'page_image');
            $model->page_image->saveAs('uploads/' . $model->page_image->baseName . '.' . $model->page_image->extension);
            $model->page_image = 'uploads/' . $model->page_image->baseName . '.' . $model->page_image->extension;
          } else {
            $model->page_image = $old_image;
          }

          if($model->save())
              return $this->redirect(['index-chapter-pages', 'id' => $chapter_id]);
        }

        return $this->render('chapter-pages/update', array('model' => $model));
    }

    public function actionDeleteChapterPages()
    {
        $model = ChapterPages::findOne(['chapter_id' => Yii::$app->request->get('chapter_id'), 'novel_id' => Yii::$app->request->get('page_id')]);
        $mid = $model->chapter_id;

        if ($model !== null) {
            $model->delete();
        }

        return $this->redirect(['index-chapter-pages', 'id' => $mid]);
    }

}
