<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\missions\models\EvokationDeadline */

$this->title = Yii::t('app', 'Create Evokation Deadline');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Evokation Deadlines'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="panel panel-default">
    <div class="panel-heading"><strong><?= $this->title ?></strong></div>
    <div class="panel-body">
        
        <div class="evokation-deadline-create">
            
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>

    </div>
</div>
