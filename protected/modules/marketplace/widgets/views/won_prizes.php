<div class="panel panel-defaul">
  <div class="panel-heading">
    <?php echo Yii::t('PrizeModule.base', 'Won Prizes'); ?>
  </div>
  <div class="panel-body">
    <ul>
      <?php foreach($won_prizes as $prize): ?>
        <li><?php echo $prize->name; ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>
