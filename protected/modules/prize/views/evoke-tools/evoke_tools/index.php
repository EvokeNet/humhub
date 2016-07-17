<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->pageTitle = Yii::t('PrizeModule.base', 'Evoke Tools');
?>
<div class="container">
    <div class="row">
        <div class="col-md-8 layout-content-container">
          <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-body row">
                <div class="panel-heading">
                  <strong><?php echo Yii::t('PrizeModule.base', 'Search for Help') ?></strong>
                </div>
                <div class="panel-body">
                  <?php if ($wallet->amount >= 5): ?>
                    <div class="col-xs-7">
                      <?php echo Html::a(
                          Yii::t('PrizeModule.base', 'Search'),
                          ['search'], array('class' => 'btn btn-success')); ?>
                      <span><?php echo Yii::t('PrizeModule.base', 'Costs 5 Evocoin'); ?></span>
                    </div>

                    <div class="col-xs-3" id="results">
                      <?php if(isset($results)): ?>
                        <span><?php echo $results ?></span>
                      <?php endif; ?>
                    </div>
                  <?php else: ?>
                    <div class="col-xs-7">
                      <?php echo Yii::t('PrizeModule.base', 'Not Enough Evocoin!'); ?>
                    </div>
                  <?php endif; ?>
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
