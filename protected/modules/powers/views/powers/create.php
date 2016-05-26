<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\powers\models\Powers */

$this->title = Yii::t('PowersModule.base', 'Create Powers');
$this->params['breadcrumbs'][] = ['label' => Yii::t('PowersModule.base', 'Powers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="powers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
