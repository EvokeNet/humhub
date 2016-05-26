<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\matching_questions\models\QualityTranslations */

$this->title = Yii::t('MatchingModule.base', 'Create Quality Translations');
$this->params['breadcrumbs'][] = ['label' => Yii::t('MatchingModule.base', 'Quality Translations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quality-translations-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
