<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\missions\models\MissionTranslations */

use yii\widgets\Breadcrumbs;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('MissionsModule.base', 'Missions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3><strong><?php echo $this->title; ?></strong></h3>
    </div>
    <div class="panel-body">

        <div class="mission-translations-view">

            <p>
                <?= Html::a(Yii::t('MissionsModule.base', 'View translations'), ['index-mission-translations', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
                <?= Html::a(Yii::t('MissionsModule.base', 'View Activities'), ['index-activities', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
                <?= Html::a(Yii::t('MissionsModule.base', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('MissionsModule.base', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('MissionsModule.base', 'Are you sure you want to delete this mission?'),
                        'method' => 'post',
                    ],
                ]) ?>
            </p><br>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'title',
                    'description:ntext',
                    'created_at',
                    'updated_at',
                ],
            ]) ?>

        </div>

    </div>
</div>
