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
<a class = "btn btn-primary" href='<?= Url::to(['/missions/evokations/view', 'id' => $evokation->id, 'sguid' => $contentContainer->guid]); ?>'>
    <?= Yii::t('MissionsModule.base', 'Go to Evokation') ?>
</a>
            
<br><br>

<div class="clearFloats"></div>
