<?php

use yii\helpers\Html;
use \yii\helpers\Url;

echo Html::beginForm(); 

?>

<strong>
   <?php print humhub\widgets\RichText::widget(['text' => $evokation->title]); ?>
</strong>
<br>
<?php print humhub\widgets\RichText::widget(['text' => $evokation->description]);?>
<br><br>

<iframe width="630" height="420" src="http://www.youtube.com/embed/<?php echo $evokation->getYouTubeCode($evokation->youtube_url)?>" frameborder="0" allowfullscreen></iframe>

<div>
    <div style = "float:left">
        <a class = "btn btn-primary" href='<?= Url::to(['/missions/evokations/view', 'id' => $evokation->id, 'sguid' => $contentContainer->guid]); ?>'>
            <?= Yii::t('MissionsModule.base', 'Read More') ?>
        </a>
    </div>
    
    <?php if((strtotime(date('Y-m-d H:i:s')) > strtotime($deadline->start_date)) && (strtotime(date('Y-m-d H:i:s')) < strtotime($deadline->finish_date))): ?>
    <div style = "float:right">
        <a class = "btn btn-primary" href='#'>
            <?= Yii::t('MissionsModule.base', 'Add to Portfolio') ?>
        </a>
    </div>
    <?php else: ?>
        <div style = "float:right">
            <a class = "btn btn-default" href='#'>
                <?= Yii::t('MissionsModule.base', 'Voting Closed') ?>
            </a>
        </div>
    <?php endif; ?>
</div>
            
<br><br>

<div class="clearFloats"></div>
