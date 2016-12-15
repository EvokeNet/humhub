<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('MarketplaceModule.base', 'Mentoring');

?>
<div class="container">
  <div class="row">
    <div class="col-sm-8 layout-content-container">
      <div class="panel panel-default">
          <div class="panel-heading"><strong><?php echo $this->title; ?></strong></div>
          <div class="panel-body">

              <div class="matching-questions-create">

                <div class="products-form">

                    <?php $form = ActiveForm::begin(); ?>

                    <div class="form-group">
                      <?php echo Html::label(Yii::t('MarketplaceModule.base', 'Time'), 'time', ['class' => 'control-label']); ?> <span><?php echo Yii::t('MarketplaceModule.base', 'in minutes') ?></span>
                      <?php echo Html::input('number', 'time', 30, ['class' => 'form-control']); ?>
                    </div>
                    <?php echo $form->field($model, 'quantity')->input('number') ?>
                    <?php echo $form->field($model, 'price')->input('number') ?>
                    <?php echo $form->field($model, 'description')->textArea(['rows' => 3]); ?>

                    <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? Yii::t('MarketplaceModule.base', 'Create') : Yii::t('MarketplaceModule.base', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>

              </div>

          </div>
      </div>
    </div>
    <div class="col-sm-4 layout-sidebar-container">
        <?php echo \app\modules\coin\widgets\UserWallet::widget() ?>
        <?php
        echo \humhub\modules\dashboard\widgets\Sidebar::widget(['widgets' => [
                [\humhub\modules\activity\widgets\Stream::className(), ['streamAction' => '/dashboard/dashboard/stream'], ['sortOrder' => 150]]
        ]]);
        ?>
    </div>
  </div>
</div>
