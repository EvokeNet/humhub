<?php

use yii\helpers\Html;
use \yii\helpers\Url;
use app\modules\missions\models\Portfolio;
use humhub\modules\space\models\Setting;

echo Html::beginForm(); 

$user = Yii::$app->user->getIdentity();

$evokation_investment = Portfolio::find()
    ->where(['user_id' => Yii::$app->user->getIdentity()->id,'evokation_id' => $evokation->id])
    ->one();

$youtube_code = $evokation->youtube_url ? $evokation->getYouTubeCode($evokation->youtube_url) : null;

?>

<h5><?php print humhub\widgets\RichText::widget(['text' => $evokation->getTitle()]); ?></h5>
<p><?php print humhub\widgets\RichText::widget(['text' => $evokation->description]);?></p>


<?php if($youtube_code): ?>
    <iframe width="598" height="398" src="http://www.youtube.com/embed/<?php echo $youtube_code; ?>" frameborder="0" allowfullscreen></iframe>
<?php endif; ?>


<!-- YOUTUBE LINK -->
<a target="_blank" href="<?=$evokation->youtube_url?>">Youtube video</a>

<!-- GDRIVE LINK -->
<?php if($user->group->name === "Mentors"): ?>
    <br><br>
    <a target="_blank" href="<?=Setting::get($contentContainer->id, "gdrive_url")?>">Google Drive</a>
<?php endif; ?>    

<hr>
<!-- INVESTMENT -->
<div class= "">
    <div class="">
        <h5>Investment</h5>
    </div>
        <div class="">
        <p>
            <b>Total Invesment:</b> <?= $total_investment ?> <?= $total_investment > 1 ? 'evocoins' : 'evocoin' ?>
        </p>
        <p>
            <b>Median Investment:</b>  <?= $median_investment ?> <?= $median_investment > 1 ? 'evocoins' : 'evocoin' ?>
        </p>
        <p>
            <b>Total Investors:</b> <?= $total_investors ?> <?= $total_investors > 1 ? Yii::t('MissionsModule.base', 'agents') : Yii::t('MissionsModule.base', 'agent') ?>
        </p>
    </div>
</div>

<br>

<?php if(!$evokation_investment && $evokation->content->user_id != Yii::$app->user->getIdentity()->id && $user->group->name != "Mentors"): ?>
<div>
    
    <!-- DISABLED
    <div style = "float:left">
        <a class = "btn btn-cta2" href='<?= Url::to(['/missions/evokations/view', 'id' => $evokation->id, 'sguid' => $contentContainer->guid]); ?>'>
            <?= Yii::t('MissionsModule.base', 'Read More') ?>
        </a>
    </div>
    -->

    <?php if ($deadline && $deadline->isOccurring() ): ?>
    <div style = "float:right">
        <a class = "btn btn-cta1" onClick="addEvokationToPortfolio<?= $evokation->id ?>();">
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
</div>
<br><br>
<?php endif; ?>

<div class="clearFloats"></div>

<?php echo Html::endForm(); ?>

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
                            '<?= $evokation->getTitle() ?>', 
                            '<?= Url::to(['/missions/evokations/view', 'id' => $evokation->id, 'sguid' => $contentContainer->guid]); ?>', 
                            investment);
                        $('#portfolio_status').hide();
                        showMessage("<?= Yii::t('MissionsModule.base', 'Updated') ?>", "<?= Yii::t('MissionsModule.base', 'Evokation added!') ?>");
                    }else if(data.status == 'error'){
                        $('#portfolio_status').hide();
                        showMessage("<?= Yii::t('MissionsModule.base', 'Error') ?>", "<?= Yii::t('MissionsModule.base', 'Something went wrong') ?>");
                    }else if(data.status == 'error_limit'){
                        $('#portfolio_status').hide();
                        showMessage("<?= Yii::t('MissionsModule.base', 'Error') ?>", "<?= Yii::t('MissionsModule.base', 'You can not invest more than {investment_limit} evocoins total.', ['investment_limit' => intval(humhub\models\Setting::Get('investment_limit'))]) ?>");
                    }
                }
            });      
        }
    }
</script>
