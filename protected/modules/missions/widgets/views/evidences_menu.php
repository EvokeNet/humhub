<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <strong>
            Evidences
        </strong>
    menu
    </div>
    <div class="list-group submit-body">
    	<div class= "list-group-item">
    		<a href='<?= $space->createUrl('/missions/evidence/create'); ?>'>
        		Submit Evidence
        	</a>
        </div>
        <div class= "list-group-item">
        	Read Missions
        </div>
        <div class= "list-group-item">
            Rate Evidence
        </div>
    </div>
</div>

