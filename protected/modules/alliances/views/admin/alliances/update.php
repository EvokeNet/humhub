<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model app\modules\alliances\models\Alliance */

$this->title = Yii::t('AlliancesModule.base', 'Edit ', [
    'modelClass' => 'Alliance',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('AlliancesModule.base', 'Alliance'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('AlliancesModule.base', 'Edit');

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

?>

<div class="panel panel-default">
    <div class="panel-heading"><strong><?php echo $this->title; ?></strong></div>
    <div class="panel-body">

        <div class="matching-questions-create">

            <?= $this->render('_form', [
                'teams' => $teams,
                'model' => $model,
            ]) ?>

        </div>

    </div>
</div>
