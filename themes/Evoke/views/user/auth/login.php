<?php

use \yii\helpers\Url;
use yii\widgets\ActiveForm;
use \humhub\compat\CHtml;

$this->pageTitle = Yii::t('UserModule.views_auth_login', 'Login');
?>

<div class="container" style="text-align: center;">
    <?= humhub\widgets\SiteLogo::widget(['place' => 'login']); ?>

    <div id="homeAnimation" class="">
      <svg class='draw' width="20em" height="20em" viewBox="0 0 400 400" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
          <!-- Generator: Sketch 3.8.3 (29802) - http://www.bohemiancoding.com/sketch -->
          <title>creative_visionary</title>
          <desc>Created with Sketch.</desc>
          <defs></defs>
          <g id="super-powers" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
              <g id="creative_visionary">
                  <g id="Group" transform="translate(77.000000, 90.000000)">
                      <g id="vision" transform="translate(20.000000, 105.000000)" stroke="#fff" stroke-width="4">
                          <path d="M85.730993,58 L44.2901424,58 C44.2871932,58.2413102 44.2857143,58.4829798 44.2857143,58.725 C44.2857143,90.357109 69.5496463,116 100.714286,116 C131.878925,116 157.142857,90.357109 157.142857,58.725 C157.142857,27.092891 131.878925,1.45 100.714286,1.45 C100.475842,1.45 100.237744,1.45150111 100,1.45449454 L100,43.5169579 C100.236702,43.5056947 100.474839,43.5 100.714286,43.5 C108.998557,43.5 115.714286,50.3164647 115.714286,58.725 C115.714286,67.1335353 108.998557,73.95 100.714286,73.95 C92.4300145,73.95 85.7142857,67.1335353 85.7142857,58.725 C85.7142857,58.4819612 85.7198962,58.2402525 85.730993,58 Z" id="Combined-Shape"></path>
                          <path d="M100,116 C168.020339,116 200,58 200,58 C200,58 160,7.72715225e-15 100,0 C40,-5.15143483e-15 0,58 0,58 C0,58 31.9796607,116 100,116 Z" id="Oval-8"></path>
                          <ellipse id="Oval-9-Copy-2" cx="100.714286" cy="58.725" rx="56.4285714" ry="57.275"></ellipse>
                          <ellipse id="Oval-9-Copy" cx="100.714286" cy="58.725" rx="15" ry="15.225"></ellipse>
                      </g>
                      <circle id="Oval-8" stroke="#fff" stroke-width="4" cx="56" cy="29" r="10"></circle>
                      <circle id="Oval-8-Copy-2" stroke="#fff" stroke-width="4" cx="52" cy="83" r="4"></circle>
                      <circle id="Oval-8-Copy-4" stroke="#fff" stroke-width="4" transform="translate(238.660254, 115.660254) rotate(-240.000000) translate(-238.660254, -115.660254) " cx="238.660254" cy="115.660254" r="5"></circle>
                      <circle id="Oval-8-Copy-3" stroke="#fff" stroke-width="4" transform="translate(210.464102, 37.464102) rotate(-240.000000) translate(-210.464102, -37.464102) " cx="210.464102" cy="37.4641016" r="4"></circle>
                      <circle id="Oval-8-Copy" fill="#fff" cx="172.5" cy="76.5" r="6.5"></circle>
                      <circle id="Oval-8-Copy-5" fill="#fff" cx="102.5" cy="6.5" r="6.5"></circle>
                      <g id="twinkle" transform="translate(124.000000, 1.000000)" stroke="#fff" stroke-width="4" stroke-linecap="round">
                          <path d="M8,0.5 L8,54.5" id="Line"></path>
                          <path d="M20,27 L0,27" id="Line-Copy"></path>
                      </g>
                      <g id="twinkle" transform="translate(0.000000, 66.000000)" stroke="#fff" stroke-width="3" stroke-linecap="round">
                          <path d="M7.8,0.436363636 L7.8,47.5636364" id="Line"></path>
                          <path d="M12,25.0909091 L0,25.0909091" id="Line-Copy"></path>
                      </g>
                  </g>
              </g>
          </g>
      </svg>

      <style media="screen">
      svg.draw {
        max-width: 95%;
        max-height: 95%;
        /*position: absolute;*/
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        margin: auto;
      }
      svg path {
        fill-opacity: 0;
        stroke: #fff;
        stroke-width: 3;
        stroke-dasharray: 870;
        stroke-dashoffset: 870;
        animation: draw 10s forwards linear;
      }

      @keyframes draw {
        to {
          stroke-dashoffset: 0;
        }
      }
      </style>
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
