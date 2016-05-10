<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model app\modules\missions\models\ActivityTranslations */

$this->title = Yii::t('app', 'Create Activity Translations');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Activity Translations'), 'url' => ['index']];
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
