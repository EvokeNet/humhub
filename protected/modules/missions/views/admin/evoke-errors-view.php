<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use humhub\compat\CHtml;

$fa_check = "<i class=\"fa fa-check\"></i>";
$fa_close = "<i class=\"fa fa-times\"></i>";

$evidence_no_content_icon = $evidence_no_content_percentage == 0 ? $fa_check : $fa_close;
$evidence_no_wall_entry_icon = $evidence_no_wall_entry_percentage == 0 ? $fa_check : $fa_close;

$votes_no_content_icon = $votes_no_content_percentage == 0 ? $fa_check : $fa_close;

$evidences_error = $evidence_no_content_percentage > 0 || $evidence_no_wall_entry_percentage > 0 ? true : false;
$reviews_error = $votes_no_content_percentage > 0  ? true : false;

$evidence_no_content_log = $evidence_no_content_percentage > 0 ? "<a target=\"_blank\" class=\"log\" href=\"".Url::to(['/missions/admin/evidences-no-content-log'])."\">LOG</a>" : "";
$evidence_no_wall_entry_log = $evidence_no_wall_entry_percentage > 0 ? "<a target=\"_blank\" class=\"log\" href=\"".Url::to(['/missions/admin/evidences-no-wall-entry-log'])."\">LOG</a>" : "";
$votes_no_content_log = $votes_no_content_percentage > 0 ? "<a target=\"_blank\" class=\"log\" href=\"".Url::to(['/missions/admin/votes-no-content-log'])."\">LOG</a>" : "";

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
        				<?= $evidence_no_content_percentage ?>% of evidences have no content <?= $evidence_no_content_icon ?> <?= $evidence_no_content_log ?>
        				<br>
        				<?= $evidence_no_wall_entry_percentage ?>% of evidences have no wall entry <?= $evidence_no_wall_entry_icon ?> <?= $evidence_no_wall_entry_log ?>
        			</div>
        			<div class="check">
        				<?php if($evidences_error): ?>
        					<i class="fa fa-times-circle"></i>
        				<?php else: ?>
        					<i class="fa fa-check-circle"></i>
        				<?php endif; ?>
        			</div>
        			<?php if($evidences_error): ?>
        				<a type="button" href="<?= Url::to(['/missions/admin/fix-evidences']) ?>" class="btn btn-md btn-fix" >
        					Fix
        				</a>
        			<?php endif; ?>
        		</div>
			</div>

			<div class="col-xs-6">
        		<div class="<?= $reviews_error ? 'btn-danger' : 'btn-success' ?> bug-box">
        			<div class="title">
        				Reviews
        			</div>
        			<div class="content">
        				<?= $votes_no_content_percentage ?>% of reviews have no content <?= $votes_no_content_icon ?> <?= $votes_no_content_log ?>
        				<br>
        				By default, all reviews have no wall entry <?= $fa_check ?>
        			</div>
        			<div class="check">
        				<?php if($reviews_error): ?>
        					<i class="fa fa-times-circle"></i>
        				<?php else: ?>
        					<i class="fa fa-check-circle"></i>
        				<?php endif; ?>
        			</div>
        			<?php if($reviews_error): ?>
        				<a type="button" href="<?= Url::to(['/missions/admin/fix-votes']) ?>" class="btn btn-md btn-fix ">
        					Fix
        				</a>
        			<?php endif; ?>
        		</div>
			</div>


        </div>
    </div>
</div>

<style>

.log {
	color: white;
	background-color: #b50d0d;
	font-size: 12px;
	font-weight: bold;
	margin-left: 3px;
	padding-left: 5px;
	padding-right: 5px;
}

.log:hover{
	color: #b50d0d;
	background-color: white;
}

.log:active{
	color: #b50d0d;
	background-color: white;
}

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