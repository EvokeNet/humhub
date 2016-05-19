<?php

echo \humhub\modules\missions\widgets\WallCreateForm::widget([
    'contentContainer' => $contentContainer,
    'submitButtonText' => Yii::t('MissionsModule.widgets_EvidenceFormWidget', 'Submit Evidence'),
]);
?>

<?php

$canCreateEvidences = $contentContainer->permissionManager->can(new \humhub\modules\missions\permissions\CreateEvidence());

?>
