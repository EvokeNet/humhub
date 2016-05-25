<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Breadcrumbs;

use humhub\modules\languages\models\Languages;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\books\models\BooksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Books');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-index">

    <h1><?= Html::encode($this->title) ?><?= $language ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Books'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <p>
        <?php echo Html::a('Create new translation', ['book-translations/create', 'id' => 1], array('class' => 'btn btn-success')); ?>
    </p>
    
    <div class="row">

        <div class="col-md-8 col-md-offset-2">
            
            <?php
                echo Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]);   
            ?>
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2><?php echo 'Books'; ?></h2>
                </div>
                <div class="panel-body">
                    
                    <?php if (count($books) != 0): ?>
                    
                        <?php foreach ($books as $mission): ?>
                            <?php echo $mission->id; ?><br>
                            <?php foreach ($mission->bookTranslations as $bt): ?>
                                <?php echo $bt->title. ' '. $bt->abstract; ?><br><br>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                        
                        <?php foreach ($customers as $mission): ?>
                            <?php echo $mission->id; ?><br>
                            <?php foreach ($mission->bookTranslations as $bt):?>
                                <?php echo $bt->title. ' '; ?><br><br>
                            <?php endforeach; ?>
                        <?php endforeach; ?>

                    <?php else: ?>

                        <p><?php echo Yii::t('MissionsModule.views_admin_index', 'No missions created yet!'); ?></p>

                    <?php endif; ?>

                </div>
            </div>

    </div>
</div>

</div>
