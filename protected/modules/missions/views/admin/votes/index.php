<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use humhub\widgets\GridView;

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
        
        <?php // if (count($reviews) != 0): ?>

        <?php
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    // [
                    //     'attribute' => 'id',
                    //     'options' => ['style' => 'width:40px;'],
                    //     'format' => 'raw',
                    //     'value' => function($data) {
                    //         return $data->id;
                    //     },
                    // ],
                    [
                        'attribute' => 'author',
                        'options' => ['style' => 'width:40px;'],
                        'format' => 'raw',
                        'value' => function($data) {
                            return $data->user->username;
                        },
                    ],
                    [
                        'attribute' => 'flag',
                        'label' => Yii::t('MissionsModule.base', 'Yes or No'),
                        'options' => ['style' => 'width:40px;'],
                        'format' => 'raw',
                        'value' => function($data) {
                            return ($data->flag == 0) ? Yii::t('MissionsModule.base', 'No') : Yii::t('MissionsModule.base', 'Yes');
                        },
                    ],
                    [
                        'attribute' => 'value',
                        'options' => ['style' => 'width:40px;'],
                        'format' => 'raw',
                        'value' => function($data) {
                            return $data->value;
                        },
                    ],
                    [
                        'header' => Yii::t('MissionsModule.views_user_index', 'Actions'),
                        'class' => 'yii\grid\ActionColumn',
                        'options' => ['style' => 'width:80px; min-width:80px;'],
                        'buttons' => [
                            'view' => function($url, $model) {
                                return Html::a(Yii::t('MissionsModule.base', 'Jump to Post'), Url::to(['/content/perma', 'id' => $model->evidence->getContentObject()->id]), ['class' => 'btn btn-success btn-sm']);
                            },
                            'update' => function($url, $model) {
                                return Html::a(Yii::t('MissionsModule.base', 'View'), Url::to(['view-reviews', 'id' => $model->id]), ['class' => 'btn btn-info btn-sm']);
                            },
                            'delete' => function($url, $model) {
                                return Html::a(Yii::t('MissionsModule.base', 'Delete'), Url::to(['delete-reviews', 'id' => $model->id]), ['class' => 'btn btn-danger btn-sm']);
                            }
                        ],
                    ],
                ]
            ]);
        ?>

        
            <!-- <table class="table">
                <tr>
                    <th><?php echo Yii::t('MissionsModule.base', 'Author'); ?></th>
                    <th><?php echo Yii::t('MissionsModule.base', 'Yes or No'); ?></th>
                    <th><?php echo Yii::t('MissionsModule.base', 'Value'); ?></th>
                    <th>&nbsp;</th>
                </tr>
                <?php //foreach ($reviews as $review): ?>
                    <tr>
                        <td><?php //echo $review->user->username; ?></td>
                        <td>
                            <?php //echo ($review->flag == 0) ? Yii::t('MissionsModule.base', 'No') : Yii::t('MissionsModule.base', 'Yes') ?>
                        </td>
                        <td><?php //echo $review->value; ?></td>
                        <td>
                            <a class = "btn btn-success btn-sm" target="_blank" href="<?php //Url::to(['/content/perma', 'id' => $review->evidence->getContentObject()->id]) ?>">
                                <?php// Yii::t('MissionsModule.base', 'Jump to Post') ?>
                            </a>
                            &nbsp;&nbsp;
                            <?php //echo Html::a(
                                //Yii::t('MissionsModule.base', 'View'),
                                //['view-reviews', 'id' => $review->id], array('class' => 'btn btn-info btn-sm')); ?>
                            &nbsp;&nbsp;
                            <?php //echo Html::a(
                                //Yii::t('MissionsModule.base', 'Delete'),
                                //['delete-reviews', 'id' => $review->id], array(
                                //'class' => 'btn btn-danger btn-sm',
                                //'data' => [
                                //    'confirm' => Yii::t('MissionsModule.base', 'Are you sure you want to delete this review?'),
                                //    'method' => 'post',
                                //],
                                //)); ?> 
                        </td>
                    </tr>
                <?php //endforeach; ?>
            </table> -->

        <!-- <?php //else: ?>

            <p><?php //echo Yii::t('MissionsModule.base', 'No reviews created yet!'); ?></p>


        <?php //endif; ?> -->

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


