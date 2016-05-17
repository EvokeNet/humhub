<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="panel panel-default members" id="space-members-panel">
    <div class="panel-heading">

    </div>
    <div class="panel-body">
    	<h3>
    		<a href='<?= Url::to(['/missions/evidence']) ?>'>
        		Submit Evidence
        	</a>
        </h3>
        <h4>
        	Read Missions
        </h4>
        <h4>
        Rate Evidence
        </h4>
    </div>
</div>

<style type="text/css">

.panel-body{
	text-align: center;
}

</style>