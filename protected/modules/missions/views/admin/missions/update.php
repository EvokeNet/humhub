<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use humhub\compat\CActiveForm;

// $this->title = Yii::t('MissionsModule.base', 'Update Mission');
// $this->params['breadcrumbs'][] = ['label' => Yii::t('MissionsModule.base', 'Missions'), 'url' => ['index']];
// $this->params['breadcrumbs'][] = Yii::t('MissionsModule.base', 'Mission').' '.$model->id_code;
// $this->params['breadcrumbs'][] = $this->title;

// $this->title = Yii::t('MissionsModule.base', 'Update {modelClass}: ', [
//     'modelClass' => 'Missions',
// ]) . $model->id_code;
$this->title = Yii::t('MissionsModule.base', 'Update Mission');
$this->params['breadcrumbs'][] = ['label' => Yii::t('MissionsModule.base', 'Missions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('MissionsModule.base', 'Mission: {alias}', ['alias' => $model->id_code]), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
        
echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

?>
<div class="panel panel-default">
    <div class="panel-heading"><strong><?php echo $this->title; ?></strong></div>
    <div class="panel-body">
        
        <div class="missions-create">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>

    </div>
</div>