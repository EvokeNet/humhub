<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\superhero_identity\models\MatchingQuestions */

$this->title = Yii::t('app', 'Create Matching Questions');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Matching Questions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="matching-questions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
