<?php

use yii\helpers\Html;
use yii\grid\GridView;
use humhub\modules\user\models\Profile;

use yii\widgets\Breadcrumbs;

$this->title = Yii::t('PrizeModule.base', 'Prizes');
$this->params['breadcrumbs'][] = $this->title;

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3><?php echo $this->title; ?></h3>
        <?php echo Html::a(Yii::t('PrizeModule.base', 'Create'), ['create'], array('class' => 'btn btn-success')); ?>
    </div>
    <div class="panel-body">
      <table class="table">
          <tr>
              <th><?php echo Yii::t('PrizeModule.base', 'User'); ?></th>
              <th><?php echo Yii::t('PrizeModule.base', 'Prize') ?></th>
          </tr>
          <?php foreach ($won_prizes as $won_prize): ?>
              <?php $prize_user = $won_prize->getUser(); ?>
              <?php $user_profile = Profile::find()->where(['user_id' => $prize_user->id])->one(); ?>
              <tr>
                  <td><?php echo $user_profile->firstname . ' ' . $user_profile->lastname;?></td>
                  <td><?php echo $won_prize->getPrizeName(); ?></td>
              </tr>
          <?php endforeach; ?>
      </table>
    </div>
</div>
