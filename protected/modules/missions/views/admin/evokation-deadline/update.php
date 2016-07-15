<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\missions\models\EvokationDeadline */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Evokation Deadline',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Evokation Deadlines'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<div class="panel panel-default">
    <div class="panel-heading"><strong><?= $this->title ?></strong></div>
    <div class="panel-body">
        
        <div class="evokation-deadline-update">
            
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>

    </div>
</div>
