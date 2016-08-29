<?php
  use yii\helpers\Html;
  use yii\helpers\Url;
  use app\modules\powers\models\UserQualities;
  use app\modules\powers\models\UserPowers;
  use app\modules\powers\models\QualityPowers;
  use humhub\modules\space\models\Space;

  $user = Yii::$app->user->getIdentity();

  $super_power_image_url = Url::to($quality_1->image);

 ?>
<div class="container">
  <div class="row">
      <div class="col-xs-7 layout-content-container">

          <div class="panel panel-default">
              <!--<div class="panel-heading"><strong><?php echo $this->title; ?></strong></div>-->

                <!--<div style = "text-align:center; padding: 20px 30px">

                  <h4><?= Yii::t('MatchingModule.base', "Your survey results are:") ?></h4>

                  <div class="row">
                      <div class="col-xs-4">

                        <img src = "<?php echo $super_power_image_url ?>" width=120 class = "power-border" style = "margin-top:30px">
                        <h6><?= isset($quality_1->qualityTranslations[0]) ? $quality_1->qualityTranslations[0]->name : $quality_1->name ?></h6>

                      </div>
                      <div class="col-xs-8" style = "margin-top:30px">

                        <p>
                          <?php echo Yii::t('MatchingModule.base', "Based on your answers to the Agent Type survey we have determined the best role for you is that of <strong>{item}</strong>.", array('item' => isset($superhero_identity->superheroIdentityTranslations[0]) ? $superhero_identity->superheroIdentityTranslations[0]->name : $superhero_identity->name)) ?>
                          <?php echo Yii::t('MatchingModule.base', 'Furthermore, you are already gifted with the <strong>{item}</strong>', array('item' => isset($quality_1->qualityTranslations[0]) ? $quality_1->qualityTranslations[0]->name : $quality_1->name)) ?>
                          <?php echo Yii::t('MatchingModule.base', 'Super Power. {description}.', array('description' => isset($quality_1->qualityTranslations[0]) ? $quality_1->qualityTranslations[0]->description : $quality_1->description)) ?></strong>
                        </p>
                      </div>
                  </div>

                </div>

                </br>-->

                <!-- earned powers -->
                <div class="panel-heading">
                  <!--<h5><?php //echo Yii::t('MatchingModule.base', 'Your {power} Powers:', array('power' => isset($quality_1->qualityTranslations[0]) ? $quality_1->qualityTranslations[0]->name : $quality_1->name)) ?></h5>-->
                  <h4><?php echo Yii::t('MatchingModule.base', 'Your Powers') ?></h4>
                </div>

                <div class="panel-body">

                  <p style = "margin-bottom:10px"><?php echo Yii::t('MatchingModule.base', 'The powers that you possess are:') ?></p>

                  <div class="relevant-powers text-center">
                    <?php foreach($relevant_powers as $user_power): ?>
                        <?php $power = $user_power->getPower(); ?>
                        <div class="col-xs-6" style = "margin: 15px 0">
                          <div style = "float:left"><img src = "<?php echo $power->image ?>" width=90px></div>
                          <div style = "margin-top:15px">
                            <span style = "font-weight:700; font-size:12pt"><?= isset($power->powerTranslations[0]) ? $power->powerTranslations[0]->title : $power->title ?></span>
                            <h6 style = "font-weight:700; color: #9013FE">
                              <?php echo Yii::t('MatchingModule.base', '{point} points', array('point' => $user_power->value)) ?>
                            </h6>
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

                  <?php foreach ($super_powers as $quality): ?>

                    <div style = "display:flex; margin-top:30px">
                      <div style = "float:left"><img src = "<?php echo $quality->image ?>" width=100 class = "power-border"></div>
                      <div style = "margin-left:20px">
                        <h6 style = "font-weight:700; color: #9013FE; margin-bottom:5px"><?= isset($quality->qualityTranslations[0]) ? $quality->qualityTranslations[0]->name : $quality->name ?></h6>
                        <!--<div class="super-power-level">
                          <?php $user_quality = UserQualities::find()->where(['and', ['user_id' => Yii::$app->user->getIdentity()->id], ['quality_id' => $quality->id]])->one() ?>
                          <?php // echo Yii::t('MatchingModule.base', 'level') ?> <?php echo $user_quality->getLevel() ?>
                        </div><br>-->
                        <p style = "font-weight:700; color: #254054">
                          <?= isset($quality->qualityTranslations[0]) ? $quality->qualityTranslations[0]->description : $quality->description ?>
                        </p>
                      </div>
                    </div>

                    <!-- <div class="col-xs-4 text-center">

                      <img src = "<?php echo $quality->image ?>" width=100 class = "power-border">
                      <h6><?= isset($quality->qualityTranslations[0]) ? $quality->qualityTranslations[0]->name : $quality->name ?></h6>


                      <?php $user_quality = UserQualities::find()->where(['and', ['user_id' => Yii::$app->user->getIdentity()->id], ['quality_id' => $quality->id]])->one() ?>
                      <span style = "color: #28C503"><?php echo Yii::t('MatchingModule.base', 'Level {level}', array('level' => $user_quality->getLevel())); ?></span>

                      <br><br><span class="label label-secondary"><?php echo Yii::t('MissionsModule.base', 'Powers'); ?> </span><br><br>

                      <div class="super-power-powers">

                        <?php $quality_powers = QualityPowers::find()->where(['quality_id' => $quality->id])->all(); ?>
                        <?php $power_ids = []; ?>
                        <?php foreach ($quality_powers as $quality_power) {
                          $power_ids[] = $quality_power->power_id;
                        } ?>

                        <?php $userPowers = UserPowers::find()->where(['and', ['power_id' => $power_ids], ['user_id' => $user->id]])->all() ?>
                      </div>
                    </div> -->
                  <?php endforeach; ?>
                </div>

                <!-- Your survey result -->
                <div class="panel-heading">
                  <!--<h5><?php //echo Yii::t('MatchingModule.base', 'Additional Powers') ?></h5>-->
                  <h4><?= Yii::t('MatchingModule.base', "Your survey results are:") ?></h4>
                </div>
                <div class="panel-body text-center">
                  <p style = "margin-bottom:10px"><?php echo Yii::t('MatchingModule.base', 'With the powers you already possess, you are closest to achieving:') ?></p>

                  <div class="row">
                      <div class="col-xs-4 text-center">

                        <img src = "<?php echo $super_power_image_url ?>" width=120 class = "power-border" style = "margin-top:30px">
                        <h6 style = "color: #9013FE; font-weight:700"><?= isset($quality_1->qualityTranslations[0]) ? $quality_1->qualityTranslations[0]->name : $quality_1->name ?></h6>

                      </div>
                      <div class="col-xs-8" style = "margin-top:35px">

                        <p>
                          <?php echo Yii::t('MatchingModule.base', "Based on your answers to the Agent Type survey we have determined the best role for you is that of <strong>{item}</strong>.", array('item' => isset($superhero_identity->superheroIdentityTranslations[0]) ? $superhero_identity->superheroIdentityTranslations[0]->name : $superhero_identity->name)) ?>
                          <?php echo Yii::t('MatchingModule.base', 'Furthermore, you are already gifted with the <strong>{item}</strong>', array('item' => isset($quality_1->qualityTranslations[0]) ? $quality_1->qualityTranslations[0]->name : $quality_1->name)) ?>
                          <?php echo Yii::t('MatchingModule.base', 'Super Power. {description}.', array('description' => isset($quality_1->qualityTranslations[0]) ? $quality_1->qualityTranslations[0]->description : $quality_1->description)) ?></strong>
                        </p>
                      </div>
                  </div>

                  <br><br><br>
                  <p style = "margin-bottom:10px"><?php echo Yii::t('MatchingModule.base', 'You can develop all of the superpowers by completing each of the mission activities.') ?></p>

                  <br>

                  <p style = "margin-bottom:10px"><?php echo Yii::t('MatchingModule.base', 'Congratulations, you are already an Evoke agent!') ?></p>

                  <br>
                  <div class = "text-center"><?php echo Html::a(
                          Yii::t('MatchingModule.base', 'Continue to Base Operations'),
                          ['/space/space', 'sguid' => $welcome_space->guid], array('class' => 'btn btn-cta1')); ?></div>
                  <br>
                </div>

                <!-- <div style = "text-align:center; padding: 20px 30px">

                  <h4><?= Yii::t('MatchingModule.base', "Your survey results are:") ?></h4>

                  <div class="row">
                      <div class="col-xs-4">

                        <img src = "<?php echo $super_power_image_url ?>" width=120 class = "power-border" style = "margin-top:30px">
                        <h6 style = "color: #9013FE; font-weight:700"><?= isset($quality_1->qualityTranslations[0]) ? $quality_1->qualityTranslations[0]->name : $quality_1->name ?></h6>

                      </div>
                      <div class="col-xs-8" style = "margin-top:30px">

                        <p>
                          <?php echo Yii::t('MatchingModule.base', "Based on your answers to the Agent Type survey we have determined the best role for you is that of <strong>{item}</strong>.", array('item' => isset($superhero_identity->superheroIdentityTranslations[0]) ? $superhero_identity->superheroIdentityTranslations[0]->name : $superhero_identity->name)) ?>
                          <?php echo Yii::t('MatchingModule.base', 'Furthermore, you are already gifted with the <strong>{item}</strong>', array('item' => isset($quality_1->qualityTranslations[0]) ? $quality_1->qualityTranslations[0]->name : $quality_1->name)) ?>
                          <?php echo Yii::t('MatchingModule.base', 'Super Power. {description}.', array('description' => isset($quality_1->qualityTranslations[0]) ? $quality_1->qualityTranslations[0]->description : $quality_1->description)) ?></strong>
                        </p>
                      </div>
                  </div>

                </div> -->

              </div>
      </div>
      <div class="col-xs-5 layout-sidebar-container">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4><?php echo Yii::t('MatchingModule.base', 'Getting started') ?></h4>
          </div>
          <div class = "panel-body">
            <span style = "font-size: 12pt;"><?php echo Yii::t('MatchingModule.base', "Welcome to the Evoke network.<br><br>Over the next 16 weeks you will be asked to respond to the urgent challenge of forced displacement and peace in your country.  You have been selected because of your unique potential to change the world.  You have some powers there is no doubt, but you will need to increase your powers to realize your potential.  I have asked one of our best agents -- Marta -- to share her story and guide you on this journey.<br><br>Over the course of these 16 weeks you will form a team to create your unique world changing idea or as we call it in the Evoke network -- your Evokation.  Your Evokation will be created as you respond to the 8 missions I will give you.  At the end of the journey, the network will invest evocoin in your Evokations. The 10 Evokations with the most investment will be reviewed by experts in my network and the top 3 will receive recognition and reward.  As a team you must complete all 6 activities for each mission to advance to the next mission.  By completing activities, your powers will increase.<br><br>You will also earn Evocoin -- the currency of the Evoke network -- each time you contribute to the quality of our collective thought by giving power to others and commenting on their contributions.  Evocoin will be used at the end of your journey to invest in those world changing ideas that you think will have the greatest impact on your community, your country, the world. <br><br>You will also be given opportunities during the 16 weeks to exchange your Evocoin for assistance in completing your Evokation by accessing Evoke tools - transportation, materials, and other forms of support will be provided....for a cost.<br><br>Good luck agents. I look forward to checking in on your progress and recognizing your final Evokations at the end of this journey.") ?></span>
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

.topbar, .footer {
  display: none;
}

body {
  padding-top: 1em;
}
</style>
