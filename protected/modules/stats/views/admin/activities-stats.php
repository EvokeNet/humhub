<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$this->title = Yii::t('StatsModule.base', 'Space Statistics');
$this->params['breadcrumbs'][] = ['label' => Yii::t('StatsModule.base', 'Statistics Reports'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3><?php echo $this->title; ?></h3>
    </div>
    <div class="panel-body">
        <h4><?php echo Yii::t('StatsModule.base', 'Total number of evidences: {evidences}', array('evidences' => count($evidences))); ?></h4><br>
        <table class="table">
            <tr>
                <th><?php echo Yii::t('StatsModule.base', 'Name'); ?></th>
                <th><?php echo Yii::t('StatsModule.base', 'Number of evidences'); ?></th>
                <th><?php echo Yii::t('StatsModule.base', '% of submitted evidence for this activity'); ?></th>
            </tr>
            <?php foreach ($activities as $activity): ?>
                <tr>
                    <td><?php echo $activity['title']; ?></td>
                    <td><?php echo count($activity->evidences); ?></td>
                    <td><?php echo number_format((float)(count($activity->evidences)/count($evidences)), 2, '.', ''); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        
    </div>
</div>