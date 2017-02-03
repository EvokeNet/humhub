<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\widgets\Breadcrumbs;

$this->title = Yii::t('LibraryModule.base', 'Library Resources');
$this->params['breadcrumbs'][] = $this->title;

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3><?php echo $this->title; ?></h3>
        <?php echo Html::a(Yii::t('LibraryModule.base', 'Create'), ['create'], array('class' => 'btn btn-success')); ?>
    </div>
    <div class="panel-body">
      <table class="table">
          <tr>
              <th><?php echo Yii::t('LibraryModule.base', 'Name'); ?></th>
              <th><?php echo Yii::t('LibraryModule.base', 'Link') ?></th>
              <th><?php echo Yii::t('LibraryModule.base', 'Description') ?></th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
          </tr>
          <?php foreach ($library_resources as $library_resource): ?>
              <tr>
                  <!--<td><?php //echo $coin->id_code; ?></td>-->
                  <td><?php echo $library_resource->name; ?></td>
                  <td><?php echo $library_resource->link; ?></td>
                  <td><?php echo $library_resource->description; ?></td>
                  <td>
                      <?php echo Html::a(
                          Yii::t('LibraryModule.base', 'Edit'),
                          ['update', 'id' => $library_resource->id], array('class' => 'btn btn-primary btn-sm')); ?>
                  </td>
                  <td>
                    <?php echo Html::a(
                        Yii::t('LibraryModule.base', 'Delete'),
                        ['delete', 'id' => $library_resource->id], array('class' => 'btn btn-alert btn-sm')); ?>
                  </td>
              </tr>
          <?php endforeach; ?>
      </table>
    </div>
</div>
