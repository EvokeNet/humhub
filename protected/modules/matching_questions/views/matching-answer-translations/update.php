<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model humhub\modules\matching_questions\models\MatchingAnswerTranslations */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Matching Answer Translations',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Matching Answer Translations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="matching-answer-translations-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
