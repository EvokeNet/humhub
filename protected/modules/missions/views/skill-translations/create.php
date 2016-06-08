<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\missions\models\SkillTranslations */

$this->title = Yii::t('app', 'Create Skill Translations');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Skill Translations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skill-translations-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
