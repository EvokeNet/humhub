<?php
  use yii\helpers\Html;
  use yii\helpers\Url;

  $super_power_image_url = Url::to('@web/themes/Evoke/img/super_powers/' . str_replace(' ', '_', strtolower($quality_1->name) . '.png'));

 ?>
<div class="container">
  <div class="row">
      <div class="col-md-8 layout-content-container">
          <div class="panel panel-default">
              <!--<div class="panel-heading"><strong><?php echo $this->title; ?></strong></div>-->
              <div class="panel-body">

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
                        </p>
                      </div>
                    </div>
                  </div>
                  <br>

                  <p>
                      <?= isset($superhero_identity->superheroIdentityTranslations[0]) ? $superhero_identity->superheroIdentityTranslations[0]->description : $superhero_identity->description ?>
                  </p>

                  <br><br>

                  <div class="qualities">
                      <h3><?= Yii::t('MatchingModule.base', "Qualities:") ?></h3>

                      <br>

                      <div class="row">
                          <div class="col-xs-6 col-sm-6 col-md-6">
                              <h4><strong><?= isset($quality_1->qualityTranslations[0]) ? $quality_1->qualityTranslations[0]->name : $quality_1->name ?></strong></h4>
                              <p><?= isset($quality_1->qualityTranslations[0]) ? $quality_1->qualityTranslations[0]->description : $quality_1->description ?></p>
                          </div>
                      </div>

                  </div>

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

.super-power-image{
  padding-bottom: 250px;
  background-image:url("<?php echo $super_power_image_url ?>");
  background-position: center;
  background-size: contain;
  background-repeat: no-repeat;
}

.image-container {
  background-color: #f6f7f9;
  position: relative;
  margin-right: 1em;
}

.image-text {
  position: absolute;
  bottom: 2em;
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
}

.panel-heading.survey-heading {
  display: inline-block;
  margin: 0;
  padding: 0;
  font-size: 1.8em;
  color: #3399e1;
}

.qualities{
    margin-top: 30px;
}

</style>
