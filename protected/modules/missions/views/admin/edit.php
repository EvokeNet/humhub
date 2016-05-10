<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use humhub\compat\CActiveForm;

$this->title = Yii::t('MissionsModule.views_admin_edit', 'Edit Mission');
$this->params['breadcrumbs'][] = ['label' => Yii::t('MissionsModule.views_admin_edit', 'Missions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
        
echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

?>
<div class="panel panel-default">
    <div class="panel-heading"><?php echo Yii::t('MissionsModule.views_admin_edit', '<strong>Edit</strong> mission'); ?></div>
    <div class="panel-body">
        
        <div class="missions-create">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>

    </div>
</div>