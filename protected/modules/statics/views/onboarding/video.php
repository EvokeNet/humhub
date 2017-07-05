<?php

use yii\helpers\Html;

?>

<style media="screen">

  <?php if (!Yii::$app->user->getIdentity()->has_read_novel && Yii::$app->user->getIdentity()->group->name != "Mentors"): ?>
    .topbar, .footer {
      display: none;
    }

    body {
      padding-top: 1em;
    }
  <?php endif; ?>
  
</style>

<!-- <h4 style="background-color: #101C2A; text-align: center; padding: 10px 0; margin: 0px 350px 20px; color: #5aa2c6;"><?php echo Yii::t('StaticsModule.base', 'ALCHEMY MESSAGE') ?></h4> -->

<h4 style="background-color: #101C2A; text-align: center; padding: 10px 0; margin: 0px 0 20px; color: #5aa2c6;"><?php echo Yii::t('StaticsModule.base', 'ALCHEMY MESSAGE') ?></h4>

<div class="container" style="text-align: center; margin-top:80px">
    <div id="player"></div>
</div>

<div style="text-align:right; margin: 10px 40px">
<?php echo Html::a(
    Yii::t('StaticsModule.base', 'Next'),
    ['/statics/statics/terms-conditions'], array('class' => 'btn btn-lg btn-cta1', 'style' => 'padding: 0 80px')); ?>
</div>

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
              // events: {
              //   'onReady': onPlayerReady,
              //   'onStateChange': onPlayerStateChange,
              // }
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

</script>
