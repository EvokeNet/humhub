<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\missions\models\Evokations */

$this->title = Yii::t('MissionsModule.base', 'Update {modelClass}: ', [
    'modelClass' => 'Evokations',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('MissionsModule.base', 'Evokations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('MissionsModule.base', 'Update');
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <div class="panel-body">    
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>