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
	    		<?= isset($power->powerTranslations[0]) ? $power->powerTranslations[0]->title : $power->title ?> - <?= $userPower->value ?> <?= Yii::t('PowersModule.base', 'points') ?>
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


<style type="text/css">

.btn-circle {
  width: 30px;
  height: 30px;
  text-align: center;
  padding: 6px 0;
  font-size: 12px;
  line-height: 1.42;
  border-radius: 15px;
  display: inline-block;
}

</style>