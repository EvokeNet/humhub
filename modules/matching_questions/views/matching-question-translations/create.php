<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model humhub\modules\matching_questions\models\MatchingQuestionTranslations */

$this->title = Yii::t('app', 'Create Matching Question Translations');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Matching Question Translations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="matching-question-translations-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
