<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\languages\models\Languages;

use yii\widgets\Breadcrumbs;

$this->title = Yii::t('NovelModule.base', 'Chapter');
$this->params['breadcrumbs'][] = $this->title;

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3><?php echo $this->title; ?></h3>
        <?php echo Html::a(Yii::t('NovelModule.base', 'Create'), ['chapter-create'], array('class' => 'btn btn-success')); ?>
    </div>
    <div class="panel-body">
      <table class="table">
          <tr>
              <th><?php echo Yii::t('NovelModule.base', 'Chapter Number'); ?></th>
              <th><?php echo Yii::t('NovelModule.base', 'Mission') ?></th>
              <th>&nbsp;</th>
          </tr>
          <?php foreach ($chapters as $chapter): ?>
              <tr>
                  <td><?php echo $chapter->number; ?></td>
                  <td><?php echo $chapter->mission->title; ?></td>
                  <td>
                      <?php echo Html::a(
                          Yii::t('NovelModule.base', 'Edit'),
                          ['chapter-update', 'id' => $chapter->id], array('class' => 'btn btn-primary btn-sm')); ?>
                      <?php echo Html::a(
                            Yii::t('NovelModule.base', 'View pages'),
                            ['index-chapter-pages', 'id' => $chapter->id], array('class' => 'btn btn-warning btn-sm')); ?>
                        &nbsp;&nbsp;
                    <?php echo Html::a(
                        Yii::t('NovelModule.base', 'Delete'),
                        ['chapter-delete', 'id' => $chapter->id], array('class' => 'btn btn-alert btn-sm')); ?>
                  </td>
              </tr>
          <?php endforeach; ?>
      </table>
    </div>
</div>
