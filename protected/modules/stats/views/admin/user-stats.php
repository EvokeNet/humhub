<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\helpers\ArrayHelper;
use backend\models\Standard;
use yii\helpers\Url;
use app\modules\stats\models\StatsUsers;

$this->title = Yii::t('StatsModule.base', 'User Statistics');
$this->params['breadcrumbs'][] = ['label' => Yii::t('StatsModule.base', 'Statistics Reports'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

//var_dump(StatsUsers::find()->all());

?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3><?php echo $this->title; ?></h3>
    </div>
    <div class="panel-body">
        
        <?= Html::dropDownList("created_at", '', ArrayHelper::map(StatsUsers::find()->groupBy('created_at')->all(), 'id', 'created_at'), ['prompt' => '--- select ---', 'id' => 'dates']) ?>

        &nbsp;&nbsp;&nbsp;

        <a href="#" id="stats_link" class="btn-sm btn-info"><?php echo Yii::t('StatsModule.base', 'Download Report'); ?></a>
        
        <br /><br />

        <table class="table">
            <tr>

                <!--<th><?php //echo Yii::t('StatsModule.base', 'Name'); ?></th>-->
                <th><?php echo Yii::t('StatsModule.base', 'Username'); ?></th>
                <th><?php echo Yii::t('StatsModule.base', '# of Evocoins'); ?></th>
                <th><?php echo Yii::t('StatsModule.base', '# of Followers'); ?></th>
                <th><?php echo Yii::t('StatsModule.base', '# of Followees'); ?></th>
                <th><?php echo Yii::t('StatsModule.base', '# of Reviews'); ?></th>
                <th><?php echo Yii::t('StatsModule.base', '# of Evidences'); ?></th>
                <th><?php echo Yii::t('StatsModule.base', 'User or Mentor'); ?></th>
                <th><?php echo Yii::t('StatsModule.base', 'Has Read Novel?'); ?></th>
                <!--<th><?php //echo Yii::t('MissionsModule.base', 'Description'); ?></th>-->
            </tr>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td>
                        <?= Html::a($user['username'], ['/user/profile', 'uguid' => $user['guid']], ['style' => ' font-weight: 700; color: #2273AC;']) ?>
                    </td>
                    <td><?php echo $user['coins']; ?></td>
                    <td><?php echo $user['followers']; ?></td>
                    <td><?php echo $user['following']; ?></td>
                    <td><?php echo $user['votes']; ?></td>
                    <td><?php echo $user['evidences']; ?></td>
                    <td><?php echo ($user['group_id'] == 1) ? Yii::t('StatsModule.base', 'User') : Yii::t('StatsModule.base', 'Mentor'); ?></td>
                    <td><?php echo ($user['has_read_novel'] == 1) ? Yii::t('StatsModule.base', 'Yes') : Yii::t('StatsModule.base', 'No'); ?></td>
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

        $("a#stats_link").attr("href", "<?= Url::to(['/stats/admin/exports-users']) ?>&date="+chosen);

    });

</script>
