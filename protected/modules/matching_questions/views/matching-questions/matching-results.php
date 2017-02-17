<?php
  use yii\helpers\Html;
  use yii\helpers\Url;
  use app\modules\powers\models\UserQualities;
  use app\modules\powers\models\UserPowers;
  use app\modules\powers\models\QualityPowers;
  use humhub\modules\space\models\Space;
  use humhub\models\Setting;
  use app\modules\missions\models\forms\EvokeSettingsForm;

  $user = Yii::$app->user->getIdentity();

  $super_power_image_url = Url::to($quality_1->image);

  $quality1_name = $quality_1->name;

  if(Yii::$app->language == 'es' && isset($quality_1->qualityTranslations[0]))
      $quality1_name = $quality_1->qualityTranslations[0]->name;

 ?>
<div class="container">
  <div class="row">
      <div class="col-xs-7 layout-content-container">

          <div class="panel panel-default">

                <!-- earned powers -->
                <div class="panel-heading">
                  <!--<h5><?php //echo Yii::t('MatchingModule.base', 'Your {power} Powers:', array('power' => isset($quality_1->qualityTranslations[0]) ? $quality_1->qualityTranslations[0]->name : $quality_1->name)) ?></h5>-->
                  <h4><?php echo Yii::t('MatchingModule.base', 'Your Powers') ?></h4>
                </div>

                <div class="panel-body">

                  <h6 style = "margin:10px 0; text-align:center"><?php echo Yii::t('MatchingModule.base', 'The powers that you possess are:') ?></h6>

                  <div class="relevant-powers text-center">
                    <?php foreach($relevant_powers as $user_power): ?>
                        <?php $power = $user_power->getPower();
                          $power_name = $power->title;
                          if(Yii::$app->language == 'es' && isset($power->powerTranslations[0]))
                            $power_name = $power->powerTranslations[0]->title;
                        ?>
                        <div class="col-xs-6" style = "margin: 15px 0">
                          
                          <div class="row">
                            <div class="col-sm-3">
                              <img src = "<?php echo $power->image ?>" width=90px>
                            </div>
                            <div class="col-sm-9" style = "margin-top:15px">
                              <span style = "font-weight:700; font-size:12pt"><?= $power_name ?></span>
                              <h6 style = "font-weight:700; color: #9013FE">
                                <?php echo Yii::t('MatchingModule.base', '{point} points', array('point' => $user_power->value)) ?>
                              </h6>
                            </div>
                          </div>
                                                    
                        </div>
                    <?php endforeach; ?>
                  </div>
                </div>
            </div>

            <div class="panel panel-default">

                <!-- additional powers -->
                 <div class="panel-heading">
                  <!--<h5><?php //echo Yii::t('MatchingModule.base', 'Additional Powers') ?></h5>-->
                  <h4><?php echo Yii::t('MatchingModule.base', 'Your Super Powers') ?></h4>
                </div>
                <div class="panel-body">
                  <p style = "margin:10px 0; text-align:center"><?php echo Yii::t('MatchingModule.base', 'Your powers are the reason why I have summoned you. They are the skills that qualify you to be part of the Evoke network. Now it is time to be your best. Over the course of this experience you must develop the four fundamental superpowers of Evoke agents:') ?></p>

                  <?php
                    foreach ($super_powers as $quality):

                    $name = $quality->name;
                    $description = $quality->description;

                    if(Yii::$app->language == 'es' && isset($quality->qualityTranslations[0])){
                        $name = $quality->qualityTranslations[0]->name;
                        $description = $quality->qualityTranslations[0]->description;
                    }

                  ?>

                    <div class="matching-results-box">
                      
                      <div class="row">
                        <div class="col-sm-3">
                          <img src = "<?php echo $quality->image ?>" width=100 class = "power-border">
                        </div>
                        <div class="col-sm-9">
                          <h6><?= $name ?></h6>
                          <p><?= $description ?></p>
                        </div>
                      </div>
                      
                      
                    </div>

                  <?php endforeach; ?>
                </div>

                <!-- Your survey result -->
                <!--<div class="panel-heading">
                  <h4><?php //Yii::t('MatchingModule.base', "Your survey results are:") ?></h4>
                </div>-->
                <br><br>
                <div class="panel-body text-center">
                  <h6 style = "margin-bottom:10px"><?php echo Yii::t('MatchingModule.base', 'According to the powers that you have, you are closest to achieving:') ?></h6>

                  <img src = "<?php echo $super_power_image_url ?>" width=120 class = "power-border" style = "margin-top:30px">
                  <h6 style = "margin-top:20px;text-transform: uppercase;font-weight:700"><?= $quality1_name ?></h6>

                  <br>
                  <p style = "margin-bottom:10px"><?php echo Yii::t('MatchingModule.base', 'On this platform you can submit evidence to complete activities within each mission. This will develop all of the superpowers.') ?></p>

                  <br>

                  <p style = "margin-bottom:10px"><?php echo Yii::t('MatchingModule.base', '{agent}: Congratulations, you are already an Evoke agent!', array('agent' => $user->username)) ?></p>

                  <br>
                  <?php if(Setting::Get('novel_order') == EvokeSettingsForm::FIRST_NOVEL): ?>
                      <div class = "text-center"><?php echo Html::a(
                          Yii::t('MatchingModule.base', 'Continue to Base Operations'),
                          ['/space/space', 'sguid' => $welcome_space->guid], array('class' => 'btn btn-cta1')); ?></div>
                  <?php else: ?>
                      <div class = "text-center"><?php echo Html::a(
                          Yii::t('MatchingModule.base', 'Continue to Novel'),
                          ['/novel/novel/graphic-novel', 'page' => 1], array('class' => 'btn btn-cta1')); ?></div>
                  <?php endif; ?>
                  <br>
                </div>

              </div>
      </div>
      <div class="col-xs-5 layout-sidebar-container">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4><?php echo Yii::t('MatchingModule.base', 'Welcome to the Evoke network') ?></h4>
          </div>
          <div class = "panel-body">

            <span style = "font-size: 12pt;"><?php echo Yii::t('MatchingModule.base', "Over the next 16 weeks you will be asked to respond to the urgent challenge of forced displacement and peace in your country. You have been selected because of your unique potential to change the world. You have some powers there is no doubt, but you will need to increase your powers to realize your potential. I have asked one of our best agents -- Marta -- to share her story and guide you on this journey.") ?></span><br /><br />

            <span style = "font-size: 12pt;"><?php echo Yii::t('MatchingModule.base', "Over the course of these 16 weeks you will form a team to create your unique world changing idea or as we call it in the Evoke network -- your Evokation. Your Evokation will be created as you respond to the 8 missions I will give you.  At the end of the journey, the network will invest evocoin in your Evokations. The 10 Evokations with the most investment will be reviewed by experts in my network and the top 3 will receive recognition and reward.") ?></span><br /><br />

            <span style = "font-size: 12pt;"><?php echo Yii::t('MatchingModule.base', "As a team you must complete all 6 activities for each mission to advance to the next mission. By completing activities, your powers will increase. You will also earn Evocoin -- the currency of the Evoke network -- each time you contribute to the quality of our collective thought by giving power to others and commenting on their contributions. Evocoin will be used at the end of your journey to invest in those world changing ideas that you think will have the greatest impact on your community, your country, the world.") ?></span><br /><br />

            <span style = "font-size: 12pt;"><?php echo Yii::t('MatchingModule.base', "You will also be given opportunities during the 16 weeks to exchange your Evocoin for assistance in completing your Evokation by accessing Evoke tools - transportation, materials, and other forms of support will be provided....for a cost") ?></span><br /><br />

            <span style = "font-size: 12pt;"><?php echo Yii::t('MatchingModule.base', "Good luck agents. I look forward to checking in on your progress and recognizing your final Evokations at the end of this journey.") ?></span>

          </div>
        </div>
      </div>
  </div>
</div>

<style type="text/css">

.topbar, .footer {
  display: none;
}

body {
  padding-top: 1em;
}

</style>
