<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$this->title = Yii::t('MissionsModule.base', 'Evokation Category Translations');
$this->params['breadcrumbs'][] = ['label' => Yii::t('MissionsModule.base', 'Evokation Categories'), 'url' => ['index-categories']];
$this->params['breadcrumbs'][] = Yii::t('MissionsModule.base', 'Category: {category}', array('category' => $category->title));
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

        <div style="position: absolute; top: 10px; right: 10px;"><?php echo Html::a(Yii::t('MissionsModule.base', 'Create new Evokation Category Translation'), ['create-category-translations', 'id' => $category->id], array('class' => 'btn btn-success')); ?></div>
        
        <br><br>
        
        <?php if (count($categories) != 0): ?>
        
            <table class="table">
                <tr>
                    <!--<th><?php //echo Yii::t('MissionsModule.base', 'ID Code'); ?></th>-->
                    <th><?php echo Yii::t('MissionsModule.base', 'Title'); ?></th>
                    <th><?php echo Yii::t('MissionsModule.base', 'Description'); ?></th>
                    <th><?php echo Yii::t('MissionsModule.base', 'Language'); ?></th>
                    <th>&nbsp;</th>
                </tr>
                <?php foreach ($categories as $category): ?>
                    <tr>
                        <!--<td><?php //echo $category->id_code; ?></td>-->
                        <td><?php echo $category->title; ?></td>
                        <td><?php echo $category->description; ?></td>
                        <td><?php echo $category->language->language; ?></td>
                        <td>
                            <?php echo Html::a(
                                Yii::t('MissionsModule.base', 'Update'),
                                ['update-category-translations', 'id' => $category->id], array('class' => 'btn btn-primary btn-sm')); ?>
                            &nbsp;&nbsp;
                            <?php echo Html::a(
                                Yii::t('MissionsModule.base', 'Delete'),
                                ['delete-category-translations', 'id' => $category->id], array(
                                'class' => 'btn btn-danger btn-sm',
                                'data' => [
                                    'confirm' => Yii::t('MissionsModule.base', 'Are you sure you want to delete this category?'),
                                    'method' => 'post',
                                ],
                                )); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

        <?php else: ?>

            <p><?php echo Yii::t('MissionsModule.base', 'No categories created yet!'); ?></p>


        <?php endif; ?>

    </div>
</div>


