<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->pageTitle = Yii::t('PrizeModule.base', 'Evoke Tools');
?>
<div class="container">
    <div class="row">
        <div class="col-sm-8 layout-content-container">
          <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">
                  <h4><?php echo Yii::t('PrizeModule.base', 'Discover Tools') ?></h4>
                </div>
              <div class="panel-body">

                <p>
                  <?php echo Yii::t('PrizeModule.base', 'We introduce some tools the network has made available to facilitate your agent work in Soacha.') ?>
                </p>

                <br>

                <div class = "text-center"><div class = "blue-border"></div></div>

                <div class="panel-heading">
                  <h4><?php echo Yii::t('PrizeModule.base', 'Slot Machine') ?></h4>
                </div>

                <div class="panel-body">

                  <p>
                    <?php echo Yii::t('PrizeModule.base', 'Try your luck to win support in our slot machine. Every attempt will cost 5 evocoins.') ?>
                  </p>

                  <div class="row" id="evokeToolsButton">
                    <?php if ($wallet->amount >= 5): ?>
                      <div class="col-sm-7">
                        <?php echo Html::a(
                            Yii::t('PrizeModule.base', 'Pay 5 Evocoins to play'),
                            ['search'], array('class' => 'btn btn-cta1', 'id' => 'toolSearch')); ?>
                      </div>

                      <div class="col-sm-5">
                        <div class="row text-right" style = "margin-top:10px; margin-right:5px">
                          <p><strong><?php echo Yii::t('PrizeModule.base', 'Tools remaining: {total}', array('total' => $total_prizes)) ?></strong></p>

                        </div>
                        <?php foreach ($prizes as $prize): ?>
                          <div class="row text-right">
                            <strong><?php echo $prize->name . ': ' . $prize->quantity ?></strong>
                          </div>
                        <?php endforeach; ?>
                      </div>
                    <?php else: ?>
                      <div class="col-sm-7">
                        <?php echo Yii::t('PrizeModule.base', 'Not Enough Evocoin!'); ?>
                      </div>
                    <?php endif; ?>
                  </div>

                  </br>
                  </br>

                  <!-- Slot machine -->
                  <div class="row">
                    <div class="spinner-container">
                      <div class="spinner">
                        <div class="prizes">
                          <div id="evocoin10" class="prize">
                            <div class="prize-image evocoin">
                              10
                            </div>
                            <div class="prize-name">
                              <p><?php echo Yii::t('PrizeModule.base', 'Evocoin(s)'); ?></p>
                            </div>
                          </div>
                          <div id="evocoin20" class="prize">
                            <div class="prize-image evocoin">
                              20
                            </div>
                            <div class="prize-name">
                              <p><?php echo Yii::t('PrizeModule.base', 'Evocoin(s)'); ?></p>
                            </div>
                          </div>
                          <div id="evocoin1" class="prize">
                            <div class="prize-image evocoin">
                              1
                            </div>
                            <div class="prize-name">
                              <?php echo Yii::t('PrizeModule.base', 'Evocoin(s)'); ?>
                            </div>
                          </div>
                          <?php foreach ($prizes as $prize): ?>
                            <div id='<?php echo "prize" . $prize->id ?>' class="prize">
                              <div class="prize-image" style="background-image: url('<?php echo  $prize->image?>')">

                              </div>
                              <div class="prize-name">
                                <?php echo $prize->name; ?>
                              </div>
                            </div>
                          <?php endforeach; ?>
                          <div id="evocoin50" class="prize">
                            <div class="prize-image evocoin">
                              50
                            </div>
                            <div class="prize-name">
                              <p><?php echo Yii::t('PrizeModule.base', 'Evocoin(s)'); ?></p>
                            </div>
                          </div>
                          <div id="evocoin5" class="prize">
                            <div class="prize-image evocoin">
                              5
                            </div>
                            <div class="prize-name">
                              <p><?php echo Yii::t('PrizeModule.base', 'Evocoin(s)'); ?></p>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="selector first-try">

                      </div>
                    </div>
                  </br>
                    <div id="results" class="row col-sm-12">
                      <?php if(isset($results)): ?>
                        <span><?php echo $results ?></span>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="row">
                  </br>
                  </div>

                  <div class = "text-center"><div class = "blue-border"></div></div>

                  <!-- boardgame rules -->

                  <div class="panel-heading">
                    <h4><?php echo Yii::t('PrizeModule.base', 'The Boardgame') ?></h4>
                  </div>
                  <div class="panel-body">

                    <p>
                      <?php echo Yii::t('PrizeModule.base', 'Located in Soacha, this game was designed by a secret team from the network to ensure countless hours of fun with your team of agents. When you play, you can win evocoins both to use the slot machine and to invest in your Evokations portfolio'); ?>
                    </p>
                    <br>

                    <div class="row">
                      <span class="col-sm-7"><img src="<?php echo Url::to('@web/themes/Evoke/img/evoke_board.png') ?>" alt="evoke board" class="img-responsive" /></span>
                      <span class="dowload col-sm-5 well well-lg">
                        <p class = "text-center">
                          <?php echo Yii::t('PrizeModule.base', 'Download here instructions to the boardgame.') ?>
                        </p>
                        </br>
                        <div class = "text-center"><?php echo Html::a(Yii::t('PrizeModule.base', 'Download instructions PDF'), Url::to('@web/themes/Evoke/documents/reglas_de_evoke.pdf'), array('class' => 'btn btn-cta1', 'target' => '_blank')); ?></div>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-4 layout-sidebar-container">
          <div class="panel panel-default">
              <div class="panel-heading">
                  <strong><?= Yii::t('MissionsModule.base', 'Your Evocoins') ?></strong>
              </div>
              <div class="panel-body text-center">
                  <div class = "evocoins">
                      <img src="<?php echo Url::to('@web/themes/Evoke/img/evocoin_bg.png') ?>">
                      <div><p id="userEvocoins"><?= $wallet->amount ?></p></div>
                  </div>
                  <br>
                  <p style = "font-size:9pt"><?= Yii::t('MissionsModule.base', 'Earn Evocoins by reviewing evidence.') ?></p>
              </div>
          </div>
            <?php
            echo \humhub\modules\dashboard\widgets\Sidebar::widget(['widgets' => [
                    [\humhub\modules\activity\widgets\Stream::className(), ['streamAction' => '/dashboard/dashboard/stream'], ['sortOrder' => 150]]
            ]]);
            ?>
        </div>
    </div>
</div>

<style media="screen">
  .spinner-container {
    position: relative;
  }

  .spinner {
    height: 10em;
    border: 1px solid #000;
    background-color: #eaeaea;
    overflow: hidden;
    white-space: nowrap;
  }

  .spinner .prizes {
    /*margin-left: -1em;*/
    display: inline-block;;
  }

  .spinner .prize{
    display: inline-block;
    width: 9em;
    height: 9em;
    margin: 0.5em;
    text-align: center;
    color: #3399e1;
    position: relative;
  }

  .spinner .prize-image {
    width: 5em;
    height: 5em;
    position: absolute;
    color: black;
    background-size: contain;
    background-repeat: no-repeat;
    line-height: 5em;
    left: 0;
    right: 0;
    margin: 0 auto;
    top: 2em;
  }

  .spinner .prize-name {
    position: absolute;
    bottom: 0;
    max-width: 8em;
    left: 0;
    right: 0;
    margin: 0 auto;
    white-space: normal;
  }

  .spinner .prize-name.no-win {
    top: 35%;
    color: #FB656F;
    font-weight: 700;
    font-size: 9pt;
    margin-left: 10px;
  }

  .spinner-container{
    position: relative;
  }

  .spinner-container .selector {
    height: 9em;
    width: 9em;
    /*border: 2px solid #1ecccc;*/
    border: 5px solid #19B8B8;
    position: absolute;
    top: 0.5em;
    left: 0;
    right: 0;
    margin: 0 auto;
    border-radius: 3px;
  }

  .spinner-container .selector:before {
    content: '';
    width: 0;
    height: 0;
    border-left: 15px solid transparent;
    border-right: 15px solid transparent;

    border-top: 15px solid #19B8B8;
    position: absolute;
    top: -2px;
    left: 0;
    right: 0;
    margin: 0 auto;
  }

  .spinner-container .selector.first-try {
    background-color: #1ecccc;
  }

  .spinner-container .selector.first-try:after {
    content: '<?php echo Yii::t('PrizeModule.base', 'Try your luck') ?>';
    line-height: 9em;
    left: 0;
    right: 0;
    text-align: center;
    position: absolute;
    font-family: 'Ubuntu', sans-serif;
    /*font-size: 12pt;*/
    text-transform: uppercase;
    font-weight: 700;
  }

  .prize-won-name {
    font-weight: bold;
    font-size: 16pt;
    color: #254054;
    margin-left: 20px;
    border: 3px solid #19B8B8;
    padding: 10px;
    text-align: center;
  }

  .well {
    background-color: #eaeaea;
    border-radius: 1px;
  }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/TweenMax.min.js"></script>

<script type="text/javascript">
  var prizeWidth = $('.prize').outerWidth(true);

  $('#toolSearch').on('click', function(event){
    event.preventDefault();
    var $toolSearch   = $(event.target),
        $userEvocoins = $('#userEvocoins');

    // show the subtracted 5 evocoin
    $userEvocoins.text(parseInt($userEvocoins.text()) - 5);

    if (!$toolSearch.hasClass('disabled')) {

      $('.selector').removeClass('first-try');
      if ($(".prizes").length > 1) { //remove the clone if it's there
        $(".prizes").not(':first').remove();
        TweenMax.to($('.prizes'), 0.5, {
          x: 0,
          ease: Back.easeOut
        });
        // TweenMax.set($('.prizes'), {clearProps: "all"});
      }

      $.ajax({
        url: '<?php echo Url::toRoute('/prize/evoke-tools/search') ?>',
        success: function(response) {
          $toolSearch.addClass('disabled');
          var result = JSON.parse(response);

          //spinner animation

          var prizeNumber = $('#' + result.id).index(),
              spinOffset  = (prizeNumber - 2) * prizeWidth;

          $('.prizes').clone().appendTo(".spinner");

          if (spinOffset > 0) {
            $('.prizes').clone().appendTo(".spinner");
          }

          TweenMax.to( $(".prizes"), 1,
            {
          	 x: -( $('.prizes').width()),
             ease: Linear.easeNone,
             repeat: 4,
             delay: 0.5
            }
          );

          TweenMax.set($('.prizes'), {clearProps: "all"});

          TweenMax.to( $(".prizes"), 5,
            {
          	 x: -( $('.prizes').width()  + 32 + spinOffset ),
             ease: Back.easeOut,
             delay: 4.5,
             onComplete: function() {
               $toolSearch.removeClass('disabled');
               // adjust evocoin
               $('#userEvocoins').html(result.evocoin);

               // show prize (if available)
               $('#results').html(
                 '<div class="prize-won-name">' + result.name + '</div>' + '<div class="prize-won-description">' + result.description + '</div>'
               );
               $(':focus').blur();

               // if user now has less than 5 evocoin, disable the evoke tools button
               if(result.evocoin < 5) {
                 $('#evokeToolsButton').html('<div class="col-sm-7"><?php echo Yii::t("PrizeModule.base", "Not Enough Evocoin!"); ?></div>')
               }
             }
            }
          );

        }
      });
    }
  });
</script>
