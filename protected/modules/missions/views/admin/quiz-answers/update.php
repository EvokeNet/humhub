<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\missions\models\TagTranslations */

$this->title = Yii::t('app', 'Create Quiz Question Answer');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tag Translations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tag-translations-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
