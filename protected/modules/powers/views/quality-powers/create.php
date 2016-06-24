<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\powers\models\QualityPowers */

$this->title = Yii::t('PowersModule.base', 'Create Quality Powers');
$this->params['breadcrumbs'][] = ['label' => Yii::t('PowersModule.base', 'Quality Powers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quality-powers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
