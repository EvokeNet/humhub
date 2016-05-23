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
    		<a href='<?= $space->createUrl('/missions/evidence/missions'); ?>'>
        		Submit Evidence
        	</a>
        </div>
        <div class= "list-group-item">
            <a href='#'>
        	   Read Missions
            </a>
        </div>
        <div class= "list-group-item">
            <a href='#'>
                Rate Evidence
            </a>
        </div>
    </div>
</div>

