<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model app\modules\powers\models\QualityPowers */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Quality Powers',
]) . $model->id;
// $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Quality Powers'), 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = Yii::t('app', 'Update');

$this->params['breadcrumbs'][] = ['label' => Yii::t('MatchingModule.base', 'Qualities'), 'url' => ['index-qualities']];
$this->params['breadcrumbs'][] = Yii::t('MatchingModule.base', 'Quality').' '.$quality->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('MatchingModule.base', 'Quality Powers'), 'url' => ['index-quality-powers']];
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
