<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$this->title = Yii::t('MissionsModule.base', 'Tag Translations');
$this->params['breadcrumbs'][] = ['label' => Yii::t('MissionsModule.base', 'Tags'), 'url' => ['index-tags']];
$this->params['breadcrumbs'][] = Yii::t('MissionsModule.base', 'Tag {tag}', array('tag' => $tag->title));
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

        <?php echo Html::a(Yii::t('MissionsModule.base', 'Create new Tag'), ['create-tag-translations', 'id' => $tag->id], array('class' => 'btn btn-success')); ?>
        
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
                                Yii::t('MissionsModule.base', 'Update'),
                                ['update-tag-translations', 'id' => $tag->id], array('class' => 'btn btn-primary btn-sm')); ?>
                            &nbsp;&nbsp;
                            <?php echo Html::a(
                                Yii::t('MissionsModule.base', 'Delete'),
                                ['delete-tag-translations', 'id' => $tag->id], array(
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

            <p><?php echo Yii::t('MissionsModule.base', 'No tag translations created yet!'); ?></p>


        <?php endif; ?>

    </div>
</div>


