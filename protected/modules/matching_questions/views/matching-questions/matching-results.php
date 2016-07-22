<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <!--<div class="panel-heading"><strong><?php echo $this->title; ?></strong></div>-->
            <div class="panel-body">

                <div class="jumbotron">
                  <div class="super-power-image">
                  </div>

                    <h3><?= Yii::t('MatchingModule.base', "Your survey results") ?>&nbsp;</h3>

                    <br>
<strong><?= isset($superhero_identity->superheroIdentityTranslations[0]) ? $superhero_identity->superheroIdentityTranslations[0]->name : $superhero_identity->name ?></strong>
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
    </div>
</div>

<style type="text/css">

.superhero_identity{
    text-align: center;
}

.qualities{
    margin-top: 30px;
}

</style>
