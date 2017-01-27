<?php

use \yii\helpers\Url;
use yii\widgets\ActiveForm;
use \humhub\compat\CHtml;

$this->pageTitle = Yii::t('UserModule.views_auth_login', 'Login');
?>

<div class="container" style="text-align: center; position:relative;">
    <?= humhub\widgets\SiteLogo::widget(['place' => 'login']); ?>

    <div id="homeAnimation" class="">
      <div class="top">
        <img width='50em' height='50em' src="<?php echo $this->theme->getBaseUrl() . '/img/powers/aggregation.svg'; ?>" alt="" />
      </div>
      <div class="left-side">
        <img width='200em' height='200em' src="<?php echo $this->theme->getBaseUrl() . '/img/super_powers/creative_visionary_white.svg'; ?>" alt="" />
        <img width='200em' height='200em' src="<?php echo $this->theme->getBaseUrl() . '/img/super_powers/deep_collaborator_white.svg'; ?>" alt="" />
      </div>
      <div class="right-side">
        <img width='200em' height='200em' src="<?php echo $this->theme->getBaseUrl() . '/img/super_powers/empathetic_activist_white.svg'; ?>" alt="" />
        <img width='200em' height='200em' src="<?php echo $this->theme->getBaseUrl() . '/img/super_powers/systems_thinker_white.svg'; ?>" alt="" />
      </div>
    </div>
    <br><br>

    <br><br>

    <div class="panel panel-default animated bounceIn" id="login-form"
         style="max-width: 300px; margin: 0 auto 20px; text-align: left;">

        <div class="panel-heading"><?php echo Yii::t('UserModule.views_auth_login', '<strong>Please</strong> sign in'); ?></div>

        <div class="panel-body">

            <?php $form = ActiveForm::begin(['id' => 'account-login-form', 'enableClientValidation'=>false]); ?>

            <p><?php echo Yii::t('UserModule.views_auth_login', "If you're already a member, please login with your username/email and password."); ?></p>

            <?php echo $form->field($model, 'username')->textInput(['id' => 'login_username', 'placeholder' => $model->getAttributeLabel('username')])->label(false); ?>
            <?php echo $form->field($model, 'password')->passwordInput(['id' => 'login_password', 'placeholder' => $model->getAttributeLabel('password')])->label(false); ?>
            <?php echo $form->field($model, 'rememberMe')->checkbox(); ?>

            <hr>
            <div class="row">
                <div class="col-md-4">
                    <?php echo CHtml::submitButton(Yii::t('UserModule.views_auth_login', 'Sign in'), array('id' => 'login-button', 'class' => 'btn btn-large btn-primary')); ?>
                </div>
                <div class="col-md-8 text-right">
                    <small>
                        <?php echo Yii::t('UserModule.views_auth_login', 'Forgot your password?'); ?>
                        <a
                            href="<?php echo Url::toRoute('/user/auth/recover-password'); ?>"><br><?php echo Yii::t('UserModule.views_auth_login', 'Create a new one.') ?></a>
                    </small>
                </div>
            </div>

            <?php ActiveForm::end(); ?>

        </div>

    </div>

    <br>

    <?php if ($canRegister) : ?>
        <div id="register-form"
             class="panel panel-default animated bounceInLeft"
             style="max-width: 300px; margin: 0 auto 20px; text-align: left;">

            <div class="panel-heading"><?php echo Yii::t('UserModule.views_auth_login', '<strong>Sign</strong> up') ?></div>

            <div class="panel-body">

                <p><?php echo Yii::t('UserModule.views_auth_login', "Don't have an account? Join the network by entering your e-mail address."); ?></p>

                <?php $form = ActiveForm::begin(['id' => 'account-register-form']); ?>

                <?php echo $form->field($registerModel, 'email')->textInput(['id' => 'register-email', 'placeholder' => $registerModel->getAttributeLabel('email')])->label(false); ?>
                <hr>
                <?php echo CHtml::submitButton(Yii::t('UserModule.views_auth_login', 'Register'), array('class' => 'btn btn-primary')); ?>

                <?php ActiveForm::end(); ?>
            </div>
        </div>

    <?php endif; ?>

    <?= humhub\widgets\LanguageChooser::widget(); ?>
</div>

<script type="text/javascript">
    $(function () {
        // set cursor to login field
        $('#login_username').focus();
    })

    // Shake panel after wrong validation
<?php if ($model->hasErrors()) { ?>
        $('#login-form').removeClass('bounceIn');
        $('#login-form').addClass('shake');
        $('#register-form').removeClass('bounceInLeft');
        $('#app-title').removeClass('fadeIn');
<?php } ?>

    // Shake panel after wrong validation
<?php if ($registerModel->hasErrors()) { ?>
        $('#register-form').removeClass('bounceInLeft');
        $('#register-form').addClass('shake');
        $('#login-form').removeClass('bounceIn');
        $('#app-title').removeClass('fadeIn');
<?php } ?>

window.onload = function() {
    var s = document.createElement('script');
    s.type = 'text/javascript';
    s.async = true;
    s.src = '<?php echo $this->theme->getBaseUrl() . '/js/home-animation.js'; ?>';
    var x = document.getElementsByTagName('script')[0];
    x.parentNode.insertBefore(s, x);
}

</script>


<style>

  .home-animation {
    position: absolute;
    width: 100%;
  }

  .left-side, .right-side {
    width: 250px;
    display: inlin-block;
  }

  .left-side {
    float: left;
  }

  .right-side {
    float: right;
  }

</style>
