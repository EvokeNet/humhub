<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use humhub\compat\CHtml;

?>
<div class="panel panel-default">
    <div class="panel-heading"><?php echo Yii::t('MissionsModule.base', '<strong>Manage</strong> evidences'); ?></div>
    <div class="panel-body" style="padding: 0 10px">
        <div class="table-responsive">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    // ['class' => 'yii\grid\SerialColumn'],

                    // 'id',
                    'title',
                    // 'text:ntext',
                    // 'activities_id',
                    // [
                    //     // 'type' => 'raw',
                    //     'format' => 'raw',
                    //     'header' => Yii::t('MissionsModule.views_user_index', 'User'),
                    //     'value'=>function($data){
                    //         return Html::a($data->author->username, ['/user/profile', 'uguid' => $data->author->guid], ['class' => '']);
                    //     },

                    // ],
                    [
                        'attribute'=> 'username',
                        'value' => function ($data) {
                            return $data->getAuthor()->username;
                        }

                    ],
                    // [
                    //     'format' => 'html', 
                    //     'attribute' => 'username',
                    //     'filter'=> CHtml::listData(User::model()->with('idMarka')->findAll(array('group'=> 'id_marka', 'order'=> 'idMarka.mark')), 'id_marka', 'idMarka.mark'),
                    //     'value' => function($data, $row) { //$data is item of DataProvider, $row is number of row (starts from 0)
                    //         return $data->created_by;
                    //     }
                    // ],
                    // [
                    //     'attribute' => 'created_by',
                    //     'label' => Yii::t('MissionsModule.views_user_index', 'User'),
                    //     'filter' => \yii\jui\DatePicker::widget([
                    //         'model' => $searchModel,
                    //         'attribute' => 'last_login',
                    //         'options' => ['style' => 'width:86px;'],
                    //     ]),
                    //     'value' => function ($data) {
                    //         return ($data->last_login == NULL) ? Yii::t('AdminModule.views_user_index', 'never') : Yii::$app->formatter->asDate($data->last_login);
                    //     }
                    // ],
                    [
                        'attribute' => 'created_at',
                        'format' => ['date', 'php:m-d-Y']
                    ],
                    'created_by',
                    // 'updated_at',
                    // 'updated_by',

                    // ['class' => 'yii\grid\ActionColumn'],
                    [
                    'header' => Yii::t('AdminModule.views_user_index', 'Actions'),
                    'class' => 'yii\grid\ActionColumn',
                    'options' => ['style' => 'width:80px; min-width:80px;'],
                    'buttons' => [
                        'view' => function($url, $model) {
                            return Html::a(Yii::t('MissionsModule.base', 'View Content'), ['view-evidences', 'id' => $model->id], ['class' => 'btn btn-warning btn-sm']);
                        },
                        'update' => function($url, $model) {
                            return Html::a(Yii::t('MissionsModule.base', 'Jump to Post'), ['/content/perma', 'id' => $model->getContentObject()->id], ['class' => 'btn btn-success btn-sm']);
                        },
                        'delete' => function($url, $model) {
                            return Html::a(Yii::t('MissionsModule.base', 'Delete'), ['delete-evidences', 'id' => $model->id], ['class' => 'btn btn-danger btn-sm', 'data' => [
                                'confirm' => Yii::t('MissionsModule.base', 'Are you sure you want to delete this evidence?'),
                                'method' => 'post',
                            ]]);
                        }
                        ],
                    ],
                    ],
                
                
            ]); ?>
        </div>
    </div>
</div>