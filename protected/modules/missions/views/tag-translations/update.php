<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\missions\models\TagTranslations */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Tag Translations',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tag Translations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tag-translations-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
