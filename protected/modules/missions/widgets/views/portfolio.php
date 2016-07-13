<?php

// use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\coin\models\Wallet;
use app\modules\missions\models\Portfolio;

$wallet = Wallet::findOne(['owner_id' => Yii::$app->user->getIdentity()->id]);
$totalAmount = Portfolio::getTotalInvestment(Yii::$app->user->getIdentity()->id);

?>

<div class="panel panel-default portfolio">
    <div class="panel-heading">
        <strong>
            <?= Yii::t('MissionsModule.base', 'Portfolio') ?>
        </strong>
    </div>
    <div class="panel-body">
        <table>
            <div>
                <div class="col-xs-8">
                   <strong style="margin-left: -10%">
                        <?= Yii::t('MissionsModule.base', 'Evokation Name') ?>
                    </strong>
                </div>

                <div class="col-xs-4">
                    <strong>
                        <?= Yii::t('MissionsModule.base', 'Investment') ?>
                    </strong> 
                </div>
            </div>

            <?php if(empty($portfolio)): ?>
                <?= Yii::t('MissionsModule.base', 'Add an evokation to invest') ?>
            <?php endif; ?>
                
            <?php foreach($portfolio as $evokation_investment): ?>    
            <div>
                <div class="col-xs-8">
                    <div class="padding-fromtop-5px margin-toleft-10">
                        <a href="<?= $evokation_investment->getEvokationObject()->content->getUrl() ?>">
                            <?= $evokation_investment->getEvokationObject()->title ?>
                        </a>
                    </div>
                </div>

                <div class="col-xs-4">
                    <div class="container margin-toleft-25">
                        <div class="input-group spinner">
                            <input id = "evokation_<?= $evokation_investment->evokation_id ?>" type="text" class="form-control" value="<?= $evokation_investment->investment ?>">
                            <input id = "oldvalue" type="hidden" value="<?= $evokation_investment->investment ?>">
                            <div class="input-group-btn-vertical">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-caret-up"></i>
                                </button>
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-caret-down"></i>
                                </button>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>   
            <?php endforeach; ?>
                
        </table>
    </div>

    <HR>

    <div class="panel-body">
        <div class="col-xs-4">
            <a class = "btn btn-info" href=''>
                    <?= Yii::t('MissionsModule.base', 'Save') ?>
            </a> 
        </div>

        <div class="col-xs-8" style="text-align: right;">
            <div class="margin-toright-10">
                <strong>
                    <?= Yii::t('MissionsModule.base', 'Total') ?>:  
                </strong>
                <div id="totalAmount" style="display: inline-block;">
                  <?= $totalAmount ?>
                </div>
                <BR>
                <strong>
                    <?= Yii::t('MissionsModule.base', 'Remaining') ?>:  
                </strong>
                <div id="remainingAmount" style="display: inline-block;">
                  <?= $wallet->amount - $totalAmount ?>
                </div>
            </div>
        </div>
    </div>

</div>

<style type="text/css">

.padding-fromtop-5px{
    padding-top: 5px;
}

.margin-toleft-10{
    margin-left: -10%;
}

.margin-toleft-25{
    margin-left: -25%;
}

.margin-toright-10{
    margin-right: -10%;
}

.spinner {
  width: 70px;
}
.spinner input {
  text-align: right;
}
.input-group-btn-vertical {
  position: relative;
  white-space: nowrap;
  width: 1%;
  vertical-align: middle;
  display: table-cell;
}
.input-group-btn-vertical > .btn {
  display: block;
  float: none;
  width: 100%;
  max-width: 100%;
  padding: 8px;
  margin-left: -1px;
  position: relative;
  border-radius: 0;
}
.input-group-btn-vertical > .btn:first-child {
  border-top-right-radius: 4px;
}
.input-group-btn-vertical > .btn:last-child {
  margin-top: -2px;
  border-bottom-right-radius: 4px;
}
.input-group-btn-vertical i{
  position: absolute;
  top: 0;
  left: 4px;
}

</style>


<script type="text/javascript">
  var totalAmount = document.getElementById('totalAmount');
  var remainingAmount = document.getElementById('remainingAmount');

    (function ($) {
      $('.spinner .btn:first-of-type').on('click', function(e) {
        var inputInvestment = e.target.parentElement.parentElement.parentElement.getElementsByClassName('form-control');
        inputInvestment[0].value = parseInt(inputInvestment[0].value) + 1;
        totalAmount.innerHTML = parseInt(totalAmount.innerHTML) + 1;
        remainingAmount.innerHTML = parseInt(remainingAmount.innerHTML) - 1;
      });

      $('.spinner .btn:last-of-type').on('click', function(e) {
        var inputInvestment = e.target.parentElement.parentElement.parentElement.getElementsByClassName('form-control');
        inputInvestment[0].value = parseInt(inputInvestment[0].value) - 1;
        totalAmount.innerHTML = parseInt(totalAmount.innerHTML) - 1;
        remainingAmount.innerHTML = parseInt(remainingAmount.innerHTML) + 1;
      });

      $('.form-control').change (function(e) {
        var inputInvestment = e.target.value;
        var oldInputInvestment = $(e.target).parent().find('#oldvalue');
        var diff = 0;

        //if new value is integer and >= 0
        if (isInt(inputInvestment) && inputInvestment >= 0){
            diff = parseInt(inputInvestment) - parseInt(oldInputInvestment.val());
            oldInputInvestment.val(inputInvestment);
            totalAmount.innerHTML = parseInt(totalAmount.innerHTML) + diff;
            remainingAmount.innerHTML = parseInt(remainingAmount.innerHTML) - diff;
        }

      });




    })(jQuery);

    function change(inputInvestment, diff){
        var oldInputInvestment = $(e.target).parent().find('#oldvalue');

    }

    function isInt(value) {
        var x;
        if (isNaN(value)) {
            return false;
        }
        x = parseFloat(value);
        return (x | 0) === x;
    }


</script>