<?php

use yii\helpers\Html;
use yii\helpers\Url;


?>

<div class="panel panel-default">
    <div class="panel-heading">
        <strong>
            <?= $powers[0]->getPower()->getQualityPowers()[0]->getQualityObject()->name ?>
            <?php
                $userQuality = $powers[0]->getUserQuality();
                if(null != $userQuality){
                    echo "<div class='btn-default btn-circle'>" . $userQuality->getLevel() . "</div>";
                }
                
            ?>
        </strong>
    </div>
    <div class="list-group submit-body">
    	<?php foreach($powers as $userPower): ?>
    	<?php $power = $userPower->getPower(); ?>
	    	<div class="list-group-item">
	    		<?= isset($power->powerTranslations[0]) ? $power->powerTranslations[0]->title : $power->title ?>
           - 
           <?= Yii::t('PowersModule.base', 'Level') ?> <?= $userPower->getLevel() ?>
	    	</div>
    	<?php endforeach; ?>
        <?php 
            if (empty($powers)){
                echo "<div class='list-group-item'>";
                echo Yii::t('PowersModule.base', 'This user must answer psychometric questionnaire first.');
                echo "</div>";
            }
        ?>
    </div>
</div>