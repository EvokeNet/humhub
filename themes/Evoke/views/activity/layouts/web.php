<?php

use humhub\modules\space\activities\MemberAdded;  
?>

<?php if($record->class == MemberAdded::classname()): ?>
    <a href="<?=$originator->getUrl()?>">
<?php elseif ($clickable): ?>
    <a href="#" onClick="activityShowItem(<?= $record->id; ?>); return false;">
<?php endif; ?>
    <li class="activity-entry">
        <div class="media">
            <?php if ($originator !== null) : ?>
                <!-- Show user image -->
                <img class="media-object img-rounded pull-left" data-src="holder.js/32x32" alt="32x32"
                     style="    width: 50px;
    height: 50px;
    border-radius: 50%;
    border: 3px solid #254054;
    margin-right: 10px;"
                     src="<?php echo $originator->getProfileImage()->getUrl(); ?>">
            <?php endif; ?>

            <!-- Show space image, if you are outside from a space -->
            <?php //if (!Yii::$app->controller instanceof \humhub\modules\content\components\ContentContainerController && $record->content->space !== null): ?>
                <?php //echo \humhub\modules\space\widgets\Image::widget([
                    // 'space' => $record->content->space,
                    // 'width' => 20,
                    // 'htmlOptions' => [
                    //     'class' => 'img-space-aux pull-left',
                    // ]
                // ]); ?>
            <?php //endif; ?>

            <div class="media-body">

                <!-- Show content -->
                <?php echo $content; ?><br/>

                <!-- show time -->
                <?php echo \humhub\widgets\TimeAgo::widget(['timestamp' => $record->content->created_at]); ?>
            </div>
        </div>
    </li>
<?php if ($clickable): ?></a><?php endif; ?>
