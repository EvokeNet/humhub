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
        
        <p style = "float:right">
            <?= Html::a(Yii::t('MissionsModule.base', 'Update'), ['update', 'id' => $model->id, 'sguid' => $contentContainer->guid], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('MissionsModule.base', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('MissionsModule.base', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        </p>
            
        <h3><?= Yii::t('MissionsModule.base', 'Title: {title}', array('title' => $model->title)) ?></h3>

    </div>
    <div class="panel-body">
        
        <div class="evokations-view">

            <h5><?= Yii::t('MissionsModule.base', 'Description: {description}', array('description' => $model->description)) ?></h5><br>
            <h5><?= Yii::t('MissionsModule.base', 'Google Drive Link: ') ?>&nbsp;<a href="//<?= $model->gdrive_url ?>"><?= $model->gdrive_url ?></a></h5><br>
            <h5><?= Yii::t('MissionsModule.base', 'Elevator Pitch:') ?></h5><br>
            
            <iframe width="640" height="420" src="http://www.youtube.com/embed/<?php echo $model->getYouTubeCode($model->youtube_url)?>" frameborder="0" allowfullscreen></iframe>
            <!--<iframe width="620" height="420" src="http://www.youtube.com/embed/<?php //echo $model->getYouTubeCode('https://www.youtube.com/watch?v=w12kbScuayI')?>" frameborder="0" allowfullscreen></iframe>-->
            <!--<iframe width="620" height="420" src="https://www.youtube.com/embed/nVWX67mWZGE" frameborder="0" allowfullscreen></iframe>-->
            <!--<iframe width="420" height="315" src="https://www.youtube.com/embed/watch?v=nVWX67mWZGE" frameborder="0" allowfullscreen></iframe>-->
        </div>
    </div>
</div>