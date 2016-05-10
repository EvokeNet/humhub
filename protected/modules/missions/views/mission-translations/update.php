<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\missions\models\MissionTranslations */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Mission Translations',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mission Translations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="mission-translations-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
