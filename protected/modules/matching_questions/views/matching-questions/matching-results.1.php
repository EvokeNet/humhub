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
      <div class="col-xs-8 layout-content-container">
          <div class="panel panel-default">
              <!--<div class="panel-heading"><strong><?php echo $this->title; ?></strong></div>-->

                <div class="survey-results">
                  <div>
                    <div class="image-container col-xs-3">
                      <div class="super-power-image">
                      </div>
                      <div class="image-text"><strong><?= isset($quality_1->qualityTranslations[0]) ? $quality_1->qualityTranslations[0]->name : $quality_1->name ?></strong>

                      </div>
                    </div>
                    <div class="panel-heading survey-heading col-xs-8">
                      <?= Yii::t('MatchingModule.base', "Your survey results") ?>
                    </div>
                    <div class="panel-body">
                      <p>
                        <?php echo Yii::t('MatchingModule.base', 'Based on your answers') ?>
                        <strong><?= isset($superhero_identity->superheroIdentityTranslations[0]) ? $superhero_identity->superheroIdentityTranslations[0]->name : $superhero_identity->name ?></strong>.
                        <?php echo Yii::t('MatchingModule.base', 'gifted power') ?>
                        <strong><?= isset($quality_1->qualityTranslations[0]) ? $quality_1->qualityTranslations[0]->name : $quality_1->name ?>
                        <?php echo Yii::t('MatchingModule.base', 'Super Power') ?>.</strong>
                        <?php echo isset($quality_1->qualityTranslations[0]) ? $quality_1->qualityTranslations[0]->description : $quality_1->description ?>.
                      </p>
                    </div>
                  </div>
                </div>
                </br>
                <!-- earned powers -->
                <div class="panel-heading sub-heading">
                  <?php echo Yii::t('MatchingModule.base', 'Your {power} Powers:', array('power' => isset($quality_1->qualityTranslations[0]) ? $quality_1->qualityTranslations[0]->name : $quality_1->name)) ?>
                </div>
                <div class="panel-body">
                  <div class="relevant-powers">
                    <?php foreach($relevant_powers as $user_power): ?>
                        <?php $power = $user_power->getPower(); ?>
                        <div class="relevant-power col-xs-6">
                          <div class="power-image" style="background-image:url('<?php echo $power->image; ?>')">
                          </div>
                          <div class="power-name">
                            <?php echo $power->title ?>
                          </div>
                          <div class="power-points-container">
                            <div class="power-points">
                              <?php echo $user_power->value ?> <?php echo Yii::t('MatchingModule.base', 'points') ?>
                            </div>
                          </div>
                        </div>
                    <?php endforeach; ?>
                  </div>
                </div>
                <!-- additional powers -->
                <div class="panel-heading sub-heading">
                  <?php echo Yii::t('MatchingModule.base', 'Additional Powers') ?>
                </div>
                <div class="panel-body">
                  <p>
                    <?php echo Yii::t('MatchingModule.base', 'other powers') ?>
                  </p>
                  <?php foreach ($other_qualities as $quality): ?>
                    <div class="col-xs-4">
                      <div class="super-power-image small" style='background-image:url("<?php echo $quality->image ?>")'>

                      </div>
                      <div class="super-power-name">
                        <?= isset($quality->qualityTranslations[0]) ? $quality->qualityTranslations[0]->name : $quality->name ?>
                      </div>
                      <div class="super-power-level">
                        <?php $user_quality = UserQualities::find()->where(['and', ['user_id' => Yii::$app->user->getIdentity()->id], ['quality_id' => $quality->id]])->one() ?>
                        <?php echo Yii::t('MatchingModule.base', 'level') ?> <?php echo $user_quality->getLevel() ?>
                      </div>
                      <div class="super-power-powers">
                        <p style="padding-top: 15px;">
                            <strong>
                                <?php echo Yii::t('MatchingModule.base', 'Powers:') ?>
                            </strong>
                        </p>
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
                                <?= isset($power->powerTranslations[0]) ? $power->powerTranslations[0]->title : $power->title ?>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?= $percentage ?>%;">
                                        <span class="sr-only"></span>
                                    </div>
                                    <span>
                                    </span>
                                </div>
                                <div class="level">
                                    Level <?= $userPower->getLevel() ?>
                                </div>
                                <div class="points">
                                    <?= $userPower->getCurrentLevelPoints() ?>
                                    /
                                    <?= $userPower->getNextLevelPoints() ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
      </div>
      <div class="col-xs-4 layout-sidebar-container">
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
  position: absolute;
  top: 0;
  left: 7em;
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

</style>
