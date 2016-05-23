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
            <a href='' class="unavailable">
        	   Unavailable - Read Missions
            </a>
        </div>
        <div class= "list-group-item">
            <a href='' class="unavailable">
                Unavailable - Rate Evidence
            </a>
        </div>
    </div>
</div>

<style type="text/css">

.unavailable{
    color: white;
    text-shadow: -0.5px 0 gray, 0 0.5px gray, 2px 0 gray, 0 -0.5px gray;
}

.unavailable:hover{
    color: white;
}

</style>