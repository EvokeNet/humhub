<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\missions\models\ActivityTranslations */

$this->title = Yii::t('app', 'Create Activity Translations');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Activity Translations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-translations-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
