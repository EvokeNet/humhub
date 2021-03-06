<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\matching_questions\models\Qualities */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('MatchingModule.base', 'Qualities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qualities-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('MatchingModule.base', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('MatchingModule.base', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('MatchingModule.base', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'short_name',
            'description',
            'created',
            'modified',
        ],
    ]) ?>

</div>
