<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model app\modules\missions\models\MissionTranslations */

$this->title = Yii::t('MissionsModule.views_admin_add-mission-translations', 'Create Mission Translation');
$this->params['breadcrumbs'][] = ['label' => Yii::t('MissionsModule.views_admin_add-mission-translations', 'Missions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('MissionsModule.views_admin_add-mission-translations', 'Mission Translation'), 'url' => ['index-mission-translations', 'id' => $model->mission_id]];
$this->params['breadcrumbs'][] = $this->title;

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

?>
<div class="panel panel-default">
    <div class="panel-heading"><?php echo Yii::t('MissionsModule.views_admin_add-mission-translations', '<strong>Add</strong> new Mission Translation'); ?></div>
    <div class="panel-body">

        <div class="activities-create">

            <?= $this->render('_form', [
                'model' => $model
            ]) ?>

        </div>

    </div>
</div>
