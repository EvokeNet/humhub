<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model humhub\modules\matching_questions\models\MatchingQuestionTranslations */

$this->title = Yii::t('app', 'Create Matching Question Translations');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Matching Question Translations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

?>
<div class="panel panel-default">
    <div class="panel-heading"><?php echo Yii::t('MissionsModule.views_admin_add-mission-translations', '<strong>Add</strong> new Mission Translation'); ?></div>
    <div class="panel-body">

        <div class="matching-question-translations-update">

            <?= $this->render('_form', [
                'model' => $model
            ]) ?>

        </div>

    </div>
</div>
