<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\widgets\Breadcrumbs;

$this->title = Yii::t('NovelModule.base', 'Prizes');
$this->params['breadcrumbs'][] = $this->title;

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3><?php echo $this->title; ?></h3>
        <?php echo Html::a(Yii::t('NovelModule.base', 'Create'), ['create'], array('class' => 'btn btn-success')); ?>
    </div>
    <div class="panel-body">
      <table class="table">
          <tr>
              <th><?php echo Yii::t('NovelModule.base', 'Page Image'); ?></th>
              <th><?php echo Yii::t('NovelModule.base', 'Page Number') ?></th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
          </tr>
          <?php foreach ($pages as $page): ?>
              <tr>
                  <td><?php echo $page->page_image; ?></td>
                  <td><?php echo $page->page_number; ?></td>
                  <td>
                      <?php echo Html::a(
                          Yii::t('NovelModule.base', 'Edit'),
                          ['update', 'id' => $page->id], array('class' => 'btn btn-primary btn-sm')); ?>
                  </td>
                  <td>
                    <?php echo Html::a(
                        Yii::t('NovelModule.base', 'Delete'),
                        ['delete', 'id' => $page->id], array('class' => 'btn btn-alert btn-sm')); ?>
                  </td>
              </tr>
          <?php endforeach; ?>
      </table>
    </div>
</div>
