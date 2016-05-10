<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\books\models\BookTranslations */

$this->title = Yii::t('app', 'Create Book Translations');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Book Translations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-translations-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
