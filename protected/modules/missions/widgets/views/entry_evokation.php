<?php

use yii\helpers\Html;
use \yii\helpers\Url;
use humhub\modules\space\models\Membership;

echo Html::beginForm(); 

$member = Membership::find()
    ->where(['user_id' => Yii::$app->user->getIdentity()->id])
    ->orderBy('space_id DESC')
    ->one();
?>

<strong>
   <?php print humhub\widgets\RichText::widget(['text' => $evokation->title]); ?>
</strong>
<br>
<?php print humhub\widgets\RichText::widget(['text' => $evokation->description]);?>
<br><br>

<iframe width="630" height="420" src="http://www.youtube.com/embed/<?php echo $evokation->getYouTubeCode($evokation->youtube_url)?>" frameborder="0" allowfullscreen></iframe>

<div>
    <div style = "float:left">
        <a class = "btn btn-primary" href='<?= Url::to(['/missions/evokations/view', 'id' => $evokation->id, 'sguid' => $contentContainer->guid]); ?>'>
            <?= Yii::t('MissionsModule.base', 'Read More') ?>
        </a>
    </div>

    <?php if($member->space->id == $contentContainer->id): ?>
    <div style = "float:right">
        <a class = "btn btn-primary" href="#" onClick="addEvokationToPortfolio<?= $evokation->id ?>();">
            <?= Yii::t('MissionsModule.base', 'Add to Portfolio') ?>
        </a>
    </div>
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