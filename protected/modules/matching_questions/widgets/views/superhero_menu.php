<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <strong>
            <?= Yii::t('MatchingModule.base', 'Agent Type') ?>
        </strong>
    </div>
    <div class="panel-body">
            
        <h5>
            <strong>
                <?php 
                    if(isset($superhero_id->name))
                        echo isset($superhero_id->superheroIdentityTranslations[0]) ? $superhero_id->superheroIdentityTranslations[0]->name : $superhero_id->name;
                    else 
                        Yii::t('MatchingModule.base', 'Not Defined Yet');               
                ?>
            </strong>
        </h5>
        
        <?= isset($superhero_id->superheroIdentityTranslations[0]) ? $superhero_id->superheroIdentityTranslations[0]->description : $superhero_id->description ?>

    </div>
</div>