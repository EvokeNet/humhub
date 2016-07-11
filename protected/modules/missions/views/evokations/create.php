<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\missions\models\Evokations */

$this->title = Yii::t('app', 'Create Evokations');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Evokations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evokations-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
