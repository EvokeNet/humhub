<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$this->title = Yii::t('AlliancesModule.base', 'Create Alliance');
$this->params['breadcrumbs'][] = ['label' => Yii::t('AlliancesModule.base', 'Alliances'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

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
