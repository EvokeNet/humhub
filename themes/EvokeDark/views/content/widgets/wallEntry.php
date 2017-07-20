<?php

use yii\helpers\Html;
use humhub\modules\space\models\Space;
use humhub\modules\user\models\User;
use humhub\modules\content\components\ContentContainerController;
use app\modules\teams\models\Team;

$user = $object->content->user;

try {
    $container = $object->content->container;
} catch(Exception  $e){

    // if object has no content, delete it
    $object->delete();
    header("Refresh:0");
    return;
}

$team_id = Team::getUserTeam($user->id);

if($team_id){
    $team = Team::findOne($team_id);
}else{
    $team = null;
}

?>

<div class="panel panel-default wall_<?php echo $object->getUniqueId(); ?>">
    <div class="panel-body">

        <div class="media" style="margin-top: 5px">

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
                     data-src="holder.js/40x40"
                     src="<?php echo $user->getProfileImage()->getUrl(); ?>"
                     width="45" height="45"/>
            </a>

            <!-- Show space image, if you are outside from a space -->
            <?php if (!Yii::$app->controller instanceof ContentContainerController && $object->content->container instanceof Space): ?>
                <?php 
                // echo \humhub\modules\space\widgets\Image::widget([
                //     'space' => $object->content->container,
                //     'width' => 20,
                //     'htmlOptions' => [
                //         'class' => 'img-space',
                //     ],
                //     'link' => 'true',
                //     'linkOptions' => [
                //         'class' => 'pull-left',
                //     ],
                // ]); 
                ?>

            <?php endif; ?> 


            <div class="media-body">

                <!-- show username with link and creation time-->
                <h4 class="media-heading" style = "margin: 5px 0">
                    <?php if (!$object instanceof \humhub\modules\post\models\Post) : ?>
                        <!-- <span class="label label-border pull-right"><?php //echo $object->getContentName(); ?></span> -->
                        <a href="<?php echo $user->getUrl(); ?>"><?= $user->displayName ?></a>
                            <?php //echo Yii::t('ContentModule.views_wallLayout', '{name} created a new <span class="label label-border">{content}</span>', array('name' => $user->displayName, 'content' => $object->getContentName())); ?>
                            <span style="color:#A6AAB6"><?php echo Yii::t('ContentModule.views_wallLayout', 'posted an {content}', array('name' => $user->displayName, 'content' => $object->getContentName())); ?></span>
                        
                    <?php else: ?>
                        <a href="<?php echo $user->getUrl(); ?>">
                            <?php echo Yii::t('ContentModule.views_wallLayout', '{name}', array('name' => $user->displayName)); ?>
                        </a>
                    <?php endif; ?>
                </h4>
                
                <span>

                    <?php if (!Yii::$app->controller instanceof ContentContainerController && $container instanceof Space): ?>
                        <?php echo Yii::t('ContentModule.views_wallLayout', '{date} &nbsp;|&nbsp; space', array('date' => date('F j, Y', strtotime($object->content->created_at)))); ?> <strong><a href="<?php echo $container->getUrl(); ?>"><?php echo Html::encode($container->name); ?></a></strong>&nbsp;
                    <?php endif; ?>

                    <?php //echo \humhub\modules\content\widgets\WallEntryLabels::widget(['object' => $object]); ?>
                   
                </span>
                <!--<h5><?php //echo Html::encode($user->profile->title); ?></h5>-->

            </div>

            <div class="content" id="wall_content_<?php echo $object->getUniqueId(); ?>" style="margin-top:20px">
                <?php echo $content; ?>
            </div>

            <?php echo \humhub\modules\content\widgets\WallEntryAddons::widget(['object' => $object]); ?>
        </div>


    </div>

</div>