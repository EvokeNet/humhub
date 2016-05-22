<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;


/* @var $this yii\web\View */
/* @var $model app\modules\matching_questions\models\SuperheroIdentityTranslations */

$this->title = Yii::t('MatchingQuestionsModule.base', 'Create Superhero Identity Translations');
$this->params['breadcrumbs'][] = ['label' => Yii::t('MatchingQuestionsModule.base', 'Superhero Identities'), 'url' => ['index-superhero-identities']];
$this->params['breadcrumbs'][] = $superhero_identity->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('MatchingQuestionsModule.base', 'Superhero Identity Translation'), 'url' => ['index-superhero-identity-translations', 'id' => $superhero_identity->id]];
$this->params['breadcrumbs'][] = $this->title;

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

?>

<div class="panel panel-default">
    <div class="panel-heading"><strong><?php echo $this->title; ?></strong></div>
    <div class="panel-body">
        
        <div class="matching-questions-create">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
        
    </div>
</div>
