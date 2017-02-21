<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\missions\models\Tags */

$this->title = Yii::t('app', 'Create Tags');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tags'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="panel panel-default">
    <div class="panel-heading"><strong><?php echo $this->title; ?></strong></div>
    <div class="panel-body">

        <div class="tags-create">

            <?= $this->render('_form', [
                'model' => $model
            ]) ?>

        </div>

    </div>
</div>
