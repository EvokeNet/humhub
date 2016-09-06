<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\missions\models\MissionTranslations */

use yii\widgets\Breadcrumbs;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('MissionsModule.base', 'Evidences'), 'url' => ['index-evidences']];
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
                <?= Html::a(Yii::t('MissionsModule.base', 'Delete'), ['delete-evidences', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('MissionsModule.base', 'Are you sure you want to delete this evidence?'),
                        'method' => 'post',
                    ],
                ]) ?>
            </p><br>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'title',
                    'text:ntext',
                    'created_at',
                    'updated_at',
                ],
            ]) ?>

        </div>

    </div>
</div>
