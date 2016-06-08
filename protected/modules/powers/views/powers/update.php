<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\powers\models\Powers */

$this->title = Yii::t('PowersModule.base', 'Update {modelClass}: ', [
    'modelClass' => 'Powers',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('PowersModule.base', 'Powers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('PowersModule.base', 'Update');
?>
<div class="powers-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
