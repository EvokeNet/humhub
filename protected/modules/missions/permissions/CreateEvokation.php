<?php

namespace humhub\modules\missions\permissions;

use Yii;
use humhub\modules\space\models\Space;

/**
 * CreateEvokation Permission
 */
class CreateEvokation extends \humhub\libs\BasePermission
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
        Space::USERGROUP_USER
    ];

    /**
     * @inheritdoc
     */
    protected $title = "Create evokation";

    /**
     * @inheritdoc
     */
    protected $description = "Allows the users to create evokations";

    /**
     * @inheritdoc
     */
    protected $moduleId = 'evokation';

}
