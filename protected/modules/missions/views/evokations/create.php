<?php

use yii\helpers\Html;
use app\modules\missions\models\Evokations;


/* @var $this yii\web\View */
/* @var $model app\modules\missions\models\Evokations */

$hasUserSubmittedEvokation = Evokations::hasUserSubmittedEvokation();

$this->title = Yii::t('app', 'Create Evokations');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Evokations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evokations-create">

    <h1><?php // Html::encode($this->title) ?></h1>
    
    <?php
        if(!$hasUserSubmittedEvokation){
            echo \humhub\modules\missions\widgets\WallCreateEvokationForm::widget([
            'contentContainer' => $contentContainer,
            'submitButtonText' => Yii::t('MissionsModule.widgets_EvokationFormWidget', 'Submit Evokation')
                ]);
        }
    ?>
    

<?php

$canCreateEvokations = $contentContainer->permissionManager->can(new \humhub\modules\missions\permissions\CreateEvokation());

echo \app\modules\missions\widgets\EvokationStream::widget(array(
    'contentContainer' => $contentContainer,
    'streamAction' => '/missions/evokations/stream',
    'messageStreamEmpty' => ($canCreateEvokations) ?
            Yii::t('MissionsModule.widgets_views_stream', 'There are no evokations yet! Be the first and create one...') :
            Yii::t('MissionsModule.widgets_views_stream', 'There are no evokations yet!'),
    'messageStreamEmptyCss' => ($canCreateEvokations) ? 'placeholder-empty-stream' : '',
    'filters' => [
    ],
    'filterContentContainer' => true,
));

?>

</div>
