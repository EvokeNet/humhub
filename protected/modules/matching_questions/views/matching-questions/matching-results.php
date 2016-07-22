<?php
  use yii\helpers\Html;
  use yii\helpers\Url;
  use app\modules\powers\models\UserQualities;
  use app\modules\powers\models\UserPowers;
  use app\modules\powers\models\QualityPowers;

  $user = Yii::$app->user->getIdentity();

  $super_power_image_url = Url::to($quality_1->image);

 ?>
<div class="container">
  <div class="row">
      <div class="col-md-8 layout-content-container">

          <div class="panel panel-default">
              <!--<div class="panel-heading"><strong><?php echo $this->title; ?></strong></div>-->

                <div style = "text-align:center; padding: 20px 30px">

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

                </br>

                <!-- earned powers -->
                <div class="panel-heading">
                  <h5><?php echo Yii::t('MatchingModule.base', 'Your {power} Powers:', array('power' => isset($quality_1->qualityTranslations[0]) ? $quality_1->qualityTranslations[0]->name : $quality_1->name)) ?></h5>
                </div>

                <div class="panel-body">
                  <div class="relevant-powers text-center">
                    <?php foreach($relevant_powers as $user_power): ?>
                        <?php $power = $user_power->getPower(); ?>
                        <div class="col-xs-6" style = "margin: 15px 0">
                          <img src = "<?php echo $power->image; ?>" width=90px>
                          <br /><br />
                          <span style = "font-weight:700"><?php echo $power->title ?></span>
                          <h6 style = "font-weight:700; color: #9013FE">
                            <?php echo Yii::t('MatchingModule.base', '{point} points', array('point' => $user_power->value)) ?>
                          </h6>
                        </div>
                    <?php endforeach; ?>
                  </div>
                </div>

                <!-- additional powers -->
                <div class="panel-heading">
                  <h5><?php echo Yii::t('MatchingModule.base', 'Additional Powers') ?></h5>
                </div>
                <div class="panel-body">
                  <p style = "margin-bottom:10px"><?php echo Yii::t('MatchingModule.base', 'You can also earn points towards 3 more Super Powers with the Powers below. Submit quality evidence to advance in your powers.') ?></p>

                  <?php foreach ($other_qualities as $quality): ?>
                    <div class="col-xs-4 text-center">

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

                        <?php foreach($userPowers as $userPower): ?>
                            <div class="power">
                                <?php
                                    $power = $userPower->getPower();
                                    $percentage = floor($userPower->getCurrentLevelPoints() / $userPower->getNextLevelPoints() * 100) ;
                                ?>

                                <p class = "text-center"><?= isset($power->powerTranslations[0]) ? $power->powerTranslations[0]->title : $power->title ?></p>

                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?= $percentage ?>%;">
                                        <span class="sr-only"></span>
                                    </div>
                                </div>

                                <div class="level italic">
                                    <?php echo Yii::t('MissionsModule.base', 'Level {level}', array('level' => $userPower->getLevel())); ?>
                                </div>

                                <div class="points italic">
                                    <?php echo Yii::t('MissionsModule.base', '{points} / {total}', array('points' => $userPower->getCurrentLevelPoints(), 'total' => $userPower->getNextLevelPoints())); ?>
                                </div>

                            </div>
                        <?php endforeach; ?>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
      </div>
      <div class="col-md-4 layout-sidebar-container">
        <div class="panel panel-default">
          <div class="panel-heading">
            <?php echo Yii::t('MatchingModule.base', 'Getting started') ?>
          </div>
          <hr></hr>
        </div>
      </div>
  </div>
</div>

<style type="text/css">

.power{
    padding-bottom: 50px;
}

.super-power-image{
  padding-bottom: 250px;
  background-image:url("<?php echo $super_power_image_url ?>");
  background-position: center;
  background-size: contain;
  background-repeat: no-repeat;
}

.super-power-image.small {
  padding-bottom: 100px;
  background-position: left;
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
  text-align: justify;
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

</style>
