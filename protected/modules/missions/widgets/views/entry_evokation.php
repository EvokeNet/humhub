<?php

use yii\helpers\Html;
use \yii\helpers\Url;
use app\modules\missions\models\Portfolio;

echo Html::beginForm(); 

$evokation_investment = Portfolio::find()
    ->where(['user_id' => Yii::$app->user->getIdentity()->id,'evokation_id' => $evokation->id])
    ->one();

$youtube_code = $evokation->youtube_url ? $evokation->getYouTubeCode($evokation->youtube_url) : null;

?>

<h5><?php print humhub\widgets\RichText::widget(['text' => $evokation->title]); ?></h5>
<p><?php print humhub\widgets\RichText::widget(['text' => $evokation->description]);?></p>
<br>

<?php if($youtube_code): ?>
    <iframe width="630" height="420" src="http://www.youtube.com/embed/<?php echo $youtube_code; ?>" frameborder="0" allowfullscreen></iframe>
<?php endif; ?>

<br><br>
<!-- INVESTMENT -->
<div class= "">
    <div class="">
        <h5>Investment</h5>
    </div>
        <div class="">
        <p>
            <b>Total Invesment:</b> <?= $total_investment ?> evokoins
        </p>
        <p>
            <b>Median Investment:</b>  <?= $median_investment ?> evokoins
        </p>
        <p>
            <b>Total Investors:</b> <?= $total_investors ?> agents
        </p>
    </div>
</div>

<br>

<div>
    <div style = "float:left">
        <a class = "btn btn-cta2" href='<?= Url::to(['/missions/evokations/view', 'id' => $evokation->id, 'sguid' => $contentContainer->guid]); ?>'>
            <?= Yii::t('MissionsModule.base', 'Read More') ?>
        </a>
    </div>

    <?php if(!$evokation_investment && $evokation->content->user_id != Yii::$app->user->getIdentity()->id): ?>

        <?php if (!$deadline || (strtotime(date('Y-m-d H:i:s')) > strtotime($deadline->start_date)) && (strtotime(date('Y-m-d H:i:s')) < strtotime($deadline->finish_date))): ?>
        <div style = "float:right">
            <a class = "btn btn-cta1" href="#" onClick="addEvokationToPortfolio<?= $evokation->id ?>();">
                <?= Yii::t('MissionsModule.base', 'Add to Portfolio') ?>
            </a>
        </div>
        <?php else: ?>
            <div style = "float:right">
                <a class = "btn btn-default" href='#'>
                    <?= Yii::t('MissionsModule.base', 'Voting Closed') ?>
                </a>
            </div>
        <?php endif; ?>

    <?php endif; ?>
</div>
            
<br><br>

<div class="clearFloats"></div>


<script type="text/javascript">

    function addEvokationToPortfolio<?= $evokation->id ?>(){

        do{
            var investment = parseInt(window.prompt("<?= Yii::t('MissionsModule.base', 'How many evocoins do you want to invest?') ?>",1), 10);
        }while( (!isNaN(investment) && (isNaN(parseInt(investment)) || investment < 1)));

        if(!isNaN(investment)){

            if(investment > availableAmount){
                showMessage("<?= Yii::t('MissionsModule.base', 'Error') ?>", "<?= Yii::t('MissionsModule.base', 'No enough Evocoins!') ?>");
                return;
            }

            $.ajax({
                url: '<?= Url::to(['/missions/portfolio/add']); ?>&evokation_id='+<?= $evokation->id ?>+"&investment="+investment,
                type: 'get',
                dataType: 'json',
                success: function (data) {
                    if(data.status == 'success'){
                        addEvokation(
                            <?= $evokation->id ?>, 
                            '<?= $evokation->title ?>', 
                            '<?= Url::to(['/missions/evokations/view', 'id' => $evokation->id, 'sguid' => $contentContainer->guid]); ?>', 
                            investment);
                        $('#portfolio_status').hide();
                        showMessage("<?= Yii::t('MissionsModule.base', 'Updated') ?>", "<?= Yii::t('MissionsModule.base', 'Evokation added!') ?>");
                    }else if(data.status == 'error'){
                        $('#portfolio_status').hide();
                        showMessage("<?= Yii::t('MissionsModule.base', 'Error') ?>", "<?= Yii::t('MissionsModule.base', 'Something went wrong') ?>");
                    }
                }
            });      
        }
    }
</script>
