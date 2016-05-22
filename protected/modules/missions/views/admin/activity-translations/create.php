<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model app\modules\missions\models\ActivityTranslations */

$this->title = Yii::t('MissionsModule.base', 'Create new Translation');
$this->params['breadcrumbs'][] = ['label' => Yii::t('MissionsModule.base', 'Missions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('MissionsModule.base', 'Mission').' '.$activity->mission->id_code;
$this->params['breadcrumbs'][] = ['label' => Yii::t('MissionsModule.base', 'Activities'), 'url' => ['index-activities', 'id' => $activity->mission->id]];
$this->params['breadcrumbs'][] = Yii::t('MissionsModule.base', 'Activity').' '.$activity->id_code;
$this->params['breadcrumbs'][] = ['label' => Yii::t('MissionsModule.base', 'Translations'), 'url' => ['index-activity-translations', 'id' => $activity->id]];
$this->params['breadcrumbs'][] = $this->title;

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

?>
<div class="panel panel-default">
    <div class="panel-heading"><strong><?php echo $this->title; ?></strong></div>
    <div class="panel-body">

        <div class="activity-translations-create">

            <?= $this->render('_form', [
                'model' => $model
            ]) ?>

        </div>

    </div>
</div>
