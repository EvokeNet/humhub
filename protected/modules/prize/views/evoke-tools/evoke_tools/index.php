<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->pageTitle = Yii::t('PrizeModule.base', 'Evoke Tools');
?>
<div class="container">
    <div class="row">
        <div class="col-md-8 layout-content-container">
          <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="panel-heading">
                  <strong><?php echo Yii::t('PrizeModule.base', 'Discover Tools') ?></strong>
                </div>
                <div class="col-xs-12">
                  <p>
                    <?php echo Yii::t('PrizeModule.base', 'Tools Description') ?>
                  </p>
                </div>
                <div class="panel-body">
                  <div class="row">
                    <?php if ($wallet->amount >= 5): ?>
                      <div class="col-xs-7">
                        <?php echo Html::a(
                            Yii::t('PrizeModule.base', 'Pay 5 Evocoins to play'),
                            ['search'], array('class' => 'btn btn-primary', 'id' => 'toolSearch')); ?>
                      </div>

                      <div class="col-xs-4">
                        <div class="row text-right">
                          <strong><?php echo Yii::t('PrizeModule.base', 'Tools remaining:') ?><?php echo $total_prizes ?></strong>
                        </div>
                        <?php foreach ($prizes as $prize): ?>
                          <div class="row text-right">
                            <strong><?php echo $prize->name . ': ' . $prize->quantity ?></strong>
                          </div>
                        <?php endforeach; ?>
                      </div>
                    <?php else: ?>
                      <div class="col-xs-7">
                        <?php echo Yii::t('PrizeModule.base', 'Not Enough Evocoin!'); ?>
                      </div>
                    <?php endif; ?>
                  </div>
                  </br>
                  </br>
                  <div class="row col-xs-12">
                    <div class="spinner-container">
                      <div class="spinner">
                        <div class="prizes">
                          <div id="evocoin10" class="prize">
                            <div class="prize-image evocoin">
                              10
                            </div>
                            <div class="prize-name">
                              Evocoin
                            </div>
                          </div>
                          <div id="evocoin20" class="prize">
                            <div class="prize-image evocoin">
                              20
                            </div>
                            <div class="prize-name">
                              Evocoin
                            </div>
                          </div>
                          <div id="noWin" class="prize">
                            <div class="prize-name no-win">
                              <?php echo Yii::t('PrizeModule.base', 'Better luck next time!'); ?>
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
                              Evocoin
                            </div>
                          </div>
                          <div id="evocoin5" class="prize">
                            <div class="prize-image evocoin">
                              5
                            </div>
                            <div class="prize-name">
                              Evocoin
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="selector first-try">

                      </div>
                    </div>
                  </br>
                    <div id="results" class="row col-xs-12">
                      <?php if(isset($results)): ?>
                        <span><?php echo $results ?></span>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="row">
                  </br>
                  </div>
                  <!-- boardgame rules -->
                  <div class="row">
                    <div class="panel-heading">
                      <strong><?php echo Yii::t('PrizeModule.base', 'The boardgame') ?></strong>
                    </div>
                    <div class="panel-body">
                      <div class="row">
                        <div class="col-xs-12">
                          <p>
                            <?php echo Yii::t('PrizeModule.base', 'Boardgame intro'); ?>
                          </p>
                        </div>
                      </div>
                      <div class="row">
                        <span class="col-xs-7"><img src="<?php echo Url::to('@web/themes/Evoke/img/evoke_board.png') ?>" alt="evoke board" class="img-responsive" /></span>
                        <span class="dowload col-xs-4 well well-lg">
                          <p>
                            <?php echo Yii::t('PrizeModule.base', 'Instructions intro') ?>
                          </p>
                          </br>
                          <?php echo Html::a(Yii::t('PrizeModule.base', 'Dowload instructions PDF'), Url::to('@web/themes/Evoke/img/evoke_board.png'), array('class' => 'btn')); ?>
                        </span>
                      </div>
                    </div>
                  </div>
                  <!-- roles -->
                  <div class="row">
                    <div class="panel-heading">
                      <strong><?php echo Yii::t('PrizeModule.base', 'Roles') ?></strong>
                    </div>
                    <div class="panel-body">
                      <div class="row">
                        <div class="col-xs-12">
                          <?php echo Yii::t('PrizeModule.base', 'Earn super powers') ?>
                        </div>
                      </div>
                      <div class="row">
                        <span class="well"></span>
                        <span class="well"></span>
                        <span class="well"></span>
                        <span class="well"></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 layout-sidebar-container">
            <?php
            echo \humhub\modules\dashboard\widgets\Sidebar::widget(['widgets' => [
                    [\humhub\modules\activity\widgets\Stream::className(), ['streamAction' => '/dashboard/dashboard/stream'], ['sortOrder' => 150]]
            ]]);
            ?>
        </div>
    </div>
</div>

<style media="screen">
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
    top: 40%;
  }

  .spinner-container .selector {
    height: 9em;
    width: 9em;
    border: 2px solid #1ecccc;
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

    border-top: 15px solid #1ecccc;
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
  }

  .prize-won-name {
    font-weight: bold;
    font-size: 1.4em;
    color: #000;
  }

  .well {
    background-color: #eaeaea;
  }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/TweenMax.min.js"></script>

<script type="text/javascript">
  var prizeWidth = $('.prize').outerWidth(true);

  $('#toolSearch').on('click', function(event){
    event.preventDefault();
    var $toolSearch = $(event.target);

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
          	 x: -( $('.prizes').width() + 18 + spinOffset ),
             ease: Back.easeOut,
             delay: 4.5,
             onComplete: function() {
               $toolSearch.removeClass('disabled');
               $('#results').html(
                 '<div class="prize-won-name">' + result.name + '</div>' + '<div class="prize-won-description">' + result.description + '</div>'
               );
               $(':focus').blur();
             }
            }
          );

        }
      });
    }
  });
</script>
