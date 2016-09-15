<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\helpers\ArrayHelper;
use backend\models\Standard;
use yii\helpers\Url;

use app\modules\stats\models\StatsActivities;
use app\modules\stats\models\StatsGeneral;
use app\modules\stats\models\StatsUsers;
use app\modules\stats\models\StatsSpaces;

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
        
        <?php

        // Html::dropdownList(
        //     ArrayHelper::map(StatsUsers::find()->all(), 'id', 'created_at'),
        //     ['prompt' => Yii::t('StatsModule.base', 'Select Category')]
        // ) 
        // Html::dropdownList('created_at',
        //     ArrayHelper::map(StatsUsers::find()->all(), 'id', 'created_at'),
        //     ['prompt' => Yii::t('StatsModule.base', 'Select Category')]
        // ) 

        // echo Html::dropDownList('listname', array('empty' => '(Select a gender)'), 
        //       array('M' => 'Male', 'F' => 'Female'),
        //       array('empty' => '(Select a gender)'));
        
        //echo Html::dropDownList("created_at", '', ArrayHelper::map(StatsUsers::find()->groupBy('created_at')->all(), 'id', 'created_at'), array('empty' => '(Select a gender)'));

        echo Html::dropDownList("created_at", '', ArrayHelper::map(StatsUsers::find()->groupBy('created_at')->all(), 'id', 'created_at'), ['prompt' => '--- select ---', 'id' => 'dates']);

        echo '&nbsp;&nbsp;&nbsp;';

        // echo Html::a(
        //     Yii::t('StatsModule.base', 'Download Report'), 
        //     [''], array('class' => 'btn-sm btn-danger')); 

        echo '<a href="#" id="stats_link" class="btn-sm btn-info">'.'Download Report'.'</a>';
        
        echo '<br /><br />';

        // echo Html::dropDownList('created_at', array(), 
        //       ArrayHelper::map(StatsUsers::find()->groupBy('created_at')->all(), 'id', 'created_at'),
        //       array('empty' => '(Select a gender)'));

              ?>

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
                    <!--<td><?php //echo $user['firstname'].' '.$user['lastname']; ?></td>-->
                    <td><?php echo $user['username']; ?></td>
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