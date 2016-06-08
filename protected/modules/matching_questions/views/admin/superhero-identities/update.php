<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
/* @var $this yii\web\View */
/* @var $model app\modules\matching_questions\models\SuperheroIdentities */

$this->title = Yii::t('MatchingModule.base', 'Update {modelClass}: ', [
    'modelClass' => 'Superhero Identities',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('MatchingModule.base', 'Superhero Identities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('MatchingModule.base', 'Update');
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
