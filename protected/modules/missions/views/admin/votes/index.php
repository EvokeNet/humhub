<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;

$this->title = Yii::t('MissionsModule.base', 'Reviews');
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
        
        <?php if (count($reviews) != 0): ?>
        
            <table class="table">
                <tr>
                    <th><?php echo Yii::t('MissionsModule.base', 'Author'); ?></th>
                    <th><?php echo Yii::t('MissionsModule.base', 'Yes or No'); ?></th>
                    <th><?php echo Yii::t('MissionsModule.base', 'Value'); ?></th>
                    <th>&nbsp;</th>
                </tr>
                <?php foreach ($reviews as $review): ?>
                    <tr>
                        <td><?php echo $review->user->username; ?></td>
                        <td>
                            <?php echo ($review->flag == 0) ? Yii::t('MissionsModule.base', 'No') : Yii::t('MissionsModule.base', 'Yes') ?>
                        </td>
                        <td><?php echo $review->value; ?></td>
                        <td>
                            <a class = "btn btn-success btn-sm" target="_blank" href="<?= Url::to(['/content/perma', 'id' => $review->evidence->getContentObject()->id]) ?>">
                                <?= Yii::t('MissionsModule.base', 'Jump to Post') ?>
                            </a>
                            &nbsp;&nbsp;
                            <?php echo Html::a(
                                Yii::t('MissionsModule.base', 'Delete'),
                                ['delete-reviews', 'id' => $review->id], array(
                                'class' => 'btn btn-danger btn-sm',
                                'data' => [
                                    'confirm' => Yii::t('MissionsModule.base', 'Are you sure you want to delete this review?'),
                                    'method' => 'post',
                                ],
                                )); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

        <?php else: ?>

            <p><?php echo Yii::t('MissionsModule.base', 'No reviews created yet!'); ?></p>


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


