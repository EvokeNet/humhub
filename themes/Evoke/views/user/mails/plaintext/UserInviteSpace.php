<?php

use yii\helpers\Url;
use yii\helpers\Html;
use humhub\models\Setting;
?>
<?php //echo strip_tags(Yii::t('UserModule.views_mails_UserInviteSpace', 'You got a <strong>space</strong> invite')); ?>

<?php if($space->id == 1): ?>
    <?php echo 'Alchemy'; ?> <?php echo strip_tags(Yii::t('UserModule.views_mails_UserInviteSpace', 'invited you to the space:')); ?> <?php echo Html::encode($space->name); ?> at <?php echo Html::encode(Yii::$app->name); ?>
    <?php echo Yii::t('UserModule.views_mails_UserInviteSpace', '<br>I am Alchemy, and this is an urgent Evoke. No matter where you are or who you are, if you found this message, your destiny is to join us. <br><br>Evoke is the network of social innovators who use their powers to save the world. And this is an invitation for you to make part of it.<br><br>For the next 16 weeks, you and your team will complete 8 missions and create with the community an "Evokation", a personal project that seeks to solve some of the problems in Soacha. By the end, the Evoke network will award the best Evokations. <br><br>Evoke counts on you.'); ?>
    <?php echo Yii::t('UserModule.views_mails_UserInviteSpace', 'Register Here'); ?>
<?php else: ?>
    <?php echo Html::encode($originator->displayName); ?> <?php echo strip_tags(Yii::t('UserModule.views_mails_UserInviteSpace', 'invited you to the space:')); ?> <?php echo Html::encode($space->name); ?> at <?php echo Html::encode(Yii::$app->name); ?>
<?php endif; ?>

<?php echo strip_tags(str_replace(["\n","<br>"], [" ","\n"], Yii::t('UserModule.views_mails_UserInviteSpace', '<br>A social network to increase your communication and teamwork.<br>Register now to join this space.'))); ?>


<?php echo strip_tags(Yii::t('UserModule.views_mails_UserInviteSpace', 'Sign up now')); ?>: <?php echo urldecode(Url::to(['/user/auth/create-account', 'token' => $token], true)); ?> 
