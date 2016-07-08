<?php

use yii\helpers\Html;

echo Html::beginForm(); 

?>

<strong>
   <?php print humhub\widgets\RichText::widget(['text' => $evokation->title]); ?>
</strong>
<br>
<?php print humhub\widgets\RichText::widget(['text' => $evokation->text]);?>

<br><br>

<div class="clearFloats"></div>
