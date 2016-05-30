<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\powers\models\UserQualities */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'User Qualities',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Qualities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="user-qualities-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
