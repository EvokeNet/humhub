<?php

use yii\helpers\Html;

$this->pageTitle = Yii::t('UserModule.views_auth_createAccount', 'Create Account');
?>

<div class="container" style="text-align: center;">
    <h1 id="app-title" class="animated fadeIn"><?php echo Html::encode(Yii::$app->name); ?></h1>
    <br/>

    <div id="player"></div>

    <br/>
    <br/>

    <div class="row">
        <div id="create-account-form" class="panel panel-default animated bounceIn" style="max-width: 500px; margin: 0 auto 20px; text-align: left;">
            <div class="panel-heading"><?php echo Yii::t('UserModule.views_auth_createAccount', '<strong>Agent</strong> registration'); ?></div>
            <div class="panel-body">
                <p style = "font-style:italic">&ldquo;<?php echo Yii::t('UserModule.views_auth_createAccount', "This is Alchemy, and this is an Urgent Evoke. Wherever you are, whoever you are, if you found this message, it's your destiny to join us."); ?>&rdquo;</p>
                <p><?php echo Yii::t('UserModule.views_auth_createAccount', "You have demonstrated your courage, and your commitment is unquestionable. The first thing we need is to update the Evoke database Evoke with the following fields and agree to the following terms:"); ?></p><br>
                <p>
                  As a member of the Evoke Literacy community (whether a mentor or agent), I understand and agree to the following:
                </p>
                <ul>
                  <li>I will be responsible and ethical in my interactions with children and other vulnerable populations.</li>
                  <li> I will work to protect these populations from getting hurt. </li>
                  <li>I will ensure that the children and guardians know they have a choice to participate.</li>
                  <li>I will respect the culture of the individuals with which I interact.</li>
                  <li>I will be sure to speak clearly and in a language easily understood by children and adults.</li>
                  <li>I will not make promises that can’t be kept.</li>
                  <li>I will respect the privacy of the children and other populations, always making sure to ask before recording what is spoken or taking pictures/video.</li>
                  <li>I will keep identities confidential and respect the wishes of the participants.</li>
                  <li>I will act appropriately when working with others, respecting their space, time, and needs.</li>
                  <li>If during my Evoke Literacy work, I come in contact with a child or person who is in need of help-then I will report the issue to the proper authorities.</li>
                </ul>
                <p>By clicking the create account link, I understand that it is my responsibility to ensure the safety of childrenand vulnerable populations I come in contact through my work on Evoke Literacy.</p>

                <?php $form = \yii\widgets\ActiveForm::begin(['enableClientValidation' => false]); ?>
                <?php echo $hForm->render($form); ?>
                <?php \yii\widgets\ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

<style>
</style>

<script src="http://www.youtube.com/player_api"></script>

<script type="text/javascript">

    var player;
        function onYouTubePlayerAPIReady() {
            player = new YT.Player('player', {
              height: '315',
              width: '560',
              videoId: 'Nzueroug_90',
              playerVars: {
                'autoplay': 1,
                'controls': 0,
                'showinfo' : 0,
                'rel' : 0,
                },
              events: {
                'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange,
              }
            });
        }

        // autoplay video
        function onPlayerReady(event) {
            //event.target.playVideo();
        }

        // when video ends
        function onPlayerStateChange(event) {
            if(event.data === 0) {
                $('#player').fadeOut('fast', 'swing');
            }
        }


    $(function () {
        // set cursor to login field
        $('#User_username').focus();
    })

    // Shake panel after wrong validation
<?php foreach ($hForm->models as $model) : ?>
    <?php if ($model->hasErrors()) : ?>
            $('#create-account-form').removeClass('bounceIn');
            $('#create-account-form').addClass('shake');
            $('#app-title').removeClass('fadeIn');
    <?php endif; ?>
<?php endforeach; ?>

</script>
