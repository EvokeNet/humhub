<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\missions\models\Evokations */

$this->title = Yii::t('app', 'Create Evokations');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Evokations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evokations-create">

    <h1><?php // Html::encode($this->title) ?></h1>
    
    <?= \humhub\modules\missions\widgets\WallCreateEvokationForm::widget([
    'contentContainer' => $contentContainer,
    'submitButtonText' => Yii::t('MissionsModule.widgets_EvokationFormWidget', 'Submit Evokation'),
    // 'activity' => $activity,
        ]) ?>
    
    <?php $canCreateEvidences = $contentContainer->permissionManager->can(new \humhub\modules\missions\permissions\CreateEvokation()); ?>
    
</div>
