<div class="container profile-layout-container">
    <div class="row">
        <div class="col-sm-12">
            <?php 

            if($user->group->name != "Mentors"){
                echo \humhub\modules\stats\widgets\CustomProfileHeader::widget(['user' => $user]); 
            }else{
                echo \humhub\modules\stats\widgets\CustomUserProfileHeader::widget(['user' => $user]);
            }
             
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2 layout-nav-container">
            <?= \humhub\modules\user\widgets\ProfileMenu::widget(['user' => $user]); ?>
        </div>

        <?php if (isset($this->context->hideSidebar) && $this->context->hideSidebar) : ?>
            <div class="col-sm-10 layout-content-container">
                <?php //echo $content; ?>
            </div>
        <?php else: ?>
            <div class="col-sm-7 layout-content-container">

	            <div class="panel panel-default">
				    <div class="panel-heading">
				        <h4 class="margin-top-10"><strong><?php echo Yii::t('AchievementsModule.base', 'Achievements'); ?></strong></h4>
				    </div>
				    <div class="panel-body">

				    	<?php foreach($achievements as $a): ?>

                            <?php $is_there = false; 
                                foreach($user_achievements as $u): 
                                    if($a->id == $u->achievement_id): $is_there = true; break; endif; 
                                endforeach;
                                 
                            $a_title = (isset($a->achievementTranslations[0]) && Yii::$app->language == 'es') ? $a->achievementTranslations[0]->title : $a->title;

                            $a_desc = (isset($a->achievementTranslations[0]) && Yii::$app->language == 'es') ? $a->achievementTranslations[0]->description : $a->description;

                            if($is_there): ?>

                                <!-- <div class="achievements-box row" style="line-height: 82px;">
                                    <div class="col-sm-3"><div class="t-icon"><i class="fa fa-trophy fa-2x" aria-hidden="true"></i></div></div>
                                    <div class="col-sm-9">
                                        <span data-toggle="tooltip" data-placement="top" title="<?php echo $a_desc; ?>"><?php echo $a_title; ?></span>
                                        <span><?php echo $a_desc; ?></span>
                                    </div>
                                    

                                    
                                </div> -->

                                <div class="achievements-box" style="line-height: 82px;" style="margin-top:15px">
                                    <div class="t-icon"><i class="fa fa-trophy fa-2x" aria-hidden="true"></i></div>
                                    <div class="t-titles"><span data-toggle="tooltip" data-placement="top"  title="<?php echo $a_desc; ?>"><?php echo $a_title; ?></span></div>
                                </div><br />

				    		<?php else: ?>
	
				    			<div class="achievements-box t-opaque" style="line-height: 82px;" style="margin-top:15px">
				    				<div class="t-icon"><i class="fa fa-trophy fa-2x" aria-hidden="true"></i></div>
				    				<div class="t-titles"><span data-toggle="tooltip" data-placement="top"  title="<?php echo $a_desc; ?>"><?php echo $a_title; ?></span></div>
				    			</div><br />

				    		<?php endif; ?>
				    		
				    	<?php endforeach; ?>

				    </div>
			    </div>

            </div>
            <div class="col-sm-3 layout-sidebar-container">
                <?php
                echo \humhub\modules\user\widgets\ProfileSidebar::widget([
                    'user' => $user,
                    'widgets' => [
                        [\humhub\modules\user\widgets\UserTags::className(), ['user' => $user], ['sortOrder' => 10]],
                        [\humhub\modules\user\widgets\UserSpaces::className(), ['user' => $user], ['sortOrder' => 20]],
                        [\humhub\modules\user\widgets\UserFollower::className(), ['user' => $user], ['sortOrder' => 30]],
                    ]
                ]);
                ?>
            </div>
        <?php endif; ?>
    </div>
</div>