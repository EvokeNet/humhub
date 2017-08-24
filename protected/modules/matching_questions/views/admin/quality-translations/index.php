<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\matching_questions\models\MatchingQuestionTranslationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('MatchingModule.base', 'Translations');
$this->params['breadcrumbs'][] = ['label' => Yii::t('MatchingModule.base', 'Qualities'), 'url' => ['index-qualities']];
$this->params['breadcrumbs'][] = $quality->name;
$this->params['breadcrumbs'][] = $this->title;

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3><?php echo Yii::t('MatchingModule.base', 'Translations'); ?></h3>
    </div>
    <div class="panel-body">

        <div style="position: absolute; top: 10px; right: 10px;"><?php echo Html::a(Yii::t('MatchingModule.base', 'Create new Translation'), ['create-quality-translations', 'id' => $quality->id], array('class' => 'btn btn-success')); ?></div>
        
        <br><br>
        
        <?php if (count($translations) != 0): ?>
        
            <table class="table">
                <tr>
                    <th><?php echo Yii::t('MatchingModule.base', 'Name'); ?></th>
                    <th><?php echo Yii::t('MatchingModule.base', 'Short Name'); ?></th>
                    <th><?php echo Yii::t('MatchingModule.base', 'Description'); ?></th>
                    <th><?php echo Yii::t('MatchingModule.base', 'Language'); ?></th>
                    <th>&nbsp;</th>
                </tr>
                <?php foreach ($translations as $translation): ?>
                    <tr>
                        <td><?php echo $translation->name; ?></td>
                        <td><?php echo $translation->short_name; ?></td>
                        <td><?php echo $translation->description; ?></td>
                        <td><?php echo $translation->language->code; ?></td>
                        <td>
                            <?php echo Html::a(
                                Yii::t('MatchingModule.base', 'Update'),
                                ['update-quality-translations', 'id' => $translation->id], array('class' => 'btn btn-primary btn-sm')); ?>
                            &nbsp;&nbsp;
                            <?php echo Html::a(
                                Yii::t('MatchingModule.base', 'Delete'),
                                ['delete-quality-translations', 'id' => $translation->id], array(
                                'class' => 'btn btn-danger btn-sm',
                                'data' => [
                                    'confirm' => Yii::t('MatchingModule.base', 'Are you sure you want to delete this translation?'),
                                    'method' => 'post',
                                ],
                                )); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

        <?php else: ?>

            <p><?php echo Yii::t('MatchingModule.base', 'No quality translations created yet!'); ?></p>


        <?php endif; ?>

    </div>
</div>
