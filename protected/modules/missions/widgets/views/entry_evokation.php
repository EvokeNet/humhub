<?php

use yii\helpers\Html;
use \yii\helpers\Url;
use app\modules\missions\models\Portfolio;
use humhub\modules\space\models\Setting;

$this->registerJsFile("js/missions/evokation.js"); 

echo Html::beginForm(); 

$user = Yii::$app->user->getIdentity();

$evokation_investment = Portfolio::find()
    ->where(['user_id' => Yii::$app->user->getIdentity()->id,'evokation_id' => $evokation->id])
    ->one();

$youtube_code = $evokation->youtube_url ? $evokation->getYouTubeCode($evokation->youtube_url) : null;

?>

<h5><?php print humhub\widgets\RichText::widget(['text' => $evokation->getTitle()]); ?></h5>
<p><?php print humhub\widgets\RichText::widget(['text' => $evokation->description]);?></p>




<!-- YOUTUBE LINK -->
<a target="_blank" href="<?=$evokation->youtube_url?>"><?= Yii::t('MissionsModule.base', 'Youtube video') ?></a>

<!-- GDRIVE LINK -->
<?php if($user->group->name === "Mentors"): ?>
    <br><br>
    <a target="_blank" href="<?=Setting::get($contentContainer->id, "gdrive_url")?>"><?= Yii::t('MissionsModule.base', 'Google Drive') ?></a>
<?php endif; ?>    

<hr>
<?php if($deadline && $deadline->hasStarted()): ?>
<!-- INVESTMENT -->
<div class= "">
    <div class="">
        <h5><?= Yii::t('MissionsModule.base', 'Investment') ?></h5>
    </div>
        <div class="">
        <p>
            <b><?= Yii::t('MissionsModule.base', 'Total Investment:') ?></b> <?= $total_investment ?> <?= $total_investment > 1 ? 'evocoins' : 'evocoin' ?>
        </p>
        <p>
            <b><?= Yii::t('MissionsModule.base', 'Median Investment:') ?></b>  <?= $median_investment ?> <?= $median_investment > 1 ? 'evocoins' : 'evocoin' ?>
        </p>
        
    </div>
</div>
<?php endif; ?>

<br>

<?php if($evokation->content->user_id): ?>
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
        <?php if(!$evokation_investment): ?>
        <a id="evokation_vote_<?= $evokation->id ?>" class = "btn btn-cta1" onClick="addEvokationToPortfolio(
            <?= $evokation->id ?>,
            '<?= Url::to(['/missions/portfolio/add']); ?>',
            '<?= $evokation->getTitle() ?>',
            '<?= Url::to(['/missions/evokations/view', 'id' => $evokation->id, 'sguid' => $contentContainer->guid]); ?>' 
            );">
            <?= Yii::t('MissionsModule.base', 'Add to Portfolio') ?>
        </a>
        <?php else: ?>
            <a id="evokation_vote_<?= $evokation->id ?>" class = "btn btn-cta1" onClick="deleteEvokation(<?= $evokation->id ?>, <?= $evokation->getTitle() ?>);">
                <?= Yii::t('MissionsModule.base', 'Remove from Portfolio') ?>
            </a>
        <?php endif; ?>
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

evocoins_message = "<?= Yii::t('MissionsModule.base', 'How many evocoins do you want to invest?') ?>";
no_enough_evocoins_message = "<?= Yii::t('MissionsModule.base', 'No enough Evocoins!') ?>";
remove_from_portfolio_text = "<?= Yii::t('MissionsModule.base', 'Remove from Portfolio') ?>";
updated_message = "<?= Yii::t('MissionsModule.base', 'Updated') ?>";
evokation_added_message = "<?= Yii::t('MissionsModule.base', 'Evokation added!') ?>";
error_message = "<?= Yii::t('MissionsModule.base', 'Error') ?>";
something_went_wrong_message = "<?= Yii::t('MissionsModule.base', 'Something went wrong') ?>";
investment_limit_message = "<?= Yii::t('MissionsModule.base', 'You can not invest more than {investment_limit} evocoins total.', ['investment_limit' => intval(humhub\models\Setting::Get('investment_limit'))]) ?>";


</script>
