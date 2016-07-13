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
                        <a href='<?= Url::to(['/missions/evokations/view', 'id' => $evokation_investment->getEvokationObject()->id, 'sguid' => $evokation_investment->getEvokationObject()->content->container->guid]); ?>'>
                            <?= $evokation_investment->getEvokationObject()->title ?>
                        </a>
                    </div>
                </div>

                <div class="col-xs-4">
                    <div class="container margin-toleft-25">
                        <div class="input-group spinner">
                            <input id = "evokation_<?= $evokation_investment->evokation_id ?>" type="text" class="form-control investment_input" value="<?= $evokation_investment->investment ?>">
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
            <a class = "btn btn-info" href='#' onclick="updatePortfolio();">
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

    <div id="portfolio_status" class="panel-body">
        Updating Portfolio
    </div>

</div>

<style type="text/css">

#portfolio_status{
    color: red;
    display: none;
}

#portfolio_status:after {
  overflow: hidden;
  display: inline-block;
  vertical-align: bottom;
  -webkit-animation: ellipsis steps(4,end) 900ms infinite;      
  animation: ellipsis steps(4,end) 900ms infinite;
  content: "\2026"; /* ascii code for the ellipsis character */
  width: 0px;
}

@keyframes ellipsis {
  to {
    width: 20px;    
  }
}

@-webkit-keyframes ellipsis {
  to {
    width: 20px;    
  }
}

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
    var raiseInvestmentInterval, decreaseInvestmentInterval;


    function updatePortfolio() {
        var evok_id, evok_value;
        var evokations = {};

        var evokation_array = document.getElementsByClassName('investment_input');

        for(var x = 0; x < evokation_array.length; x++){
            evok_value = evokation_array[x].value;
            evok_id = evokation_array[x].id.slice(10);
            evokations[evok_id] = evok_value;
        }

        $('#portfolio_status').show();

        $.ajax({
            url: '<?= Url::to(['/missions/portfolio/update']); ?>',
            type: 'post',
            dataType: 'json',
            success: function (data) {
                if(data.status == 'success'){
                    $('#portfolio_status').hide();
                    showMessage("<?= Yii::t('MissionsModule.base', 'Updated') ?>", "<?= Yii::t('MissionsModule.base', 'Portfolio updated successfully!') ?>");
                }
                
            },
            data: evokations
        });
    }

    (function ($) {
      $('.spinner .btn:first-of-type').on('click', function(e) {
            var inputInvestment = e.target.parentElement.parentElement.parentElement.getElementsByClassName('form-control');
            raiseInvestment(inputInvestment[0]);
      });

      $('.spinner .btn:first-of-type').mousedown(function(e) {
            var inputInvestment = e.target.parentElement.parentElement.parentElement.getElementsByClassName('form-control');
        
            raiseInvestmentInterval = setInterval(function(){
                raiseInvestment(inputInvestment[0]);
            }, 150);
      });

      $('.spinner .btn:first-of-type').mouseup(function(e) {
            var inputInvestment = e.target.parentElement.parentElement.parentElement.getElementsByClassName('form-control');
            clearInterval(raiseInvestmentInterval);
      });

      $('.spinner .btn:last-of-type').on('click', function(e) {
            var inputInvestment = e.target.parentElement.parentElement.parentElement.getElementsByClassName('form-control');
            decreaseInvestment(inputInvestment[0]);
      });

      $('.spinner .btn:last-of-type').mousedown(function(e) {
            var inputInvestment = e.target.parentElement.parentElement.parentElement.getElementsByClassName('form-control');
        
            decreaseInvestmentInterval = setInterval(function(){
                decreaseInvestment(inputInvestment[0]);
            }, 150);
      });

      $('.spinner .btn:last-of-type').mouseup(function(e) {
            var inputInvestment = e.target.parentElement.parentElement.parentElement.getElementsByClassName('form-control');
            clearInterval(decreaseInvestmentInterval);
      });

      $('.form-control').change(function(e) {
            var inputInvestment = e.target.value;
            change(e.target, inputInvestment);
      });

    })(jQuery);

    function raiseInvestment(target){
        target.value = parseInt(target.value) + 1;
        change(target, target.value)
    }

    function decreaseInvestment(target){
        if(target.value > 0){
            target.value = parseInt(target.value) - 1;
            change(target, target.value)
        }
    }

    function change(target, inputInvestment){
        var oldInputInvestment = $(target).parent().find('#oldvalue');

        if (isInt(inputInvestment) && inputInvestment >= 0){
            diff = parseInt(inputInvestment) - parseInt(oldInputInvestment.val());
            newRemainingValue = parseInt(remainingAmount.innerHTML) - diff;

            if(newRemainingValue >=0){
              oldInputInvestment.val(inputInvestment);
              totalAmount.innerHTML = parseInt(totalAmount.innerHTML) + diff;
              remainingAmount.innerHTML = newRemainingValue;
            }else{
              target.value = oldInputInvestment.val();
            }          
        }
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