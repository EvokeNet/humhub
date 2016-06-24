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
        
        <?php if(isset($superhero_id)): ?>
            <h6>
                <strong>
                    <?php echo isset($superhero_id->superheroIdentityTranslations[0]) ? $superhero_id->superheroIdentityTranslations[0]->name : $superhero_id->name; ?>
                </strong>
            </h6>
            
            <p>
                <?php echo isset($superhero_id->superheroIdentityTranslations[0]) ? $superhero_id->superheroIdentityTranslations[0]->description : $superhero_id->description; ?>
            </p>
        
        <?php else: ?>
            <p>
                <strong>
                    <?php echo Yii::t('MatchingModule.base', 'Not Defined Yet'); ?>
                </strong>
            </p>
        <?php endif; ?>
                
    </div>
</div>