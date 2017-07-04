<?php

// use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\missions\models\Activities;
use app\modules\missions\models\Evidence;

?>

<div class="panel panel-default portfolio">
    <div class="panel-heading">
        <strong>
            <?= Yii::t('MissionsModule.base', 'General Progress Indicator') ?>
        </strong>
    </div>
    <div class="panel-body">

        <div style="margin-top:10px">

        <?php foreach($missions as $m): 

        	$p = 0;

        	if(count($m->activities) > 0)
        		$p = 3/count($m->activities); 

        	//echo $p;

        	//echo $mission_progress[$m->id]; echo count($m->activities); ?>
        	<span style="text-align:center; display:block"><?php echo Yii::t('MissionsModule.base', 'Mission {position}', array('position' => $m['position'])); ?></span>

        	<?php if(round($p*100) == 0): ?>

        		<div class="progress" style="height:25px">
				  <div class="progress-bar" role="progressbar"
				  aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="background:#f0ad4e; width:100%">
				    <?= Yii::t('MissionsModule.base', 'NOT STARTED') ?>
				  </div>
				</div><br>

        	<?php elseif(round($p*100) == 100): ?>

        		<div class="progress" style="height:25px;">
				  <div class="progress-bar" role="progressbar"
				  aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="background:#28C503; width:100%">
				    <?= Yii::t('MissionsModule.base', 'COMPLETED') ?>
				  </div>
				</div><br>

        	<?php else: ?>
        		
        		<div class="progress" style="height:25px">
				  <div class="progress-bar" role="progressbar"
				  aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:<?= round($p*100) ?>%">
				    <?= Yii::t('MissionsModule.base', '{number}%', array('number' => round($p*100))) ?>
				  </div>
				</div><br>

        	<?php endif; ?>

        <?php endforeach; ?>

        <span style="text-align:center; display:block"><?php echo Yii::t('MissionsModule.base', 'Evokation'); ?></span>
        <div class="progress" style="height:25px">
		  <div class="progress-bar" role="progressbar"
		  aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="background:#f0ad4e; width:100%">
		    <?= Yii::t('MissionsModule.base', 'NOT STARTED') ?>
		  </div>
		</div><br>

        </div>
    </div>
</div>