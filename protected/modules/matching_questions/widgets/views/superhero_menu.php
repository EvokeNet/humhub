<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <strong>
            <?= Yii::t('MatchingModule.base', 'Superhero Identity') ?>
        </strong>
    </div>
    <div class="panel-body">
            
        <h5><strong>
        <?php 
            if(isset($superhero_id->name))
                echo isset($superhero_id->superheroIdentityTranslations[0]) ? $superhero_id->superheroIdentityTranslations[0]->name : $superhero_id->name;
            else 
                Yii::t('MatchingModule.base', 'Not Defined Yet');               
        ?>
        </strong></h5>
        
        <?= isset($superhero_id->superheroIdentityTranslations[0]) ? $superhero_id->superheroIdentityTranslations[0]->description : $superhero_id->description ?>
                
        <br><br><br>
        
        <h5><strong><?= Yii::t('MatchingModule.base', 'Qualities:') ?></strong><h5>
        <br>
        
        <strong><?= isset($superhero_id->quality1->qualityTranslations[0]) ? $superhero_id->quality1->qualityTranslations[0]->name : $superhero_id->quality1->name ?></strong><br><br>
        <?= isset($superhero_id->quality1->qualityTranslations[0]) ? $superhero_id->quality1->qualityTranslations[0]->description : $superhero_id->quality1->description ?><br><br>
        
        <strong><?= isset($superhero_id->quality2->qualityTranslations[0]) ? $superhero_id->quality2->qualityTranslations[0]->name : $superhero_id->quality2->name ?></strong><br><br>
        <?= isset($superhero_id->quality2->qualityTranslations[0]) ? $superhero_id->quality2->qualityTranslations[0]->description : $superhero_id->quality2->description ?><br><br>       

    </div>
</div>