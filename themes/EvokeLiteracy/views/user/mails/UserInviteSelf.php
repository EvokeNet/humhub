<?php

use yii\helpers\Url;
use yii\helpers\Html;
use humhub\models\Setting;
?>
<tr>
    <td align="center" valign="top" class="fix-box">

        <!-- start  container width 600px -->
        <table width="600" align="center" border="0" cellspacing="0" cellpadding="0" class="container"
               style="background-color: #ffffff; ">


            <tr>
                <td valign="top">

                    <!-- start container width 560px -->
                    <table width="540" align="center" border="0" cellspacing="0" cellpadding="0" class="full-width"
                           bgcolor="#ffffff" style="background-color:#ffffff;">


                        <!-- start text content -->
                        <tr>
                            <td valign="top">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                                    <tr>
                                        <td valign="top" width="auto" align="center">
                                            <!-- start button -->
                                            <table border="0" align="center" cellpadding="0" cellspacing="0">
                                                <tr>
                                                    <td width="auto" align="center" valign="middle" height="28"
                                                        style=" background-color:#ffffff; background-clip: padding-box; font-size:26px; font-family:Open Sans, Arial,Tahoma, Helvetica, sans-serif; text-align:center;  color:#a3a2a2; font-weight: 300; padding-left:18px; padding-right:18px; ">

                                                        <span style="color: #254054; font-weight: 300;">
                                                            <?php echo Yii::t('UserModule.views_mails_UserInviteSelf', 'Welcome to %appName%', array('%appName%' => '<strong>' . Html::encode(Yii::$app->name) . '</strong>')); ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                            </table>
                                            <!-- end button -->
                                        </td>
                                    </tr>


                                </table>
                            </td>
                        </tr>
                        <!-- end text content -->


                    </table>
                    <!-- end  container width 560px -->
                </td>
            </tr>
        </table>
        <!-- end  container width 600px -->
    </td>
</tr>


<tr>
    <td align="center" valign="top" class="fix-box">

        <!-- start  container width 600px -->
        <table width="600" align="center" border="0" cellspacing="0" cellpadding="0" class="container"
               style="background-color: #ffffff; ">


            <tr>
                <td valign="top">

                    <!-- start container width 560px -->
                    <table width="540" align="center" border="0" cellspacing="0" cellpadding="0" class="full-width"
                           bgcolor="#ffffff" style="background-color:#ffffff;">


                        <!-- start text content -->
                        <tr>
                            <td valign="top">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">


                                    <!-- start text content -->
                                    <tr>
                                        <td valign="top">
                                            <table border="0" cellspacing="0" cellpadding="0" align="center">


                                                <!--start space height -->
                                                <tr>
                                                    <td height="15"></td>
                                                </tr>
                                                <!--end space height -->

                                                <tr>
                                                    <td style="font-size: 14px; line-height: 22px; font-family:Open Sans,Arial,Tahoma, Helvetica, sans-serif; color:#254054; font-weight:300; text-align:center; ">

                                                        <?php // echo Yii::t('UserModule.views_mails_UserInviteSelf', 'Please click on the button below to proceed with your registration!'); ?>
                                                        
                                                        <img src="http://i.imgur.com/cQsndoX.png" width = "120px" style = "border-radius: 50%; border: 3px solid #254054; margin-bottom:10px">
                                                        
                                                        <p style = "font-style:italic">&ldquo;<?php echo Yii::t('UserModule.views_mails_UserInviteSelf', 'This is Alchemy, and this is an Urgent Evoke. Wherever you are, whoever you are, if you found this message, it\'s your destiny to join us.'); ?>&rdquo;</p>
                                                        
                                                        <p><?php echo Yii::t('UserModule.views_mails_UserInviteSelf', 'Evoke is a network of social innovators that use their powers to save the world. And this is an invitation to join us.<br><br>During the next 16 weeks you and your team will complete 8 missions and create with the community an Evokation -- your team project that seeks to solve problems in your community of Soacha.  At the end of this journey, the Evoke network will recognize the best Evokations.<br><br>Evoke is counting on you'); ?></p>

                                                    </td>
                                                </tr>

                                                <!--start space height -->
                                                <tr>
                                                    <td height="15"></td>
                                                </tr>
                                                <!--end space height -->


                                            </table>
                                        </td>
                                    </tr>
                                    <!-- end text content -->

                                    <tr>
                                        <td valign="top" width="auto" align="center">
                                            <!-- start button -->
                                            <table border="0" align="center" cellpadding="0" cellspacing="0" style = "margin-top:10px">
                                                <tr>
                                                    <td width="auto" align="center" valign="middle" height="32"
                                                        style=" background-color:none;  border-radius:5px; background-clip: padding-box;font-size:14px; font-family:Open Sans, Arial,Tahoma, Helvetica, sans-serif; text-align:center;  color:#ffffff; font-weight: 600; padding-left:30px; padding-right:30px; padding-top: 5px; padding-bottom: 5px;">

                                                        <a href="<?php echo Url::toRoute(["/user/auth/create-account", 'token' => $token], true); ?>" 
                                                            style="
                                                                border-radius: 3px;
                                                                padding: 8px 16px;
                                                                background: #3399E1;
                                                                color: white !important;
                                                                text-decoration: none;
                                                                width: 140px;
                                                                border-bottom: 2px solid #254054;">
                                                            <strong><?php echo Yii::t('UserModule.views_mails_UserInviteSelf', 'Sign Up'); ?></strong>
                                                        </a>
                                                            
                                                    </td>

                                                </tr>
                                            </table>
                                            <!-- end button -->
                                        </td>

                                    </tr>

                                </table>
                            </td>
                        </tr>
                        <!-- end text content -->

                        <!--start space height -->
                        <tr>
                            <td height="20"></td>
                        </tr>
                        <!--end space height -->


                    </table>
                    <!-- end  container width 560px -->
                </td>
            </tr>
        </table>
        <!-- end  container width 600px -->
    </td>
</tr>