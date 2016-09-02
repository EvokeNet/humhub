<?php

use yii\helpers\Html;
use humhub\modules\space\models\Space;
use humhub\modules\space\models\Membership;

?>

<div class="container">
    <div class="row">
        <div class="col-xs-12">

            <div class="panel panel-default">

			    <div class="panel-heading">
			    	<b>
			    		<?= $space->name ?>
			    	</b>
			    	Access Request
			    </div>

			    <div class="panel-body">
			    	<?php

			    	if ($membership === null) {
					    if ($space->canJoin()) {
					        if ($space->join_policy == Space::JOIN_POLICY_APPLICATION) {
					        	echo Yii::t('MissionsModule.contact', 'Request membership to obtain access to ');
					        	echo Html::tag("b", $space->name);
					        	echo Yii::t('MissionsModule.contact', ' space.');
					        	echo "<br><br>";
					            echo Html::a(Yii::t('SpaceModule.widgets_views_membershipButton', 'Request membership'), $space->createUrl('/missions/membership/request-membership-form'), array('class' => 'btn btn-cta2', 'data-target' => '#globalModal'));
					        } else {
					        	echo Yii::t('MissionsModule.contact', 'Become a member to obtain access to ');
					        	echo Html::tag("b", $space->name);
					        	echo Yii::t('MissionsModule.contact', ' space.');
					        	echo "<br><br>";
					            echo Html::a(Yii::t('SpaceModule.widgets_views_membershipButton', 'Become member'), $space->createUrl('/missions/membership/request-membership'), array('class' => 'btn btn-cta2', 'data-method' => 'POST'));
					        }
					    }
					} elseif ($membership->status == Membership::STATUS_INVITED) {
					    ?>
					    <div class="btn-group">
					    	<?php
					    		echo Yii::t('MissionsModule.contact', 'Become a member to obtain access to ');
					        	echo Html::tag("b", $space->name);
					        	echo Yii::t('MissionsModule.contact', ' space.');
					        	echo "<br><br>";
					    	?>
					        <?php echo Html::a(Yii::t('SpaceModule.widgets_views_membershipButton', 'Accept Invite'), $space->createUrl('/missions/membership/invite-accept'), array('class' => 'btn btn-cta1', 'data-method' => 'POST')); ?>
					        <button type="button" class="btn btn-cta1 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					            <span class="caret"></span>
					            <span class="sr-only">Toggle Dropdown</span>
					        </button>
					        <ul class="dropdown-menu">
					            <li><?php echo Html::a(Yii::t('SpaceModule.widgets_views_membershipButton', 'Deny Invite'), $space->createUrl('/missions/membership/revoke-membership'), array('data-method' => 'POST')); ?></li>
					        </ul>
					    </div>
					    <?php
					} elseif ($membership->status == Membership::STATUS_APPLICANT) {
						echo Yii::t('MissionsModule.contact', 'You\'ve already sent a membership request to access ');
					    echo Html::tag("b", $space->name);
					    echo Yii::t('MissionsModule.contact', ' space.');
					    echo "<br>";
					    echo Yii::t('MissionsModule.contact', 'Please, wait until the space owner responds to your requisition.');
					    echo "<br><br>";
					    echo Html::a(Yii::t('SpaceModule.widgets_views_membershipButton', 'Cancel pending membership application'), $space->createUrl('/missions/membership/revoke-membership'), array('class' => 'btn btn-cta2'));
					}

			    	?>
			    </div>
			 </div>
		</div>
	</div>
</div>
