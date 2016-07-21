<?php

use yii\helpers\Html;
use app\modules\missions\models\Evidence;

$vote = $source;
$evidence = Evidence::findOne($vote->evidence_id);
?>
<?php

echo Yii::t('MissionsModule.views_notifications_rejectedEvidence', "%contentTitle% has been reviewed.", array(
    '%contentTitle%' => $this->context->getContentInfo($evidence)
)); 
?>