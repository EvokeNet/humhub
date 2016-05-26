<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\matching_questions\models\Qualities */

$this->title = Yii::t('MatchingModule.base', 'Create Qualities');
$this->params['breadcrumbs'][] = ['label' => Yii::t('MatchingModule.base', 'Qualities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qualities-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
