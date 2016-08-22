<?php

use yii\helpers\Html;
use app\modules\missions\models\Evidence;

$vote = $source;

$evidence = Evidence::findOne($vote->evidence_id);

?>
<?php

echo Yii::t('MissionsModule.views_notifications_rejectedEvidence', "%contentTitle% has been marked  as: ", array(
    '%contentTitle%' => $this->context->getContentInfo($evidence)
)); 
?>
<em>"<?php echo humhub\widgets\RichText::widget(['text' => Yii::t('MissionsModule.model', "No, it does not meet the activity's requirement"), 'minimal' => true, 'maxLength' => 400]); ?>"</em>