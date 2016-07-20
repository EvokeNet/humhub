<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model app\modules\missions\models\MissionTranslations */

$this->title = Yii::t('MissionsModule.base', 'Update Translation');
$this->params['breadcrumbs'][] = ['label' => Yii::t('MissionsModule.base', 'Missions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('MissionsModule.base', 'Mission').' '.$mission->id_code;
$this->params['breadcrumbs'][] = ['label' => Yii::t('MissionsModule.base', 'Translations'), 'url' => ['index-mission-translations', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('MissionsModule.base', 'Translation').' '.$model->title;
$this->params['breadcrumbs'][] = $this->title;

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

?>
<div class="panel panel-default">
    <div class="panel-heading"><strong><?php echo $this->title; ?></strong></div>
    <div class="panel-body">

        <div class="mission-translations-create">

            <?= $this->render('_form', [
                'model' => $model
            ]) ?>

        </div>

    </div>
</div>
