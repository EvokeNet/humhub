<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\superhero_identity\models\MatchingAnswers */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Matching Answers',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Matching Answers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="matching-answers-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
