<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model app\modules\powers\models\Powers */

$this->title = Yii::t('CoinModule.base', 'Update {modelClass}: ', [
    'modelClass' => 'Wallet',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('CoinModule.base', 'Wallet'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('CoinModule.base', 'Wallet'.$model->id), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('CoinModule.base', 'Update');

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

?>

<div class="panel panel-default">
    <div class="panel-heading"><strong><?php echo $this->title; ?></strong></div>
    <div class="panel-body">

        <div class="matching-questions-create">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>

    </div>
</div>
