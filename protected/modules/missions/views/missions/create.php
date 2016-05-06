<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\missions\models\Missions */

$this->title = Yii::t('app', 'Create Missions');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Missions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="missions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
