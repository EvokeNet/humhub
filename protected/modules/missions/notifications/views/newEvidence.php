<?php

use yii\helpers\Html;

$evidence = $source->content->getPolymorphicRelation();
?>
<?php
echo Yii::t('MissionsModule.views_notifications_newEvidence', "%displayName% posted %contentTitle%.", array(
    '%displayName%' => '<strong>' . Html::encode($source->user->displayName) . '</strong>',
    '%contentTitle%' => $this->context->getContentInfo($evidence)
));
?>
<em>"<?php echo humhub\widgets\RichText::widget(['text' => $source->message, 'minimal' => true, 'maxLength' => 400]); ?>"</em>