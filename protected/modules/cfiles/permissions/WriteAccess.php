<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\cfiles\permissions;

use humhub\modules\space\models\Space;

/**
 * WriteAccess Permission
 */
class WriteAccess extends \humhub\libs\BasePermission
{

    /**
     * @inheritdoc
     */
    public $defaultAllowedGroups = [
        Space::USERGROUP_OWNER,
        Space::USERGROUP_ADMIN,
        Space::USERGROUP_MODERATOR,
        Space::USERGROUP_MEMBER,
    ];

    /**
     * @inheritdoc
     */
    protected $fixedGroups = [
        Space::USERGROUP_USER,
        Space::USERGROUP_GUEST
    ];

    /**
     * @inheritdoc
     */
    protected $title = "Write access";

    /**
     * @inheritdoc
     */
    protected $description = "Allows the user to add or modify files";

    /**
     * @inheritdoc
     */
    protected $moduleId = 'cfiles';

}
