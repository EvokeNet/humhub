<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\matching_questions\models\SuperheroIdentities */

$this->title = Yii::t('MatchingModule.base', 'Create Superhero Identities');
$this->params['breadcrumbs'][] = ['label' => Yii::t('MatchingModule.base', 'Superhero Identities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="superhero-identities-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
