<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\missions\models\MissionTranslations */

$this->title = Yii::t('app', 'Create Mission Translations');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mission Translations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mission-translations-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
