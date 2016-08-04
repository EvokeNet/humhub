<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\missions\models\Evokations */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('MissionsModule.base', 'Evokations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="panel panel-default">
    <div class="panel-heading">
        
        <p style = "text-align:right; margin-top:10px">
            <?= Html::a(Yii::t('MissionsModule.base', 'Update'), ['update', 'id' => $model->id, 'sguid' => $contentContainer->guid], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('MissionsModule.base', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('MissionsModule.base', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        </p>
            
        

    </div>
    <div class="panel-body">
        
        <div class="evokations-view grey-box" style = "word-break: break-all; padding:20px; margin-bottom:15px">
            <h3 style = "margin: 20px 0 40px; line-height:30px"><?php echo $model->title; // Yii::t('MissionsModule.base', '<strong>Title:</strong> {title}', array('title' => $model->title)) ?></h3>
            <h5 style = "margin: 30px 0; line-height:30px"><?php echo $model->description; // Yii::t('MissionsModule.base', '<strong>Description:</strong> {description}', array('description' => $model->description)) ?></h5>
            <h6 style = "margin: 30px 0 5px; line-height:30px"><?= Yii::t('MissionsModule.base', '<strong>Google Drive URL:</strong>') ?>&nbsp;<a href="//<?= $model->gdrive_url ?>"><?= $model->gdrive_url ?></a></h6>
            <!--<h6 style = "margin: 30px 0 5px; line-height:30px"><?php // Yii::t('MissionsModule.base', '<strong>Elevator Pitch:</strong>') ?></h6>-->
            
            <!--<iframe width="605" height="420" src="http://www.youtube.com/embed/<?php echo $model->getYouTubeCode($model->youtube_url)?>" frameborder="0" allowfullscreen></iframe>-->
            <!--<iframe width="620" height="420" src="http://www.youtube.com/embed/<?php //echo $model->getYouTubeCode('https://www.youtube.com/watch?v=w12kbScuayI')?>" frameborder="0" allowfullscreen></iframe>-->
            <!--<iframe width="620" height="420" src="https://www.youtube.com/embed/nVWX67mWZGE" frameborder="0" allowfullscreen></iframe>-->
            <!--<iframe width="420" height="315" src="https://www.youtube.com/embed/watch?v=nVWX67mWZGE" frameborder="0" allowfullscreen></iframe>-->
        </div>
        
        <iframe width="605" height="420" src="http://www.youtube.com/embed/<?php echo $model->getYouTubeCode($model->youtube_url)?>" frameborder="0" allowfullscreen></iframe>
    </div>
</div>