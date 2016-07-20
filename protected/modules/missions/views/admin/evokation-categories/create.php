<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use humhub\compat\CActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\missions\models\EvokationCategories */

$this->title = Yii::t('MissionsModule.base', 'Create Evokation Categories');
$this->params['breadcrumbs'][] = ['label' => Yii::t('MissionsModule.base', 'Evokation Categories'), 'url' => ['index-categories']];
$this->params['breadcrumbs'][] = $this->title;

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

?>
<div class="panel panel-default">
    <div class="panel-heading"><strong><?php echo $this->title; ?></strong></div>
    <div class="panel-body">

        <div class="activities-create">

            <?= $this->render('_form', [
                'model' => $model
            ]) ?>

        </div>

    </div>
</div>
