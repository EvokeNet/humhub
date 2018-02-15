<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->pageTitle = Yii::t('LibraryModule.base', 'Library');

?>
<style>

  .resource-list {
    list-style:none;
    padding: 0;
  }

  .resource-item {
    padding: 1em;
    border-bottom: 1px solid;
  }

  .resource-item h6 {
    font-size: 1em;
  }

  .resource-item p {
    font-size: 1.2em;
  }

</style>

<div class="container">
  <div class="row">
    <div class="col-sm-8 layout-content-container">
      <div class="panel-group">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4><?php echo Yii::t('LibraryModule.base', 'Resources'); ?></h3>
          </div>
          <div class="panel-body">
            <ul class="resource-list">
              <?php foreach ($library_resources as $library_resource): ?>
                <a href="<?php echo $library_resource->link; ?>" target="_blank">
                  <li class="resource-item">
                      <h6><?php echo $library_resource->name ?></h6>
                      <p>
                        <?php echo $library_resource->description; ?>
                      </p>
                  </li>
                </a>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-4 layout-sidebar-container">
      <?php
      echo \humhub\modules\dashboard\widgets\Sidebar::widget(['widgets' => [
              [\humhub\modules\activity\widgets\Stream::className(), ['streamAction' => '/dashboard/dashboard/stream'], ['sortOrder' => 150]]
      ]]);
      ?>
    </div>
  </div>
</div>
