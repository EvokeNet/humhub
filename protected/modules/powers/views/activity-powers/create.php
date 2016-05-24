<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\powers\models\ActivityPowers */

$this->title = Yii::t('app', 'Create Activity Powers');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Activity Powers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-powers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
