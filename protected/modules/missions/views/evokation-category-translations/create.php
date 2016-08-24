<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\missions\models\EvokationCategoryTranslations */

$this->title = Yii::t('app', 'Create Evokation Category Translations');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Evokation Category Translations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evokation-category-translations-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
