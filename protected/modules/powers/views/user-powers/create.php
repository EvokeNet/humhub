<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\powers\models\UserPowers */

$this->title = Yii::t('PowersModule.base', 'Create User Powers');
$this->params['breadcrumbs'][] = ['label' => Yii::t('PowersModule.base', 'User Powers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-powers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
