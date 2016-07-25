<?php

use yii\helpers\Html;
use humhub\modules\space\models\Space;
use humhub\modules\user\models\User;
use humhub\modules\content\components\ContentContainerController;
use app\modules\teams\models\Team;

$user = $object->content->user;
$container = $object->content->container;

$team_id = Team::getUserTeam(Yii::$app->user->getIdentity()->id);
if($team_id){
    $team = Team::findOne($team_id);
}else{
    $team = null;
}

?>

<div class="panel panel-default wall_<?php echo $object->getUniqueId(); ?>">
    <div class="panel-body">

        <div class="media">

            <!-- start: show wall entry options -->
            <ul class="nav nav-pills preferences">
                <li class="dropdown ">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-angle-down"></i></a>
                    <ul class="dropdown-menu pull-right">
                        <?php echo \humhub\modules\content\widgets\WallEntryControls::widget(['object' => $object, 'wallEntryWidget' => $wallEntryWidget]); ?>
                    </ul>
                </li>
            </ul>
            <!-- end: show wall entry options -->

            <a href="<?php echo $user->getUrl(); ?>" class="pull-left">
                <img class="media-object img-rounded user-image user-<?php echo $user->guid; ?>" alt="40x40"
                     data-src="holder.js/40x40" style="width: 40px; height: 40px;"
                     src="<?php echo $user->getProfileImage()->getUrl(); ?>"
                     width="40" height="40"/>
            </a>

            <!-- Show space image, if you are outside from a space -->
            <?php if (!Yii::$app->controller instanceof ContentContainerController && $object->content->container instanceof Space): ?>
                <?php echo \humhub\modules\space\widgets\Image::widget([
                    'space' => $object->content->container,
                    'width' => 20,
                    'htmlOptions' => [
                        'class' => 'img-space',
                    ],
                    'link' => 'true',
                    'linkOptions' => [
                        'class' => 'pull-left',
                    ],
                ]); ?>

            <?php endif; ?>


            <div class="media-body">

                <!-- show username with link and creation time-->
                <h4 class="media-heading" style = "margin-bottom:5px">
                    <a href="<?php echo $user->getUrl(); ?>">
                        <?php if($team): ?>
                            <?php echo Yii::t('ContentModule.views_wallLayout', '{name} @ {team}', array('name' => $user->displayName, 'team' => $team->name)); ?>
                        <?php else: ?>
                            <?php echo Yii::t('ContentModule.views_wallLayout', '{name}', array('name' => $user->displayName)); ?>
                        <?php endif ?> 
                    </a>
                </h4>
                
                <span>
                        <?php echo \humhub\widgets\TimeAgo::widget(['timestamp' => $object->content->created_at]); ?>

                        <?php if ($object->content->created_at !== $object->content->updated_at && $object->content->updated_at != ''): ?>
                            (<?php echo Yii::t('ContentModule.views_wallLayout', 'Updated :timeago', array(':timeago' => \humhub\widgets\TimeAgo::widget(['timestamp' => $object->content->updated_at]))); ?>)
                        <?php endif; ?>

                        <!-- show space name -->
                        <?php if (!Yii::$app->controller instanceof ContentContainerController && $container instanceof Space): ?>
                            <?php echo Yii::t('ContentModule.views_wallLayout', 'in'); ?> <strong><a
                                    href="<?php echo $container->getUrl(); ?>"><?php echo Html::encode($container->name); ?></a></strong>&nbsp;
                        <?php endif; ?>

                        <?php //echo \humhub\modules\content\widgets\WallEntryLabels::widget(['object' => $object]); ?>
                   
                </span>
                <!--<h5><?php //echo Html::encode($user->profile->title); ?></h5>-->

            </div>
            <hr/>

            <div class="content" id="wall_content_<?php echo $object->getUniqueId(); ?>">
                <?php if (!$object instanceof \humhub\modules\post\models\Post) : ?>
                    <span class="label label-border pull-right"><?php echo $object->getContentName(); ?></span>
                <?php endif; ?>
                <?php echo $content; ?>
            </div>

            <?php echo \humhub\modules\content\widgets\WallEntryAddons::widget(['object' => $object]); ?>
        </div>


    </div>

</div>