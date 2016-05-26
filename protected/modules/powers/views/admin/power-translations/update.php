<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model app\modules\powers\models\PowerTranslations */

$this->title = Yii::t('PowersModule.base', 'Update {modelClass}: ', [
    'modelClass' => 'Power Translations',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('PowersModule.base', 'Powers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $power->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('PowersModule.base', 'Power Translations'), 'url' => ['index-power-translations', 'id' => $power->id]];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('PowersModule.base', 'Update');

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

?>

<div class="panel panel-default">
    <div class="panel-heading"><strong><?php echo $this->title; ?></strong></div>
    <div class="panel-body">
        
        <div class="matching-questions-create">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
        
    </div>
</div>
