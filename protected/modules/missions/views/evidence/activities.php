<?php

use yii\helpers\Html;
use humhub\modules\missions\models\Missions;
use yii\widgets\Breadcrumbs;

$this->title = Yii::t('MissionsModule.views_admin_index', 'Activities');
$this->params['breadcrumbs'][] = $this->title;

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            <?php echo Yii::t('MissionsModule.views_admin_index', 'Choose Activity for Mission '); ?> <?php echo $mission->title; ?>
        </h3>
    </div>
    <div class="panel-body">

        <?php 
            $x = 0;
            if (count($mission->activities) != 0): ?>
        
            <table class="table">
                <?php foreach ($mission->activities as $activity): ?>
                    <tr>
                        <td>
                            <strong>
                                <?php echo $activity->title; ?>
                            </strong>
                            <BR>
                            <p class="description">
                                <?php echo $activity->description; ?>
                            </p>
                            <?php echo Html::a('Enter Activity', ['show', 'activityId' => $activity->id, 'sguid' => $contentContainer->guid], array('class' => 'btn btn-success')); ?>
                        </td>
                    </tr>

                <?php endforeach; ?>
            </table>

        <?php else: ?>
            <p><?php echo Yii::t('MissionsModule.views_admin_index', 'No activities created yet!'); ?></p>
        <?php endif; ?>
    </div>
</div>

<style type="text/css">

.description{
    text-align: justify;
}

</style>
