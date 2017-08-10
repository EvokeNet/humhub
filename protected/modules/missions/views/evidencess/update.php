<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\missions\models\Evidence */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Evidence',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Evidences'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="evidence-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
