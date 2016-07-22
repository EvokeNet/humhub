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
                          <div class="prize evocoin">
                            <div class="prize-name">
                              10 Evocoin
                            </div>
                          </div>
                          <div class="prize evocoin">
                            <div class="prize-name">
                              20 Evocoin
                            </div>
                          </div>
                          <div class="prize">
                            <div class="prize-name">
                              <?php echo Yii::t('PrizeModule.base', 'Better luck next time!'); ?>
                            </div>
                          </div>
                          <?php foreach ($prizes as $prize): ?>
                            <div class="prize">
                              <div class="prize-name">
                                <?php echo $prize->name; ?>
                              </div>
                            </div>
                          <?php endforeach; ?>
                          <div class="prize evocoin">
                            <div class="prize-name">
                              5 Evocoin
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="selector">

                      </div>
                    </div>
                    <div id="results">
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

  .spinner .prize-name {
    position: absolute;
    bottom: 0;
    max-width: 8em;
    left: 0;
    right: 0;
    margin: 0 auto;
    white-space: normal;
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

  .well {
    background-color: #eaeaea;
  }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/TweenMax.min.js"></script>

<script type="text/javascript">
  $('#toolSearch').on('click', function(event){
    event.preventDefault();

    $.ajax({
      url: '<?php echo Url::toRoute('/prize/evoke-tools/search') ?>',
      success: function(result) {
        //spinner animation
        $('#results').html(result);
        $('.prizes').clone().appendTo(".spinner");
        TweenMax.to( $(".prizes"), 2,
          {
        	 x: -( $('.prizes').width() + 18 ),
           ease: Linear.easeNone
          //  repeat: 5
          }
        );
      }
    })
  });
</script>
