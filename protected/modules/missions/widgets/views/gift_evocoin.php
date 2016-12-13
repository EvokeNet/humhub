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

    <div class="panel-body">
        <div class="col-xs-4">
            <?php
                $form = CActiveForm::begin(['id' => 'gift_evocoins']);
            ?>
            <p>
                <input name="Gift[evocoins]" id = "evocoins_value" type="number" min="0" max="<?= $wallet->amount ?>" value="0">
            </p>
            <?php
                echo \humhub\widgets\AjaxButton::widget([
                  'label' => Yii::t('MissionsModule.base', 'Give Evocoins'),
                  'beforeSend' => new yii\web\JsExpression("function(html){  if(!confirm('".Yii::t('MissionsModule.base', 'Are you sure?')."')){return false;} }"),
                  'ajaxOptions' => [
                      'dataType' => 'json',
                      'type' => 'POST',
                      'url' => Url::to(['/missions/gift/evocoins', 'user_id' => $user->id]),
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

</div>

