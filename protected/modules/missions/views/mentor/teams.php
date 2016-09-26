<?php

use yii\helpers\Html;
use humhub\modules\space\models\Space;
use yii\helpers\Url;

$teams_count = count($teams);

?>

<div class="container" style="width: 700px">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default" id="teams-panel">
                <div class="panel-heading">
                    <?php if($this->context->action->actionMethod === "actionMyteams"): ?>
                        <?php echo Yii::t('MissionsModule.mentor', '<strong>My Teams</strong>'); ?>
                    <?php elseif($this->context->action->actionMethod === "actionTeams"): ?>
                        <?php echo Yii::t('MissionsModule.mentor', '<strong>Teams</strong>'); ?>
                    <?php endif; ?>
                </div>

                <ul class="media-list">
                    
                    <?php if($teams_count <= 0): ?>
                        <div class="panel-body">

                            <?php if($this->context->action->actionMethod === "actionMyteams"): ?>
                                <h5><?php echo Yii::t('MissionsModule.mentor', 'Oops, there is no team here yet.'); ?></h5>
                                <h5><?php echo Yii::t('MissionsModule.mentor', 'Follow a team to add it to the list.'); ?></h6>
                                <br>
                                <h5>
                                    Go to the 
                                    <a href="<?= Url::to(['/missions/mentor/teams']) ?>">teams page</a> and start following a team.
                                </h5>
                            <?php elseif($this->context->action->actionMethod === "actionTeams"): ?>
                                <h5><?php echo Yii::t('MissionsModule.mentor', 'Oops, there is no team here yet.'); ?></h5>
                            <?php endif; ?>
                            
                        </div>
                    <?php endif; ?>

                    <?php foreach ($teams as $team) : ?>
                       <li>
                            <?php $space = Space::findOne($team->id) ?>

                            <!-- Follow Handling -->
                            <div class="pull-right">
                                <?php
                                if (!Yii::$app->user->isGuest) {
                                    $followed = $space->isFollowedByUser();
                                    echo Html::a(Yii::t('DirectoryModule.views_directory_members', 'Follow'), 'javascript:setFollow("' . $space->createUrl('/teams/team/follow') . '", "' . $space->id . '")', array('class' => 'btn btn-info btn-sm ' . (($followed) ? 'hide' : ''), 'id' => 'button_follow_' . $space->id));
                                    echo Html::a(Yii::t('DirectoryModule.views_directory_members', 'Unfollow'), 'javascript:setUnfollow("' . $space->createUrl('/teams/team/unfollow') . '", "' . $space->id . '")', array('class' => 'btn btn-primary btn-sm ' . (($followed) ? '' : 'hide'), 'id' => 'button_unfollow_' . $space->id));
                                }
                                ?>
                            </div>

                            <div class="media">
                                <?php echo \humhub\modules\space\widgets\Image::widget([
                                    'space' => $space,
                                    'width' => 50,
                                    'htmlOptions' => [
                                        'class' => 'media-object',
                                    ],
                                    'link' => 'true',
                                    'linkOptions' => [
                                        'class' => 'pull-left',
                                    ],
                                ]); ?>

                                <div class="media-body">
                                    <h4 class="media-heading"><a
                                            href="<?php echo $team->getUrl(); ?>"><?php echo Html::encode($team->name); ?></a>
                                    </h4>
                                    <h5><?php echo Html::encode(humhub\libs\Helpers::truncateText($team->description, 100)); ?></h5>

                                    <?php $tag_count = 0; ?>
                                    <?php if ($team->hasTags()) : ?>
                                        <?php foreach ($team->getTags() as $tag): ?>
                                            <?php if ($tag_count <= 5) { ?>
                                                <?php echo Html::a(Html::encode($tag), ['/directory/directory/spaces', 'keyword' => $tag], array('class' => 'label label-default')); ?>
                                                <?php
                                                $tag_count++;
                                            }
                                            ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                </div>
                            </div>

                        </li>
                    <?php endforeach; ?>

                    <?php if($teams_count > 0): ?>
                        <div class="panel-body">

                            <?php if($this->context->action->actionMethod === "actionMyteams"): ?>
                                <div><?php echo Yii::t('MissionsModule.mentor', 'Follow a team to add it to the list.'); ?></div>
                                <br>
                                <div>
                                    Go to the 
                                    <a href="<?= Url::to(['/missions/mentor/teams']) ?>">teams page</a> and start following a team.
                                </div>
                            <?php endif; ?>
                            
                        </div>
                    <?php endif; ?>

                </ul>

            </div>
        </div>
    </div>
</div>    

<script type="text/javascript">
    // ajax request to follow the user
    function setFollow(url, id) {
        jQuery.ajax({
            url: url,
            type: "POST",
            success: function (e) {
                console.log(e);
                $("#button_follow_" + id).addClass('hide');
                $("#button_unfollow_" + id).removeClass('hide');
            }
        });
    }

    // ajax request to unfollow the user
    function setUnfollow(url, id) {
        jQuery.ajax({
            url: url,
            type: "POST",
            'success': function () {
                $("#button_follow_" + id).removeClass('hide');
                $("#button_unfollow_" + id).addClass('hide');
            }
        });
    }

</script>

