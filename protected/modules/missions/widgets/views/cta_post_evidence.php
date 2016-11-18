<?php

// use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="panel panel-default">
    <div class="panel-heading">
        <strong><?= Yii::t('MissionsModule.base', 'Submit Evidence') ?></strong>
    </div>
    <div class="list-group submit-body">
    	<div class= "list-group-item">
            <?php if($member): ?>
        		<a class = "btn btn-primary" href='<?= Url::to(['/missions/evidence/missions', 'sguid' => $member->space->guid]); ?>'>
            		<?= Yii::t('MissionsModule.base', 'Choose a mission') ?>
            	</a>
                <a class = "btn btn-primary" href='<?= Url::to(['/missions/review/index', 'sguid' => $member->space->guid]) ?>'>
            		<?= Yii::t('MissionsModule.base', 'Review evidences') ?>
            	</a>
            <?php endif; ?>
        </div>
    </div>
</div>