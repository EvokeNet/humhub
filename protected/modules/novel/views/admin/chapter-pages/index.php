<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\widgets\Breadcrumbs;

$this->title = Yii::t('NovelModule.base', 'Chapter Pages');
$this->params['breadcrumbs'][] = ['label' => Yii::t('NovelModule.base', 'Chapter'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $chapter->id;
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

        <?php echo Html::a(Yii::t('NovelModule.base', 'Create new page'), ['create-chapter-pages', 'chapter_id' => $chapter->id], array('class' => 'btn btn-success')); ?>
        <?php echo Html::a(Yii::t('NovelModule.base', 'Add an existent page'), ['add-chapter-pages', 'id' => $chapter->id], array('class' => 'btn btn-success')); ?>
        
        <br><br>
        
        <?php if (count($pages) > 0): ?>
        
            <table class="table">
                <tr>
                
                    <th><?php echo Yii::t('NovelModule.base', 'Page ID'); ?></th>
                    <th><?php echo Yii::t('NovelModule.base', 'Page Number'); ?></th>
                    <th>&nbsp;</th>
                </tr>
                <?php foreach ($pages as $page): ?>
                    <tr>
                        <td><?php echo $page->novel_id; ?></td>
                        <td><?php echo $page->novel->page_number; ?></td>
                        <td>
                            <?php echo Html::a(
                                Yii::t('NovelModule.base', 'Update'),
                                ['update-chapter-pages', 'chapter_id' => $page->chapter_id, 'page_id' => $page->novel_id], array('class' => 'btn btn-primary btn-sm')); ?>
                            &nbsp;&nbsp;
                            <?php echo Html::a(
                                Yii::t('NovelModule.base', 'Delete'),
                                ['delete-chapter-pages', 'chapter_id' => $page->chapter_id, 'page_id' => $page->novel_id], array(
                                'class' => 'btn btn-danger btn-sm',
                                'data' => [
                                    'confirm' => Yii::t('NovelModule.base', 'Are you sure you want to delete this item?'),
                                    'method' => 'post',
                                ],
                                )); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

        <?php else: ?>

            <p><?php echo Yii::t('NovelModule.base', 'No chapter page added yet!'); ?></p>


        <?php endif; ?>

    </div>
</div>
