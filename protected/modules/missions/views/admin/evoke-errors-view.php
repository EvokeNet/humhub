<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use humhub\compat\CHtml;

$fa_check = "<i class=\"fa fa-check\"></i>";
$fa_close = "<i class=\"fa fa-times\"></i>";

$evidences_error = true;
$reviews_error = false;


?>
<div class="panel panel-default">
    <div class="panel-heading"><?php echo Yii::t('MissionsModule.base', '<strong>Evoke\'s</strong> Errors View'); ?></div>
    <div class="panel-body" style="padding: 0 10px">
        <div class="table-responsive" style="text-align: center">

        	<div class="col-xs-6">
        		<div class="<?= $evidences_error ? 'btn-danger' : 'btn-success' ?> bug-box">
        			<div class="title">
        				Evidences
        			</div>
        			<div class="content">
        				5% of evidences have no content <?= $fa_close ?>
        				<br>
        				15% of evidences have no wall entry <?= $fa_close ?>
        			</div>
        			<div class="check">
        				<?php if($evidences_error): ?>
        					<i class="fa fa-times-circle"></i>
        				<?php else: ?>
        					<i class="fa fa-check-circle"></i>
        				<?php endif; ?>
        			</div>
        			<?php if($evidences_error): ?>
        				<button type="button" class="btn btn-md btn-fix">
        					Fix
        				</button>
        			<?php endif; ?>
        		</div>
			</div>

			<div class="col-xs-6">
        		<div class="<?= $reviews_error ? 'btn-danger' : 'btn-success' ?> bug-box">
        			<div class="title">
        				Reviews
        			</div>
        			<div class="content">
        				0% of reviews have no content <?= $fa_check ?>
        				<br>
        				0% of reviews have no wall entry <?= $fa_check ?>
        			</div>
        			<div class="check">
        				<?php if($reviews_error): ?>
        					<i class="fa fa-times-circle"></i>
        				<?php else: ?>
        					<i class="fa fa-check-circle"></i>
        				<?php endif; ?>
        			</div>
        			<?php if($reviews_error): ?>
        				<button type="button" class="btn btn-lg btn-fix">
        					Fix
        				</button>
        			<?php endif; ?>
        		</div>
			</div>


        </div>
    </div>
</div>

<style>

.bug-box{
	margin-top: 10%;
	margin-bottom: 10%;
	width: 380px;
	height: 290px;
}

.bug-box .title{
	padding-top: 2%;
	font-weight: bold;
	font-size: 20px;
}

.bug-box .content{
	padding-top: 2%;
}

.bug-box .check{
	padding-top: 1%;
	font-size: 100px;
}

.btn-danger:hover{
	background: #ff8989 !important;
}

.btn-success:hover{
	background: #97d271 !important;
}

.btn-fix{
	background: #d9534f;
	color: white;
	width: 210px;
}

.btn-fix:hover{
	background: white;
	color: #ff8989;
}

</style>