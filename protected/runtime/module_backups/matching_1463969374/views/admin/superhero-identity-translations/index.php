<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\matching_questions\models\MatchingQuestionTranslationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('MatchingModule.base', 'Translations');
$this->params['breadcrumbs'][] = ['label' => Yii::t('MatchingModule.base', 'Superhero Identities'), 'url' => ['index-superhero-identity-translations']];
$this->params['breadcrumbs'][] = $superhero_identity->name;
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

        <?php echo Html::a(Yii::t('MatchingModule.base', 'Create new Translation'), ['create-superhero-identity-translations', 'id' => $superhero_identity->id], array('class' => 'btn btn-success')); ?>
        
        <br><br>
        
        <?php if (count($translations) != 0): ?>
        
            <table class="table">
                <tr>
                    <th><?php echo Yii::t('MatchingModule.base', 'Name'); ?></th>
                    <th><?php echo Yii::t('MatchingModule.base', 'Description'); ?></th>
                    <th><?php echo Yii::t('MatchingModule.base', 'Language'); ?></th>
                    <th>&nbsp;</th>
                </tr>
                <?php foreach ($translations as $translation): ?>
                    <tr>
                        <td><?php echo $translation->name; ?></td>
                        <td><?php echo $translation->description; ?></td>
                        <td><?php echo $translation->language->code; ?></td>
                        <td>
                            <?php echo Html::a(
                                Yii::t('MatchingModule.base', 'Update'),
                                ['update-superhero-identity-translations', 'id' => $translation->id], array('class' => 'btn btn-primary btn-sm')); ?>
                            &nbsp;&nbsp;
                            <?php echo Html::a(
                                Yii::t('MatchingModule.base', 'Delete'),
                                ['delete-superhero-identity-translations', 'id' => $translation->id], array(
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

            <p><?php echo Yii::t('MatchingModule.base', 'No superhero identity translations created yet!'); ?></p>


        <?php endif; ?>

    </div>
</div>
