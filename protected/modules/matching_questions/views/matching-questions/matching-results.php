<?php
  use yii\helpers\Html;
  use yii\helpers\Url;
  use app\modules\powers\models\UserQualities;
  use app\modules\powers\models\UserPowers;
  use app\modules\powers\models\QualityPowers;
  use humhub\modules\space\models\Space;

  $user = Yii::$app->user->getIdentity();

  $super_power_image_url = Url::to($quality_1->image);
  
  $quality1_name = $quality_1->name;
  
  if(Yii::$app->language == 'es' && isset($quality_1->qualityTranslations[0]))
      $quality1_name = $quality_1->qualityTranslations[0]->name;

 ?>
<div class="container">
  <div class="row">
      <div class="col-md-7 layout-content-container">

          <div class="panel panel-default">

                <!-- earned powers -->
                <div class="panel-heading">
                  <!--<h5><?php //echo Yii::t('MatchingModule.base', 'Your {power} Powers:', array('power' => isset($quality_1->qualityTranslations[0]) ? $quality_1->qualityTranslations[0]->name : $quality_1->name)) ?></h5>-->
                  <h4><?php echo Yii::t('MatchingModule.base', 'Your Powers') ?></h4>
                </div>

                <div class="panel-body">

                  <p style = "margin-bottom:10px"><?php echo Yii::t('MatchingModule.base', 'The powers that you possess are:') ?></p>

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

                <br>

                <!-- additional powers -->
                 <div class="panel-heading">
                  <!--<h5><?php //echo Yii::t('MatchingModule.base', 'Additional Powers') ?></h5>-->
                  <h4><?php echo Yii::t('MatchingModule.base', 'Your Super Powers') ?></h4>
                </div>
                <div class="panel-body">
                  <p style = "margin-bottom:10px"><?php echo Yii::t('MatchingModule.base', 'Your powers are the reason why I have summoned you. They are the skills that qualify you to be part of the Evoke network. Now it is time to be your best. Over the course of this experience you must develop the four fundamental superpowers of Evoke agents:') ?></p>

                  <?php 
                    foreach ($super_powers as $quality):
                    
                    $name = $quality->name;
                    $description = $quality->description;
            
                    if(Yii::$app->language == 'es' && isset($quality->qualityTranslations[0])){
                        $name = $quality->qualityTranslations[0]->name;
                        $description = $quality->qualityTranslations[0]->description;
                    }
                 
                  ?>

                    <div style = "display:flex; margin-top:30px">
                      
                      <div class="row">
                        <div class="col-sm-3" style = "margin-top:10px">
                          <img src = "<?php echo $quality->image ?>" width=100 class = "power-border">
                        </div>
                        <div class="col-sm-9">
                          <h6 style = "font-weight:700; color: #9013FE; margin-bottom:5px"><?= $name ?></h6>
                          <p style = "font-weight:700; color: #254054">
                            <?= $description ?>
                          </p>
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
                  <h6 style = "color: #9013FE; font-weight:700"><?= $quality1_name ?></h6>
                  
                  <br>
                  <p style = "margin-bottom:10px"><?php echo Yii::t('MatchingModule.base', 'On this platform you can submit evidence to complete activities within each mission. This will develop all of the superpowers.') ?></p>
                  
                  <br>
                  
                  <p style = "margin-bottom:10px"><?php echo Yii::t('MatchingModule.base', '{agent}: Congratulations, you are already an Evoke agent!', array('agent' => $user->username)) ?></p>
                  
                  <br>
                  <div class = "text-center"><?php echo Html::a(
                          Yii::t('MatchingModule.base', 'Continue to Base Operations'),
                          ['/space/space', 'sguid' => $welcome_space->guid], array('class' => 'btn btn-cta1')); ?></div>
                  <br>
                </div>

              </div>
      </div>
      <div class="col-md-5 layout-sidebar-container">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4><?php echo Yii::t('MatchingModule.base', 'Welcome to the Evoke network') ?></h4>
          </div>
          <div class = "panel-body">
            <span style = "font-size: 12pt;"><?php echo Yii::t('MatchingModule.base', "Over the next 16 weeks you will be asked to respond to the urgent challenge of forced displacement and peace in your country.  You have been selected because of your unique potential to change the world.  You have some powers there is no doubt, but you will need to increase your powers to realize your potential.  I have asked one of our best agents -- Marta -- to share her story and guide you on this journey.<br><br>Over the course of these 16 weeks you will form a team to create your unique world changing idea or as we call it in the Evoke network -- your Evokation.  Your Evokation will be created as you respond to the 8 missions I will give you.  At the end of the journey, the network will invest evocoin in your Evokations. The 10 Evokations with the most investment will be reviewed by experts in my network and the top 3 will receive recognition and reward.  As a team you must complete all 6 activities for each mission to advance to the next mission.  By completing activities, your powers will increase.<br><br>You will also earn Evocoin -- the currency of the Evoke network -- each time you contribute to the quality of our collective thought by giving power to others and commenting on their contributions.  Evocoin will be used at the end of your journey to invest in those world changing ideas that you think will have the greatest impact on your community, your country, the world. <br><br>You will also be given opportunities during the 16 weeks to exchange your Evocoin for assistance in completing your Evokation by accessing Evoke tools - transportation, materials, and other forms of support will be provided....for a cost.<br><br>Good luck agents. I look forward to checking in on your progress and recognizing your final Evokations at the end of this journey.") ?></span>
          </div>
        </div>
      </div>
  </div>
</div>

<style type="text/css">

.power{
    padding-bottom: 50px;
}

.super-power-image{
  padding-bottom: 15px;
  /*background-image:url("<?php echo $super_power_image_url ?>");*/
  background-position: center;
  background-size: contain;
  background-repeat: no-repeat;
}

.super-power-image.small {
  /*padding-bottom: 100px;*/
  /*background-position: left;*/
}

.power-image {
  padding-bottom: 5em;
  width: 5em;
  background-position: center;
  background-size: contain;
  background-repeat: no-repeat;
  display: inline-block;
}

.image-container {
  background-color: #f6f7f9;
  position: relative;
  margin-right: 1em;
}

.image-text {
  position: absolute;
  bottom: 1em;
  left: 0;
  right: 0;
  text-align: center;
  font-weight: bold;
  font-size: 1.5em;
}

.survey-results {
  background-color: #fff;
  border: 1px solid #eaeaea;
  padding: 1em;
  margin: 1em;
  float: left;
  font-family: 'Ubuntu';
}

.panel-heading.survey-heading {
  display: inline-block;
  margin: 0;
  padding: 0;
  font-size: 1.8em;
  color: #3399e1;
  font-weight: bold;
}

.panel-heading.sub-heading {
  font-weight: bold;
  font-size: 1.4em;
}

.qualities{
    margin-top: 30px;
}

.relevant-power {
  position: relative;
  font-family: 'Ubuntu';
  margin-bottom: 1em;
}

.relevant-powers .power-name {
  /*position: absolute;
  top: 0;
  left: 7em;*/
  font-weight: bold;
}

.relevant-powers .power-points-container {
  position: absolute;
  top: 2em;
  left: 7em;
}

.relevant-powers .power-points {
  font-size: 1.5em;
  font-weight: bold;
  color: #9013fe;
}

.super-power-name {
  /*text-align: justify;*/
  font-weight: bold;
}

.super-power-level {
  color: #28c503;
  font-style: italic;
}

.power .level{
    float: left;
}

.power .points{
    float: right;
}

.continue{
  text-align: center;
  position: relative;
  margin-top: 1em;
}

.topbar {
  display: none;
}

body {
  padding-top: 1em;
}
</style>
