<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use humhub\compat\CActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\missions\models\EvokationCategoryTranslations */

$this->title = Yii::t('app', 'Create Evokation Category Translations');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Evokation Category Translations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);
?>
<div class="panel panel-default">
    <div class="panel-heading"><strong><?php echo $this->title; ?></strong></div>
    <div class="panel-body">

        <div class="evokation-category-translations-create">

            <?= $this->render('_form', [
                'model' => $model
            ]) ?>

        </div>

    </div>
</div>
