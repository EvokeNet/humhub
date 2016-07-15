<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\missions\models\EvokationDeadlineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Evokation Deadlines');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default">
    <div class="panel-heading">

        <h3><?= Html::encode($this->title) ?></h3h1>
    
    </div>
    <div class="panel-body">
        
        <?php if (isset($model)): ?>
        
        <p>
            <?= Html::a(Yii::t('MissionsModule.base', 'Update'), ['update-deadline', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('MissionsModule.base', 'Delete'), ['delete-deadline', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('MissionsModule.base', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        </p>
        
        <table class="table">
        <thead>
            <tr>
                <th><?= Yii::t('MissionsModule.base', 'Start Date') ?></th>
                <th><?= Yii::t('MissionsModule.base', 'Close Date') ?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td scope="row"><?= date_format(date_create($model->start_date), "d/m/Y") ?></td>
                <td><?= date_format(date_create($model->finish_date), "d/m/Y") ?></td>
            </tr>
        </tbody>
        </table>

        <?php else: ?>
            
            <p>
                <?= Html::a(Yii::t('MissionsModule.base', 'Create Deadline'), ['create-deadline'], ['class' => 'btn btn-success']) ?>
            </p>
        
            <p><?php echo Yii::t('MissionsModule.base', 'No deadline defined yet!'); ?></p>

        <?php endif; ?>
            
</div>
</div>
