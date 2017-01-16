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
        				<?= $evidence_no_content_total ?> out of <?= $evidences_total ?> evidences have no content (<?= $evidence_no_content_percentage ?>%) <?= $evidence_no_content_icon ?> <?= $evidence_no_content_log ?>
        				<br>
        				<?= $evidence_no_wall_entry_total ?> out of <?= $evidences_total ?> evidences have no wall entry (<?= $evidence_no_wall_entry_percentage ?>%) <?= $evidence_no_wall_entry_icon ?> <?= $evidence_no_wall_entry_log ?>
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
        				<?= $votes_no_content_total ?> out of <?= $votes_total ?> reviews have no content (<?= $votes_no_content_percentage ?>%) <?= $votes_no_content_icon ?> <?= $votes_no_content_log ?>
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

			<div class="col-xs-12" style="text-align: left">
				<ul>
					<li>All <b>Humhub's</b> objects are <b>ContentActiveRecords</b>. They must be related to a <b>Content</b> object.</li>
					<li>If it's desirable that a <b>Humhub's</b> object is loaded at a stream, then it must be related to a <b>Wall Entry</b> object.</li>
					<li>Teams' Streams are loaded with <b>evidences</b> objects.</li>
					<li><b>Reviews</b> aren't loaded by any stream on Evoke, then they don't require a <b>Wall Entry</b> object.</li>
				</ul>
			</div>

        </div>
    </div>
</div>