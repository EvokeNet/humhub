<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\missions\models\Votes */

$this->title = Yii::t('app', 'Create Votes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Votes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="votes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
