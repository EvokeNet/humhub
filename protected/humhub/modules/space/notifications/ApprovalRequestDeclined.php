<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\space\notifications;

use humhub\modules\notification\components\BaseNotification;

/**
 * SpaceApprovalRequestDeclinedNotification
 *
 * @since 0.5
 */
class ApprovalRequestDeclined extends BaseNotification
{

    /**
     * @inheritdoc
     */
    public $moduleId = "space";

    /**
     * @inheritdoc
     */
    public $viewName = "approvalRequestDeclined";

}

?>
