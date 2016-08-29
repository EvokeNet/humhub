<?php
$space = $this->context->contentContainer;
?>
<div class="container space-layout-container">
    <div class="row">
        <div class="col-xs-12">
            <?= \humhub\modules\stats\widgets\CustomSpaceHeader::widget(['space' => $space]); ?>
            <?php //echo humhub\modules\space\widgets\Header::widget(['space' => $space]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-2 layout-nav-container">
            <?php echo \humhub\modules\space\widgets\Menu::widget(['space' => $space]); ?>
            <br>
        </div>

        <?php if (isset($this->context->hideSidebar) && $this->context->hideSidebar) : ?>
            <div class="col-xs-10 layout-content-container">
                <?php echo $content; ?>
            </div>
        <?php else: ?>
            <div class="col-xs-7 layout-content-container">
                <?php echo $content; ?>
            </div>
            <div class="col-xs-3 layout-sidebar-container">
                <?php
                echo \humhub\modules\space\widgets\Sidebar::widget(['space' => $space, 'widgets' => [
                        [\humhub\modules\space\modules\manage\widgets\PendingApprovals::className(), ['space' => $space], ['sortOrder' => 10]],
                        [\humhub\modules\missions\widgets\SpaceStream::className(), ['streamAction' => '/space/space/stream', 'contentContainer' => $space], ['sortOrder' => 20]],
                        [\humhub\modules\space\widgets\Members::className(), ['space' => $space], ['sortOrder' => 30]]
                ]]);
                ?>
            </div>
        <?php endif; ?>
    </div>
</div>
