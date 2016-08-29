<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;

$this->title = Yii::t('MissionsModule.base', 'Evidences');
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
        
        <?php if (count($evidences) != 0): ?>
        
            <table class="table">
                <tr>
                    <th><?php echo Yii::t('MissionsModule.base', 'Title'); ?></th>
                    <th><?php echo Yii::t('MissionsModule.base', 'Text'); ?></th>
                    <th><?php echo Yii::t('MissionsModule.base', 'Author'); ?></th>
                    <th>&nbsp;</th>
                </tr>
                <?php foreach ($evidences as $evidence): ?>
                    <tr>
                        <!--<td><?php //echo $category->id_code; ?></td>-->
                        <td><?php echo $evidence->title; ?></td>
                        <td class="text_min"><?php echo $evidence->text; ?></td>
                        <td>
                            <a href="<?= Url::to(['/user/profile', 'uguid' => $evidence->author->guid]) ?>">
                                <?php echo $evidence->author->username; ?>
                            </a>
                        </td>
                        <td>
                            <a class = "btn btn-warning btn-sm" target="_blank" href="<?= Url::to(['/content/perma', 'id' => $evidence->getContentObject()->id]) ?>">
                                <?= Yii::t('MissionsModule.base', 'View') ?>
                            </a>
                            &nbsp;&nbsp;
                            <?php echo Html::a(
                                Yii::t('MissionsModule.base', 'Delete'),
                                ['delete-evidences', 'id' => $evidence->id], array(
                                'class' => 'btn btn-danger btn-sm',
                                'data' => [
                                    'confirm' => Yii::t('MissionsModule.base', 'Are you sure you want to delete this evidence?'),
                                    'method' => 'post',
                                ],
                                )); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

        <?php else: ?>

            <p><?php echo Yii::t('MissionsModule.base', 'No evidences created yet!'); ?></p>


        <?php endif; ?>

    </div>
</div>

<style>

.text_min{
    text-overflow: ellipsis;
    max-width: 300px;
    max-height: 100px;
    white-space: nowrap;
    overflow: hidden !important;
}

</style>


