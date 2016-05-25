<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use humhub\compat\CActiveForm;

$this->title = Yii::t('MissionsModule.base', 'Create new Activity');
$this->params['breadcrumbs'][] = ['label' => Yii::t('MissionsModule.base', 'Missions'), 'url' => ['index', 'id' => $mission->id]];
$this->params['breadcrumbs'][] = Yii::t('MissionsModule.base', 'Mission').' '.$mission->id_code;
$this->params['breadcrumbs'][] = ['label' => Yii::t('MissionsModule.base', 'Activities'), 'url' => ['index-activities', 'id' => $mission->id]];
$this->params['breadcrumbs'][] = $this->title;
        
echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

?>
<div class="panel panel-default">
    <div class="panel-heading"><strong><?php echo $this->title; ?></strong></div>
    <div class="panel-body">

        <div class="activities-create">

            <?= $this->render('_form', [
                'model' => $model
            ]) ?>

        </div>

    </div>
</div>