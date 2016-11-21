 <?php
    use yii\helpers\Html;
    use yii\helpers\Url;
 ?>
 <div id="evokation_row_<?= $evokation_investment->evokation_id ?>" class="evokation_row row">
    <div class="col-xs-7">
        <div class="padding-fromtop-5px">
            <a href='<?= Url::to(['/missions/evokations/view', 'id' => $evokation_investment->getEvokationObject()->id, 'sguid' => $evokation_investment->getEvokationObject()->content->container->guid]); ?>'>
                <?= $evokation_investment->getEvokationObject()->getTitle() ?>
            </a>
        </div>
    </div>

    <?php if ($deadline && $deadline->isOccurring()): ?>
        <div class="col-xs-5">
            <div class="container2" style = "display:inline-flex">
                <div class="input-group spinner">
                    <input id = "evokation_<?= $evokation_investment->evokation_id ?>" type="text" class="form-control investment_input" value="<?= $evokation_investment->investment ?>">
                    <input id = "oldvalue" type="hidden" value="<?= $evokation_investment->investment ?>">
                        <!--
                        <div class="input-group-btn-vertical">
                            <button class="btn btn-default" type="button">
                                <i class="fa fa-caret-up"></i>
                            </button>
                            <button class="btn btn-default" type="button">
                                <i class="fa fa-caret-down"></i>
                            </button>
                        </div>
                        -->
                </div>
                <a href='#' onclick="deleteEvokation(<?= $evokation_investment->evokation_id ?>, '<?= $evokation_investment->getEvokationObject()->title ?>');">
                    <span class="glyphicon glyphicon-trash" style ="color: #FB656F; top:15px; left:5px"></span>
                </a>
            </div>
        </div>
    <?php else: ?>
        <div class="col-xs-5">
            <div class="container2">
                <div class="input-group spinner">
                    <?= $evokation_investment->investment ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>