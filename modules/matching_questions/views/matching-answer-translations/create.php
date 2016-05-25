<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model humhub\modules\matching_questions\models\MatchingAnswerTranslations */

$this->title = Yii::t('app', 'Create Matching Answer Translations');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Matching Answer Translations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="matching-answer-translations-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
