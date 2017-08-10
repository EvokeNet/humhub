<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\widgets\Breadcrumbs;

$this->title = Yii::t('LanguagesModule.base', 'Languages');
$this->params['breadcrumbs'][] = $this->title;

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3><?php echo $this->title; ?></h3>
        <div style="position: absolute; top: 10px; right: 10px;"><?php echo Html::a(Yii::t('LanguagesModule.base', 'Create'), ['create'], array('class' => 'btn btn-success')); ?></div>
    </div>
    <div class="panel-body">
      <table class="table">
          <tr>
              <th><?php echo Yii::t('LanguagesModule.base', 'Language'); ?></th>
              <th><?php echo Yii::t('LanguagesModule.base', 'Code') ?></th>
              <!-- <th>&nbsp;</th> -->
              <th>&nbsp;</th>
          </tr>
          <?php foreach ($languages as $language): ?>
              <tr>
                  <!--<td><?php //echo $coin->id_code; ?></td>-->
                  <td><?php echo $language->language; ?></td>
                  <td><?php echo $language->code; ?></td>
                  <!-- <td>
                      <?php echo Html::a(
                          Yii::t('LanguagesModule.base', 'Edit'),
                          ['update', 'id' => $language->id], array('class' => 'btn btn-primary btn-sm')); ?>
                  </td> -->
                  <td>
                    <?php echo Html::a(
                        Yii::t('LanguagesModule.base', 'Delete'),
                        ['delete', 'id' => $language->id], array('class' => 'btn btn-alert btn-sm')); ?>
                  </td>
              </tr>
          <?php endforeach; ?>
      </table>
    </div>
</div>
