<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\helpers\ArrayHelper;
use backend\models\Standard;
use yii\helpers\Url;
use app\modules\stats\models\StatsSpaces;

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
        
        <?= Html::dropDownList("created_at", '', ArrayHelper::map(StatsSpaces::find()->groupBy('created_at')->all(), 'id', 'created_at'), ['prompt' => '--- select ---', 'id' => 'dates']) ?>

        &nbsp;&nbsp;&nbsp;

        <a href="#" id="stats_link" class="btn-sm btn-info"><?php echo Yii::t('StatsModule.base', 'Download Report'); ?></a>
        
        <br /><br />
        
        <table class="table">
            <tr>
                <th><?php echo Yii::t('StatsModule.base', 'Name'); ?></th>
                <!--<th><?php //echo Yii::t('StatsModule.base', 'Username'); ?></th>-->
                <th><?php echo Yii::t('StatsModule.base', 'Total Users on each team'); ?></th>
                <th><?php echo Yii::t('StatsModule.base', 'Evidences Submitted by team'); ?></th>
                <th><?php echo Yii::t('StatsModule.base', 'Total reviews by team'); ?></th>
            </tr>
            <?php foreach ($spaces as $space): ?>
                <tr>
                    <td>
                        <?= Html::a($space['name'], ['/space/space', 'sguid' => $space['guid']], ['style' => ' font-weight: 700; color: #2273AC;']) ?>
                    </td>
                    <td><?php echo $space['members']; ?></td>
                    <td><?php echo $space['evidences']; ?></td>
                    <td><?php echo $space['reviews']; ?></td>
                    <!--<td><?php //echo $mission->description; ?></td>-->
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

        $("a#stats_link").attr("href", "<?= Url::to(['/stats/admin/exports-spaces']) ?>&date="+chosen);

    });

</script>
