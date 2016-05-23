<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model app\modules\missions\models\Missions */

$this->title = $mission->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Missions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">

        <div class="col-md-8 col-md-offset-2">
            
            <?php
                echo Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]);   
            ?>
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2><?php echo Yii::t('MissionsModule.views_view', 'Mission').' '.$mission->title; ?></h2>
                    <p><?php echo $mission->description; ?></p>
                </div>
                <div class="panel-body">
                    
                    <h4><strong><?php echo Yii::t('MissionsModule.views_view', 'Activities'); ?></strong></h4>
                    
                    <br>
                    
                    <?php if (count($mission->activities) != 0): ?>
                    
                        <table class="table">
                            <tr>
                                <th><?php echo Yii::t('MissionsModule.views_view', 'Title'); ?></th>
                                <th><?php echo Yii::t('MissionsModule.views_view', 'Description'); ?></th>
                                <th>&nbsp;</th>
                            </tr>
                            <?php foreach ($mission->activities as $activity): ?>
                                <tr>
                                    <td><?php echo $activity->title; ?></td>
                                    <td><?php echo $activity->description; ?></td>
                                    <td>
                                        <?php //echo Html::a('Post Evidence', '', array('class' => 'btn btn-success')); ?>
                                        <?php //echo Html::a('View Mission', ['view', 'id' => $mission->id], array('class' => 'btn btn-success btn-xs')); ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>

                    <?php else: ?>

                        <p><?php echo Yii::t('MissionsModule.views_view', 'No missions created yet!'); ?></p>

                    <?php endif; ?>

                </div>
            </div>

    </div>
</div>
