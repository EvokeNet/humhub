<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\missions\models\Evokations */

$this->title = Yii::t('app', 'Create Evokations');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Evokations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evokations-create">

    <h1><?php // Html::encode($this->title) ?></h1>
    
    <?= \humhub\modules\missions\widgets\WallCreateEvokationForm::widget([
    'contentContainer' => $contentContainer,
    'submitButtonText' => Yii::t('MissionsModule.widgets_EvokationFormWidget', 'Submit Evokation')
        ]) ?>
    

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
));

?>

</div>
