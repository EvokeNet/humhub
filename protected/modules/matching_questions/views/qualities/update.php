<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\matching_questions\models\Qualities */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Qualities',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Qualities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="qualities-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
