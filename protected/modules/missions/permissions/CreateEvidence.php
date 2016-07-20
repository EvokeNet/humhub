<?php

namespace humhub\modules\missions\permissions;

use humhub\modules\space\models\Space;

/**
 * CreatePost Permission
 */
class CreateEvidence extends \humhub\libs\BasePermission
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
    protected $title = "Create evidence";

    /**
     * @inheritdoc
     */
    protected $description = "Allows the user to create evidences";

    /**
     * @inheritdoc
     */
    protected $moduleId = 'evidences';

}
