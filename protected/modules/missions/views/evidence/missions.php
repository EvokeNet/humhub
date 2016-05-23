<?php

use yii\helpers\Html;
use app\modules\missions\models\Missions;
use yii\widgets\Breadcrumbs;

$this->title = Yii::t('MissionsModule.views_admin_index', 'Missions');
$this->params['breadcrumbs'][] = $this->title;

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3><?php echo Yii::t('MissionsModule.views_admin_index', 'Missions'); ?></h3>
    </div>
    <div class="panel-body">

        <?php 
            $x = 0;
            if (count($missions) != 0): ?>
        
            <table class="table">
                <?php foreach ($missions as $mission): ?>
                    <tr>
                        <td>
                            <strong>
                                <?php echo $mission->title; ?>
                            </strong>
                            <BR>
                            <p class="description">
                                <?php echo $mission->description; ?>
                            </p>
                            <?php echo Html::a('Enter Mission', ['activities', 'missionId' => $mission->id, 'sguid' => $contentContainer->guid], array('class' => 'btn btn-success')); ?>
                        </td>
                    </tr>

                <?php endforeach; ?>
            </table>

        <?php else: ?>
            <p><?php echo Yii::t('MissionsModule.views_admin_index', 'No missions created yet!'); ?></p>
        <?php endif; ?>
    </div>
</div>

<style type="text/css">

.description{
    text-align: justify;
}

</style>
