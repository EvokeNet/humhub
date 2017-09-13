<?php

use humhub\modules\space\activities\MemberAdded;  
?>

<?php if($originator !== null && $record->class == MemberAdded::classname()): ?>
    <a href="<?=$originator->getUrl()?>">
<?php elseif ($clickable): ?>
    <a href="#" onClick="activityShowItem(<?= $record->id; ?>); return false;">
<?php endif; ?>
    <li class="activity-entry">
        <div class="media">

            <div class="media-body">

                <div style="">
                    <?php if ($originator !== null) : ?>
                        <!-- Show user image -->
                        <img class="media-object img-rounded pull-left" data-src="holder.js/32x32" alt="32x32"
                             style="height:25px; "
                             src="<?php echo $originator->getProfileImage()->getUrl(); ?>">
                    <?php endif; ?>
                </div>

                <!-- Show content -->
                <div style="top: 50%;
    transform: translateY(-50%);
    position: absolute;
    left: 10%;"><?php echo $content; ?></div><br/>

                <!-- show time -->
                <?php //echo \humhub\widgets\TimeAgo::widget(['timestamp' => $record->content->created_at]); ?>
            </div>
        </div>
    </li>
<?php if ($clickable): ?></a><?php endif; ?>
