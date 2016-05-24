<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\powers\models\QualityPowers */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Quality Powers',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Quality Powers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="quality-powers-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
