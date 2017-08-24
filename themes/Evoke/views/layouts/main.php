<?php

use yii\helpers\Html;
use humhub\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <!-- start: Meta -->
        <meta charset="utf-8">
        <title><?php echo $this->pageTitle; ?></title>
        <!-- end: Meta -->

        <!-- start: Mobile Specific -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <!-- end: Mobile Specific -->
        <?= Html::csrfMetaTags() ?>
        <?php $this->head() ?>

        <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="<?php echo Yii::getAlias(" @web"); ?>/js/html5shiv.js"></script>
        <
        link
        id = "ie-style"
        href = "<?php echo Yii::getAlias("
        @
        web
        "); ?>/css/ie.css"
        rel = "stylesheet" >
        <![endif]-->

        <!--[if IE 9]>
        <link id="ie9style" href="<?php echo Yii::getAlias(" @web"); ?>/css/ie9.css" rel="stylesheet">
        <![endif]-->

        <!-- start: render additional head (css and js files) -->
        <?php echo $this->render('head'); ?>
        <!-- end: render additional head -->


        <!-- start: Favicon and Touch Icons -->
        <link rel="icon" type="image/png" sizes="192x192"
              href="<?php echo Yii::getAlias("@web"); ?>/ico/evoke-icon-400x.png">
        <link rel="icon" type="image/png" sizes="32x32"
              href="<?php echo Yii::getAlias("@web"); ?>/ico/evoke-icon-200x.png">
        <link rel="icon" type="image/png" sizes="96x96"
              href="<?php echo Yii::getAlias("@web"); ?>/ico/evoke-icon-300x.png">
        <link rel="icon" type="image/png" sizes="16x16"
              href="<?php echo Yii::getAlias("@web"); ?>/ico/evoke-icon.png">
        <link rel="manifest" href="/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/evoke-icon-400x.png">
        <meta name="theme-color" content="#ffffff">
        <meta charset="<?= Yii::$app->charset ?>">
        <!-- end: Favicon and Touch Icons -->

        <!-- Include stylesheet -->
        <link href="https://cdn.quilljs.com/1.1.10/quill.snow.css" rel="stylesheet">
        <!-- Include the Quill library -->
        <script src="https://cdn.quilljs.com/1.1.10/quill.js"></script>

        <!-- Green Sock library -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TweenMax.min.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenLite.min.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/plugins/CSSPlugin.min.js"></script>

    </head>

    <body>
    <?php $this->beginBody() ?>

    <?php include_once("analyticstracking.php") ?>
    
    <!-- start: first top navigation bar -->
    <div id="topbar-first" class="topbar">
        <div class="container">
            <div class="topbar-brand hidden-xs">
                <?php echo \humhub\widgets\SiteLogo::widget(); ?>
            </div>

            <div class="topbar-actions pull-right">
                <?php echo \humhub\modules\user\widgets\AccountTopMenu::widget(); ?>
            </div>

            <div class="notifications pull-right">

                <?php
                echo \humhub\widgets\NotificationArea::widget(['widgets' => [
                    [\humhub\modules\notification\widgets\Overview::className(), [], ['sortOrder' => 10]],
                ]]);
                ?>

            </div>

        </div>

    </div>
    <!-- end: first top navigation bar -->


    <!-- start: second top navigation bar -->
    <div id="topbar-second" class="topbar">
        <div class="container">
            <ul class="nav ">
                <!-- load space chooser widget -->
                <?php echo \humhub\modules\space\widgets\Chooser::widget(); ?>

                <!-- load navigation from widget -->
                <?php echo \humhub\widgets\TopMenu::widget(); ?>
            </ul>

            <ul class="nav pull-right" id="search-menu-nav">
                <?php echo \humhub\widgets\TopMenuRightStack::widget(); ?>
            </ul>
        </div>
    </div>

    <!-- end: second top navigation bar -->

    <?php echo \humhub\modules\tour\widgets\Tour::widget(); ?>

    <!-- start: show content (and check, if exists a sublayout -->
    <?php if (isset($this->context->subLayout) && $this->context->subLayout != "") : ?>
        <?php echo $this->render($this->context->subLayout, array('content' => $content)); ?>
    <?php else: ?>
        <?php echo $content; ?>
    <?php endif; ?>
    <!-- end: show content -->

    <!-- start: Modal (every lightbox will/should use this construct to show content)-->
    <div class="modal" id="globalModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <?php echo \humhub\widgets\LoaderWidget::widget(); ?>
                </div>
            </div>
        </div>
    </div>
    <!-- end: Modal -->
    
    <footer class="footer">
      <div class="container">
        <p class="text-muted"><i class="fa fa-copyright" aria-hidden="true"></i> Copyright 2017 - World Bank</p>
        <p class = "right">
        <?php //echo Html::a(
            //Yii::t('StaticsModule.base', 'About'), 
            //['/static_pages/static-pages/about'], array('class' => 'bordered')); ?>
        <?php //echo Html::a(
            //Yii::t('StaticsModule.base', 'Privacy Policy'), 
            //['/static_pages/static-pages/privacy-policy'], array('class' => 'bordered')); ?>
        <?php echo Html::a(
            Yii::t('StaticsModule.base', 'Terms & Conditions'), 
            ['/statics/statics/terms-conditions'], array('class' => '')); ?>
         </p>                       
      </div>
    </footer>
    
    <?php echo \humhub\models\Setting::GetText('trackingHtmlCode'); ?>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>