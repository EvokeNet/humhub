  <?php

// use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use humhub\compat\CActiveForm;
?>

<div class="panel panel-default portfolio">
    <div class="panel-heading">
        <strong>
            <?= Yii::t('MissionsModule.base', 'Gift') ?>
        </strong>
    </div>

    <div class="panel-body" style="text-align:center; margin-top:10px">
        <?php
            $form = CActiveForm::begin(['id' => 'gift_evocoins']);
        ?>
        <input name="Gift[evocoins]" id = "evocoins_value" type="number" min="0" max="<?= $wallet->amount ?>" value="0"><br /><br />
        <?php
            echo \humhub\widgets\AjaxButton::widget([
                'label' => Yii::t('MissionsModule.base', 'Give Evocoins'),
                'beforeSend' => new yii\web\JsExpression("function(html){  if(!confirm('".Yii::t('MissionsModule.base', 'Are you sure?')."')){return false;} }"),
                'ajaxOptions' => [
                    'dataType' => 'json',
                    'type' => 'POST',
                    'url' => Url::to(['/missions/gift/evocoins', 'user_id' => $user->id]),
                    'complete' => new yii\web\JsExpression('function(){
                    loadPopUps(); updateEvocoins();
                    }'),
                ],
                'htmlOptions' => [
                    'class' => 'btn btn-cta2',
                    'id' => 'gift_evocoins_submit',
                    'type' => 'submit'
                ]
            ]);
        
            CActiveForm::end(); 
        ?>
    </div>

</div>

