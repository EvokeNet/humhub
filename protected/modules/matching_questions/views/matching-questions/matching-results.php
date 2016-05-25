<div class="superhero_identity">

    <h4>
        <?= Yii::t('MatchingModule.base', "Your Superhero Identity is:") ?>
    </h4>
    <br>
        <div>
            <h1 class="id">
                <?= isset($superhero_identity->superheroIdentityTranslations[0]) ? $superhero_identity->superheroIdentityTranslations[0]->name : $superhero_identity->name ?>
            </h1><br>
            <h4>
                <?= isset($superhero_identity->superheroIdentityTranslations[0]) ? $superhero_identity->superheroIdentityTranslations[0]->description : $superhero_identity->description ?>
            </h4>
            <br><br>
            <div class="qualities">
                <h4>
                    <?= Yii::t('MatchingModule.base', "Qualities:") ?>
                </h4>

                <h3>
                    <p><?= isset($quality_1->qualityTranslations[0]) ? $quality_1->qualityTranslations[0]->name : $quality_1->name ?></p>
                    <p><?= isset($quality_2->qualityTranslations[0]) ? $quality_2->qualityTranslations[0]->name : $quality_2->name ?></p>
                </h3>
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