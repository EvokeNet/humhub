<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\matching_questions\models\SuperheroIdentityTranslations */

$this->title = Yii::t('MatchingModule.base', 'Create Superhero Identity Translations');
$this->params['breadcrumbs'][] = ['label' => Yii::t('MatchingModule.base', 'Superhero Identity Translations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="superhero-identity-translations-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
