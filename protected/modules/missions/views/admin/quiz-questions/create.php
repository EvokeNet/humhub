<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\missions\models\TagTranslations */

$this->title = Yii::t('app', 'Create Quiz Question');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Quiz'), 'url' => ['index-quiz']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quiz-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
