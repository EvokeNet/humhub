<?php

use yii\helpers\Html;

echo Html::beginForm(); 
?>
<strong>
   <?php print humhub\widgets\RichText::widget(['text' => $evidence->title]); ?>
</strong>
<br>
<?php print humhub\widgets\RichText::widget(['text' => $evidence->text]);?>

<br><br>

<div class="clearFloats"></div>

<?php echo Html::endForm(); ?>