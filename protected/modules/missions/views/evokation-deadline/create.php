<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\missions\models\EvokationDeadline */

$this->title = Yii::t('app', 'Create Evokation Deadline');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Evokation Deadlines'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evokation-deadline-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
