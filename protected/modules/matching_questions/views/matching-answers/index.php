<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\matching_questions\models\MatchingAnswersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('MatchingModule.base', 'Matching Answers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="matching-answers-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('MatchingModule.base', 'Create Matching Answers'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'description',
            'matching_question_id',
            'social_innovator_quality_id',
            'created',
            // 'modified',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
