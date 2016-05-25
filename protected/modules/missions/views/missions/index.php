<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\missions\models\MissionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Missions');
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
                    <h2><?php echo Yii::t('MissionsModule.base', 'Missions'); ?></h2>
                </div>
                <div class="panel-body">
                    
                    <?php if (count($missions) != 0): ?>
                    
                        <table class="table">
                            <tr>
                                <th><?php echo Yii::t('MissionsModule.base', 'ID'); ?></th>
                                <th><?php echo Yii::t('MissionsModule.base', 'Title'); ?></th>
                                <th><?php echo Yii::t('MissionsModule.base', 'Description'); ?></th>
                                <th>&nbsp;</th>
                            </tr>
                            <?php foreach ($missions as $mission): ?>
                                <tr>
                                    <td><?php echo $mission->id; ?></td>
                                    <td><?php echo $mission->missionTranslations[0]->title; ?></td>
                                    <td><?php echo $mission->missionTranslations[0]->description; ?></td>
                                    <?php //foreach ($mission->missionTranslations as $m): ?>
                                        <!--<td><?php //echo $m->title; ?></td>-->
                                        <!--<td><?php //echo $m->description; ?></td>-->
                                    <?php //endforeach; ?>
                                    <td>
                                        <?php echo Html::a('Enter Mission', ['view', 'id' => $mission->id], array('class' => 'btn btn-success')); ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>

                    <?php else: ?>

                        <p><?php echo Yii::t('MissionsModule.base', 'No missions created yet!'); ?></p>

                    <?php endif; ?>

                </div>
            </div>

    </div>
</div>
