<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use humhub\compat\CActiveForm;

$this->title = Yii::t('MissionsModule.views_admin_add-activities', 'Create Activity');
$this->params['breadcrumbs'][] = ['label' => Yii::t('MissionsModule.views_admin_add', 'Missions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('MissionsModule.views_admin_add-activities', 'Activity'), 'url' => ['index-activities', 'id' => $model->mission_id]];
$this->params['breadcrumbs'][] = $this->title;
        
echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

?>
<div class="panel panel-default">
    <div class="panel-heading"><?php echo Yii::t('MissionsModule.views_admin_add-activities', '<strong>Add</strong> new Activity'); ?></div>
    <div class="panel-body">

        <div class="activities-create">

            <?= $this->render('_form', [
                'model' => $model
            ]) ?>

        </div>

    </div>
</div>