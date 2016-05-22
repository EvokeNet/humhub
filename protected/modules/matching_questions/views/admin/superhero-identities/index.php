<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\matching_questions\models\QualitiesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('MatchingQuestionsModule.base', 'Superhero Identities');
$this->params['breadcrumbs'][] = $this->title;

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3><?php echo Yii::t('MatchingQuestionsModule.base', 'Superhero Identities'); ?></h3>
    </div>
    <div class="panel-body">

        <?php echo Html::a(Yii::t('MatchingQuestionsModule.base', 'Create new Superhero Identity'), ['create-superhero-identities'], array('class' => 'btn btn-success')); ?>
        
        <br><br>
        
        <?php if (count($identities) != 0): ?>
        
            <table class="table">
                <tr>
                    <!--<th><?php echo Yii::t('MatchingQuestionsModule.base', 'ID Code'); ?></th>-->
                    <th><?php echo Yii::t('MatchingQuestionsModule.base', 'Name'); ?></th>
                    <th><?php echo Yii::t('MatchingQuestionsModule.base', 'Description'); ?></th>
                    <th><?php echo Yii::t('MatchingQuestionsModule.base', 'Primary Quality'); ?></th>
                    <th><?php echo Yii::t('MatchingQuestionsModule.base', 'Secondary Quality'); ?></th>
                    <th><?php echo Yii::t('MatchingQuestionsModule.base', 'Primary Power'); ?></th>
                    <th><?php echo Yii::t('MatchingQuestionsModule.base', 'Secondary Power'); ?></th>
                    <th>&nbsp;</th>
                </tr>
                <?php foreach ($identities as $identity): ?>
                    <tr>
                        <!--<td><?php //echo $quality->id_code; ?></td>-->
                        <td><?php echo $identity->name; ?></td>
                        <td><?php echo $identity->description; ?></td>
                        <td><?php echo $identity->quality_1; ?></td>
                        <td><?php echo $identity->quality_2; ?></td>
                        <td><?php echo $identity->primary_power; ?></td>
                        <td><?php echo $identity->secondary_power; ?></td>
                        <td>
                            <?php echo Html::a(
                                Yii::t('MatchingQuestionsModule.base', 'View translations'),
                                ['index-superhero-identity-translations', 'id' => $identity->id], array('class' => 'btn btn-warning btn-sm')); ?>
                            &nbsp;&nbsp;
                            <?php echo Html::a(
                                Yii::t('MatchingQuestionsModule.base', 'Update'),
                                ['update-superhero-identities', 'id' => $identity->id], array('class' => 'btn btn-primary btn-sm')); ?>
                            &nbsp;&nbsp;
                            <?php echo Html::a(
                                Yii::t('MatchingQuestionsModule.base', 'Delete'),
                                ['delete-superhero-identities', 'id' => $identity->id], array(
                                'class' => 'btn btn-danger btn-sm',
                                'data' => [
                                    'confirm' => Yii::t('MatchingQuestionsModule.base', 'Are you sure you want to delete this superhero identity?'),
                                    'method' => 'post',
                                ],
                                )); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

        <?php else: ?>

            <p><?php echo Yii::t('MatchingQuestionsModule.base', 'No superhero identity created yet!'); ?></p>


        <?php endif; ?>

    </div>
</div>
