<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$this->title = Yii::t('MissionsModule.base', 'Tags');
$this->params['breadcrumbs'][] = $this->title;

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3><?php echo $this->title; ?></h3>
    </div>
    <div class="panel-body">

        <div style="position: absolute; top: 10px; right: 10px;"><?php echo Html::a(Yii::t('MissionsModule.base', 'Create new Tag'), ['create-tags'], array('class' => 'btn btn-success')); ?></div>
        
        <br><br>
        
        <?php if (count($tags) != 0): ?>
        
            <table class="table">
                <tr>
                    <!--<th><?php //echo Yii::t('MissionsModule.base', 'ID Code'); ?></th>-->
                    <th><?php echo Yii::t('MissionsModule.base', 'Title'); ?></th>
                    <th><?php echo Yii::t('MissionsModule.base', 'Description'); ?></th>
                    <th>&nbsp;</th>
                </tr>
                <?php foreach ($tags as $tag): ?>
                    <tr>
                        <!--<td><?php //echo $tag->id_code; ?></td>-->
                        <td><?php echo $tag->title; ?></td>
                        <td><?php echo $tag->description; ?></td>
                        <td>
                            <?php echo Html::a(
                                Yii::t('MissionsModule.base', 'View translations'), 
                                ['index-tag-translations', 'id' => $tag->id], array('class' => 'btn btn-warning btn-sm')); ?>
                            &nbsp;&nbsp;
                            <?php echo Html::a(
                                Yii::t('MissionsModule.base', 'Update'),
                                ['update-tags', 'id' => $tag->id], array('class' => 'btn btn-primary btn-sm')); ?>
                            &nbsp;&nbsp;
                            <?php echo Html::a(
                                Yii::t('MissionsModule.base', 'Delete'),
                                ['delete-tags', 'id' => $tag->id], array(
                                'class' => 'btn btn-danger btn-sm',
                                'data' => [
                                    'confirm' => Yii::t('MissionsModule.base', 'Are you sure you want to delete this tag?'),
                                    'method' => 'post',
                                ],
                                )); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

        <?php else: ?>

            <p><?php echo Yii::t('MissionsModule.base', 'No tags created yet!'); ?></p>


        <?php endif; ?>

    </div>
</div>


