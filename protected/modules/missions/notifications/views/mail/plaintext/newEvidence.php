<?php

use yii\helpers\Html;

$evidence = $source->content->getPolymorphicRelation();
?>
<?php
echo strip_tags(Yii::t('MissionsModule.views_notifications_newEvidence', "%displayName% posted %contentTitle%.", array(
    '%displayName%' => Html::encode($source->user->displayName),
    '%contentTitle%' => $this->context->getContentInfo($evidence)
)));
?>

"<?php echo strip_tags(humhub\widgets\RichText::widget(['text' => $source->message, 'minimal' => true, 'maxLength' => 400])); ?>"