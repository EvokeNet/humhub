<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\powers\models\PowerTranslations */

$this->title = Yii::t('app', 'Create Power Translations');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Power Translations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="power-translations-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
