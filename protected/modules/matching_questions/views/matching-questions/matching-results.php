<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <!--<div class="panel-heading"><strong><?php echo $this->title; ?></strong></div>-->
            <div class="panel-body">

                <div class="superhero_identity">

                    <h3><?= Yii::t('MatchingModule.base', "Your Agent Type is:") ?>&nbsp;<strong><?= isset($superhero_identity->superheroIdentityTranslations[0]) ? $superhero_identity->superheroIdentityTranslations[0]->name : $superhero_identity->name ?></strong></h3>
                    
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
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <h4><strong><?= isset($quality_2->qualityTranslations[0]) ? $quality_2->qualityTranslations[0]->name : $quality_2->name ?></strong></h4>
                                <p><?= isset($quality_2->qualityTranslations[0]) ? $quality_2->qualityTranslations[0]->description : $quality_2->description ?></p>
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