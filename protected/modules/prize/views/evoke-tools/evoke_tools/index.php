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
                <p>
                  <?php echo Yii::t('PrizeModule.base', 'Tools Description') ?>
                </p>
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
                  <div class="row">
                    <div class="spinner">
                      <div class="prizes">
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
                  <div class="row">
                    <div class="panel-heading">
                      <strong><?php echo Yii::t('PrizeModule.base', 'The boardgame') ?></strong>
                    </div>
                    <div class="panel-body">
                      <div class="row">
                        <p>
                          <?php echo Yii::t('PrizeModule.base', 'Boardgame intro'); ?>
                        </p>
                      </div>
                      <div class="row">
                        <span class="boardgame-image col-xs-7"></span>
                        <span class="dowload col-xs-4"></span>
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

<script type="text/javascript">
  $('#toolSearch').on('click', function(event){
    event.preventDefault();

    $.ajax({
      url: '<?php echo Url::toRoute('/prize/evoke-tools/search') ?>',
      success: function(result) {
        $('#results').html(result);
      }
    })
  });
</script>
