<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */

$this->title = Yii::t('NovelModule.base', 'Create New Novel');
$this->params['breadcrumbs'][] = ['label' => Yii::t('NovelModule.base', 'Graphic Novels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

?>

<div class="panel panel-default">
    <div class="panel-heading"><strong><?php echo $this->title; ?></strong></div>
    <div class="panel-body">

        <div class="matching-questions-create">

            <?= $this->render('..\novel-page\_form.php', [
                'model' => $model,
            ]) ?>

        </div>

    </div>
</div>
