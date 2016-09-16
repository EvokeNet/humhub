<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\helpers\ArrayHelper;
use backend\models\Standard;
use yii\helpers\Url;
use app\modules\stats\models\StatsActivities;

$this->title = Yii::t('StatsModule.base', 'Activities Statistics');
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

        <?= Html::dropDownList("created_at", '', ArrayHelper::map(StatsActivities::find()->groupBy('created_at')->all(), 'id', 'created_at'), ['prompt' => '--- select ---', 'id' => 'dates']) ?>

        &nbsp;&nbsp;&nbsp;

        <a href="#" id="stats_link" class="btn-sm btn-info"><?php echo Yii::t('StatsModule.base', 'Download Report'); ?></a>
        
        <br /><br />

        <h4><?php echo Yii::t('StatsModule.base', 'Total number of evidences: {evidences}', array('evidences' => count($evidences))); ?></h4><br>
        <table class="table">
            <tr>
                <th><?php echo Yii::t('StatsModule.base', 'Name'); ?></th>
                <th><?php echo Yii::t('StatsModule.base', 'Mission'); ?></th>
                <th><?php echo Yii::t('StatsModule.base', 'Number of evidences'); ?></th>
                <th><?php echo Yii::t('StatsModule.base', '% of submitted evidence for this activity'); ?></th>
            </tr>
            <?php foreach ($activities as $activity): ?>
                <tr>
                    <td><?php echo $activity['title']; ?></td>
                    <td><?php echo $activity->mission['title']; ?></td>
                    <td><?php echo count($activity->evidences); ?></td>
                    <td><?php echo number_format((float)(count($activity->evidences)/count($evidences)), 2, '.', ''); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        
    </div>
</div>

<script>
    var x = document.getElementById("dates").value;

    console.log(x);

    $('#dates').change(function() {
        // console.log('The option with value ' + $(this).val() + ' and text ' + $(this).text() + ' was selected.');

        var x = document.getElementById("dates");
        
        if (x.val == -1)
            console.log(null);
        
        console.log(x.value);
        console.log(x.options[x.selectedIndex].text);

        var chosen = x.options[x.selectedIndex].text;

        $("a#stats_link").attr("href", "<?= Url::to(['/stats/admin/exports-activities']) ?>&date="+chosen);

    });

</script>