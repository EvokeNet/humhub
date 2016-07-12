<?php

// use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

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
                        Evokation Name
                    </strong>
                </div>

                <div class="col-xs-4">
                    <strong>
                        Investment
                    </strong> 
                </div>
            </div>
                
            <?php for($x = 1 ; $x <= 5; $x++): ?>    
            <div>
                <div class="col-xs-8">
                    <div class="padding-fromtop-5px margin-toleft-10">
                        <a href="">
                            Evokation Name
                        </a>
                    </div>
                </div>

                <div class="col-xs-4">
                    <div class="container margin-toleft-25">
                        <div class="input-group spinner">
                            <input type="text" class="form-control" value="42">
                            <div class="input-group-btn-vertical">
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>   
            <?php endfor; ?>
                
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
                    Total:  
                </strong>
                500
                <BR>
                <strong>
                    Remaning:  
                </strong>
                200
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

    (function ($) {
      $('.spinner .btn:first-of-type').on('click', function(e) {
        var inputInvestment = e.target.parentElement.parentElement.parentElement.getElementsByClassName('form-control');
        inputInvestment[0].value = parseInt(inputInvestment[0].value) + 1;
      });

      $('.spinner .btn:last-of-type').on('click', function(e) {
        var inputInvestment = e.target.parentElement.parentElement.parentElement.getElementsByClassName('form-control');
        inputInvestment[0].value = parseInt(inputInvestment[0].value) - 1;
      });
    })(jQuery);

</script>