<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\powers\models\Powers */

$this->title = Yii::t('CoinModule.base', 'Credit Coins to') . ' ' . $model->getOwner()->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('CoinModule.base', 'Coin'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('CoinModule.base', 'Update');

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

?>

<div class="panel panel-default">
    <div class="panel-heading"><strong><?php echo $this->title; ?></strong></div>
    <div class="panel-body">

        <div class="matching-questions-create">

          <form action="/humhub/index.php?r=coin%2Fadmin%2Fupdate&id=<?php echo $model->id; ?>" method="post">
            <label for="wallet-credit"><?= Yii::t('CoinModule.base', 'Credit'); ?></label>
            <input type="integer" name="wallet-credit" value="0"></input>
            <?= Html::submitButton(Yii::t('CoinModule.base', 'Give Coins'), ['class' => 'btn btn-primary']) ?>
          </form>
        </div>

    </div>
</div>
