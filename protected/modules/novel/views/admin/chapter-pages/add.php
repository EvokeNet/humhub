<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$this->title = Yii::t('NovelModule.base', 'Add Chapter Page');
$this->params['breadcrumbs'][] = ['label' => Yii::t('NovelModule.base', 'Chapters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $chapter->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('NovelModule.base', 'Chapter Pages'), 'url' => ['index-chapter-pages', 'id' => $chapter->id]];
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
