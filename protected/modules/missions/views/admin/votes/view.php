<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $model app\modules\missions\models\Votes */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('MissionsModule.base', 'Votes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3><strong><?php echo $this->title; ?></strong></h3>
    </div>
    <div class="panel-body">

        <div class="votes-view">

            <p>
                <?php // echo Html::a(Yii::t('MissionsModule.base', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
                <?php 
                    if($model->quality == 0){
                        echo Html::a(Yii::t('MissionsModule.base', 'Mark as quality review'), ['update-quality-reviews', 'id' => $model->id, 'mark' => 1, 'user_id' => $model->user_id], ['class' => 'btn btn-primary btn-sm']);
                    }
                    else{
                        echo Html::a(Yii::t('MissionsModule.base', 'Unmark as quality review'), ['update-quality-reviews', 'id' => $model->id, 'mark' => 0, 'user_id' => $model->user_id], ['class' => 'btn btn-primary btn-sm']); 
                    }
                ?>
                <?php echo Html::a(
                    Yii::t('MissionsModule.base', 'Delete'),
                    ['delete-reviews', 'id' => $model->id], array(
                    'class' => 'btn btn-danger btn-sm',
                    'data' => [
                        'confirm' => Yii::t('MissionsModule.base', 'Are you sure you want to delete this review?'),
                        'method' => 'post',
                    ],
                    )); ?> 
            </p><br>

            <?php echo Yii::t('MissionsModule.base', 'Activity {position}: {title}', array('position' => $evidence->activities->position, 'title' => $evidence->activities->title)); ?><br /><br />
            <?php echo Yii::t('MissionsModule.base', 'Evidence: {title}', array('title' => $evidence->title)); ?><br />
            <?php echo $evidence->text; ?><br /><br />

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    // 'user.username',
                    [                      // the owner name of the model
                        'label' => 'Author',
                        'value' => $model->user->username,
                    ],
                    'flag',
                    'comment',
                    'created_at',
                    'updated_at',
                ],
            ]) ?>

        </div>

    </div>
</div>
