<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\powers\models\PowerTranslations */

$this->title = Yii::t('PowersModule.base', 'Update {modelClass}: ', [
    'modelClass' => 'Power Translations',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('PowersModule.base', 'Power Translations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('PowersModule.base', 'Update');
?>
<div class="power-translations-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
