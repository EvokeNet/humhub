<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use humhub\compat\CHtml;

?>

<tr>
    <td align="center" valign="top" class="fix-box">

        <!-- start  container width 600px -->
        <table width="600" align="center" border="0" cellspacing="0" cellpadding="0" class="container"
               style="background-color: #ffffff; border-bottom-left-radius: 4px; border-bottom-right-radius: 4px;">


            <tr>
                <td valign="top">

                    <!-- start container width 560px -->
                    <table width="540" align="center" border="0" cellspacing="0" cellpadding="0" class="full-width"
                           bgcolor="#ffffff" style="background-color:#ffffff;">


                        <!-- start text content -->
                        <tr>
                            <td valign="top">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">

                                    <h1 style="text-align:center"><?php echo Yii::t('MissionsModule.base', 'Hey {user}', array('user' => $user->username)); ?></h1>
                                    <!-- start text content -->
                                    <tr>
                                        <td valign="top">
                                            <table border="0" cellspacing="0" cellpadding="0" align="center">

                                                <tr>
                                                    <td style="font-size: 14px; line-height: 22px; font-family:Open Sans,Arial,Tahoma, Helvetica, sans-serif; color:#777777; font-weight:300; text-align:center; ">
                                                        
                                                        <div>
                                                            <h3><?php echo Yii::t('MissionsModule.base', 'Your evidence was just reviewed'); ?></h3>
                                                            <?php echo Html::a(Yii::t('MissionsModule.base', Yii::t('MissionsModule.base', 'Click here to see it')), ['/content/perma', 'id' => $evidence_link], ['class' => 'btn btn-success btn-sm']); ?>
                                                        </div>

                                                    </td>
                                                </tr>


                                            </table>
                                        </td>
                                    </tr>
                                    <!-- end text content -->


                                </table>
                            </td>
                        </tr>
                        <!-- end text content -->

                        <!--start space height -->
                        <tr>
                            <td height="15"></td>
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
